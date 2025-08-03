<?php
session_start();
include '../config.php'; // DB connection

$score_inserted = false;
$error_message = '';

// Guest user id (users table eke thiyena id ekak)
$guest_user_id = 1;

// Debug: Session user_id print
if (isset($_SESSION['user_id'])) {
    error_log('Session user_id: ' . $_SESSION['user_id']);
}

if (isset($_GET['score'])) {
    // Always use the session user_id if set (login user), else guest
    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
        $user_id = intval($_SESSION['user_id']);
    } else {
        $user_id = $guest_user_id; // Guest user id
    }
    $game_id = 1; // Game 1 id (games table eke id eka)
    $score = intval($_GET['score']);

    if ($score > 0) {
        $stmt = $conn->prepare("INSERT INTO scores (user_id, game_id, score) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("iii", $user_id, $game_id, $score);
            if ($stmt->execute()) {
                $score_inserted = true;
                // --- Leaderboard table eke high score update/insert karanna ---
                $check = $conn->prepare("SELECT high_score FROM leaderboard WHERE user_id = ? AND game_id = ?");
                $check->bind_param('ii', $user_id, $game_id);
                $check->execute();
                $check->store_result();
                if ($check->num_rows > 0) {
                    $check->bind_result($current_high);
                    $check->fetch();
                    if ($score > $current_high) {
                        $update = $conn->prepare("UPDATE leaderboard SET high_score = ?, achieved_at = NOW() WHERE user_id = ? AND game_id = ?");
                        $update->bind_param('iii', $score, $user_id, $game_id);
                        $update->execute();
                        $update->close();
                    }
                } else {
                    $insert = $conn->prepare("INSERT INTO leaderboard (user_id, game_id, high_score) VALUES (?, ?, ?)");
                    $insert->bind_param('iii', $user_id, $game_id, $score);
                    $insert->execute();
                    $insert->close();
                }
                $check->close();
                // --- end leaderboard logic ---
            } else {
                $error_message = 'Score insert failed: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            $error_message = 'DB Error: ' . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Game Over</title>
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
    /* Body eke background ekath font ekath set karanawa - flex ekak denna center karanna */
    body {
      background: radial-gradient(ellipse at bottom, #1B2735 0%, #090A0F 100%);
      color: white;
      font-family: 'Segoe UI', sans-serif;
      overflow-x: hidden;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
    /* Score container ekata background ekak, border radius ekak, shadow ekak denna */
    .score-container {
      text-align: center;
      color: white;
      padding: 30px;
      background-color: rgba(0, 0, 0, 0.5);
      border-radius: 20px;
      box-shadow: 0 0 30px rgba(0, 255, 255, 0.3);
      margin-top: 80px;
    }
    /* Final score display karana div ekata font size, color, shadow ekak denna */
    #finalScore {
      font-size: 80px;
      color: yellow;
      margin: 20px 0;
      text-shadow: 0 0 10px rgba(255, 255, 0, 0.7);
      font-family: 'Press Start 2P', cursive;
    }
    /* Button container ekata flex ekak denna + gap denna */
    .button-container {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 30px;
    }
    /* Button walata style ekak denna - gradient, border radius, shadow, font, etc. */
    .btn, .back-btn {
      padding: 15px 30px;
      font-size: 20px;
      background: linear-gradient(135deg, #00d2ff, #3a7bd5);
      border: none;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.3s ease;
      color: white;
      font-weight: bold;
      box-shadow: 0 5px 15px rgba(0, 210, 255, 0.4);
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 1px;
      text-transform: uppercase;
    }
    /* Button hover ekedi color, shadow, background change wenawa */
    .btn:hover, .back-btn:hover {
      transform: translateY(-3px) scale(1.05);
      box-shadow: 0 8px 20px rgba(0, 210, 255, 0.6);
      background: linear-gradient(135deg, #ff3366, #00ffff);
      color: #111;
    }
    /* Main title ekata font size, shadow, font-family denna */
    h1 {
      font-size: 48px;
      margin-bottom: 10px;
      text-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 2px;
    }
    /* Paragraph walata font size denna */
    p {
      font-size: 24px;
      margin-bottom: 5px;
    }
    </style>
</head>

<body>
    <!-- Score container ekak - game over message, score, buttons okkoma meka athule -->
    <div class="score-container">
        <h1>Game Over</h1> <!-- Main title ekak - game over kiyana eka -->
        <p>Your Final Score:</p> <!-- User ge final score eka pennanawa -->
        <div id="finalScore">0</div> <!-- Final score value eka display karanawa -->
        <?php if ($score_inserted): ?>
            <p style="color: #0f0; font-size:18px;">Score successfully added to the database!</p>
        <?php elseif ($error_message): ?>
            <p style="color: #f00; font-size:18px;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <div class="button-container"> <!-- Button 2k ekak - try again, back to game page -->
          <button onclick="retry()" class="btn">Try Again</button> <!-- Game eka restart karanna button ekak -->
          <button onclick="goToGamePage()" class="back-btn">Back to Game Page</button> <!-- Game page ekata yanna button ekak -->
        </div>
    </div>
    <script>
        // URL eke score parameter eka ganna - user ge score eka display karanna
        const urlParams = new URLSearchParams(window.location.search);
        const score = urlParams.get('score');
        document.getElementById("finalScore").innerText = score;
        // Try Again button ekata click karama game eka restart karanawa
        function retry() {
            window.location.href = "index.php";
        }
        // Back to Game Page button ekata click karama game page ekata yanna
        function goToGamePage() {
            window.location.href = "../gamepage.php";
        }
    </script>
</body>
</html>