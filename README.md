# Family Expense Manager

## Database Connection Setup

To connect your Family Expense Manager project to a MySQL database, create a file named `config.php` and add the following code:

```php
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
```

## Usage

1. **Create `config.php`:**  
   Copy the above code into a file named `config.php` in your project directory.

2. **Configure Credentials:**  
   Update `$user` and `$pass` with your MySQL username and password if they are different.

3. **Include in Your Project:**  
   Include `config.php` in your PHP files to use the database connection.

```
<?php
include 'config.php';
// Your code here
?>
```