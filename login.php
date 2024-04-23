<?php
session_start();
include 'config.php'; // Contains $conn for MySQL connection

$username = $_POST['username'];
$password = $_POST['password'];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare the SQL statement to select the user
$query = $conn->prepare("SELECT id, password, is_supervisor FROM users WHERE username = ?");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();

if ($user = $result->fetch_assoc()) {
    // Verify hashed password
    if (password_verify($password, $user['password'])) {
        // Password is correct
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_supervisor'] = $user['is_supervisor'];
        header('Location: dashboard.php');
        exit(); // Stop further execution
    } else {
        // Password is incorrect
        echo "Invalid login";
    }
} else {
    // User not found
    echo "Invalid login";
}

// Close the connection
$conn->close();
?>
