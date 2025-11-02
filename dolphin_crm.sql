DROP DATABASE IF EXISTS dolphin_crm;
CREATE DATABASE IF NOT EXISTS dolphin_crm;
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;
USE dolphin_crm;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    role VARCHAR(50) NOT NULL,              -- admin, user, etc.
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50),
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(150),
    telephone VARCHAR(50),
    company VARCHAR(150),
    type ENUM('sales lead', 'support') NOT NULL,
    assigned_to INT NOT NULL,                -- FK to users.id
    created_by INT NOT NULL,                 -- FK to users.id
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,

    -- Foreign keys
    CONSTRAINT fk_contacts_assigned_to
        FOREIGN KEY (assigned_to) REFERENCES users(id)
        ON DELETE SET NULL ON UPDATE CASCADE,

    CONSTRAINT fk_contacts_created_by
        FOREIGN KEY (created_by) REFERENCES users(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contact_id INT NOT NULL,                 -- FK to contacts.id
    comment TEXT NOT NULL,
    created_by INT NOT NULL,                 -- FK to users.id
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    -- Foreign keys
    CONSTRAINT fk_notes_contact
        FOREIGN KEY (contact_id) REFERENCES contacts(id)
        ON DELETE CASCADE ON UPDATE CASCADE,

    CONSTRAINT fk_notes_user
        FOREIGN KEY (created_by) REFERENCES users(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);


LOCK TABLES `users` WRITE;

INSERT INTO users (firstname, lastname, email, password, role) VALUES ('Jane', 'Doe', 'admin@project2.com', 'password123', 'admin');

UNLOCK TABLES;