<?php
$servername = "localhost";
$username = "root";
$password = "";  // Default for XAMPP
$database = "health_track";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
