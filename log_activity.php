<?php
session_start();
include "db.php";

$userId = $_SESSION['user_id'];
$date = $_POST['date'];
$steps = $_POST['steps'];
$minutes = $_POST['minutes'];
$distance = $_POST['distance'];
$calories = $_POST['calories'];

$sql = "INSERT INTO activities (user_id, activity_date, steps, active_minutes, distance, calories) 
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isiiid", $userId, $date, $steps, $minutes, $distance, $calories);
$stmt->execute();
echo "Activity logged";
?>
