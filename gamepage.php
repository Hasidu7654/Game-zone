<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Game Zone - Play Now</title>
  <!-- Font Awesome CDN link ekak danna - icon tika ganna -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Google Fonts link ekak danna - font tika ganna -->
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Press+Start+2P&display=swap" rel="stylesheet">
  <style>
    /* Reset - moolika widiyata page eke margin, padding, box sizing okkoma reset karanawa */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Body eke background ekath font ekath set karanawa - backdrop ekath min-height ekath denna */
    body {
      background: radial-gradient(ellipse at bottom, #1B2735 0%, #090A0F 100%);
      color: white;
      font-family: 'Segoe UI', sans-serif;
      overflow-x: hidden;
      margin: 0;
      padding: 0;
      min-height: 100vh;
    }

    /* Snow effect ekata canvas ekak - page eke issarahama thiyenawa */
    #snow {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    } 

    /* Navigation Bar ekata style denna - cyberpunk look ekak */
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

    /* Navigation links walata neon style ekak denna */
    .nav-links {
      list-style: none;
      display: flex;
      gap: 30px;
    }

    /* Nav link ekak - hover ekedi neon effect ekak denna */
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

    /* Nav link ekata hover ekedi underline ekak animate wenawa */
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

    /* Nav link hover ekedi color change + shadow ekak denna */
    .nav-links a:hover {
      color: #00ffff;
      text-shadow: 0 0 10px rgba(0, 255, 255, 0.7);
    }

    /* Nav link hover ekedi underline full width wenawa */
    .nav-links a:hover::before {
      width: 100%;
    }

    /* Auth buttons (login/signup/logout) walata glowing style ekak denna */
    .auth-buttons {
      font-size: 17px;
      display: flex;
      gap: 20px;
    }

    /* Auth button ekata gradient background ekak + neon shadow ekak denna */
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

    /* Logout button ekata red gradient ekak denna */
    .logout-btn {
      background: linear-gradient(135deg, #ff3c3c 0%, #ff0080 100%);
      box-shadow: 0 4px 15px rgba(255, 0, 0, 0.4);
    }

    /* Auth button hover ekedi up ekata move wenawa + shadow wadi wenawa */
    .auth-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0, 255, 255, 0.8);
      cursor: pointer;
    }

    /* Logout button hover ekedi red shadow wadi wenawa */
    .logout-btn:hover {
      box-shadow: 0 6px 20px rgba(255, 0, 0, 0.8);
    }

    /* Auth button ekata shine ekak animate karanawa hover ekedi */
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

    /* Hover ekedi shine ekak auth button eke athule yanna denna */
    .auth-btn:hover::after {
      transform: translateX(0);
    }

    /* Game selection section ekata padding ekak denna + z-index ekak denna */
    .game-selection {
      padding: 80px 50px;
      text-align: center;
      position: relative;
      z-index: 10;
    }

    /* Section title ekata retro font ekak + neon shadow ekak denna */
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

    /* Section title eke yatin neon line ekak denna */
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

    /* Games container ekata flex ekak denna + gap denna */
    .games-container {
      display: flex;
      justify-content: center;
      gap: 50px;
      flex-wrap: wrap;
      margin-top: 50px;
    }

    /* Game card ekata background ekak + border ekak denna */
    .game-card {
      width: 400px;
      background: rgba(0, 0, 0, 0.5);
      border: 1px solid rgba(0, 255, 255, 0.3);
      border-radius: 15px;
      overflow: hidden;
      transition: all 0.5s ease;
      position: relative;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    /* Game card hover ekedi up ekata move wenawa + border color change wenawa */
    .game-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(0, 255, 255, 0.3);
      border-color: #00ffff;
    }

    /* Game image container ekata height ekak denna + overflow hidden karanawa */
    .game-image-container {
      height: 500px;
      overflow: hidden;
      position: relative;
    }

    /* Game image ekata size ekak denna + object-fit cover denna */
    .game-image {
      width: 90%;
      height: 90%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    /* Game card hover ekedi image eka zoom wenawa */
    .game-card:hover .game-image {
      transform: scale(1.05);
    }

    /* Game overlay ekata gradient ekak denna + hover ekedi display karanawa */
    .game-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.7));
      display: flex;
      justify-content: center;
      align-items: center;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    /* Game card hover ekedi overlay eka pennanawa */
    .game-card:hover .game-overlay {
      opacity: 1;
    }

    /* Play button ekata neon border ekak denna + hover ekedi color change ekak denna */
    .play-btn {
      padding: 12px 30px;
      background: rgba(0, 0, 0, 0.7);
      color: #00ffff;
      border: 2px solid #00ffff;
      border-radius: 30px;
      font-weight: bold;
      font-family: 'Orbitron', sans-serif;
      text-transform: uppercase;
      letter-spacing: 2px;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    /* Play button ekata shine ekak denna hover ekedi */
    .play-btn::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, rgba(0, 255, 255, 0.3), transparent);
      transform: translateX(-100%);
      transition: transform 0.4s ease;
    }

    /* Play button hover ekedi background ekak + shadow ekak denna */
    .play-btn:hover {
      background: rgba(0, 255, 255, 0.2);
      box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
      transform: translateY(-3px);
    }

    /* Play button hover ekedi shine ekak pennanawa */
    .play-btn:hover::after {
      transform: translateX(0);
    }

    /* Game info ekata padding ekak denna + text align left karanawa */
    .game-info {
      padding: 25px;
      text-align: left;
    }

    /* Game title ekata font ekak + color ekak denna */
    .game-title {
      font-family: 'Orbitron', sans-serif;
      color: #00ffff;
      font-size: 1.8rem;
      margin-bottom: 15px;
      letter-spacing: 1px;
    }

    /* Game description ekata color ekak denna + spacing denna */
    .game-description {
      color: #ccc;
      font-size: 1rem;
      line-height: 1.6;
      margin-bottom: 20px;
    }

    /* Game stats walata flex ekak denna + color ekak denna */
    .game-stats {
      display: flex;
      justify-content: space-between;
      color: #aaa;
      font-size: 0.9rem;
    }

    /* Stat ekata flex ekak denna + icon ekak denna */
    .stat {
      display: flex;
      align-items: center;
    }

    /* Stat icon ekata neon color ekak denna */
    .stat i {
      color: #00ffff;
      margin-right: 8px;
    }

    /* Game preview section ekata padding ekak denna + background gradient ekak denna */
    .game-preview {
      padding: 80px 50px;
      background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.9));
      margin-top: 50px;
      position: relative;
      overflow: hidden;
    }

    /* Preview container ekata max width ekak denna + flex ekak denna */
    .preview-container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      gap: 50px;
    }

    /* Preview image ekata flex ekak denna + min width ekak denna */
    .preview-image {
      flex: 1;
      min-width: 400px;
      position: relative;
    }

    /* Preview image eke athule image ekata border ekak denna + shadow ekak denna */
    .preview-image img {
      width: 100%;
      border-radius: 15px;
      border: 3px solid #00ffff;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
      transition: all 0.5s ease;
    }

    /* Preview image hover ekedi zoom ekak denna + shadow wadi wenawa */
    .preview-image:hover img {
      transform: scale(1.02);
      box-shadow: 0 30px 60px rgba(0, 255, 255, 0.3);
    }

    /* Preview content ekata flex ekak denna */
    .preview-content {
      flex: 1;
    }

    /* Preview title ekata font ekak + color ekak denna */
    .preview-title {
      font-family: 'Orbitron', sans-serif;
      color: #00ffff;
      font-size: 2.5rem;
      margin-bottom: 20px;
      letter-spacing: 2px;
    }

    /* Preview text ekata color ekak denna + spacing denna */
    .preview-text {
      color: #ccc;
      font-size: 1.1rem;
      line-height: 1.8;
      margin-bottom: 30px;
    }

    /* Features list ekata list style nathi karanawa + spacing denna */
    .features-list {
      list-style: none;
      margin-bottom: 30px;
    }

    /* Feature item ekata spacing denna + icon ekak denna */
    .feature-item {
      margin-bottom: 15px;
      display: flex;
      align-items: center;
    }

    /* Feature item icon ekata neon color ekak denna */
    .feature-item i {
      color: #00ffff;
      margin-right: 15px;
      font-size: 1.2rem;
    }

    /* Login prompt modal ekak - user kenekta login nathnam pennanawa */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.8);
      z-index: 1000;
      justify-content: center;
      align-items: center;
      backdrop-filter: blur(5px);
    }

    /* Modal content ekata background ekak + border ekak denna */
    .modal-content {
      background: rgba(0, 0, 0, 0.9);
      border: 1px solid rgba(0, 255, 255, 0.3);
      border-radius: 15px;
      padding: 30px;
      width: 90%;
      max-width: 500px;
      box-shadow: 0 0 30px rgba(0, 255, 255, 0.3);
      position: relative;
      animation: modalFadeIn 0.3s ease;
    }

    /* Modal fade in animation ekak denna */
    @keyframes modalFadeIn {
      from { opacity: 0; transform: translateY(-50px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Close modal button ekata position ekak denna + hover ekedi color change ekak denna */
    .close-modal {
      position: absolute;
      top: 15px;
      right: 15px;
      color: #aaa;
      font-size: 24px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    /* Close modal button hover ekedi color change + rotate ekak denna */
    .close-modal:hover {
      color: #00ffff;
      transform: rotate(90deg);
    }

    /* Modal title ekata color ekak + font ekak denna */
    .modal-title {
      color: #00ffff;
      font-family: 'Orbitron', sans-serif;
      margin-bottom: 20px;
      text-align: center;
      font-size: 1.8rem;
    }

    /* Modal text ekata color ekak denna + spacing denna */
    .modal-text {
      color: #ccc;
      font-size: 1.1rem;
      text-align: center;
      margin-bottom: 30px;
      line-height: 1.6;
    }

    /* Modal buttons walata flex ekak denna + gap denna */
    .modal-buttons {
      display: flex;
      justify-content: center;
      gap: 20px;
    }

    /* Floating particles background ekata style ekak denna (future use) */
    .particles {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      pointer-events: none;
    }

    /* Footer ekata cyberpunk terminal style ekak denna */
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
    /* Footer eke background ekata SVG grid ekak denna (light lines) */
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
    /* Footer left section ekata min width ekak denna + padding denna */
    .footer-left {
      flex: 1;
      min-width: 300px;
      padding-right: 30px;
    }
    /* Footer left eke h2 ekata neon font ekak denna */
    .footer-left h2 {
      font-size: 2.5rem;
      font-weight: bold;
      margin-bottom: 25px;
      color: #00ffff;
      text-shadow: 0 0 15px rgba(0, 255, 255, 0.8);
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 2px;
    }
    /* Footer contact info walata icon ekak + color ekak denna */
    .footer-contact p {
      font-size: 1.1rem;
      color: #aaa;
      margin: 12px 0;
      display: flex;
      align-items: center;
    }
    /* Footer contact icon walata neon color ekak denna */
    .footer-contact p i {
      margin-right: 10px;
      color: #00ffff;
      width: 20px;
      text-align: center;
    }
    /* Footer center section ekata text align center ekak denna */
    .footer-center {
      flex: 1;
      text-align: center;
      padding: 0 30px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    /* Footer center eke copyright text ekata color ekak denna */
    .footer-center p {
      font-size: 1.1rem;
      color: #ddd;
      margin-bottom: 25px;
    }
    /* Footer links walata flex ekak denna + gap denna */
    .footer-links {
      display: flex;
      justify-content: center;
      gap: 25px;
      flex-wrap: wrap;
      margin-top: 20px;
    }
    /* Footer link ekata neon color ekak denna + hover ekedi underline animate karanawa */
    .footer-links a {
      color: #00ffff;
      text-decoration: none;
      transition: all 0.3s ease;
      font-size: 1rem;
      position: relative;
      padding: 5px 0;
      font-family: 'Orbitron', sans-serif;
    }
    /* Footer link ekata hover ekedi underline animate karanawa */
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
    /* Footer link hover ekedi color change + shadow denna */
    .footer-links a:hover {
      color: white;
      text-shadow: 0 0 10px rgba(0, 255, 255, 0.7);
    }
    /* Footer link hover ekedi underline full width wenawa */
    .footer-links a:hover::after {
      width: 100%;
    }
    /* Social links walata flex ekak denna + gap denna */
    .social-combined {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      gap: 30px;
      flex-wrap: wrap;
      min-width: 300px;
    }
    /* Social item ekata column flex ekak denna + icon ekak denna */
    .social-item {
      text-decoration: none;
      display: flex;
      flex-direction: column;
      align-items: center;
      font-size: 1rem;
      color: #ccc;
    }
    /* Social icon ekata neon color ekak denna + hover ekedi color change ekak denna */
    .social-item i {
      font-size: 2rem;
      margin-bottom: 10px;
      color: #00ffff;
      transition: all 0.3s ease;
    }
    /* Social item hover ekedi up ekata move wenawa */
    .social-item:hover {
      transform: translateY(-5px);
    }
    /* Social icon hover ekedi color change + shadow denna */
    .social-item:hover i {
      color: white;
      text-shadow: 0 0 15px rgba(0, 255, 255, 0.8);
    }

    /* Title images animation ekata style ekak denna */
    .title-images {
      display: flex;
      justify-content: flex-end;
      gap: 30px;
      margin-right: 50px;
      margin-top: 40px;
    }

    /* Title icon ekata animation ekak denna + shadow ekak denna */
    .title-icon {
      width: 200px;
      height: 200px;
      object-fit: contain;
      transition: all 0.5s ease;
      animation: float 3s ease-in-out infinite alternate;
      filter: drop-shadow(0 0 15px rgba(0, 255, 255, 0.9));
    }

    /* Title icon ekata animation delay denna (1st icon) */
    .title-icon:nth-child(1) {
      animation-delay: 0.5s;
    }

    /* Title icon ekata animation delay denna (2nd icon) */
    .title-icon:nth-child(2) {
      animation-delay: 1s;
    }

    /* Float animation ekata keyframes denna */
    @keyframes float {
      0% {
        transform: translateY(0) rotate(0deg);
      }
      100% {
        transform: translateY(-25px) rotate(5deg);
      }
    }

    /* Game name under the title image ekata style ekak denna */
    .game-title-under-image {
      color: #00ffff;
      font-family: 'Orbitron', sans-serif;
      font-size: 1.2rem;
      margin-top: 10px;
      text-align: center;
    }

  </style>
</head>
<body>
  <!-- Snow effect ekata canvas ekak - page eke issarahama thiyenawa -->
  <canvas id="snow"></canvas>

  <!-- Navigation bar ekak - site eke main links okkoma meka athule -->
  <nav class="navbar">
    <ul class="nav-links">
       <li><a href="home.php">Home</a></li>
      <li><a href="gamepage.php">Games</a></li>
      <li><a href="About.php">About</a></li>
      <li><a href="leardboard.php">Leaderboard</a></li>
    </ul>
    <div class="auth-buttons">
      <!-- Login/Logout button ekata JavaScript walin pennanawa -->
    </div>
  </nav>

  <!-- Game selection section ekak - user kenekta game ekak select karanna denna -->
  <section class="game-selection">
    <div style="display: flex; align-items: center; gap: 30px; margin-bottom: 10px;">
      <div class="title-images">
        <img src="game 3.webp" alt="Icon 2" class="title-icon" />
      </div>
      <h2 class="section-title" style="margin: 0;">CHOOSE YOUR GAME</h2>
    </div>
    
    <!-- Games container ekak - game card dekak display karanawa -->
    <div class="games-container">
      <!-- Run Jump Game Card ekak - game 1 -->
      <div class="game-card">
        <div class="game-image-container">
          <img src="Run (4).png" alt="Run Jump Game" class="game-image">
          <div class="game-overlay">
            <button class="play-btn" id="playRunJump">PLAY NOW</button>
          </div>
        </div>
        <div class="game-info">
          <h3 class="game-title">RUN JUMP</h3>
          <p class="game-description">A fast-paced, brick breaking balancing act! Jump over obstacles and collect coins in this endless runner game.</p>
          <div class="game-stats">
            <div class="stat"><i class="fas fa-star"></i> 4.8/5</div>
            <div class="stat"><i class="fas fa-users"></i> 10K+ Players</div>
            <div class="stat"><i class="fas fa-gamepad"></i> Arcade</div>
          </div>
        </div>
      </div>
      
      <!-- Fire Game Card ekak - game 2 -->
      <div class="game-card">
        <div class="game-image-container">
          <img src="RunShoot.png" alt="Fire Game" class="game-image">
          <div class="game-overlay">
            <button class="play-btn" id="playFireGame">PLAY NOW</button>
          </div>
        </div>
        <div class="game-info">
          <h3 class="game-title">FIRE GAME</h3>
          <p class="game-description">Dodge the traps and race to the end! Shoot your way through enemies in this action-packed adventure.</p>
          <div class="game-stats">
            <div class="stat"><i class="fas fa-star"></i> 4.6/5</div>
            <div class="stat"><i class="fas fa-users"></i> 8K+ Players</div>
            <div class="stat"><i class="fas fa-gamepad"></i> Shooter</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Title images ekak - page eke aduma athule thiyena decorative images -->
 <div class="title-images">
    <img src="game 7.webp" alt="Icon 1" class="title-icon" />
  </div>

  <!-- Game preview section ekak - games walata preview ekak denna -->
  <section class="game-preview">
    <div class="preview-container">
      <div class="preview-image">
        <img src="game 5.webp" alt="Game Preview">
      </div>
      <div class="preview-content">
        <h3 class="preview-title">ULTIMATE GAMING EXPERIENCE</h3>
        <p class="preview-text">Immerse yourself in our collection of hand-crafted JavaScript games. Each game is designed to provide hours of entertainment with responsive controls and challenging gameplay.</p>
        
        <ul class="features-list">
          <li class="feature-item">
            <i class="fas fa-bolt"></i>
            <span>Fast-paced action with smooth animations</span>
          </li>
          <li class="feature-item">
            <i class="fas fa-trophy"></i>
            <span>Leaderboards to compete with friends</span>
          </li>
          <li class="feature-item">
            <i class="fas fa-cog"></i>
            <span>Customizable controls and settings</span>
          </li>
          <li class="feature-item">
            <i class="fas fa-desktop"></i>
            <span>Works on all devices - no downloads needed</span>
          </li>
        </ul>
      </div>
    </div>
  </section>

  <!-- Login prompt modal ekak - user kenekta login nathnam pennanawa -->
  <div class="modal" id="loginModal">
    <div class="modal-content">
      <span class="close-modal">&times;</span>
      <h2 class="modal-title">LOGIN REQUIRED</h2>
      <p class="modal-text">You need to be logged in to play this game. Please sign in or create an account to continue.</p>
      <div class="modal-buttons">
        <a href="signup.php" class="auth-btn">SIGNUP</a>
      </div>
    </div>
  </div>

  <!-- Game ready modal ekak - game ekata play karanna ready unaama pennanawa -->
  <div class="modal" id="gameReadyModal">
    <div class="modal-content">
      <span class="close-modal">&times;</span>
      <h2 class="modal-title">GAME READY!</h2>
      <p class="modal-text" id="gameReadyText">You're now ready to play Run Jump! Click the button below to start your adventure.</p>
      <div class="modal-buttons">
        <button class="auth-btn" id="startGameBtn">START GAME</button>
      </div>
    </div>
  </div>

  <!-- Footer ekak - contact info, links, social links okkoma meka athule -->
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
        <a href="home.php">Home</a>
        <a href="gamepage.php">Games</a>
        <a href="leardboard.php">Leaderboard</a>
        <a href="About.php">About</a>
      </div>
    </div>
    <div class="social-combined">
      <a href="https://twitter.com/" class="social-item">
        <i class="fab fa-twitter"></i>
        <span>Twitter</span>
      </a>
      <a href="https://www.reddit.com/" class="social-item">
        <i class="fab fa-reddit"></i>
        <span>Reddit</span>
      </a>
      <a href="https://discord.com/" class="social-item">
        <i class="fab fa-discord"></i>
        <span>Discord</span>
      </a>
    </div>
  </footer>

  <script>
    // Snow effect ekata super lightweight JS code ekak - canvas walin snow animation ekak denna
    const canvas = document.getElementById('snow');
    const ctx = canvas.getContext('2d');

    // Canvas eke size eka set karanawa
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    // Snowflakes array ekak hadanawa - minimal particles walin
    const snowflakes = [];

    // Snowflake hadanna function ekak - random position, size, speed, opacity denna
    function createSnowflake() {
      snowflakes.push({
        x: Math.random() * canvas.width,
        y: -5,
        radius: Math.random() * 2 + 1, // podi flakes
        speedY: Math.random() * 3 + 1, // slow fall
        speedX: Math.random() * 0.1 - 0.05, // podi horizontal movement
        opacity: Math.random() * 0.3 + 0.2 // transparent flakes
      });
    }

    // Snowflakes draw karana function ekak
    function drawSnowflakes() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      
      for (let i = 0; i < snowflakes.length; i++) {
        const f = snowflakes[i];
        ctx.beginPath();
        ctx.arc(f.x, f.y, f.radius, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(255, 255, 255, ${f.opacity})`;
        ctx.fill();
        ctx.closePath();
        
        // Snowflake eka move karanawa
        f.y += f.speedY;
        f.x += f.speedX;
        
        // Snowflake eka out of bounds nam recycle karanawa
        if (f.y > canvas.height + f.radius) {
          f.y = -f.radius;
          f.x = Math.random() * canvas.width;
        }
      }
    }

    // Initial snowflakes hadanawa (100k wadi snow ekak)
    for (let i = 0; i < 100; i++) {
      createSnowflake();
    }

    // Animation ekata interval ekak denna
    setInterval(drawSnowflakes, 50);

    // Window resize ekedi canvas size update karanawa
    window.addEventListener('resize', () => {
      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;
    });

    // Game play button walata event listener denna - login una nam game ekata redirect karanawa, nathnam modal ekak pennanawa
    const playRunJumpBtn = document.getElementById('playRunJump');
    const playFireGameBtn = document.getElementById('playFireGame');
    const loginModal = document.getElementById('loginModal');
    const gameReadyModal = document.getElementById('gameReadyModal');
    const gameReadyText = document.getElementById('gameReadyText');
    const startGameBtn = document.getElementById('startGameBtn');
    const closeModalButtons = document.querySelectorAll('.close-modal');

    // User login status check karana function ekak
    function isLoggedIn() {
      return localStorage.getItem('gamezoneLoggedIn') === 'true';
    }

    // Run Jump game play button ekata click karama - login una nam game ekata redirect karanawa, nathnam login modal ekak pennanawa
    playRunJumpBtn.addEventListener('click', () => {
      if (isLoggedIn()) {
        window.location.href = "game 1/index.php"; // game page ekata redirect karanawa
      } else {
        loginModal.style.display = 'flex';
      }
    });

    // Fire Game play button ekata click karama - login una nam game ekata redirect karanawa, nathnam login modal ekak pennanawa
    playFireGameBtn.addEventListener('click', () => {
      if (isLoggedIn()) {
        window.location.href = "firegame.html"; // fire game page ekata redirect karanawa
      } else {
        loginModal.style.display = 'flex';
      }
    });

    // Close modal button walata event listener denna - modal close karanawa
    closeModalButtons.forEach(button => {
      button.addEventListener('click', () => {
        loginModal.style.display = 'none';
        gameReadyModal.style.display = 'none';
      });
    });

    // Modal eke athule nathi thanakata click karama modal close karanawa
    window.addEventListener('click', (e) => {
      if (e.target === loginModal || e.target === gameReadyModal) {
        loginModal.style.display = 'none';
        gameReadyModal.style.display = 'none';
      }
    });

    // --- Auth button login/logout switch (single logic, duplicate code ain karanawa) ---
    (function() {
      const authButtons = document.querySelector('.auth-buttons');
      if (authButtons) {
        if (localStorage.getItem('gamezoneLoggedIn') === 'true') {
          authButtons.innerHTML = '<a href="#" class="auth-btn logout-btn" id="logoutBtn">LOGOUT</a>';
          document.getElementById('logoutBtn').addEventListener('click', function(e) {
            e.preventDefault();
            localStorage.removeItem('gamezoneLoggedIn');
            window.location.href = 'gamepage.php';
          });
        } else {
          authButtons.innerHTML = '<a href="login.php" class="auth-btn">LOGIN</a>';
        }
      }
    })();

    // Game card walata mouse move ekedi background animation ekak denna
    const gameCards = document.querySelectorAll('.game-card');
    gameCards.forEach(card => {
      card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        card.style.setProperty('--mouse-x', `${x}px`);
        card.style.setProperty('--mouse-y', `${y}px`);
      });
    });
  </script>
</body>
</html>