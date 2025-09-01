<?php
require 'config.php';
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user = $_SESSION['user'];
$sqlUser = "SELECT id FROM users WHERE username='$user'";
$userIdResult = $conn->query($sqlUser);
$userId = $userIdResult->fetch_assoc()['id'];

if (isset($_POST['date'])) {
    $date = $_POST['date'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO expenses (user_id, date, category, description, amount) VALUES ('$userId', '$date', '$category', '$description', '$amount')";
    $conn->query($sql);
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Expense - Family Expense Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Add New Expense</h2>
    <form method="POST">
        <label>Date:</label><br>
        <input type="date" name="date" required><br>
        <label>Category:</label><br>
        <input type="text" name="category" required><br>
        <label>Description:</label><br>
        <input type="text" name="description"><br>
        <label>Amount:</label><br>
        <input type="number" name="amount" step="0.01" required><br><br>
        <button type="submit">Add Expense</button>
    </form>
    <p><a href="index.php">Back to Dashboard</a></p>
</body>
</html>