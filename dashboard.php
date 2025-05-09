<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include "db.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];

// Fetch user details from the database
$userQuery = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
$userQuery->bind_param("i", $userId);
$userQuery->execute();
$userData = $userQuery->get_result()->fetch_assoc();

// Fetch goals from the database
$goalsQuery = $conn->prepare("SELECT calorie_target, steps_target, water_goal, sleep_goal FROM goals WHERE user_id = ?");
$goalsQuery->bind_param("i", $userId);
$goalsQuery->execute();
$goalsData = $goalsQuery->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Fitness Dashboard</title>
  <link rel="stylesheet" href="dash.css" />
  <style>
    .arrow {
      font-size: 24px;
      font-weight: bold;
      transform-origin: center;
      transition: transform 0.3s ease;
      opacity: 1;
    }
    .arrow.move { fill: #ff3d57; }
    .arrow.exercise { fill: #00ff85; }
    .arrow.stand { fill: #00e5ff; }
    

    /* Profile Circle Styling */
    .profile-pic {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      overflow: hidden; /* Ensures the image is clipped within the circle */
      cursor: pointer;
    }
    .profile-pic img {
      width: 100%;
      height: 100%;
      object-fit: cover; /* Ensures the image covers the circle properly */
    }
    .profile-pic:hover {
      background-color: #aaa;  /* Hover effect */
    }
  </style>
</head>
<body>
  <div class="top-bar">
    <h2 class="title">My Dashboard</h2>
    <div class="profile-pic">
      <img src="your-profile-image.jpg" alt="Profile" /> <!-- Replace with your profile image path -->
    </div>
  </div>

  <div class="container">
    <div class="circle-section">
      <svg width="240" height="240" viewBox="0 0 240 240" class="activity-rings">
        <!-- Background Rings -->
        <circle class="ring-bg" cx="120" cy="120" r="100" stroke="#e6e6e6" stroke-width="15" fill="none"/>
        <circle class="ring-bg" cx="120" cy="120" r="75" stroke="#e6e6e6" stroke-width="15" fill="none"/>
        <circle class="ring-bg" cx="120" cy="120" r="50" stroke="#e6e6e6" stroke-width="15" fill="none"/>

        <!-- Foreground Rings -->
        <circle class="ring move" cx="120" cy="120" r="100" stroke="#ff3d57" stroke-width="15" fill="none"/>
        <circle class="ring exercise" cx="120" cy="120" r="75" stroke="#00ff85" stroke-width="15" fill="none"/>
        <circle class="ring stand" cx="120" cy="120" r="50" stroke="#00e5ff" stroke-width="15" fill="none"/>

        <!-- Arrows -->
        <text id="arrowMove" class="arrow move" x="120" y="50" text-anchor="middle" font-size="20" transform="rotate(0, 120, 120)">➤</text>
        <text id="arrowExercise" class="arrow exercise" x="120" y="80" text-anchor="middle" font-size="20" transform="rotate(0, 120, 120)">➤</text>
        <text id="arrowStand" class="arrow stand" x="120" y="110" text-anchor="middle" font-size="20" transform="rotate(0, 120, 120)">➤</text>
      </svg>

      <div class="stats-row">
        <div class="stat-box"><strong>Move</strong><br><span id="moveText">0/800 KCAL</span></div>
        <div class="stat-box"><strong>Exercise</strong><br><span id="exerciseText">0/60 MIN</span></div>
        <div class="stat-box"><strong>Stand</strong><br><span id="standText">0/6 HRS</span></div>
      </div>
    </div>

    <div class="info-grid">
      <div class="info-box"><h4><a href="meal.php" class="info-link">Meal Tracker</a></h4><p>Logged Meals</p></div>
      <div class="info-box"><h4><a href="reports.php" class="info-link">Progress </a></h4><p>Mark your fitness reports</p></div>
      <div class="info-box"><h4><a href="activity.php" class="info-link">Activity</a></h4><p>Indoor Walk</p></div>
      <div class="info-box"><h4><a href="share.php" class="info-link">Sharing</a></h4><p>Compare your progress</p></div>
    </div>
  </div>
  
  <script>
    const data = {
      move: { current: 500, goal: 800, radius: 100, label: "moveText", unit: "KCAL", arrowId: "arrowMove" },
      exercise: { current: 30, goal: 60, radius: 75, label: "exerciseText", unit: "MIN", arrowId: "arrowExercise" },
      stand: { current: 4, goal: 6, radius: 50, label: "standText", unit: "HRS", arrowId: "arrowStand" },
    };

    function animateRing(id, radius, percent) {
      const circle = document.querySelector(`.${id}`);
      const circumference = 2 * Math.PI * radius;
      const offset = circumference * (1 - percent);
      circle.style.strokeDasharray = `${circumference}`;
      circle.style.strokeDashoffset = offset;
    }

    function updateArrow(arrowId, percent) {
      const angle = 360 * percent; // Calculate the angle based on the percentage
      const arrow = document.getElementById(arrowId);
      arrow.setAttribute("transform", `rotate(${angle}, 120, 120)`); // Rotate the arrow around the center
    }

    function updateRings() {
      for (let key in data) {
        const { current, goal, radius, label, unit, arrowId } = data[key];
        const percent = Math.min(current / goal, 1);
        animateRing(key, radius, percent);
        document.getElementById(label).textContent = `${current}/${goal} ${unit}`;
        updateArrow(arrowId, percent); // Update the arrow position based on progress
      }
    }

    updateRings();
  
    // Get the profile circle element by its class (now in top-right)
    const profilePic = document.querySelector('.profile-pic');
    
    // Add an event listener to handle the click event
    if (profilePic) {
        profilePic.addEventListener('click', function() {
            // Redirect to the profile page when clicked
            window.location.href = 'profile.php';  // Make sure this is the correct path to your profile page
        });
    } else {
        console.log('Profile circle not found!');
    }
  </script>
</body>
</html>