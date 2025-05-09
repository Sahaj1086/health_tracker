<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Fitness Rings</title>
  <style>
    :root {
      --background: #000;
      --foreground: #fff;
      --secondary: #111;
      --border: #444;
      --highlight: 0, 0%, 100%;
      --muted-foreground: #999;
    }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: var(--background);
      color: var(--foreground);
    }

    header {
      position: sticky;
      top: 0;
      background: var(--background);
      padding: 16px;
      border-bottom: 1px solid var(--border);
      display: flex;
      justify-content: space-between;
      align-items: center;
      z-index: 10;
      margin-top: 30px;
    }

    header span {
      font-size: 14px;
      color: var(--foreground);
    }

    .container {
      padding: 24px 16px 80px;
      margin-top: 100px;
      margin-bottom: 30px;
    }

    .workout-box {
      background: var(--secondary);
      padding: 16px;
      border-radius: 12px;
      margin-bottom: 24px;
      box-shadow: 0 0 8px hsl(var(--highlight), 0.3);
    }

    .workout-box h2 {
      color: hsl(var(--highlight));
      font-size: 13px;
      margin-bottom: 4px;
    }

    .workout-box p {
      font-size: 14px;
    }

    .section-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 16px;
      color: hsl(var(--highlight));
      text-shadow: 0 0 6px hsl(var(--highlight));
      margin-top: 30px;
    }

    .card {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 16px;
      background: var(--secondary);
      border-radius: 12px;
      margin-bottom: 12px;
      box-shadow: 0 0 6px rgba(255, 255, 255, 0.1);
      transition: border 0.3s ease;
    }

    .card.current-user {
      border: 2px solid hsl(var(--highlight));
      box-shadow: 0 0 10px hsl(var(--highlight));
    }

    .profile {
      display: flex;
      align-items: center;
      gap: 12px;
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


    .profile img {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      object-fit: cover;
      background: #222;
    }

    .profile .info p {
      font-weight: bold;
      margin: 0;
    }

    .profile .info p.current {
      color: hsl(var(--highlight));
    }

    .profile .info span {
      display: inline-block;
      font-size: 12px;
      color: var(--muted-foreground);
      margin-right: 10px;
    }

    .activity-ring {
      width: 64px;
      height: 64px;
    }

    circle {
      transition: stroke-dashoffset 1s ease-out;
    }
  </style>
</head>
<body>

<?php include $_SERVER['DOCUMENT_ROOT'].'/health_track/navbar.html'; ?>
  <div class="container">
    <div class="workout-box">
      <h2>TODAY'S WORKOUT</h2>
      <p>221 KCAL – Traditional Strength Training</p>
    </div>

    <h2 class="section-title" id="activity-date">Activity Rings – </h2>

    <div id="friends-list"></div>
  </div>

  <script>
    document.getElementById('activity-date').textContent += new Date().toLocaleDateString(undefined, {
      weekday: 'long', month: 'long', day: 'numeric'
    });

    const data = [
      {
        id: "1",
        name: "Jane Smith",
        profilePic: "https://randomuser.me/api/portraits/women/44.jpg",
        move: { current: 620, goal: 650, percentage: 95 },
        exercise: { current: 45, goal: 45, percentage: 100 },
        stand: { current: 10, goal: 12, percentage: 83 }
      },
      {
        id: "2",
        name: "Mark Johnson",
        profilePic: "https://randomuser.me/api/portraits/men/32.jpg",
        move: { current: 540, goal: 700, percentage: 77 },
        exercise: { current: 38, goal: 45, percentage: 84 },
        stand: { current: 8, goal: 12, percentage: 67 }
      },
      {
        id: "3",
        name: "Sarah Wilson",
        profilePic: "https://randomuser.me/api/portraits/women/68.jpg",
        move: { current: 450, goal: 600, percentage: 75 },
        exercise: { current: 30, goal: 40, percentage: 75 },
        stand: { current: 9, goal: 12, percentage: 75 }
      },
      {
        id: "current-user",
        name: "You",
        profilePic: "https://randomuser.me/api/portraits/women/17.jpg",
        move: { current: 421, goal: 800, percentage: 53 },
        exercise: { current: 32, goal: 45, percentage: 71 },
        stand: { current: 7, goal: 12, percentage: 58 },
        isCurrentUser: true
      }
    ];

    const friends = data.filter(f => !f.isCurrentUser).sort((a, b) => b.move.percentage - a.move.percentage);
    const currentUser = data.find(f => f.isCurrentUser);
    const container = document.getElementById('friends-list');

    [...friends, currentUser].forEach(friend => {
      const card = document.createElement('div');
      card.className = 'card' + (friend.isCurrentUser ? ' current-user' : '');

      const profile = document.createElement('div');
      profile.className = 'profile';

      const img = document.createElement('img');
      img.src = friend.profilePic;

      const info = document.createElement('div');
      info.className = 'info';

      const name = document.createElement('p');
      name.textContent = friend.name;
      if (friend.isCurrentUser) name.classList.add('current');

      const details = document.createElement('div');
      details.innerHTML = `
        <span>${friend.move.current > 0 ? `${friend.move.current}/${friend.move.goal} KCAL` : "- KCAL"}</span>
        <span>${friend.exercise.current > 0 ? `${friend.exercise.current}/${friend.exercise.goal} MIN` : "- MIN"}</span>
        <span>${friend.stand.current > 0 ? `${friend.stand.current}/${friend.stand.goal} HR` : "- HR"}</span>
      `;

      info.appendChild(name);
      info.appendChild(details);
      profile.appendChild(img);
      profile.appendChild(info);

      const ring = document.createElementNS("http://www.w3.org/2000/svg", "svg");
      ring.setAttribute("viewBox", "0 0 36 36");
      ring.classList.add("activity-ring");

      const colors = ["#FF3B30", "#4CD964", "#007AFF"];
      const values = [friend.move.percentage, friend.exercise.percentage, friend.stand.percentage];

      values.forEach((percent, i) => {
        const radius = 16 - i * 2.5;
        const circumference = 2 * Math.PI * radius;

        const circle = document.createElementNS("http://www.w3.org/2000/svg", "circle");
        circle.setAttribute("fill", "none");
        circle.setAttribute("stroke", colors[i]);
        circle.setAttribute("stroke-width", "2.5");
        circle.setAttribute("r", radius);
        circle.setAttribute("cx", "18");
        circle.setAttribute("cy", "18");
        circle.setAttribute("stroke-dasharray", `${circumference}`);
        circle.setAttribute("stroke-dashoffset", circumference); // Start hidden
        circle.setAttribute("transform", "rotate(-90 18 18)");

        // Animate
        setTimeout(() => {
          circle.style.strokeDashoffset = `${circumference - (percent / 100) * circumference}`;
        }, 100);

        ring.appendChild(circle);
      });

      card.appendChild(profile);
      card.appendChild(ring);
      container.appendChild(card);
    });
  </script>
</body>
</html>