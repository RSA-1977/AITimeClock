<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_supervisor']) {
    header('Location: login.php');
    exit;
}

$db = new PDO('mysql:host=localhost;dbname=TimeClock', 'username', 'password');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $db->prepare("INSERT INTO shifts (user_id, start_time, end_time) VALUES (?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $_POST['start_time'], $_POST['end_time']]);
}

$stmt = $db->prepare("SELECT start_time, end_time FROM shifts WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$shifts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- HTML to display the form and shifts -->
