<?php
session_start();
include "db.php";

$userId = $_SESSION['user_id'];
$sql = "SELECT activity_date, steps FROM activities WHERE user_id = ? ORDER BY activity_date";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);
?>
