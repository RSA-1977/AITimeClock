<?php
include 'config.php'; // Contains $conn for MySQL connection

$username = 'supervisor';
$password = 'password1234';

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and execute the SQL statement to insert the user
$query = $conn->prepare("INSERT INTO users (username, password, is_supervisor) VALUES (?, ?, ?)");
$is_supervisor = 1; // Set is_supervisor to 0 (false) for regular user
$query->bind_param("ssi", $username, $hashed_password, $is_supervisor);
$query->execute();

// Check if the user was successfully inserted
if ($query->affected_rows > 0) {
    echo "User inserted successfully";
} else {
    echo "Error inserting user: " . $conn->error;
}

// Close the connection
$conn->close();
?>
