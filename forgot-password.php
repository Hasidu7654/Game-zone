<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Game Zone - Reset Password</title>
 
  <!-- UI eke icons (Font Awesome) saha font (Google Fonts) link karanawa. -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Press+Start+2P&display=swap" rel="stylesheet">
  <style>
    /* Browser eke default margin, padding, box sizing okkoma ain karanawa. */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    /* Body background + font eka set karanawa */
    body {
      background: radial-gradient(ellipse at bottom, #1B2735 0%, #090A0F 100%);
      color: white;
      font-family: 'Segoe UI', sans-serif;
      overflow-x: hidden;
      margin: 0;
      padding: 0;
      min-height: 100vh;
    }
    /* Side background blur effect denna */
    .login-container::before {
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
    /* Container eka center karanawa */
    .login-container {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 50px 20px;
      z-index: 10;
    }
    /* Main box ekata glass look ekak denna */
    .login-box {
      background: rgba(0, 0, 0, 0.7);
      border: 1px solid rgba(0, 255, 255, 0.3);
      border-radius: 15px;
      padding: 40px;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 0 30px rgba(0, 255, 255, 0.2);
      backdrop-filter: blur(10px);
      position: relative;
      overflow: hidden;
    }
    /* Box ekata gradient border effect ekak denna */
    .login-box::before {
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
    /* Heading ekata style ekak denna */
    .login-title {
      font-family: 'Press Start 2P', cursive;
      color: #00ffff;
      text-align: center;
      margin-bottom: 30px;
      font-size: 1.5rem;
      text-shadow: 0 0 15px rgba(0, 255, 255, 0.7);
      letter-spacing: 3px;
    }
    /* Input group walata spacing denna */
    .input-group {
      margin-bottom: 25px;
      position: relative;
    }
    /* Label ekata style ekak denna */
    .input-group label {
      display: block;
      margin-bottom: 8px;
      color: #00ffff;
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 1px;
    }
    /* Input field ekata glass look ekak denna */
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
    .input-field:focus {
      outline: none;
      border-color: #00ffff;
      box-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
    }
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
    .password-toggle:hover {
      color: #00ffff;
    }
    /* Reset button ekata lassanata design ekak denna */
    .login-btn {
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
    .login-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0, 255, 255, 0.4);
    }
    /* Form eke links walata style ekak denna */
    .login-links {
      display: flex;
      justify-content: center;
      margin-top: 20px;
      flex-wrap: wrap;
      gap: 10px;
    }
    .login-links a {
      color: #00ffff;
      text-decoration: none;
      font-size: 14px;
      transition: all 0.3s ease;
      position: relative;
    }
    .login-links a::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 1px;
      background: #00ffff;
      transition: width 0.3s ease;
    }
    .login-links a:hover::after {
      width: 100%;
    }
    .login-links a:hover {
      text-shadow: 0 0 10px rgba(0, 255, 255, 0.7);
    }
    /* Error message ekata red color ekak denna */
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
    /* Success message ekata green color ekak denna */
    .success-message {
      color: #00ff88;
      font-size: 14px;
      margin-top: 5px;
      display: none;
    }
    /* Password strength bar ekata style ekak denna */
    .password-strength {
      width: 100%;
      height: 5px;
      background: rgba(255, 255, 255, 0.1);
      margin-top: 10px;
      border-radius: 5px;
      overflow: hidden;
    }
    .strength-meter {
      height: 100%;
      width: 0;
      background: #ff3c3c;
      transition: all 0.3s ease;
    }
    /* Modal ekata glass look ekak denna */
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
    @keyframes modalFadeIn {
      from { opacity: 0; transform: translateY(-50px); }
      to { opacity: 1; transform: translateY(0); }
    }
    /* Modal eke close button ekata hover ekak denna */
    .close-modal {
      position: absolute;
      top: 15px;
      right: 15px;
      color: #aaa;
      font-size: 24px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    .close-modal:hover {
      color: #00ffff;
      transform: rotate(90deg);
    }
    /* Modal eke title ekata attractive font ekak denna */
    .modal-title {
      color: #00ffff;
      font-family: 'Orbitron', sans-serif;
      margin-bottom: 20px;
      text-align: center;
      font-size: 1.8rem;
    }
    /* Responsive design ekak denna */
    @media (max-width: 768px) {
      .login-box {
        padding: 30px 20px;
      }
      .login-title {
        font-size: 1.2rem;
      }
    }
  </style>
</head>
<body>
  <!-- Reset password page eke mulama wrap karana container eka. -->
  <div class="login-container">
    <div class="login-box">
      <h2 class="login-title">RESET PASSWORD</h2>
      <?php
      $success = $error = '';
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email'] ?? '');
        $new_password = $_POST['new-password'] ?? '';
        $confirm_password = $_POST['confirm-password'] ?? '';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $error = 'Please enter a valid email address.';
        } elseif ($new_password !== $confirm_password) {
          $error = 'Passwords do not match.';
        } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/', $new_password)) {
          $error = 'Password must be at least 8 characters with uppercase, lowercase, number and special character.';
        } else {
          // Email eka database eke innawada balanna
          $stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
          $stmt->bind_param('s', $email);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result->num_rows === 1) {
            // Password eka update karanawa
            $hashed = password_hash($new_password, PASSWORD_DEFAULT);
            $update = $conn->prepare('UPDATE users SET password = ? WHERE email = ?');
            $update->bind_param('ss', $hashed, $email);
            if ($update->execute()) {
              $success = 'Your password has been successfully reset.';
            } else {
              $error = 'Something went wrong. Please try again.';
            }
            $update->close();
          } else {
            $error = 'මෙම ඊමේල් ලිපිනය සඳහා ගිණුමක් සොයාගත නොහැකියි';
          }
          $stmt->close();
        }
      }
      ?>
      <?php if ($success): ?>
        <div class="success-message" style="display:block; text-align:center; margin-bottom:20px;"> <?php echo $success; ?> <br><a href="login.php" class="login-btn" style="margin-top:15px;display:inline-block;">LOGIN NOW</a></div>
      <?php elseif ($error): ?>
        <div class="error-message" style="display:block; text-align:center; margin-bottom:20px;"> <?php echo $error; ?> </div>
      <?php endif; ?>
      <form id="resetForm" method="POST" autocomplete="off" <?php if ($success) echo 'style="display:none;"'; ?>>
        <!-- User ge email eka denna input ekak. -->
        <div class="input-group">
          <label for="email">EMAIL</label>
          <input type="email" id="email" name="email" class="input-field" placeholder="Enter your registered email" required>
          <div class="error-message" id="email-error">Please enter a valid email address</div>
        </div>
        <!-- User ta password eka denna input ekak. -->
        <div class="input-group">
          <label for="new-password">NEW PASSWORD</label>
          <input type="password" id="new-password" name="new-password" class="input-field" placeholder="Enter your new password" required>
          <i class="fas fa-eye password-toggle" id="toggleNewPassword"></i>
          <div class="password-strength">
            <div class="strength-meter" id="strength-meter"></div>
          </div>
          <div class="error-message" id="password-error">Password must be at least 8 characters with uppercase, lowercase, number and special character</div>
        </div>
        <!-- User ta password eka confirm karanna input ekak. -->
        <div class="input-group">
          <label for="confirm-password">CONFIRM PASSWORD</label>
          <input type="password" id="confirm-password" name="confirm-password" class="input-field" placeholder="Confirm your new password" required>
          <i class="fas fa-eye password-toggle" id="toggleConfirmPassword"></i>
          <div class="error-message" id="confirm-error">Passwords do not match</div>
        </div>
        <button type="submit" class="login-btn">RESET PASSWORD</button>
        <div class="login-links">
          <a href="login.php">Back to Login</a>
        </div>
      </form>
    </div>
  </div>
  <!-- Password reset unaama pennana popup ekak. -->
  <div class="modal" id="successModal">
    <div class="modal-content">
      <span class="close-modal">&times;</span>
      <h2 class="modal-title">PASSWORD RESET!</h2>
      <p style="text-align: center; margin: 20px 0; color: #00ffff; font-size: 1.2rem;">
        Your password has been successfully reset.
      </p>
      <div style="display: flex; justify-content: center;">
        <a href="login.html" class="login-btn" style="text-align: center; display: inline-block;">LOGIN NOW</a>
      </div>
    </div>
  </div>
  <script>
    // Password field eka show/hide karanna function ekak.
    const toggleNewPassword = document.getElementById('toggleNewPassword');
    const newPassword = document.getElementById('new-password');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPassword = document.getElementById('confirm-password');
    toggleNewPassword.addEventListener('click', function() {
      const type = newPassword.getAttribute('type') === 'password' ? 'text' : 'password';
      newPassword.setAttribute('type', type);
      this.classList.toggle('fa-eye-slash');
    });
    toggleConfirmPassword.addEventListener('click', function() {
      const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
      confirmPassword.setAttribute('type', type);
      this.classList.toggle('fa-eye-slash');
    });
    // Form eka submit karaddi input tika validate karanawa.
    const resetForm = document.getElementById('resetForm');
    const emailInput = document.getElementById('email');
    const newPasswordInput = document.getElementById('new-password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const emailError = document.getElementById('email-error');
    const passwordError = document.getElementById('password-error');
    const confirmError = document.getElementById('confirm-error');
    const strengthMeter = document.getElementById('strength-meter');
    // Email field eke value eka validda balanna event ekak.
    emailInput.addEventListener('input', () => {
      if (!emailInput.validity.valid) {
        emailError.style.display = 'block';
      } else {
        emailError.style.display = 'none';
      }
    });
    // Password eka strongda balanna bar ekak update karanawa.
    newPasswordInput.addEventListener('input', () => {
      const password = newPasswordInput.value;
      let strength = 0;
      if (password.length >= 8) strength += 1;
      if (password.length >= 12) strength += 1;
      if (/[A-Z]/.test(password)) strength += 1;
      if (/[a-z]/.test(password)) strength += 1;
      if (/[0-9]/.test(password)) strength += 1;
      if (/[^A-Za-z0-9]/.test(password)) strength += 1;
      // Password strength bar eka update karanawa.
      let width = 0;
      let color = '#ff3c3c'; // red
      if (strength <= 2) {
        width = 33;
      } else if (strength <= 4) {
        width = 66;
        color = '#ffcc00'; // yellow
      } else {
        width = 100;
        color = '#00ff88'; // green
      }
      strengthMeter.style.width = `${width}%`;
      strengthMeter.style.background = color;
      // Password eka validda balanna check karanawa.
      if (password.length > 0) {
        const hasUpper = /[A-Z]/.test(password);
        const hasLower = /[a-z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        const hasSpecial = /[^A-Za-z0-9]/.test(password);
        if (password.length < 8 || !hasUpper || !hasLower || !hasNumber || !hasSpecial) {
          passwordError.style.display = 'block';
        } else {
          passwordError.style.display = 'none';
        }
      } else {
        passwordError.style.display = 'none';
      }
      // Password dekama match wenawada balanna check karanawa.
      if (confirmPasswordInput.value.length > 0) {
        if (password !== confirmPasswordInput.value) {
          confirmError.style.display = 'block';
        } else {
          confirmError.style.display = 'none';
        }
      }
    });
    // Confirm password field eka match wenawada balanna event ekak.
    confirmPasswordInput.addEventListener('input', () => {
      if (confirmPasswordInput.value !== newPasswordInput.value) {
        confirmError.style.display = 'block';
      } else {
        confirmError.style.display = 'none';
      }
    });
    // Form eka submit karaddi okkoma validda balala, password update karanawa.
    resetForm.addEventListener('submit', (e) => {
      let isValid = true;
      // Email eka validda balanna check karanawa.
      if (!emailInput.validity.valid) {
        emailError.style.display = 'block';
        isValid = false;
      } else {
        emailError.style.display = 'none';
      }
      // Password eka validda balanna check karanawa.
      const password = newPasswordInput.value;
      const hasUpper = /[A-Z]/.test(password);
      const hasLower = /[a-z]/.test(password);
      const hasNumber = /[0-9]/.test(password);
      const hasSpecial = /[^A-Za-z0-9]/.test(password);
      if (password.length < 8 || !hasUpper || !hasLower || !hasNumber || !hasSpecial) {
        passwordError.style.display = 'block';
        isValid = false;
      } else {
        passwordError.style.display = 'none';
      }
      // Password dekama match wenawada balanna check karanawa.
      if (confirmPasswordInput.value !== newPasswordInput.value) {
        confirmError.style.display = 'block';
        isValid = false;
      } else {
        confirmError.style.display = 'none';
      }
      if (!isValid) {
        e.preventDefault();
      }
      // If valid, form will submit and PHP will handle DB update and errors
    });
    // Popup eka close karanna function ekak.
    document.querySelector('.close-modal').addEventListener('click', () => {
      document.getElementById('successModal').style.display = 'none';
    });
    // Popup eke athule nemei, pitin click karama close karanawa.
    window.addEventListener('click', (e) => {
      if (e.target === document.getElementById('successModal')) {
        document.getElementById('successModal').style.display = 'none';
      }
    });
  </script>
</body>
</html>