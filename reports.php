<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reports & Analytics - FitTrack</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #121212;
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

    .container {
      padding: 30px;
      max-width: 1200px;
      margin: auto;
    }

    h1 {
      font-size: 30px;
      font-weight: bold;
      margin-bottom: 10px;
      text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.2); /* Text shadow */
    }

    .subheading {
      color: #ccc;
      font-size: 16px;
      margin-bottom: 30px;
      text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.3); /* Text shadow */
    }

    .card {
      background-color: #1e1e1e;
      border-radius: 16px;
      box-shadow: 0 4px 16px rgba(255, 255, 255, 0.1);
      padding: 20px;
      margin-bottom: 30px;
    }

    .grid-2 {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
    }

    canvas {
      width: 100% !important;
      max-height: 250px !important;
    }

    .section-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 15px;
      color: #fff;
      text-shadow: 1px 1px 3px rgba(255, 255, 255, 0.4); /* Text shadow */
    }
  </style>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'].'/health_track/navbar.html'; ?>
  <div class="container">
    <h1>Reports & Analytics</h1>
    <div class="subheading">Visualize your health and fitness data</div>

    <div class="card">
      <div class="section-title">Weekly Step Count</div>
      <canvas id="stepChart"></canvas>
    </div>

    <div class="grid-2">
      <div class="card">
        <div class="section-title">Activity Duration by Type</div>
        <canvas id="activityChart"></canvas>
      </div>

      <div class="card">
        <div class="section-title">Water Intake </div>
        <canvas id="calorieChart"></canvas>
      </div>
    </div>
  </div>

  <script>
    // Weekly Step Count (Bar Chart)
    new Chart(document.getElementById('stepChart'), {
      type: 'bar',
      data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
          label: 'Steps',
          data: [4500, 6000, 7100, 8000, 9000, 9500, 11000],
          backgroundColor: '#A7F3D0', // Light turquoise
          borderColor: '#81E6D9', // Slightly darker turquoise
          borderWidth: 1,
          borderRadius: 10
        }]
      },
      options: {
        plugins: {
          legend: { display: false }
        },
        scales: {
          x: { ticks: { color: '#ccc' } },
          y: { ticks: { color: '#ccc' } }
        }
      }
    });

   // Activity Duration by Type (Doughnut Chart)
// Activity Duration by Type (Doughnut Chart)
// Activity Duration by Type (Doughnut Chart)
// Activity Duration by Type (Doughnut Chart)
new Chart(document.getElementById('activityChart'), {
  type: 'doughnut',
  data: {
    labels: ['Cardio', 'Strength', 'Pilates', 'Yoga'],
    datasets: [{
      data: [100, 200, 80, 50],
      backgroundColor: [
       '#FF6B6B',  // Cardio - Vibrant Rose Red
        '#4FC3F7',  // Strength - Sky Blue
        '#1DE9B6',  // Pilates - Aqua Green
        '#BA68C8'  // Yoga - Royal Purple
        
      ],
    
      borderWidth: 2,
      borderColor: '#121212'
    }]
  },
  options: {
    hover: {
      mode: null
    },
    plugins: {
      legend: {
        labels: { color: '#ccc' }
      },
      tooltip: {
        enabled: false
      }
    }
  }
});




    new Chart(document.getElementById('calorieChart'), {
  type: 'line',
  data: {
    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
    datasets: [{
      label: 'Water Intake (Liters)',
      data: [1.5, 2.0, 1.8, 2.2, 2.5, 3.0, 2.1], // Replace with your actual data
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
    plugins: {
      legend: {
        labels: {
          color: '#ccc'
        }
      },
      annotation: {
        annotations: {
          goalLine: {
            type: 'line',
            yMin: 2,
            yMax: 2,
            borderColor: 'rgba(255, 99, 132, 0.8)',
            borderWidth: 2,
            label: {
              content: 'Goal: 2L/day',
              enabled: true,
              position: 'start',
              color: '#fff'
            }
          }
        }
      }
    },
    scales: {
      x: {
        ticks: {
          color: '#ccc'
        }
      },
      y: {
        min: 0,
        max: 4.5,
        ticks: {
          stepSize: 0.5,
          color: '#ccc',
          callback: function(value) {
            return value + 'L';
          }
        },
        grid: {
          color: 'rgba(255, 255, 255, 0.1)'
        }
      }
    }
  }
});
  </script>

</body>
</html>