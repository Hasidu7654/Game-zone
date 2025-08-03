<?php
include 'config.php';
session_start();

// Helper: Get current user id from session (if logged in)
$current_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Helper: Get leaderboard data (all-time, for game 1 by default)
// You can extend this to support multiple games and time periods if needed
$game_id = 1; // Default to game 1 (Run Jump)
$period = 'all-time';
if (isset($_GET['game'])) {
    $game_id = intval($_GET['game']);
}
if (isset($_GET['period'])) {
    $period = $_GET['period'];
}

// Build WHERE clause for time period
$where_period = '';
if ($period === 'monthly') {
    $where_period = "AND MONTH(s.created_at) = MONTH(CURRENT_DATE()) AND YEAR(s.created_at) = YEAR(CURRENT_DATE())";
} elseif ($period === 'weekly') {
    $where_period = "AND YEARWEEK(s.created_at, 1) = YEARWEEK(CURRENT_DATE(), 1)";
}

// Fetch top 20 scores for the selected game and period
$sql = "SELECT s.*, u.username FROM scores s LEFT JOIN users u ON s.user_id = u.id WHERE s.game_id = ? $where_period ORDER BY s.score DESC, s.created_at ASC LIMIT 20";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $game_id);
$stmt->execute();
$result = $stmt->get_result();
$leaderboard = [];
while ($row = $result->fetch_assoc()) {
    $leaderboard[] = $row;
}
$stmt->close();

// Helper: Get game names for tabs
$game_names = [1 => 'Run Jump', 2 => 'Fire Game'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Meta tag ekak - character set eka set karanawa -->
  <meta charset="UTF-8" />
  <title>Game Zone - Leaderboard</title>
  <!-- Font Awesome icons link eka (social icons walata) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Google Fonts - Orbitron saha Press Start 2P (game look ekata) -->
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Press+Start+2P&display=swap" rel="stylesheet">
  <style>
    /* Reset - page eke okkoma margin, padding, box sizing ain karanawa */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Body eke background ekata gradient ekak denna, font eka set karanawa, overflow-x ain karanawa, min-height set karanawa */
    body {
      background: radial-gradient(ellipse at bottom, #1B2735 0%, #090A0F 100%);
      color: white;
      font-family: 'Segoe UI', sans-serif;
      overflow-x: hidden;
      margin: 0;
      padding: 0;
      min-height: 100vh;
    }

    /* Snow effect ekata canvas ekak - background snow animation ekata */
    #snow {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    } 

    /* Navigation Bar ekata style ekak denna - cyberpunk look ekak */
    .navbar {
      font-family: 'Orbitron', sans-serif;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 50px;
      position: relative;
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(0, 255, 255, 0.3);
      z-index: 100;
      box-shadow: 0 0 20px rgba(0, 255, 255, 0.1);
    }

    /* Navigation links walata style ekak denna - neon hover effect ekak */
    .nav-links {
      list-style: none;
      display: flex;
      gap: 30px;
    }

    /* Nav link ekakata style ekak denna */
    .nav-links a {
      text-decoration: none;
      color: #aaa;
      font-size: 18px;
      position: relative;
      font-weight: 500;
      letter-spacing: 1px;
      transition: all 0.3s ease;
      padding: 5px 10px;
      text-transform: uppercase;
    }

    /* Nav link ekata hover unama bottom line ekak pennanawa */
    .nav-links a::before {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: 0;
      left: 0;
      background-color: #00ffff;
      transition: width 0.3s ease;
    }

    /* Nav link ekata hover unama color change wenawa, shadow ekak denna */
    .nav-links a:hover {
      color: #00ffff;
      text-shadow: 0 0 10px rgba(0, 255, 255, 0.7);
    }

    /* Nav link ekata hover unama bottom line ekata width 100% karanawa */
    .nav-links a:hover::before {
      width: 100%;
    }

    /* Nav link ekata active class ekak denna - glowing effect */
    .nav-links a.active {
      color: #00ffff;
      text-shadow: 0 0 10px rgba(0, 255, 255, 0.7);
      font-weight: bold;
    }

    /* Auth buttons (login/logout) walata style ekak denna */
    .auth-buttons {
      font-size: 17px;
      display: flex;
      gap: 20px;
    }

    /* Login/Signup button ekata style ekak denna - glowing effect ekak */
    .auth-btn {
      padding: 12px 30px;
      background: linear-gradient(135deg, #00ffff 0%, #0080ff 100%);
      color: #111;
      border: none;
      border-radius: 30px;
      text-decoration: none;
      font-weight: bold;
      letter-spacing: 1px;
      box-shadow: 0 4px 15px rgba(0, 255, 255, 0.4);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      text-transform: uppercase;
      font-family: 'Orbitron', sans-serif;
    }

    /* Logout button ekata style ekak denna - red glowing effect ekak */
    .logout-btn {
      background: linear-gradient(135deg, #ff3c3c 0%, #ff0080 100%);
      box-shadow: 0 4px 15px rgba(255, 0, 0, 0.4);
    }

    /* Auth button ekata hover unama color, shadow, background change wenawa */
    .auth-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0, 255, 255, 0.8);
      cursor: pointer;
    }

    /* Logout button ekata hover unama shadow ekak denna */
    .logout-btn:hover {
      box-shadow: 0 6px 20px rgba(255, 0, 0, 0.8);
    }

    /* Auth button ekata hover unama glass shine ekak pennanawa */
    .auth-btn::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(255,255,255,0.3) 0%, transparent 100%);
      transform: translateX(-100%);
      transition: transform 0.4s ease;
    }

    .auth-btn:hover::after {
      transform: translateX(0);
    }

    /* Leaderboard section ekata style ekak denna - main leaderboard area */
    .leaderboard-section {
      padding: 80px 50px;
      text-align: center;
      position: relative;
      z-index: 10;
    }

    /* Leaderboard title ekata style ekak denna */
    .section-title {
      font-family: 'Press Start 2P', cursive;
      color: #00ffff;
      font-size: 2.5rem;
      margin-bottom: 60px;
      text-shadow: 0 0 15px rgba(0, 255, 255, 0.7);
      letter-spacing: 3px;
      position: relative;
      display: inline-block;
    }

    /* Leaderboard title eke underline ekata gradient ekak denna */
    .section-title::after {
      content: '';
      position: absolute;
      bottom: -15px;
      left: 50%;
      transform: translateX(-50%);
      width: 80%;
      height: 3px;
      background: linear-gradient(90deg, transparent, #00ffff, transparent);
    }

    /* Game selector tabs walata style ekak denna */
    .game-tabs {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-bottom: 40px;
      flex-wrap: wrap;
    }

    /* Game tab ekakata style ekak denna */
    .game-tab {
      padding: 12px 25px;
      background: rgba(0, 0, 0, 0.3);
      color: #aaa;
      border: 1px solid rgba(0, 255, 255, 0.3);
      border-radius: 30px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-family: 'Orbitron', sans-serif;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    /* Active game tab ekata style ekak denna */
    .game-tab.active {
      background: linear-gradient(135deg, rgba(0, 255, 255, 0.2) 0%, rgba(0, 128, 255, 0.2) 100%);
      color: #00ffff;
      border-color: #00ffff;
      box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
    }

    /* Game tab ekata hover unama color, border change wenawa */
    .game-tab:hover:not(.active) {
      color: #00ffff;
      border-color: #00ffff;
    }

    /* Leaderboard container ekata style ekak denna */
    .leaderboard-container {
      max-width: 1000px;
      margin: 0 auto;
      background: rgba(0, 0, 0, 0.5);
      border: 1px solid rgba(0, 255, 255, 0.3);
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    /* Leaderboard header ekata style ekak denna */
    .leaderboard-header {
      display: grid;
      grid-template-columns: 80px 1fr 150px 150px;
      padding: 20px;
      background: rgba(0, 255, 255, 0.1);
      border-bottom: 1px solid rgba(0, 255, 255, 0.3);
      font-family: 'Orbitron', sans-serif;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #00ffff;
    }

    /* Leaderboard rows walata style ekak denna */
    .leaderboard-rows {
      max-height: 600px;
      overflow-y: auto;
    }

    /* Leaderboard row ekakata style ekak denna */
    .leaderboard-row {
      display: grid;
      grid-template-columns: 80px 1fr 150px 150px;
      padding: 15px 20px;
      align-items: center;
      border-bottom: 1px solid rgba(0, 255, 255, 0.1);
      transition: all 0.3s ease;
    }

    /* Leaderboard row ekata hover unama background ekak denna */
    .leaderboard-row:hover {
      background: rgba(0, 255, 255, 0.05);
    }

    /* Last leaderboard row ekata border ain karanawa */
    .leaderboard-row:last-child {
      border-bottom: none;
    }

    /* Rank walata style ekak denna */
    .rank {
      font-family: 'Orbitron', sans-serif;
      font-weight: bold;
      font-size: 1.2rem;
      text-align: center;
    }

    /* 1st, 2nd, 3rd rank walata aluth color ekak denna */
    .rank-1 {
      color: gold;
      text-shadow: 0 0 10px rgba(255, 215, 0, 0.7);
    }

    .rank-2 {
      color: silver;
      text-shadow: 0 0 10px rgba(192, 192, 192, 0.7);
    }

    .rank-3 {
      color: #cd7f32; /* bronze */
      text-shadow: 0 0 10px rgba(205, 127, 50, 0.7);
    }

    /* Player info walata style ekak denna */
    .player-info {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    /* Player avatar ekata style ekak denna */
    .player-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #00ffff;
    }

    /* Player name ekata style ekak denna */
    .player-name {
      font-weight: bold;
    }

    /* Player country ekata style ekak denna */
    .player-country {
      font-size: 0.8rem;
      color: #aaa;
      display: flex;
      align-items: center;
      gap: 5px;
      margin-top: 3px;
    }

    /* Score saha time walata style ekak denna */
    .score, .time {
      font-family: 'Orbitron', sans-serif;
      font-weight: bold;
    }

    /* Score ekata color ekak denna */
    .score {
      color: #00ffaa;
    }

    /* Time ekata color ekak denna */
    .time {
      color: #ffaa00;
    }

    /* Current user row ekata highlight ekak denna */
    .current-user {
      background: rgba(0, 255, 255, 0.1);
      box-shadow: inset 0 0 15px rgba(0, 255, 255, 0.3);
      position: relative;
    }

    /* Current user row eke left ekata blue line ekak denna */
    .current-user::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 5px;
      background: #00ffff;
      box-shadow: 0 0 10px #00ffff;
    }

    /* Time period selector walata style ekak denna */
    .time-period {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 30px;
    }

    /* Time period button ekakata style ekak denna */
    .period-btn {
      padding: 8px 20px;
      background: rgba(0, 0, 0, 0.3);
      color: #aaa;
      border: 1px solid rgba(0, 255, 255, 0.3);
      border-radius: 30px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-family: 'Orbitron', sans-serif;
      font-size: 0.9rem;
    }

    /* Active period button ekata style ekak denna */
    .period-btn.active {
      background: linear-gradient(135deg, rgba(0, 255, 255, 0.2) 0%, rgba(0, 128, 255, 0.2) 100%);
      color: #00ffff;
      border-color: #00ffff;
      box-shadow: 0 0 10px rgba(0, 255, 255, 0.3);
    }

    /* Period button ekata hover unama color, border change wenawa */
    .period-btn:hover:not(.active) {
      color: #00ffff;
      border-color: #00ffff;
    }

    /* Floating particles background ekata style ekak denna (snow effect) */
    .particles {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      pointer-events: none;
    }

    /* Footer ekata style ekak denna - background, flex, border, shadow */
    .footer {
      padding: 80px 50px;
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      color: #ffffff;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to bottom, rgba(13, 1, 31, 0.9), rgba(4, 0, 10, 0.95));
      position: relative;
      z-index: 20;
      border-top: 1px solid rgba(0, 255, 255, 0.2);
      margin-top: 100px;
    }

    /* Footer eke background ekata SVG grid ekak pennanawa */
    .footer::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none" stroke="%2300ffff" stroke-width="0.5" opacity="0.1"/></svg>');
      opacity: 0.1;
      z-index: -1;
    }

    /* Footer eke left side ekata style ekak denna */
    .footer-left {
      flex: 1;
      min-width: 300px;
      padding-right: 30px;
    }

    /* Footer eke h2 ekata style ekak denna */
    .footer-left h2 {
      font-size: 2.5rem;
      font-weight: bold;
      margin-bottom: 25px;
      color: #00ffff;
      text-shadow: 0 0 15px rgba(0, 255, 255, 0.8);
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 2px;
    }

    /* Footer eke contact info walata style ekak denna */
    .footer-contact p {
      font-size: 1.1rem;
      color: #aaa;
      margin: 12px 0;
      display: flex;
      align-items: center;
    }

    /* Footer eke contact icon walata style ekak denna */
    .footer-contact p i {
      margin-right: 10px;
      color: #00ffff;
      width: 20px;
      text-align: center;
    }

    /* Footer eke center ekata style ekak denna */
    .footer-center {
      flex: 1;
      text-align: center;
      padding: 0 30px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    /* Footer eke center eke p ekata style ekak denna */
    .footer-center p {
      font-size: 1.1rem;
      color: #ddd;
      margin-bottom: 25px;
    }

    /* Footer eke links walata style ekak denna */
    .footer-links {
      display: flex;
      justify-content: center;
      gap: 25px;
      flex-wrap: wrap;
      margin-top: 20px;
    }

    /* Footer eke link ekakata style ekak denna */
    .footer-links a {
      color: #00ffff;
      text-decoration: none;
      transition: all 0.3s ease;
      font-size: 1rem;
      position: relative;
      padding: 5px 0;
      font-family: 'Orbitron', sans-serif;
    }

    /* Footer eke link ekata hover unama underline ekak pennanawa */
    .footer-links a::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 2px;
      background: #00ffff;
      transition: width 0.3s ease;
    }

    .footer-links a:hover {
      color: white;
      text-shadow: 0 0 10px rgba(0, 255, 255, 0.7);
    }

    .footer-links a:hover::after {
      width: 100%;
    }

    /* Footer eke social icons walata style ekak denna */
    .social-combined {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      gap: 30px;
      flex-wrap: wrap;
      min-width: 300px;
    }

    /* Social item ekakata style ekak denna */
    .social-item {
      text-decoration: none;
      display: flex;
      flex-direction: column;
      align-items: center;
      font-size: 1rem;
      color: #ccc;
    }

    /* Social icon ekata style ekak denna */
    .social-item i {
      font-size: 2rem;
      margin-bottom: 10px;
      color: #00ffff;
      transition: all 0.3s ease;
    }

    /* Social item ekata hover unama up wenawa, icon eka color change wenawa */
    .social-item:hover {
      transform: translateY(-5px);
    }

    .social-item:hover i {
      color: white;
      text-shadow: 0 0 15px rgba(0, 255, 255, 0.8);
    }

    /* Responsive design ekata style ekak denna - mobile walata */
    @media (max-width: 1200px) {
      .preview-container {
        flex-direction: column;
      }
      
      .preview-image {
        min-width: 100%;
      }
    }

    @media (max-width: 768px) {
      .navbar {
        padding: 15px 20px;
        flex-direction: column;
      }
      
      .nav-links {
        margin-bottom: 20px;
        gap: 15px;
      }
      
      .section-title {
        font-size: 1.8rem;
      }
      
      .leaderboard-section {
        padding: 50px 20px;
      }
      
      .leaderboard-header, .leaderboard-row {
        grid-template-columns: 50px 1fr 100px 100px;
        padding: 10px 15px;
      }
      
      .footer {
        flex-direction: column;
        padding: 50px 20px;
      }
      
      .footer-left, .footer-center, .social-combined {
        margin-bottom: 40px;
        text-align: center;
      }
      
      .footer-contact p {
        justify-content: center;
      }
    }

    /* Leaderboard scroll ekata style ekak denna */
    .leaderboard-rows::-webkit-scrollbar {
      width: 8px;
    }

    .leaderboard-rows::-webkit-scrollbar-track {
      background: rgba(0, 0, 0, 0.2);
    }

    .leaderboard-rows::-webkit-scrollbar-thumb {
      background: rgba(0, 255, 255, 0.3);
      border-radius: 4px;
    }

    .leaderboard-rows::-webkit-scrollbar-thumb:hover {
      background: rgba(0, 255, 255, 0.5);
    }
  </style>
</head>
<body>
  <!-- Snow effect ekata canvas ekak -->
  <canvas id="snow"></canvas>

  <!-- Navigation bar ekak - main links saha signup button -->
  <nav class="navbar">
    <ul class="nav-links">
      <!-- Home link ekata -->
      <li><a href="home.php">Home</a></li>
      <!-- Games page link ekata -->
      <li><a href="gamepage.php">Games</a></li>
      <!-- About page link ekata -->
      <li><a href="About.php">About</a></li>
      <!-- Leaderboard page link ekata (active class denna) -->
      <li><a href="leardboard.php" class="active">Leaderboard</a></li>
    </ul>
    <div class="auth-buttons">
      <!-- Login/Logout button ekata JavaScript walin pennanawa -->
    </div>
  </nav>

  <!-- Leaderboard section ekata - leaderboard data, tabs, time period -->
  <section class="leaderboard-section">
    <h2 class="section-title">LEADERBOARD</h2>
    <div class="game-tabs">
      <?php foreach ($game_names as $gid => $gname): ?>
        <div class="game-tab<?= $game_id == $gid ? ' active' : '' ?>" onclick="window.location.href='leardboard.php?game=<?= $gid ?>&period=<?= htmlspecialchars($period) ?>'" data-game="<?= $gid ?>"><?= htmlspecialchars($gname) ?></div>
      <?php endforeach; ?>
    </div>
    <div class="leaderboard-container">
      <div class="leaderboard-header">
        <div>RANK</div>
        <div>PLAYER</div>
        <div>SCORE</div>
        <div>TIME</div>
      </div>
      <div class="leaderboard-rows" id="leaderboardData">
        <?php if (count($leaderboard) === 0): ?>
          <div class="leaderboard-row"><div colspan="4">No scores yet.</div></div>
        <?php else: ?>
          <?php $rank = 1; foreach ($leaderboard as $row): ?>
            <?php
              $is_current = $current_user_id && $row['user_id'] == $current_user_id;
              $rank_class = $rank <= 3 ? 'rank-' . $rank : '';
              $player_name = $row['username'] ? htmlspecialchars($row['username']) : 'Guest';
              $score = number_format($row['score']);
              $time = date('Y-m-d H:i', strtotime($row['created_at']));
            ?>
            <div class="leaderboard-row<?= $is_current ? ' current-user' : '' ?>">
              <div class="rank <?= $rank_class ?>"><?= $rank ?></div>
              <div class="player-info">
                <img src="https://randomuser.me/api/portraits/lego/<?= $row['user_id'] ? ($row['user_id'] % 10) : 0 ?>.jpg" alt="avatar" class="player-avatar">
                <div>
                  <div class="player-name"><?= $player_name ?></div>
                  <div class="player-country"><i class="fas fa-globe"></i> --</div>
                </div>
              </div>
              <div class="score"><?= $score ?></div>
              <div class="time"><?= $time ?></div>
            </div>
            <?php $rank++; endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
    <div class="time-period">
      <div class="period-btn<?= $period === 'all-time' ? ' active' : '' ?>" onclick="window.location.href='leardboard.php?game=<?= $game_id ?>&period=all-time'" data-period="all-time">All Time</div>
      <div class="period-btn<?= $period === 'monthly' ? ' active' : '' ?>" onclick="window.location.href='leardboard.php?game=<?= $game_id ?>&period=monthly'" data-period="monthly">This Month</div>
      <div class="period-btn<?= $period === 'weekly' ? ' active' : '' ?>" onclick="window.location.href='leardboard.php?game=<?= $game_id ?>&period=weekly'" data-period="weekly">This Week</div>
    </div>
  </section>

  <!-- Footer section ekata - contact info, links, social icons -->
  <footer class="footer">
    <div class="footer-left">
      <h2>Game Zone</h2>
      <div class="footer-contact">
        <p><i class="fas fa-envelope"></i> Email: hasidudilshan894@gmail.com</p>
        <p><i class="fas fa-phone"></i> Phone: +94 701235187</p>
        <p><i class="fas fa-map-marker-alt"></i> Location: Colombo, Sri Lanka</p>
      </div>
    </div>
    <div class="footer-center">
      <p>@2025 Game Zone Studio Inc. All rights reserved</p>
      <div class="footer-links">
        <!-- Footer link ekata -->
        <a href="home.php">Home</a>
        <a href="gamepage.php">Games</a>
        <a href="leardboard.php">Leaderboard</a>
        <a href="About.php">About</a>
      </div>
    </div>
    <div class="social-combined">
      <!-- Twitter link ekata -->
      <a href="https://twitter.com/" class="social-item">
        <i class="fab fa-twitter"></i>
        <span>Twitter</span>
      </a>
      <!-- Reddit link ekata -->
      <a href="https://www.reddit.com/" class="social-item">
        <i class="fab fa-reddit"></i>
        <span>Reddit</span>
      </a>
      <!-- Discord link ekata -->
      <a href="https://discord.com/" class="social-item">
        <i class="fab fa-discord"></i>
        <span>Discord</span>
      </a>
    </div>
  </footer>

  <script>
    // Remove JS leaderboard rendering, only keep auth button logic
    document.addEventListener('DOMContentLoaded', function() {
      const authButtons = document.querySelector('.auth-buttons');
      if (authButtons) {
        if (localStorage.getItem('gamezoneLoggedIn') === 'true') {
          authButtons.innerHTML = '<a href="#" class="auth-btn logout-btn" id="logoutBtn">LOGOUT</a>';
          document.getElementById('logoutBtn').addEventListener('click', function(e) {
            e.preventDefault();
            localStorage.removeItem('gamezoneLoggedIn');
            window.location.href = 'login.php';
          });
        } else {
          authButtons.innerHTML = '<a href="login.php" class="auth-btn">LOGIN</a>';
        }
      }
    });
  </script>
</body>
</html>