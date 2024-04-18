<?php
session_start();
include 'config.php'; // Contains $conn for MySQL connection

$username = $_POST['username'];
$password = $_POST['password'];

$query = $conn->prepare("SELECT id, is_supervisor FROM users WHERE username = ? AND password = ?");
$query->bind_param("ss", $username, $password);
$query->execute();
$result = $query->get_result();

if ($user = $result->fetch_assoc()) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['is_supervisor'] = $user['is_supervisor'];
    header('Location: dashboard.php');
} else {
    echo "Invalid login";
}
?>
