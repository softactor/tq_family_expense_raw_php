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

$id = $_GET['id'];
$sql = "DELETE FROM expenses WHERE id='$id' AND user_id='$userId'";
$conn->query($sql);

header('Location: index.php');
exit();
?>