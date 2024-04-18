<?php
// Database configuration settings
$host = 'localhost'; // or the IP address of your MySQL server
$dbname = 'TimeClock';
$username = 'admin'; // replace with your database username
$password = 'password'; // replace with your database password

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
