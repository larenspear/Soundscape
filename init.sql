-- Create and select the database
CREATE DATABASE IF NOT EXISTS soundscape;
USE soundscape;

-- Create the USERS table
CREATE TABLE IF NOT EXISTS USERS (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE
);

-- Insert a sample user (password hashed with bcrypt)
INSERT INTO USERS (username, password, email) VALUES (
    'testuser',
    '$2y$10$wC1nPvlnAKvcrZ18KQ04peJk3MKY3PfRhOr04iNOq6m0d5CqzGZca', -- 'Test1234'
    'test@example.com'
);