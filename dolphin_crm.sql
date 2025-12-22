DROP DATABASE IF EXISTS dolphin_crm;
CREATE DATABASE IF NOT EXISTS dolphin_crm;
USE dolphin_crm;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    role VARCHAR(50) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50),
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(150),
    telephone VARCHAR(50),
    company VARCHAR(150),
    type ENUM('Sales Lead', 'Support') NOT NULL,
    assigned_to INT NULL,    -- allow NULL because ON DELETE SET NULL
    created_by INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_contacts_assigned_to
        FOREIGN KEY (assigned_to) REFERENCES users(id)
        ON DELETE SET NULL ON UPDATE CASCADE,

    CONSTRAINT fk_contacts_created_by
        FOREIGN KEY (created_by) REFERENCES users(id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contact_id INT NOT NULL,
    comment TEXT NOT NULL,
    created_by INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_notes_contact
        FOREIGN KEY (contact_id) REFERENCES contacts(id)
        ON DELETE CASCADE ON UPDATE CASCADE,

    CONSTRAINT fk_notes_user
        FOREIGN KEY (created_by) REFERENCES users(id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

LOCK TABLES `users` WRITE;

INSERT INTO users (firstname, lastname, email, password, role) VALUES ('Jane', 'Doe', 'admin@project2.com', '$2y$10$IDXPWRCchz4X2HConEloXegfB9FwpzpyERxiDEVKkV/TRzTbgmtne', 'Admin');

UNLOCK TABLES;