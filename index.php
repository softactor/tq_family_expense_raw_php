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

$sql = "SELECT * FROM expenses WHERE user_id='$userId' ORDER BY date DESC";
$result = $conn->query($sql);

$sqlTotal = "SELECT SUM(amount) as total FROM expenses WHERE user_id='$userId'";
$totalResult = $conn->query($sqlTotal);
$total = $totalResult->fetch_assoc()['total'] ?? 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Family Expense Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Family Expense Manager</h2>
    <p>Welcome, <?php echo htmlspecialchars($user); ?>! <a href="logout.php">Logout</a></p>
    <p><a href="add_expense.php">Add New Expense</a></p>
    <p><a href="report.php">View Date-wise Report</a></p>
    <h3>Total Expenses: $<?php echo number_format($total,2); ?></h3>
    <table border="1" cellpadding="8">
        <tr>
            <th>Date</th>
            <th>Category</th>
            <th>Description</th>
            <th>Amount</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['date']); ?></td>
            <td><?php echo htmlspecialchars($row['category']); ?></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
            <td>$<?php echo number_format($row['amount'],2); ?></td>
            <td>
                <a href="expense_edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="expense_delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this expense?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>