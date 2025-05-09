<?php
session_start();
include "db.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];

// Fetch user basic info
$userQuery = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
$userQuery->bind_param("i", $userId);
$userQuery->execute();
$userResult = $userQuery->get_result();
$userData = $userResult->fetch_assoc();

// Fetch health profile data
$healthQuery = $conn->prepare("SELECT height, weight, blood_group FROM health_profile WHERE user_id = ?");
$healthQuery->bind_param("i", $userId);
$healthQuery->execute();
$healthResult = $healthQuery->get_result();
$healthData = $healthResult->fetch_assoc();

// Fetch goals data
$goalsQuery = $conn->prepare("SELECT calorie_target, steps_target, water_goal, sleep_goal FROM goals WHERE user_id = ?");
$goalsQuery->bind_param("i", $userId);
$goalsQuery->execute();
$goalsResult = $goalsQuery->get_result();
$goalsData = $goalsResult->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Advanced Profile | Meal Planner</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * {margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif;}
    body {
      background:linear-gradient(135deg,#0a0a0a,#1a1a1a);
      color:#fff; padding:50px;
    }
    .profile-page {
      max-width:1100px; margin:0 auto;
      display:grid; grid-template-columns:300px 1fr; gap:30px;
      animation:fadeIn 0.8s ease forwards;
    }
    .sidebar,.main-content {
      background:rgba(255,255,255,0.04);
      border-radius:20px; padding:30px;
      backdrop-filter:blur(20px);
      box-shadow:0 8px 30px rgba(0,0,0,0.5);
      border:1px solid rgba(255,255,255,0.08);
    }
    .sidebar {text-align:center;}
    .name {font-size:24px; font-weight:700; margin:10px 0;}
    .main-content h2 {font-size:28px; margin-bottom:20px;}
    .info-section {
      margin: 20px 0;
      padding: 15px;
      background: rgba(255,255,255,0.06);
      border-radius: 8px;
    }
    .info-section h3 {
      margin-bottom: 10px;
      font-size: 22px;
      color: #4f46e5;
    }
    p {
      margin: 5px 0;
    }
    .form-group input, .form-group select {
      width:100%; padding:12px 15px;
      border-radius:12px; border:none;
      background:rgba(255,255,255,0.06); color:#fff;
      outline:none; font-size:14px; margin-bottom:10px;
    }
  </style>
</head>
<body>

<div class="profile-page">
  <div class="sidebar">
    <div class="name">
      <?php echo htmlspecialchars($userData['name']); ?>
    </div>
    <p><?php echo htmlspecialchars($userData['email']); ?></p>
  </div>

  <div class="main-content">
    <h2>Profile Settings</h2>

    <div class="info-section">
      <h3>Personal Information</h3>
      <p><strong>Name:</strong> <?php echo htmlspecialchars($userData['name']); ?></p>
      <p><strong>Email:</strong> <?php echo htmlspecialchars($userData['email']); ?></p>
    </div>

    <div class="info-section">
      <h3>Health Profile</h3>
      <p><strong>Height:</strong> <?php echo htmlspecialchars($healthData['height']); ?> cm</p>
      <p><strong>Weight:</strong> <?php echo htmlspecialchars($healthData['weight']); ?> kg</p>
      <p><strong>Blood Group:</strong> <?php echo htmlspecialchars($healthData['blood_group']); ?></p>
    </div>

    <div class="info-section">
      <h3>Fitness Goals</h3>
      <p><strong>Calorie Target:</strong> <?php echo htmlspecialchars($goalsData['calorie_target']); ?> kcal</p>
      <p><strong>Steps Target:</strong> <?php echo htmlspecialchars($goalsData['steps_target']); ?> steps</p>
      <p><strong>Water Goal:</strong> <?php echo htmlspecialchars($goalsData['water_goal']); ?> liters</p>
      <p><strong>Sleep Goal:</strong> <?php echo htmlspecialchars($goalsData['sleep_goal']); ?> hours</p>
    </div>
  </div>
</div>

</body>
</html>
