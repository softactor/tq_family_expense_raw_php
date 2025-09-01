Family Expense Manager
This is a simple web application built with PHP for managing and tracking family expenses. It is designed to be a straightforward tool for households to log their spending, categorize expenses, and monitor their financial outgoings.
Getting Started
To get the application up and running, follow the steps below.
Prerequisites
You will need a web server environment that supports PHP and MySQL, such as XAMPP, WAMP, or MAMP.
Database Setup
Create the Database:
First, you need to create the MySQL database named family_expense_manager. You can do this using a tool like phpMyAdmin or by running the following SQL command:
CREATE DATABASE family_expense_manager;
USE family_expense_manager;


Create the expenses Table:
Next, create a table to store your expense records. This example includes fields for the expense amount, category, a brief description, and the date.
CREATE TABLE expenses (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    amount DECIMAL(10, 2) NOT NULL,
    category VARCHAR(255) NOT NULL,
    description TEXT,
    date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


Configuration
The provided config.php file is used to connect to your database. Make sure you update the credentials if they differ from the defaults.
$host: Your database host (usually localhost).
$db: The database name you created (family_expense_manager).
$user: Your MySQL username (default is root).
$pass: Your MySQL password. It is crucial to change the placeholder password to your actual MySQL password.
Here is the code for config.php:
<?php 
session_start(); 

$host = 'localhost'; 
$db   = 'family_expense_manager'; 
$user = 'root'; 
$pass = ''; // Change as per your MySQL password 

$conn = new mysqli($host, $user, $pass, $db); 

if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 
?>


Usage
Place all your PHP files (including config.php) in your web server's document root (e.g., htdocs for XAMPP). You can then access the application by navigating to the file's location in your web browser.
If you'd like to continue building this application, let me know if you need help with the main expense tracking page or the logic for adding and displaying data.
