<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in.");
}

$userId = $_SESSION['user_id'];
$calories = $_POST['calories'];
$steps = $_POST['steps'];
$water = $_POST['water'];
$sleep = $_POST['sleep'];

// Check if any of the POST values are empty
if (empty($calories) || empty($steps) || empty($water) || empty($sleep)) {
    die("Error: All goal fields are required.");
}

// Check if the user already has goals set
$check = $conn->prepare("SELECT user_id FROM goals WHERE user_id = ?");
if (!$check) {
    die("Prepare failed: " . $conn->error);
}
$check->bind_param("i", $userId);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    // Update existing goals
    $sql = "UPDATE goals SET calorie_target=?, steps_target=?, water_goal=?, sleep_goal=? WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Update prepare failed: " . $conn->error);
    }
    $stmt->bind_param("iidii", $calories, $steps, $water, $sleep, $userId);
} else {
    // Insert new goals
    $sql = "INSERT INTO goals (user_id, calorie_target, steps_target, water_goal, sleep_goal) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Insert prepare failed: " . $conn->error);
    }
    $stmt->bind_param("iiidi", $userId, $calories, $steps, $water, $sleep);
}

// Execute the statement and check for errors
if ($stmt->execute()) {
    header("Location: dashboard.php");
    exit;
} else {
    die("Execution failed: " . $stmt->error);
}
?>
