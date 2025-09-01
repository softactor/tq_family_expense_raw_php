-- Create database
CREATE DATABASE family_expense_manager;

USE family_expense_manager;

-- Create users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Insert default user
INSERT INTO users (username, password) VALUES ('family', MD5('1234'));

-- Create expenses table
CREATE TABLE expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    date DATE NOT NULL,
    category VARCHAR(50) NOT NULL,
    description VARCHAR(255),
    amount DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);