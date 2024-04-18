<?php
session_start();
if (!isset($_SESSION['user_id']) || !$_SESSION['is_supervisor']) {
    header('Location: index.php');
    exit();
}

include 'config.php';

$username = "";
$shifts = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];

    $stmt = $conn->prepare("SELECT start_time, end_time FROM shifts INNER JOIN users ON shifts.user_id = users.id WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $shifts[] = $row;
    }
    $stmt->close();
}
?>

<h1>Supervisor Dashboard</h1>
<form method="post">
    Search Username: <input type="text" name="username" value="<?= htmlspecialchars($username) ?>"><br>
    <button type="submit">Search</button>
</form>

<h2>Shift Records</h2>
<table>
    <tr>
        <th>Start Time</th>
        <th>End Time</th>
    </tr>
    <?php
    foreach ($shifts as $shift) {
        echo "<tr><td>" . $shift['start_time'] . "</td><td>" . $shift['end_time'] . "</td></tr>";
    }
    ?>
</table>
