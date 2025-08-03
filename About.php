<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>About Game Zone - Ultimate Gaming Experience</title>
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

    /* Game elements background ekata canvas ekak denna - floating icons walata */
    #gameElements {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      pointer-events: none;
      opacity: 0.1;
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

    /* Signup button ekata gradient background ekak + neon shadow ekak denna */
    .signup-btn {
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

    /* Signup button hover ekedi up ekata move wenawa + shadow wadi wenawa */
    .signup-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0, 255, 255, 0.8);
      cursor: pointer;
    }

    /* Signup button ekata shine ekak animate karanawa hover ekedi */
    .signup-btn::after {
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

    /* Hover ekedi shine ekak signup button eke athule yanna denna */
    .signup-btn:hover::after {
      transform: translateX(0);
    }
    
    /* Login button ekata home page eke color theme ekak denna */
    .login-btn {
      padding: 12px 30px;
      background: linear-gradient(135deg, #00ff99 0%, #0055ff 100%);
      color: #fff;
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
    /* Login button hover ekedi color theme change wenawa */
    .login-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(255, 255, 255, 0.8);
      cursor: pointer;
      background: linear-gradient(135deg, #00ffff 0%, #0080ff 100%);
      color: #111;
    }
    /* Login button ekata shine ekak animate karanawa hover ekedi */
    .login-btn::after {
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
    /* Hover ekedi shine ekak login button eke athule yanna denna */
    .login-btn:hover::after {
      transform: translateX(0);
    }
    
    /* Hero section ekata text align center ekak denna + margin denna */
    .about-hero {
      text-align: center;
      margin-top: 100px;
      position: relative;
      z-index: 10;
      padding: 0 20px;
    }

    /* About hero eke h1 ekata font ekak + neon shadow ekak denna */
    .about-hero h1 {
      font-size: 4rem;
      color: #00ffff;
      text-shadow: 0 0 20px rgba(0, 255, 255, 0.8);
      font-family: 'Press Start 2P', cursive;
      letter-spacing: 5px;
      margin-bottom: 20px;
      animation: glowPulse 3s ease-in-out infinite;
      position: relative;
      line-height: 1.2;
    }

    /* Glow pulse animation ekata keyframes denna */
    @keyframes glowPulse {
      0%, 100% {
        text-shadow: 0 0 20px rgba(0, 255, 255, 0.8), 0 0 40px rgba(0, 255, 255, 0.5);
        transform: scale(1);
      }
      50% {
        text-shadow: 0 0 30px rgba(0, 255, 255, 1), 0 0 60px rgba(0, 255, 255, 0.8);
        transform: scale(1.05);
      }
    }

    /* About content section ekata max width ekak denna + margin denna */
    .about-content {
      max-width: 1200px;
      margin: 80px auto;
      padding: 0 30px;
      position: relative;
      z-index: 10;
    }

    /* About section ekata background ekak + border ekak denna */
    .about-section {
      margin-bottom: 80px;
      background: rgba(0, 0, 0, 0.3);
      border-radius: 15px;
      padding: 40px;
      border-left: 3px solid #00ffff;
      box-shadow: 0 0 30px rgba(0, 255, 255, 0.1);
      transition: transform 0.3s ease;
    }

    /* About section hover ekedi up ekata move wenawa + shadow wadi wenawa */
    .about-section:hover {
      transform: translateY(-5px);
      box-shadow: 0 0 40px rgba(0, 255, 255, 0.2);
    }

    /* About section eke h2 ekata font ekak + color ekak denna */
    .about-section h2 {
      font-size: 2.5rem;
      color: #00ffff;
      margin-bottom: 20px;
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 2px;
      position: relative;
    }

    /* About section eke h2 eke yatin neon line ekak denna */
    .about-section h2::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 0;
      width: 100px;
      height: 3px;
      background: linear-gradient(90deg, #00ffff, transparent);
    }

    /* About section eke paragraph ekata font ekak + color ekak denna */
    .about-section p {
      font-size: 1.2rem;
      line-height: 1.8;
      color: #ddd;
      margin-bottom: 20px;
    }

    /* Timeline section ekata style ekak denna */
    .timeline {
      position: relative;
      max-width: 1200px;
      margin: 80px auto;
      padding: 0 30px;
    }

    /* Timeline eke vertical line ekata style ekak denna */
    .timeline::after {
      content: '';
      position: absolute;
      width: 3px;
      background: linear-gradient(to bottom, #00ffff, transparent);
      top: 0;
      bottom: 0;
      left: 50%;
      margin-left: -1.5px;
    }

    /* Timeline item ekata width ekak denna + position ekak denna */
    .timeline-item {
      padding: 10px 40px;
      position: relative;
      width: 50%;
      box-sizing: border-box;
    }

    /* Timeline item eke dot ekata neon color ekak denna */
    .timeline-item::after {
      content: '';
      position: absolute;
      width: 20px;
      height: 20px;
      background-color: #00ffff;
      border-radius: 50%;
      top: 15px;
      z-index: 1;
      box-shadow: 0 0 10px rgba(0, 255, 255, 0.8);
    }

    /* Timeline item left/right ekata position ekak denna */
    .left {
      left: 0;
      text-align: right;
    }

    .right {
      left: 50%;
      text-align: left;
    }

    /* Timeline item eke dot ekata position ekak denna (left/right) */
    .left::after {
      right: -10px;
    }

    .right::after {
      left: -10px;
    }

    /* Timeline content ekata background ekak + border ekak denna */
    .timeline-content {
      padding: 20px;
      background: rgba(0, 0, 0, 0.3);
      border-radius: 10px;
      border: 1px solid rgba(0, 255, 255, 0.2);
      box-shadow: 0 0 15px rgba(0, 255, 255, 0.1);
    }

    /* Timeline content eke h3 ekata color ekak denna */
    .timeline-content h3 {
      color: #00ffff;
      font-family: 'Orbitron', sans-serif;
      margin-bottom: 10px;
    }

    /* Timeline content eke paragraph ekata color ekak denna */
    .timeline-content p {
      color: #ddd;
      line-height: 1.6;
    }

    /* Team section ekata max width ekak denna + text align center ekak denna */
    .team-section {
      max-width: 1200px;
      margin: 80px auto;
      padding: 0 30px;
      text-align: center;
    }

    /* Team section eke h2 ekata font ekak + color ekak denna */
    .team-section h2 {
      font-size: 2.5rem;
      color: #00ffff;
      margin-bottom: 50px;
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 2px;
    }

    /* Team grid ekata grid ekak denna + gap denna */
    .team-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
    }

    /* Team member ekata background ekak + border ekak denna */
    .team-member {
      background: rgba(0, 0, 0, 0.3);
      border-radius: 15px;
      padding: 30px;
      transition: all 0.3s ease;
      border: 1px solid rgba(0, 255, 255, 0.1);
      position: relative;
      overflow: hidden;
    }

    /* Team member hover ekedi shine ekak denna */
    .team-member::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(0, 255, 255, 0.1), transparent);
      transform: translateX(-100%);
      transition: transform 0.4s ease;
    }

    /* Team member hover ekedi shine ekak animate wenawa */
    .team-member:hover::before {
      transform: translateX(0);
    }

    /* Team member hover ekedi up ekata move wenawa + shadow wadi wenawa */
    .team-member:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 30px rgba(0, 255, 255, 0.2);
      border-color: rgba(0, 255, 255, 0.3);
    }

    /* Team member eke image ekata border ekak + shadow ekak denna */
    .team-member img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #00ffff;
      margin-bottom: 20px;
      box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
    }

    /* Team member eke h3 ekata color ekak denna */
    .team-member h3 {
      color: #00ffff;
      font-size: 1.5rem;
      margin-bottom: 10px;
      font-family: 'Orbitron', sans-serif;
    }

    /* Team member eke paragraph ekata color ekak denna */
    .team-member p {
      color: #aaa;
      font-size: 1rem;
      margin-bottom: 15px;
    }

    /* Floating game elements walata animation ekak denna */
    .game-element {
      position: absolute;
      opacity: 0.1;
      z-index: -1;
      pointer-events: none;
      animation: floatElement 15s ease-in-out infinite;
    }

    /* Floating game elements walata keyframes denna */
    @keyframes floatElement {
      0%, 100% {
        transform: translate(0, 0) rotate(0deg);
      }
      25% {
        transform: translate(50px, 30px) rotate(5deg);
      }
      50% {
        transform: translate(0, 60px) rotate(0deg);
      }
      75% {
        transform: translate(-50px, 30px) rotate(-5deg);
      }
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

    /* Logout button ekata game page eke color theme ekak denna */
    .logout-btn {
      background: linear-gradient(135deg, #ff3c3c 0%, #ff0080 100%);
      box-shadow: 0 4px 15px rgba(255, 0, 0, 0.4);
      color: #fff;
    }
    /* Logout button hover ekedi color theme change wenawa */
    .logout-btn:hover {
      box-shadow: 0 6px 20px rgba(255, 0, 0, 0.8);
      background: linear-gradient(135deg, #ff0080 0%, #ff3c3c 100%);
      color: #fff;
    }

    /* Responsive design walata media queries denna - mobile walata adjust karanawa */
    @media (max-width: 1200px) {
      .timeline::after {
        left: 31px;
      }

      .timeline-item {
        width: 100%;
        padding-left: 70px;
        padding-right: 25px;
      }

      .timeline-item::after {
        left: 21px;
      }

      .left::after, .right::after {
        left: 21px;
      }

      .right {
        left: 0;
        text-align: left;
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
      
      .about-hero h1 {
        font-size: 3.5rem;
      }
      
      .about-section h2 {
        font-size: 2rem;
      }
      
      .about-section p {
        font-size: 1rem;
      }
      
      .team-member {
        padding: 20px;
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
  </style>
</head>
<body>
  <!-- Floating game elements in background - canvas ekak + icons -->
  <canvas id="gameElements"></canvas>
  
  <!-- Floating game icons - decorative images page eke background eke -->
  <img src="https://cdn-icons-png.flaticon.com/512/686/686589.png" class="game-element" style="top: 20%; left: 10%; width: 80px; animation-delay: 0s;">
  <img src="https://cdn-icons-png.flaticon.com/512/2965/2965879.png" class="game-element" style="top: 30%; right: 15%; width: 60px; animation-delay: 2s;">
  <img src="https://cdn-icons-png.flaticon.com/512/3612/3612569.png" class="game-element" style="top: 60%; left: 20%; width: 70px; animation-delay: 4s;">
  <img src="https://cdn-icons-png.flaticon.com/512/2936/2936886.png" class="game-element" style="top: 70%; right: 10%; width: 50px; animation-delay: 6s;">
  <img src="https://cdn-icons-png.flaticon.com/512/13/13973.png" class="game-element" style="top: 40%; right: 25%; width: 90px; animation-delay: 1s;">

  <!-- Navigation bar ekak - site eke main links okkoma meka athule -->
  <nav class="navbar">
    <ul class="nav-links">
      <li><a href="home.php">Home</a></li>
      <li><a href="gamepage.php">Games</a></li>
      <li><a href="About.php">About</a></li>
      <li><a href="leardboard.php">Leaderboard</a></li>
    </ul>
    <div class="auth-buttons" id="authButtons">
      <a href="login.php" class="login-btn" id="loginBtn">LOGIN</a>
    </div>
  </nav>

  <!-- About hero section ekak - page eke main title eka -->
  <section class="about-hero">
    <h1>ABOUT GAME ZONE</h1>
  </section>

  <!-- About content ekak - mission saha technology paragraphs -->
  <div class="about-content">
    <div class="about-section">
      <h2>OUR MISSION</h2>
      <p>At Game Zone, we're passionate about bringing the joy of gaming to everyone. Our mission is to create accessible, browser-based games that don't require expensive hardware or downloads. We believe in the power of JavaScript to deliver immersive gaming experiences right in your web browser.</p>
      <p>Founded in 2015, we've grown from a small indie game studio to a platform hosting dozens of unique games played by millions worldwide. Our team of developers, designers, and gaming enthusiasts work tirelessly to push the boundaries of what's possible with web technologies.</p>
    </div>

    <div class="about-section">
      <h2>THE TECHNOLOGY</h2>
      <p>All our games are built using pure HTML5, CSS3, and JavaScript - no plugins required. We leverage cutting-edge web APIs like Canvas, WebGL, and Web Audio to create rich, interactive experiences that rival native applications.</p>
      <p>Our proprietary game engine, ZoneCore, optimizes performance across all devices while maintaining stunning visual fidelity. Whether you're playing on a high-end PC or a mobile device, Game Zone adapts to deliver the best possible experience.</p>
    </div>
  </div>

  <!-- Timeline ekak - company history display karanawa -->
  <div class="timeline">
    <div class="timeline-item left">
      <div class="timeline-content">
        <h3>2015 - FOUNDING</h3>
        <p>Game Zone was founded by a small group of web developers who wanted to prove that browser games could be just as engaging as console games.</p>
      </div>
    </div>
    <div class="timeline-item right">
      <div class="timeline-content">
        <h3>2017 - FIRST HIT</h3>
        <p>Our game "Space Shooter" went viral, reaching over 1 million players in just 3 months and proving the viability of our platform.</p>
      </div>
    </div>
    <div class="timeline-item left">
      <div class="timeline-content">
        <h3>2019 - ZONECORE ENGINE</h3>
        <p>We launched our proprietary game engine, allowing for more complex physics, AI, and multiplayer capabilities in our games.</p>
      </div>
    </div>
    <div class="timeline-item right">
      <div class="timeline-content">
        <h3>2021 - MOBILE OPTIMIZATION</h3>
        <p>Complete overhaul of our platform to provide seamless touch controls and performance optimization for mobile devices.</p>
      </div>
    </div>
    <div class="timeline-item left">
      <div class="timeline-content">
        <h3>2023 - COMMUNITY FEATURES</h3>
        <p>Added leaderboards, achievements, and social features to create a more connected gaming experience.</p>
      </div>
    </div>
    <div class="timeline-item right">
      <div class="timeline-content">
        <h3>2025 - THE FUTURE</h3>
        <p>Expanding into Web3 gaming with blockchain integration while maintaining our commitment to free, accessible browser games.</p>
      </div>
    </div>
  </div>

  <!-- Team section ekak - team members display karanawa -->
  <div class="team-section">
    <h2>MEET THE TEAM</h2>
    <div class="team-grid">
      <div class="team-member">
        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Team Member" style="width:120px;height:120px;object-fit:cover;border-radius:50%;" >
        <h3>DILSHAN HASINDU</h3>
        <p>Founder & Lead Developer</p>
      </div>
      <div class="team-member">
        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Team Member" style="width:120px;height:120px;object-fit:cover;border-radius:50%;" >
        <h3>SAMANTHA JAYAWEERA</h3>
        <p>Game Designer</p>
      </div>
      <div class="team-member">
        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Team Member" style="width:120px;height:120px;object-fit:cover;border-radius:50%;" >
        <h3>RAVINDU PERERA</h3>
        <p>Frontend Developer</p>
      </div>
      <div class="team-member">
        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Team Member" style="width:120px;height:120px;object-fit:cover;border-radius:50%;" >
        <h3>NISHA FERNANDO</h3>
        <p>UI Designer</p>
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
    // Game elements background animation ekata canvas walin floating icons denna
    const canvas = document.getElementById('gameElements');
    const ctx = canvas.getContext('2d');
    
    // Canvas eke size eka set karanawa
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    
    // Game elements array ekak hadanawa - floating icons walata
    const elements = [];
    const gameIcons = [
      '🎮', '👾', '🕹️', '🎯', '🎲',
      '🏆', '⚔️', '🛡️', '🧙', '🐉'
    ];
    
    // Game element hadanna function ekak - random position, size, speed, opacity denna
    function createElement() {
      elements.push({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        size: Math.random() * 30 + 20,
        speed: Math.random() * 2 + 1,
        icon: gameIcons[Math.floor(Math.random() * gameIcons.length)],
        opacity: Math.random() * 0.2 + 0.05,
        angle: Math.random() * 360
      });
    }
    
    // Game elements draw karana function ekak
    function drawElements() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      
      for (let i = 0; i < elements.length; i++) {
        const el = elements[i];
        
        ctx.save();
        ctx.translate(el.x, el.y);
        ctx.rotate(el.angle * Math.PI / 180);
        ctx.globalAlpha = el.opacity;
        ctx.font = `${el.size}px Arial`;
        ctx.fillText(el.icon, -el.size/2, el.size/3);
        ctx.restore();
        
        // Game element eka move karanawa
        el.y += el.speed;
        el.angle += 0.2;
        
        // Game element eka out of bounds nam recycle karanawa
        if (el.y > canvas.height + el.size) {
          el.y = -el.size;
          el.x = Math.random() * canvas.width;
        }
      }
    }
    
    // Initial game elements hadanawa (30k wadi icons ekak)
    for (let i = 0; i < 30; i++) {
      createElement();
    }
    
    // Animation ekata interval ekak denna
    setInterval(drawElements, 50);
    
    // Window resize ekedi canvas size update karanawa
    window.addEventListener('resize', () => {
      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;
    });
    
    // Signup button ekata click karama alert ekak pennanawa (future use)
    document.getElementById('openSignup').addEventListener('click', (e) => {
      e.preventDefault();
      alert('Signup form will appear here!');
    });
    
    // Page eka load unaama top ekata scroll karanawa
    window.addEventListener('DOMContentLoaded', () => {
      window.scrollTo(0, 0);
    });
    
    // User login status check karala LOGOUT/LOGIN button display karanawa
    // --- Auth button login/logout switch (single logic, duplicate code ain karanawa ---
    (function() {
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
    })();
  </script>
</body>
</html>