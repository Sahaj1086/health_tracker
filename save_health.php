<?php
session_start();
include "db.php";

$userId = $_SESSION['user_id'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$blood_group = $_POST['blood_group'];

$sql = "INSERT INTO health_profile (user_id, height, weight, blood_group) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("idds", $userId, $height, $weight, $blood_group);
$stmt->execute();
header("Location: goals_profile.php");
?>
