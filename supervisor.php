<?php
session_start();
if (!isset($_SESSION['user_id']) || !$_SESSION['is_supervisor']) {
    header('Location: login.php');
    exit;
}

$db = new PDO('mysql:host=localhost;dbname=TimeClock', 'username', 'password');

$username = '';
$shifts = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $stmt = $db->prepare("SELECT s.start_time, s.end_time FROM shifts s JOIN users u ON s.user_id = u.id WHERE u.username = ?");
    $stmt->execute([$username]);
    $shifts = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!-- HTML to display the form and shifts -->
