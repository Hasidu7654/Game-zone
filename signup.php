<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Meta tag - character set ekata -->
  <meta charset="UTF-8" />
  <title>Game Zone - Sign Up</title>
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
    /* Signup container ekata style ekak denna - center, padding, z-index */
    .signup-container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: calc(100vh - 200px);
      padding: 50px 20px;
      position: relative;
      z-index: 10;
    }
    /* Signup box ekata style ekak denna - glass look, border, shadow */
    .signup-box {
      background: rgba(0, 0, 0, 0.7);
      border: 1px solid rgba(0, 255, 255, 0.3);
      border-radius: 15px;
      padding: 40px;
      width: 100%;
      max-width: 600px;
      box-shadow: 0 0 30px rgba(0, 255, 255, 0.2);
      backdrop-filter: blur(10px);
      position: relative;
      overflow: hidden;
    }
    /* Signup box eke athule gradient effect ekak denna */
    .signup-box::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(
        to bottom right,
        rgba(0, 255, 255, 0.1) 0%,
        transparent 50%,
        rgba(0, 255, 255, 0.1) 100%
      );
      transform: rotate(30deg);
      z-index: -1;
    }
    /* Signup title ekata style ekak denna */
    .signup-title {
      font-family: 'Press Start 2P', cursive;
      color: #00ffff;
      text-align: center;
      margin-bottom: 30px;
      font-size: 2rem;
      text-shadow: 0 0 15px rgba(0, 255, 255, 0.7);
      letter-spacing: 3px;
    }
    /* Input group walata spacing ekak denna */
    .input-group {
      margin-bottom: 25px;
      position: relative;
    }
    /* Input group eke label ekata style ekak denna */
    .input-group label {
      display: block;
      margin-bottom: 8px;
      color: #00ffff;
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 1px;
    }
    /* Input field ekata style ekak denna - glass look ekak */
    .input-field {
      width: 100%;
      padding: 15px 20px;
      background: rgba(0, 0, 0, 0.5);
      border: 1px solid rgba(0, 255, 255, 0.3);
      border-radius: 8px;
      color: white;
      font-size: 16px;
      transition: all 0.3s ease;
      font-family: 'Segoe UI', sans-serif;
    }
    /* Input field ekata focus unama border, shadow denna */
    .input-field:focus {
      outline: none;
      border-color: #00ffff;
      box-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
    }
    /* Input field eke placeholder ekata color ekak denna */
    .input-field::placeholder {
      color: rgba(255, 255, 255, 0.5);
    }
    /* Password show/hide icon ekata style ekak denna */
    .password-toggle {
      position: absolute;
      right: 15px;
      top: 40px;
      color: #aaa;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    /* Password show/hide icon ekata hover unama color change wenawa */
    .password-toggle:hover {
      color: #00ffff;
    }
    /* Signup container eke back ekata blur image ekak denna */
    .signup-container::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('game 4.webp') center/cover no-repeat;
      z-index: -1;
      filter: blur(10px);
      opacity: 0.3;
    }
    /* Login container ekata position relative denna (compatibility) */
    .login-container {
      position: relative;
    }
    /* Signup button ekata style ekak denna */
    .signup-btn {
      width: 100%;
      padding: 15px;
      background: linear-gradient(135deg, #00ffff 0%, #0080ff 100%);
      color: #111;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 10px;
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 1px;
      text-transform: uppercase;
    }
    /* Signup button ekata hover unama transform, shadow denna */
    .signup-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0, 255, 255, 0.4);
    }
    /* Signup links walata style ekak denna */
    .signup-links {
      display: flex;
      justify-content: center;
      margin-top: 20px;
      flex-wrap: wrap;
      gap: 10px;
    }
    /* Signup links eke link ekata style ekak denna */
    .signup-links a {
      color: #00ffff;
      text-decoration: none;
      font-size: 14px;
      transition: all 0.3s ease;
      position: relative;
    }
    /* Signup links eke link ekata hover unama underline ekak denna */
    .signup-links a::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 1px;
      background: #00ffff;
      transition: width 0.3s ease;
    }
    .signup-links a:hover::after {
      width: 100%;
    }
    .signup-links a:hover {
      text-shadow: 0 0 10px rgba(0, 255, 255, 0.7);
    }
    /* Divider ekata style ekak denna */
    .divider {
      display: flex;
      align-items: center;
      margin: 25px 0;
      color: rgba(255, 255, 255, 0.5);
    }
    .divider::before, .divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: rgba(0, 255, 255, 0.3);
    }
    .divider::before {
      margin-right: 15px;
    }
    .divider::after {
      margin-left: 15px;
    }
    /* Social signup buttons walata style ekak denna */
    .social-signup {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 20px;
    }
    .social-btn {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(0, 0, 0, 0.5);
      border: 1px solid rgba(0, 255, 255, 0.3);
      color: white;
      font-size: 20px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    .social-btn:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 255, 255, 0.3);
      border-color: #00ffff;
    }
    .google-btn:hover {
      color: #db4437;
      border-color: #db4437;
    }
    /* Error message ekata style ekak denna - red color, shake animation */
    .error-message {
      color: #ff3c3c;
      font-size: 14px;
      margin-top: 5px;
      display: none;
      animation: shake 0.5s ease;
    }
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      20%, 60% { transform: translateX(-5px); }
      40%, 80% { transform: translateX(5px); }
    }
    /* Success message ekata style ekak denna - green color */
    .success-message {
      color: #00ff88;
      font-size: 14px;
      margin-top: 5px;
      display: none;
    }
    /* Password strength meter ekata style ekak denna */
    .strength-meter {
      width: 100%;
      height: 5px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 3px;
      margin-top: 10px;
      overflow: hidden;
    }
    .strength-meter-fill {
      height: 100%;
      width: 0;
      transition: width 0.3s ease, background 0.3s ease;
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
    @media (max-width: 768px) {
      .navbar {
        padding: 15px 20px;
        flex-direction: column;
      }
      .nav-links {
        margin-bottom: 20px;
        gap: 15px;
      }
      .signup-box {
        padding: 30px 20px;
      }
      .signup-title {
        font-size: 1.5rem;
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
    /* Modal ekata style ekak denna - glass look, blur, center */
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
    /* Modal eke content ekata style ekak denna */
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
    /* Modal fade in animation ekata keyframes denna */
    @keyframes modalFadeIn {
      from { opacity: 0; transform: translateY(-50px); }
      to { opacity: 1; transform: translateY(0); }
    }
    /* Modal eke close button ekata style ekak denna */
    .close-modal {
      position: absolute;
      top: 15px;
      right: 15px;
      color: #aaa;
      font-size: 24px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    /* Modal eke close button ekata hover unama color, rotate denna */
    .close-modal:hover {
      color: #00ffff;
      transform: rotate(90deg);
    }
    /* Modal eke title ekata style ekak denna */
    .modal-title {
      color: #00ffff;
      font-family: 'Orbitron', sans-serif;
      margin-bottom: 20px;
      text-align: center;
      font-size: 1.8rem;
    }
    /* Terms checkbox ekata style ekak denna */
    .terms-group {
      display: flex;
      align-items: flex-start;
      margin: 20px 0;
    }
    .terms-group input {
      margin-right: 10px;
      margin-top: 3px;
    }
    .terms-group label {
      color: #aaa;
      font-size: 14px;
      line-height: 1.5;
    }
    .terms-group label a {
      color: #00ffff;
      text-decoration: none;
      transition: all 0.3s ease;
    }
    .terms-group label a:hover {
      text-shadow: 0 0 10px rgba(0, 255, 255, 0.7);
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
    <div class="auth-buttons">
      <!-- Login button ekata -->
      <a href="login.php" class="auth-btn">LOGIN</a>
    </div>
  </nav>
  <!-- Signup container ekata - signup form eka wrap karanawa -->
  <div class="signup-container">
    <div class="signup-box">
      <h2 class="signup-title">JOIN THE GAME ZONE</h2>
      <form id="signupForm" method="POST" action="">
        <!-- Username input ekata -->
        <div class="input-group">
          <label for="username">USERNAME</label>
          <input type="text" id="username" class="input-field" placeholder="Choose your gamertag" name="username" required>
          <div class="error-message" id="username-error">Username must be 3-20 characters</div>
        </div>
        <!-- Email input ekata -->
        <div class="input-group">
          <label for="email">EMAIL</label>
          <input type="email" id="email" class="input-field" placeholder="Enter your email" name="email" required>
          <div class="error-message" id="email-error">Please enter a valid email address</div>
        </div>
        <!-- Password input ekata -->
        <div class="input-group">
          <label for="password">PASSWORD</label>
          <input type="password" id="password" class="input-field" placeholder="Create a strong password" name="password" required>
          <i class="fas fa-eye password-toggle" id="togglePassword"></i>
          <div class="strength-meter">
            <div class="strength-meter-fill" id="strengthMeter"></div>
          </div>
          <div class="error-message" id="password-error">Password must be at least 8 characters with uppercase, lowercase, number and symbol</div>
        </div>
        <!-- Confirm password input ekata -->
        <div class="input-group">
          <label for="confirm-password">CONFIRM PASSWORD</label>
          <input type="password" id="confirm-password" class="input-field" placeholder="Re-enter your password" name="confirm-password" required>
          <i class="fas fa-eye password-toggle" id="toggleConfirmPassword"></i>
          <div class="error-message" id="confirm-error">Passwords don't match</div>
        </div>
        <!-- Terms checkbox ekata -->
        <div class="terms-group">
          <input type="checkbox" id="terms" required>
          <label for="terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>. I confirm that I am at least 13 years old.</label>
        </div>
        <div class="error-message" id="terms-error">You must accept the terms to continue</div>
        <!-- Signup button ekata -->
        <button type="submit" class="signup-btn">CREATE ACCOUNT</button>
        <!-- Signup links ekata -->
        <div class="signup-links">
          <span>Already have an account?</span>
          <a href="login.php">Login here</a>
        </div>
        <!-- Divider ekata -->
        <div class="divider">OR</div>
        <!-- Social signup button ekata -->
        <div class="social-signup">
          <div class="social-btn google-btn" id="googleSignupBtn">
            <i class="fab fa-google"></i>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- Success Modal ekata - account create unaama pennanawa -->
  <div class="modal" id="successModal">
    <div class="modal-content">
      <span class="close-modal">&times;</span>
      <h2 class="modal-title">WELCOME TO GAME ZONE!</h2>
      <p style="text-align: center; margin: 20px 0; color: #00ffff; font-size: 1.2rem;">
        Your account has been successfully created.<br>Now you can log in to play games!
      </p>
      <div style="display: flex; justify-content: center;">
        <a href="login.php" class="auth-btn" style="text-align: center; display: inline-block;">GO TO LOGIN</a>
      </div>
    </div>
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
    // Password show/hide karanna function ekak - password field ekata
    const togglePassword = document.getElementById('togglePassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm-password');
    togglePassword.addEventListener('click', function() {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      this.classList.toggle('fa-eye-slash');
    });
    toggleConfirmPassword.addEventListener('click', function() {
      const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
      confirmPassword.setAttribute('type', type);
      this.classList.toggle('fa-eye-slash');
    });
    // Form validation ekata variables tika hadanawa
    const signupForm = document.getElementById('signupForm');
    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('confirm-password');
    const termsCheckbox = document.getElementById('terms');
    const strengthMeter = document.getElementById('strengthMeter');
    // Error message elements tika hadanawa
    const usernameError = document.getElementById('username-error');
    const emailError = document.getElementById('email-error');
    const passwordError = document.getElementById('password-error');
    const confirmError = document.getElementById('confirm-error');
    const termsError = document.getElementById('terms-error');
    // Username validation ekata event ekak denna
    usernameInput.addEventListener('input', () => {
      if (usernameInput.value.length < 3 && usernameInput.value.length > 0) {
        usernameError.style.display = 'block';
      } else if (usernameInput.value.length > 20) {
        usernameError.textContent = 'Username must be less than 20 characters';
        usernameError.style.display = 'block';
      } else {
        usernameError.style.display = 'none';
      }
    });
    // Email validation ekata event ekak denna
    emailInput.addEventListener('input', () => {
      if (!emailInput.validity.valid) {
        emailError.style.display = 'block';
      } else {
        emailError.style.display = 'none';
      }
    });
    // Password strength meter ekata event ekak denna
    passwordInput.addEventListener('input', () => {
      const password = passwordInput.value;
      let strength = 0;
      // Length check ekak denna
      if (password.length >= 8) strength += 25;
      if (password.length >= 12) strength += 25;
      // Complexity checks ekak denna
      if (/[A-Z]/.test(password)) strength += 15;
      if (/[a-z]/.test(password)) strength += 15;
      if (/\d/.test(password)) strength += 10;
      if (/[^A-Za-z0-9]/.test(password)) strength += 10;
      // Meter ekata width set karanawa
      strengthMeter.style.width = `${strength}%`;
      // Color ekak denna strength anuwa
      if (strength < 50) {
        strengthMeter.style.background = '#ff3c3c';
      } else if (strength < 75) {
        strengthMeter.style.background = '#ffcc00';
      } else {
        strengthMeter.style.background = '#00ff88';
      }
      // Password validation ekak denna
      if (password.length > 0 && password.length < 8) {
        passwordError.style.display = 'block';
      } else if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9])/.test(password) && password.length > 0) {
        passwordError.style.display = 'block';
      } else {
        passwordError.style.display = 'none';
      }
    });
    // Confirm password validation ekata event ekak denna
    confirmInput.addEventListener('input', () => {
      if (passwordInput.value !== confirmInput.value && confirmInput.value.length > 0) {
        confirmError.style.display = 'block';
      } else {
        confirmError.style.display = 'none';
      }
    });
    // Terms checkbox validation ekata event ekak denna
    termsCheckbox.addEventListener('change', () => {
      if (!termsCheckbox.checked) {
        termsError.style.display = 'block';
      } else {
        termsError.style.display = 'none';
      }
    });
    // Form submit karaddi validation okkoma balala, valid nam modal ekak pennanawa
    signupForm.addEventListener('submit', (e) => {
      let isValid = true;
      // Username validation ekak denna
      if (usernameInput.value.length < 3 || usernameInput.value.length > 20) {
        usernameError.style.display = 'block';
        isValid = false;
      } else {
        usernameError.style.display = 'none';
      }
      // Email validation ekak denna
      if (!emailInput.validity.valid) {
        emailError.style.display = 'block';
        isValid = false;
      } else {
        emailError.style.display = 'none';
      }
      // Password validation ekak denna
      if (passwordInput.value.length < 8 || !/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9])/.test(passwordInput.value)) {
        passwordError.style.display = 'block';
        isValid = false;
      } else {
        passwordError.style.display = 'none';
      }
      // Confirm password validation ekak denna
      if (passwordInput.value !== confirmInput.value) {
        confirmError.style.display = 'block';
        isValid = false;
      } else {
        confirmError.style.display = 'none';
      }
      // Terms checkbox validation ekak denna
      if (!termsCheckbox.checked) {
        termsError.style.display = 'block';
        isValid = false;
      } else {
        termsError.style.display = 'none';
      }
      if (!isValid) {
        e.preventDefault(); // Only prevent if validation fails
      }
      // If valid, form will submit to PHP and DB insert will happen
    });
    // Modal close karanna function ekak
    const closeModal = document.querySelectorAll('.close-modal');
    closeModal.forEach(btn => {
      btn.addEventListener('click', () => {
        document.querySelectorAll('.modal').forEach(modal => {
          modal.style.display = 'none';
        });
      });
    });
    // Modal eke pitin click karama close karanawa
    window.addEventListener('click', (e) => {
      if (e.target.classList.contains('modal')) {
        e.target.style.display = 'none';
      }
    });
    // User already logged in nam logout button ekak pennanawa
    const isLoggedIn = localStorage.getItem('gamezoneLoggedIn');
    if (isLoggedIn) {
      // Signup button eka logout button ekak widiyata wenas karanawa
      const authButtons = document.querySelector('.auth-buttons');
      authButtons.innerHTML = '<a href="#" class="auth-btn logout-btn" id="logoutBtn">LOGOUT</a>';
      // Logout button ekata click karama logout karanawa
      document.getElementById('logoutBtn').addEventListener('click', (e) => {
        e.preventDefault();
        localStorage.removeItem('gamezoneLoggedIn');
        window.location.href = 'home.php.';
      });
    }
    // Google signup button ekata click karama Google OAuth ekata redirect karanawa
    document.getElementById('googleSignupBtn').addEventListener('click', function() {
      window.location.href = 'https://accounts.google.com/o/oauth2/v2/auth?client_id=YOUR_CLIENT_ID&redirect_uri=YOUR_REDIRECT_URI&response_type=token&scope=email%20profile';
    });
  </script>
  <?php
  include 'config.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = trim($_POST["username"]);
      $email = trim($_POST["email"]);
      $password = $_POST["password"];
      $confirm = $_POST["confirm-password"];

      // Basic validation
      if ($password === $confirm && strlen($password) >= 8) {
          $hashed = password_hash($password, PASSWORD_DEFAULT);
          $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
          $stmt->bind_param("sss", $username, $email, $hashed);
          if ($stmt->execute()) {
              echo '<script>document.addEventListener("DOMContentLoaded",function(){document.getElementById("successModal").style.display="flex";});</script>';
          } else {
              echo "<div style='color:red;text-align:center;'>Error: Email already exists or DB error!</div>";
          }
          $stmt->close();
      } else {
          echo "<div style='color:red;text-align:center;'>Password mismatch or too short!</div>";
      }
  }
  ?>
</body>
</html>