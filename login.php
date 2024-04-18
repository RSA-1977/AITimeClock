<?php
session_start();

$db = new PDO('mysql:host=localhost;dbname=TimeClock', 'username', 'password');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT id, password, is_supervisor FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_supervisor'] = $user['is_supervisor'];
        header('Location: ' . ($user['is_supervisor'] ? 'supervisor.php' : 'employee.php'));
        exit;
    } else {
        $error = 'Invalid username or password!';
    }
}
?>
