<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db.php';
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

// Check if email and password are not empty
if (empty($email) || empty($password)) {
    die("Error: Email and password are required.");
}

// Prepare the SQL statement to avoid SQL injection
$sql = "SELECT * FROM users WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    // Verify password
    if (password_verify($password, $user['password'])) {
        // Set the session variable with user ID
        $_SESSION['user_id'] = $user['id'];
        // Redirect to the dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "User not found.";
}
?>
