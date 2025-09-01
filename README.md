# tq_family_expense_raw_php
# create a config.php and paste the following code
<?php
session_start();

$host = 'localhost';
$db   = 'family_expense_manager';
$user = 'root';
$pass = 'password'; // Change as per your MySQL password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>