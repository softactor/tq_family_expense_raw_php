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

// Set default dates to this month
$start_date = date('Y-m-01');
$end_date = date('Y-m-t');

if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
}

$sql = "SELECT date, SUM(amount) as total FROM expenses WHERE user_id='$userId' AND date BETWEEN '$start_date' AND '$end_date' GROUP BY date ORDER BY date ASC";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Expense Report - Family Expense Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Expense Report (Date-wise)</h2>
    <form method="POST">
        <label>Start Date:</label>
        <input type="date" name="start_date" value="<?php echo $start_date; ?>" required>
        <label>End Date:</label>
        <input type="date" name="end_date" value="<?php echo $end_date; ?>" required>
        <button type="submit">Show Report</button>
    </form>
    <p><a href="index.php">Back to Dashboard</a></p>

    <h3>Expense Summary</h3>
    <table border="1" cellpadding="8">
        <tr>
            <th>Date</th>
            <th>Total Expense</th>
        </tr>
        <?php
        $grand_total = 0;
        while($row = $result->fetch_assoc()):
            $grand_total += $row['total'];
        ?>
        <tr>
            <td><?php echo htmlspecialchars($row['date']); ?></td>
            <td>$<?php echo number_format($row['total'],2); ?></td>
        </tr>
        <?php endwhile; ?>
        <tr>
            <th>Grand Total</th>
            <th>$<?php echo number_format($grand_total,2); ?></th>
        </tr>
    </table>
</body>
</html>