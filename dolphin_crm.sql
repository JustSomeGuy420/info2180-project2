DROP DATABASE IF EXISTS dolphin_crm;
CREATE DATABASE dolphin_crm;
USE dolphin_crm;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100),
    lastname VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role VARCHAR(100),
    created_at DATETIME
);

CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    firstname VARCHAR(100),
    lastname VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    telephone VARCHAR(100),
    company VARCHAR(100),
    type VARCHAR(100),
    assigned_to INT,
    created_by INT,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contact_id INT,
    comment TEXT,
    created_by INT,
    created_at DATETIME
);

LOCK TABLES `users` WRITE;

INSERT INTO users (firstname, lastname, email, password, role) VALUES ('Jane', 'Doe', 'admin@project2.com', 'password123', 'admin');

UNLOCK TABLES;