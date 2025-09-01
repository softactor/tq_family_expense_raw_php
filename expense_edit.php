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
$sql = "SELECT * FROM expenses WHERE id='$id' AND user_id='$userId'";
$res = $conn->query($sql);
if ($res->num_rows != 1) {
    header('Location: index.php');
    exit();
}
$row = $res->fetch_assoc();

if (isset($_POST['date'])) {
    $date = $_POST['date'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];

    $sql = "UPDATE expenses SET date='$date', category='$category', description='$description', amount='$amount' WHERE id='$id' AND user_id='$userId'";
    $conn->query($sql);
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Expense - Family Expense Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Expense</h2>
    <form method="POST">
        <label>Date:</label><br>
        <input type="date" name="date" value="<?php echo $row['date']; ?>" required><br>
        <label>Category:</label><br>
        <input type="text" name="category" value="<?php echo htmlspecialchars($row['category']); ?>" required><br>
        <label>Description:</label><br>
        <input type="text" name="description" value="<?php echo htmlspecialchars($row['description']); ?>"><br>
        <label>Amount:</label><br>
        <input type="number" name="amount" step="0.01" value="<?php echo $row['amount']; ?>" required><br><br>
        <button type="submit">Update Expense</button>
    </form>
    <p><a href="index.php">Back to Dashboard</a></p>
</body>
</html>