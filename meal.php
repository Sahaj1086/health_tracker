<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Advanced Meal Planner Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background-color: #010101;
      color: #ffffff;
      text-shadow: 0 0 8px rgba(255, 255, 255, 0.25);
    }

    .navbar {
      color: #ffffff;
      text-align: center;
      padding: 20px;
      font-size: 19px;
      margin-top: 20px;
    }

    .navbar a {
      text-decoration: none;
      color: #ffffff;
      font-weight: 600;
      margin: 0 15px;
    }

    
    .navbar a.active {
  font-weight: bold;
  color: #ff5252; /* Primary red shade */
  background: linear-gradient(135deg, #ff5252, #ff1744); /* Gradient from red to dark red */
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  transition: color 0.3s ease;
}
    .main {
      margin-right: auto;
      padding: 40px;
    }
    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: #ffffff;
    }
    h1 {
      margin-bottom: 10px;
      text-shadow: 0 0 10px rgba(255,255,255,0.2);
      margin-top: 60px;
      margin-left: 40px;
    }

    p {
      color: #ffffff;
      margin-bottom: 40px;
      margin-left: 40px;
    }

    .container {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 25px;
      padding: 0 20px;
      animation: fadeIn 1s ease forwards;
    }

    @media (max-width: 900px) {
      .container {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 600px) {
      .container {
        grid-template-columns: 1fr;
      }
    }

    .card {
      background: rgba(255,255,255,0.05);
      border-radius: 20px;
      padding: 25px;
      backdrop-filter: blur(15px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.6);
      border: 1px solid rgba(255,255,255,0.05);
      position: relative;
      overflow: hidden;
      text-align: auto;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.8);
      background: rgba(255,255,255,0.08);
    }

    .card h3 {
  margin-bottom: 15px;
  font-size: 20px;
  font-weight: bold;
  color: #ff1744; /* Deeper red shade to match the theme */
  transition: color 0.3s ease;
}





    .card ul {
      list-style: none;
      padding-left: 0;
    }

    .card ul li {
      margin-bottom: 8px;
      color: #ccc;
    }

    .tag {
      display: inline-block;
      background: linear-gradient(135deg, #3f51b5, #5c6bc0);
      color: #fff;
      padding: 3px 10px;
      border-radius: 12px;
      font-size: 12px;
      margin-left: 10px;
    }
  </style>
</head>
<body>
 <!-- Include the navbar using an absolute path -->
 <?php include $_SERVER['DOCUMENT_ROOT'].'/health_track/navbar.html'; ?>

  <h1>Advanced Meal Planner</h1>
  <p>Track and plan every essential type of food your body needs, with macronutrients and micronutrients breakdown.</p>

  <div class="container">
    <div class="card">
      <h3>Monday</h3>
      <ul>
        <li>Oats / Muesli</span></li>
        <li>Eggs </li>
        <li>Greek Yogurt </li>
        <li>Cottage Cheese </li>
        <li>Lentils </li>
        <li>Tofu </li>
        <li>Whey Protein Shake </li>
      </ul>
    </div>

    <div class="card">
      <h3>Tuesday</h3>
      <ul>
        <li>Brown Rice </li>
        <li>Grilled Chicken </li>
        <li>Oats with Milk </li>
        <li>Chickpeas Salad </li>
        <li>Boiled Eggs </li>
        <li>Whey Protein Shake </li>
      </ul>
    </div>

    <div class="card">
      <h3>Wednesday</h3>
      <ul>
        <li>Quinoa Bowl </li>
        <li>Greek Yogurt with Fruits </li>
        <li>Steamed Broccoli </li>
        <li>Whole Wheat Roti </li>
        <li>Mixed Vegetable Curry </li>
        <li>Almonds & Walnuts </li>
      </ul>
    </div>

    <div class="card">
      <h3>Thursday</h3>
      <ul>
        <li>Scrambled Eggs </li>
        <li>Peanut Butter Toast </li>
        <li>Fruit Smoothie </li>
        <li>Lentil Soup </li>
        <li>Stir Fry Vegetables </li>
        <li>Cottage Cheese Cubes </li>
      </ul>
    </div>

    <div class="card">
      <h3>Friday</h3>
      <ul>
        <li>Spinach </li>
        <li>Broccoli </li>
        <li>Carrots </li>
        <li>Bananas </li>
        <li>Berries </li>
        <li>Grilled Salmon </li>
        <li>Sweet Potatoes </li>
      </ul>
    </div>

    <div class="card">
      <h3>Saturday</h3>
      <ul>
        <li>Oatmeal with Berries </li>
        <li>Grilled Fish </li>
        <li>Veg Sandwich </li>
        <li>Fruit Salad </li>
        <li>Protein Shake </li>
        <li>Roasted Chickpeas </li>
      </ul>
    </div>
  </div>
</body>
</html>