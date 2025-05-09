<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pulse - Activity Tracking</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background-color: #010101;
      color: #ffffff;
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
    .cards {
      display: flex;
      gap: 20px;
      margin-top: 20px;
    }
    .card {
      background-color: #333;
      color: #fff;
      border-radius: 12px;
      text-shadow: 0 0 8px rgba(255, 255, 255, 0.25);
      padding: 20px;
      flex: 1;
      transition: transform 0.3s ease-in-out;
    }
    .card:hover {
      transform: scale(1.05);
    }
    .chart-container {
      margin-top: 80px;
      background: #222;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 0 30px rgba(255, 255, 255, 0.25);
      text-shadow: 0 0 8px rgba(255, 255, 255, 0.25);
      max-height: 500px;
    }
    .chart-container canvas {
      width: 100%;
      height: 400px;
    }
    .recent { color: #ffffff; }
    .records { margin-top: 30px; }
    .record {
      background-color: #333;
      padding: 15px 20px;
      border-radius: 10px;
      margin-bottom: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      text-shadow: 0 0 8px rgba(255, 255, 255, 0.25);
    }
    .record-info {
      display: flex;
      flex-direction: column;
    }
     /* Log Activity Button */
    button, .modal-content button {
      background: linear-gradient(135deg, #ff5252, #ff1744);
      color: white;
      border: none;
      border-radius: 8px;
      padding: 12px 20px;
      cursor: pointer;
      font-weight: bold;
      transition: all 0.3s ease-in-out;
      box-shadow: 0 4px 15px rgba(255, 82, 82, 0.3);
    }

    button:hover, .modal-content button:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(255, 82, 82, 0.4);
    }

    button:active, .modal-content button:active {
      transform: scale(0.98);
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0; top: 0;
      width: 100%; height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.7);
    }
    .modal-content {
      background-color: #1f1f1f;
      color: white;
      margin: 10% auto;
      padding: 30px;
      border-radius: 12px;
      width: 90%;
      max-width: 500px;
      box-shadow: 0 0 20px rgba(255,255,255,0.2);
      position: relative;
    }
    .modal-content h2 { margin-top: 0; }
    .modal-content label {
      display: block;
      margin: 15px 0 10px;
    }
    .modal-content input {
      width: 100%;
      padding: 10px;
      background: #2e2e2e;
      color: white;
      border: none;
      border-radius: 8px;
    }
    .close {
      position: absolute;
      top: 12px;
      right: 16px;
      font-size: 24px;
      cursor: pointer;
    }
    /* Gradient Underline Effect */
.gradient-link {
  position: relative;
  padding: 5px 0;
  color: #ffffff;
  text-decoration: none;
  font-weight: 600;
  transition: color 0.3s ease;
}

.gradient-link::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: linear-gradient(135deg, #ff5252, #ff1744); /* Gradient colors */
  transition: width 0.3s ease;
}

.gradient-link:hover::after {
  width: 100%;
}

.gradient-link:hover {
  color: #ff5252;
}

  </style>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'].'/health_track/navbar.html'; ?>

  <div class="main">
    <div id="logActivityModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Log New Activity</h2>
        <form id="logActivityForm">
          <label>Date: <input type="date" name="date" required /></label>
          <label>Total Steps: <input type="number" name="steps" required /></label>
          <label>Active Minutes: <input type="number" name="minutes" required /></label>
          <label>Distance (km): <input type="number" step="0.01" name="distance" required /></label>
          <label>Calories Burned: <input type="number" name="calories" required /></label>
          <button type="submit">Save Activity</button>
        </form>
      </div>
    </div>

    <div class="section-header">
      <div>
        <h1>Activity Tracking</h1>
        <p>Monitor and manage your physical activities</p>
      </div>
      <div>
        <button>+ Log Activity</button>
      </div>
    </div>

    <div class="cards">
      <div class="card"><h3>Total Steps</h3><p><strong>52,483</strong> ⬆️ 8%</p></div>
      <div class="card"><h3>Active Minutes</h3><p><strong>287</strong> ⬇️ 12%</p></div>
      <div class="card"><h3>Distance</h3><p><strong>23.6 km</strong> ⬆️ 5%</p></div>
      <div class="card"><h3>Calories Burned</h3><p><strong>4,812</strong> ⬇️ 10%</p></div>
    </div>

    <div class="chart-container">
      <canvas id="activityChart"></canvas>
    </div>

    <div class="records">
      <div class="recent"><h2>Recent Activities</h2></div>
      <div class="record"><div class="record-info"><span>Running - Today, 8:30 AM</span><span>Duration: 32 min | Distance: 4.2 km | Calories: 320</span></div></div>
      <div class="record"><div class="record-info"><span>Cycling - Yesterday, 5:45 PM</span><span>Duration: 45 min | Distance: 12.8 km | Calories: 410</span></div></div>
      <div class="record"><div class="record-info"><span>Walking - Apr 14, 12:20 PM</span><span>Duration: 38 min | Distance: 2.5 km | Calories: 180</span></div></div>
      <div class="record"><div class="record-info"><span>HIIT Workout - Apr 13, 7:00 AM</span><span>Duration: 25 min | Distance: 0 km | Calories: 280</span></div></div>
    </div>
  </div>

  <script>
    const modal = document.getElementById('logActivityModal');
    const openBtn = document.querySelector('.section-header button');
    const closeBtn = document.querySelector('.close');

    openBtn.onclick = () => modal.style.display = 'block';
    closeBtn.onclick = () => modal.style.display = 'none';
    window.onclick = (e) => { if (e.target == modal) modal.style.display = 'none'; };

    document.getElementById('logActivityForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const formData = new FormData(this);
      fetch('log_activity.php', {
        method: 'POST',
        body: formData
      }).then(res => {
        if (res.ok) {
          this.reset();
          modal.style.display = 'none';
          updateChart();
        }
      });
    });

    const ctx = document.getElementById('activityChart').getContext('2d');
    let activityChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [],
        datasets: [{
          label: 'Steps per Day',
          data: [],
          borderColor: '#81E6D9',
      backgroundColor: 'rgba(129, 230, 217, 0.2)',
      fill: true,
      tension: 0.4,
      pointBackgroundColor: '#81E6D9'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        layout: {
          padding: { top: 10, bottom: 10, left: 0, right: 0 }
        },
        scales: {
          x: {
            ticks: { color: '#fff' },
            grid: { color: 'rgba(255,255,255,0.1)' }
          },
          y: {
            beginAtZero: true,
            ticks: { color: '#fff', stepSize: 5000 },
            grid: { color: 'rgba(255,255,255,0.1)' }
          }
        }
      }
    });

    function updateChart() {
      fetch('get_activity_data.php')
        .then(res => res.json())
        .then(data => {
          activityChart.data.labels = data.map(entry => entry.activity_date);
          activityChart.data.datasets[0].data = data.map(entry => entry.steps);
          activityChart.update();
        });
    }

    updateChart();
  </script>
</body>
</html>
