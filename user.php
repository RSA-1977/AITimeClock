<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_supervisor']) {
    header('Location: index.php');
    exit();
}

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $stmt = $conn->prepare("INSERT INTO shifts (user_id, start_time, end_time) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $_SESSION['user_id'], $start_time, $end_time);
    $stmt->execute();
    $stmt->close();
}

$query = $conn->prepare("SELECT start_time, end_time FROM shifts WHERE user_id = ?");
$query->bind_param("i", $_SESSION['user_id']);
$query->execute();
$result = $query->get_result();
?>

<h1>User Dashboard</h1>
<form method="post">
    Start Time: <input type="datetime-local" name="start_time" required><br>
    End Time: <input type="datetime-local" name="end_time" required><br>
    <button type="submit">Submit Shift</button>
</form>

<h2>Your Shift History</h2>
<table>
    <tr>
        <th>Start Time</th>
        <th>End Time</th>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['start_time'] . "</td><td>" . $row['end_time'] . "</td></tr>";
    }
    $query->close();
    ?>
</table>
