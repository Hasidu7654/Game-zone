<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Meta tag - mobile view ekata support denna -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Zone - Ultimate Gaming Experience</title>
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
      min-height: 300%;
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

    /* Auth buttons (login/logout) walata style ekak denna */
    .auth-buttons {
      font-size: 17px;
      display: flex;
      gap: 20px;
    }

    /* Login button ekata style ekak denna - glowing effect ekak */
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

    /* Login button ekata hover unama color, shadow, background change wenawa */
    .login-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0, 255, 255, 0.8);
      cursor: pointer;
      background: linear-gradient(135deg, #00ffff 0%, #0080ff 100%);
      color: #111;
    }

    /* Login button ekata hover unama glass shine ekak pennanawa */
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

    .login-btn:hover::after {
      transform: translateX(0);
    }
    
    /* Logout button ekata style ekak denna - red glowing effect ekak */
    .logout-btn {
      padding: 12px 30px;
      background: linear-gradient(135deg, #ff3c3c 0%, #ff0080 100%);
      color: #fff;
      border: none;
      border-radius: 30px;
      text-decoration: none;
      font-weight: bold;
      letter-spacing: 1px;
      box-shadow: 0 4px 15px rgba(255, 0, 0, 0.4);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      text-transform: uppercase;
      font-family: 'Orbitron', sans-serif;
    }

    /* Logout button ekata hover unama color, shadow, background change wenawa */
    .logout-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(255, 0, 0, 0.8);
      cursor: pointer;
      background: linear-gradient(135deg, #ff0080 0%, #ff3c3c 100%);
      color: #fff;
    }

    /* Logout button ekata hover unama glass shine ekak pennanawa */
    .logout-btn::after {
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

    .logout-btn:hover::after {
      transform: translateX(0);
    }

    /* Hero section ekata style ekak denna - main title eka center karanawa, animation ekak thiyenawa */
    .hero {
      text-align: center;
      margin-top: 100px;
      position: relative;
      z-index: 10;
      padding: 0 20px;
    }

    /* Hero section eke h1 title ekata style ekak denna - font, color, animation */
    .hero h1 {
      font-size: 6rem;
      color: #00ffff;
      text-shadow: 0 0 20px rgba(0, 255, 255, 0.8);
      font-family: 'Press Start 2P', cursive;
      letter-spacing: 5px;
      margin-bottom: 20px;
      animation: glowPulse 3s ease-in-out infinite;
      position: relative;
      line-height: 1.2;
    }

    /* Glow pulse animation ekata keyframes denna - text shadow animate wenawa */
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

    /* Logo description ekata style ekak denna - border ekak, font ekak, shadow ekak */
    .logo-description {
      text-align: left;
      margin: 80px auto;
      max-width: 700px;
      margin-left: 100px;
      position: relative;
      z-index: 10;
      border-left: 3px solid #00ffff;
      padding-left: 30px;
    }

    /* Logo description eke h3 ekata style ekak denna */
    .logo-description h3 {
      font-size: 3.5rem;
      color: #00ffff;
      margin-bottom: 20px;
      font-weight: bold;
      font-family: 'Orbitron', sans-serif;
      text-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
      letter-spacing: 2px;
    }

    /* Logo description eke p ekata style ekak denna */
    .logo-description p {
      font-size: 1.5rem;
      color: #ccc;
      font-weight: bold;
      max-width: 600px;
      line-height: 1.6;
      font-family: 'Segoe UI', sans-serif;
      text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    /* Title images walata style ekak denna - float animation ekak */
    .title-images {
      display: flex;
      justify-content: flex-end;
      gap: 30px;
      margin-right: 50px;
      margin-top: 40px;
    }

    /* Title image ekakata style ekak denna - animation, filter, hover effect */
    .title-icon {
      width: 350px;
      height: 350px;
      object-fit: contain;
      transition: all 0.5s ease;
      animation: float 3s ease-in-out infinite alternate;
      filter: drop-shadow(0 0 15px rgba(0, 255, 255, 0.9));
    }

    /* Title image 1 ekata animation delay ekak denna */
    .title-icon:nth-child(1) {
      animation-delay: 0.5s;
    }

    /* Title image 2 ekata animation delay ekak denna */
    .title-icon:nth-child(2) {
      animation-delay: 1s;
    }

    /* Float animation ekata keyframes denna - image eka up/down wenawa */
    @keyframes float {
      0% {
        transform: translateY(0) rotate(0deg);
      }
      100% {
        transform: translateY(-25px) rotate(5deg);
      }
    }

    /* Title image ekata hover unama pulse animation ekak denna */
    .title-icon:hover {
      animation: pulse 0.5s ease-in-out;
      transform: scale(1.3);
      filter: drop-shadow(0 0 25px rgba(0, 255, 255, 1));
    }

    /* Pulse animation ekata keyframes denna - scale wenawa */
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.3); }
      100% { transform: scale(1); }
    }

    /* Why Gamezone section ekata style ekak denna - reveal animation, gradient background, border radius, shadow */
    .reveal-section {
      opacity: 0;
      transform: translateY(100px);
      transition: opacity 1s ease-out, transform 1s ease-out;
      padding: 80px 20px;
      text-align: center;
      background: linear-gradient(to bottom, #070740, #000000);
      color: white;
      margin-top: 70px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 255, 255, 0.2);
      max-width: 1400px;
      margin-left: auto;
      margin-right: auto;
    }

    /* Why Gamezone section eka visible unama show class ekak denna */
    .reveal-section.show {
      opacity: 1;
      transform: translateY(0);
    }

    /* Why box ekata style ekak denna - max width, margin */
    .why-box {
      max-width: 600px;
      margin: auto;
    }

    /* Why box eke h2 ekata style ekak denna */
    .why-box h2 {
      font-size: 2.5rem;
      margin-bottom: 15px;
    }

    /* Why box eke h2 eke span ekata color, shadow denna */
    .why-box h2 span {
      color: #00ffff;
      text-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
    }

    /* Why box eke p ekata style ekak denna */
    .why-box p {
      font-size: 1.2rem;
      font-weight: bold;
      line-height: 1.6;
    }

    /* Hidden section ekata style ekak denna - default walata hide karanawa */
    .hidden-section {
      opacity: 0;
      transform: translateY(50px);
      transition: opacity 0.8s ease, transform 0.8s ease;
    }

    /* Fade-in class ekata style ekak denna - section eka view ekata enakota */
    .fade-in {
      opacity: 1;
      transform: translateY(0);
    }

    /* Fade-out class ekata style ekak denna - section eka view eken yanna */
    .fade-out {
      opacity: 0;
      transform: translateY(50px);
    }

    /* Games section ekata style ekak denna - flex, margin, width, z-index */
    .scroll-section {
      display: flex;
      margin: 150px auto;
      width: 85%;
      justify-content: space-between;
      align-items: center;
      position: relative;
      z-index: 10;
    }

    /* Games section eke left side ekata style ekak denna */
    .left-side {
      width: 45%;
      color: white;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }

    /* Built with text ekata style ekak denna */
    .built-with {
      color: #00ffff;
      font-size: 2rem;
      font-family: 'Orbitron', sans-serif;
      font-weight: bold;
      letter-spacing: 3px;
      margin-bottom: 40px;
      text-transform: uppercase;
      position: relative;
      display: inline-block;
    }

    /* Built with eke underline ekata style ekak denna */
    .built-with::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 0;
      width: 100%;
      height: 3px;
      background: linear-gradient(90deg, #00ffff, transparent);
    }

    /* Arrow button walata style ekak denna - up/down buttons */
    .arrow-btn {
      font-size: 2.5rem;
      background: transparent;
      color: #00ffff;
      border: none;
      cursor: pointer;
      margin: 20px 0;
      transition: all 0.3s ease;
      position: relative;
    }

    /* Arrow button ekata hover unama scale, shadow denna */
    .arrow-btn:hover {
      transform: scale(1.3);
      text-shadow: 0 0 20px rgba(0, 255, 255, 0.8);
    }

    /* Game list ekata style ekak denna - scroll, max height, smooth scroll */
    #gameList {
      list-style: none;
      padding: 0;
      margin: 30px 0;
      max-height: 300px;
      overflow: hidden;
      width: 100%;
      scroll-behavior: smooth;
    }

    /* Game item walata style ekak denna - background, border, hover, selected */
    .game-item {
      margin-bottom: 30px;
      padding: 20px;
      border-radius: 10px;
      background: rgba(0, 0, 0, 0.3);
      border-left: 3px solid transparent;
      transition: all 0.3s ease;
      opacity: 0.7;
      cursor: pointer;
      position: relative;
      overflow: hidden;
    }

    /* Game item ekata hover unama gradient ekak pennanawa */
    .game-item::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, rgba(0, 255, 255, 0.1), transparent);
      transform: translateX(-100%);
      transition: transform 0.4s ease;
    }

    .game-item:hover::before {
      transform: translateX(0);
    }

    /* Game item ekak selected unama style ekak denna */
    .game-item.selected {
      opacity: 1;
      background: rgba(0, 0, 0, 0.5);
      border-left: 3px solid #00ffff;
      box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
    }

    /* Game item eke p ekata style ekak denna */
    .game-item p {
      color: #ffffff;
      font-size: 1rem;
      margin-top: 10px;
      line-height: 1.6;
    }

    /* Game item eke h2 ekata style ekak denna */
    .game-item h2 {
      font-size: 1.8rem;
      margin: 5px 0;
      color: #00ffff;
      letter-spacing: 1px;
      font-weight: bold;
      font-family: 'Orbitron', sans-serif;
    }

    /* Start game button ekata style ekak denna */
    .start-btn {
      position: relative;
      display: inline-block;
      padding: 12px 30px;
      background: rgba(0, 0, 0, 0.5);
      color: #fff;
      font-size: 1rem;
      margin-top: 15px;
      border: 2px solid #00ffff;
      border-radius: 30px;
      cursor: pointer;
      overflow: hidden;
      z-index: 1;
      font-weight: bold;
      letter-spacing: 1px;
      transition: all 0.3s ease;
      font-family: 'Orbitron', sans-serif;
      text-transform: uppercase;
    }

    /* Start game button ekata hover unama background, shadow, transform denna */
    .start-btn:hover {
      background: rgba(0, 255, 255, 0.2);
      box-shadow: 0 0 20px rgba(0, 255, 255, 0.4);
      transform: translateY(-3px);
    }

    /* Start game button ekata hover unama glass shine ekak pennanawa */
    .start-btn::after {
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

    .start-btn:hover::after {
      transform: translateX(0);
    }

    /* Games section eke right side ekata style ekak denna - image preview */
    .right-side {
      width: 50%;
      perspective: 1000px;
      position: relative;
    }

    /* Game image ekata style ekak denna - border, shadow, animation */
    .game-image {
      width: 100%;
      max-width: 600px;
      height: auto;
      max-height: 650px;
      object-fit: cover;
      border: 3px solid #00ffff;
      border-radius: 15px;
      transition: all 0.5s ease;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
      transform-style: preserve-3d;
      animation: float 6s ease-in-out infinite;
    }

    /* Game image ekata hover unama rotate, scale, shadow denna */
    .game-image:hover {
      transform: rotateY(15deg) scale(1.05);
      box-shadow: 0 30px 60px rgba(0, 255, 255, 0.5);
    }

    /* Game image ekata float animation ekak denna */
    @keyframes float {
      0%, 100% {
        transform: translateY(0) rotateY(0deg);
      }
      50% {
        transform: translateY(-20px) rotateY(5deg);
      }
    }

    /* Footer image ekata style ekak denna - animation, shadow, hover */
    .footer-image-container {
      position: relative;
      width: 100%;
      height: 0;
    }

    .footer-side-image {
      position: absolute;
      left: 30%;
      bottom: 15%;
      width: 400px;
      height: auto;
      z-index: 10;
      opacity: 0.9;
      transition: transform 0.3s ease, opacity 0.3s ease;
      transform-origin: center center;
      filter: drop-shadow(0 0 15px rgba(0, 255, 255, 0.5));
      animation: float 4s ease-in-out infinite;
    }

    .footer-side-image:hover {
      transform: scale(1.05) rotate(3deg);
      opacity: 1;
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
      transition: all 0.3s ease;
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

    /* Responsive design ekata style ekak denna - mobile walata */
    @media (max-width: 1200px) {
      .scroll-section {
        flex-direction: column;
        width: 90%;
      }
      
      .left-side, .right-side {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
      }
      
      .right-side {
        margin-top: 50px;
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
      
      .hero h1 {
        font-size: 3.5rem;
      }
      
      .logo-description {
        margin-left: 20px;
        margin-right: 20px;
      }
      
      .logo-description h3 {
        font-size: 2.5rem;
      }
      
      .logo-description p {
        font-size: 1.2rem;
      }
      
      .title-images {
        justify-content: center;
        margin-right: 0;
        margin-top: 30px;
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
      
      .footer-side-image {
        right: 50%;
        transform: translateX(50%);
        width: 300px;
      }
      
      .why-gamezone {
        margin: 100px auto;
        padding: 50px 20px;
      }
      
      .why-box h2 {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>
  <!-- Snow effect ekata canvas ekak -->
  <canvas id="snow"></canvas>

  <!-- Navigation bar ekak - main links saha login/logout button -->
  <nav class="navbar">
    <ul class="nav-links">
      <!-- Home link ekata -->
      <li><a href="home.php">Home</a></li>
      <!-- Games page link ekata -->
      <li><a href="gamepage.php">Games</a></li>
      <!-- About page link ekata -->
      <li><a href="About.php">About</a></li>
      <!-- Leaderboard page link ekata -->
      <li><a href="leardboard.php">Leaderboard</a></li>
    </ul>
    <div class="auth-buttons" id="authButtons">
      <!-- Login button ekata -->
      <a href="login.php" class="login-btn" id="loginBtn">LOGIN</a>
    </div>
  </nav>

  <!-- Hero section ekata - main title eka -->
  <section class="hero">
    <h1>GAME ZONE</h1><br><br><br>
  </section>

  <!-- Logo description ekata - game site eke description eka -->
  <div class="logo-description">
    <h3>THE JAVASCRIPT GAME</h3><br>
    <p>Experience fun and interactive browser games created using only HTML, CSS, and JavaScript.</p>
  </div>

  <!-- Title images ekata - main title ekata side images 2k -->
  <div class="title-images">
    <img src="Tv 1.png" alt="Icon 1" class="title-icon" />
    <img src="Tv.png" alt="Icon 2" class="title-icon" />
  </div>

  <!-- Why Gamezone section ekata - reveal animation ekak thiyenawa -->
  <section class="reveal-section" id="why-gamezone">
    <div class="why-box">
      <h2>Why use <span>GAMEZONE?</span></h2>
      <p>For over a decade, GAMEZONE has empowered developers of all skill levels to create exciting and interactive 2D web games. Whether you're just starting your journey into game development or you're an experienced developer looking to innovate, GAMEZONE provides the tools, resources, and a passionate community to help bring your ideas to life. Join us and explore the limitless possibilities of browser-based gaming!</p>
    </div>
  </section><br><br>

  <!-- Games section ekata - games list ekak saha preview image ekak -->
  <section class="scroll-section">
    <div class="left-side">
      <p class="built-with">GAMES WITH ZONE</p>
      <!-- Up arrow button ekata -->
      <button class="arrow-btn" id="upBtn"><i class="fas fa-arrow-up"></i></button>

      <ul id="gameList">
        <!-- Game 1 ekata -->
        <li class="game-item selected" data-image="Run (4).png">
          <h2>Run Jump</h2>
          <p>A fast-paced, brick breaking balancing act!</p>
          <button class="start-btn">Start Game</button>
        </li>
        <!-- Game 2 ekata -->
        <li class="game-item" data-image="RunShoot.png">
          <h2>Fire game</h2>
          <p>Dodge the traps and race to the end!</p>
          <button class="start-btn">Start Game</button>
        </li>
        <!-- Game 3 ekata -->
        <li class="game-item" data-image="photo 1.jpg">
          <h2>Space Shooter</h2>
          <p>Blast through alien fleets in this arcade classic!</p>
          <button class="start-btn">Start Game</button>
        </li>
        <!-- Game 4 ekata -->
        <li class="game-item" data-image="photo 3.jpg">
          <h2>Speed Racer</h2>
          <p>High-speed pixel racing with power-ups!</p>
          <button class="start-btn">Start Game</button>
        </li>
      </ul>

      <!-- Down arrow button ekata -->
      <button class="arrow-btn" id="downBtn"><i class="fas fa-arrow-down"></i></button>
    </div>

    <div class="right-side">
      <!-- Game preview image ekata -->
      <img src="https://img.freepik.com/free-vector/pixel-art-illustration-running-character_52683-83551.jpg" alt="Current Game" class="game-image" id="gameImage" />
    </div>
  </section>

  <!-- Image above footer ekata - game character ekak -->
  <div class="footer-image-container">
    <img src="https://cdn-icons-png.flaticon.com/512/686/686589.png" alt="Game Character" class="footer-side-image">
  </div>

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
        <a href="homepage.php">Home</a>
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
    // Snow effect ekata canvas ekak use karanawa - ultra lightweight snow effect
    const canvas = document.getElementById('snow');
    const ctx = canvas.getContext('2d');

    // Canvas size set karanawa - window size ekata anuwa
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    // Snowflakes array ekak hadanawa - snow particles tika denna
    const snowflakes = [];

    // Snowflake hadanna function ekak - random position, size, speed, opacity
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
        
        // Snowflake eka page eke yatin giyoth, top ekata reset karanawa
        if (f.y > canvas.height + f.radius) {
          f.y = -f.radius;
          f.x = Math.random() * canvas.width;
        }
      }
    }

    // Initial snowflakes 100k hadanawa (dense snow ekak pennanna)
    for (let i = 0; i < 100; i++) {
      createSnowflake();
    }

    // Animation ekata interval ekak use karanawa
    setInterval(drawSnowflakes, 50);

    // Window resize unama canvas size update karanawa
    window.addEventListener('resize', () => {
      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;
    });

    // Intersection Observer - why-gamezone section eka view ekata enakota fade-in/fade-out denna
    const target = document.querySelector("#why-gamezone");
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          target.classList.add("fade-in");
          target.classList.remove("fade-out");
        } else {
          target.classList.remove("fade-in");
          target.classList.add("fade-out");
        }
      });
    }, {
      threshold: 0.2
    });
    observer.observe(target);

    // Game selection logic - games list eke item select karanna, image update karanna
    const gameItems = document.querySelectorAll('.game-item');
    const gameList = document.getElementById('gameList');
    let currentIndex = 0;

    // Game select unama UI update karana function ekak
    function updateSelection() {
      gameItems.forEach((item, index) => {
        item.classList.toggle('selected', index === currentIndex);
        if (index === currentIndex) {
          const imageUrl = item.getAttribute('data-image');
          document.getElementById('gameImage').src = imageUrl;
          
          // Selected item eka smooth scroll karanawa
          item.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
      });
    }

    // Up button click - list eke udata yanna
    document.getElementById('upBtn').addEventListener('click', () => {
      if (currentIndex > 0) {
        currentIndex--;
        updateSelection();
      }
    });

    // Down button click - list eke yata yanna
    document.getElementById('downBtn').addEventListener('click', () => {
      if (currentIndex < gameItems.length - 1) {
        currentIndex++;
        updateSelection();
      }
    });

    // Game item ekakata click karama select karanawa
    gameItems.forEach((item, index) => {
      item.addEventListener('click', () => {
        currentIndex = index;
        updateSelection();
      });
    });

    // Page eka load unama initial selection ekak denna
    updateSelection();

    // Start game button click - Run Jump game ekata adala button ekata click karama signup.php ekata redirect karanawa
    document.querySelectorAll('.start-btn').forEach((button, idx) => {
      button.addEventListener('click', (e) => {
        e.preventDefault();
        if (idx === 0) { // Run Jump game (first item)
          window.location.href = 'signup.php';
        } else {
          alert('Game will start after login!');
        }
      });
    });

    // Page eka load unama scroll top karanawa
    window.addEventListener('DOMContentLoaded', () => {
      window.scrollTo(0, 0);
    });

    // Signup button click - demo alert ekak denna (me button eka page eke nathi unath, code eka sample ekak widiyata thiyenawa)
    document.getElementById('openSignup').addEventListener('click', (e) => {
      e.preventDefault();
      alert('Signup form will appear here!');
    });

    // Auth button login/logout switch (single logic, duplicate code ain karanawa)
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