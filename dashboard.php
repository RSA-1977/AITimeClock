<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

if ($_SESSION['is_supervisor']) {
    include 'supervisor.php';
} else {
    include 'user.php';
}
?>
