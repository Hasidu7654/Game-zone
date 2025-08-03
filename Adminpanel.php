<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Zone - Admin Panel</title>
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

    /* Auth buttons (signout) walata glowing style ekak denna */
    .auth-buttons {
      font-size: 17px;
      display: flex;
      gap: 20px;
    }

    /* Signout button ekata gradient background ekak + neon shadow ekak denna */
    .signout-btn {
      padding: 12px 30px;
      background: linear-gradient(135deg, #ff3366 0%, #ff0033 100%);
      color: white;
      border: none;
      border-radius: 30px;
      text-decoration: none;
      font-weight: bold;
      letter-spacing: 1px;
      box-shadow: 0 4px 15px rgba(255, 0, 51, 0.4);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      text-transform: uppercase;
      font-family: 'Orbitron', sans-serif;
    }

    /* Signout button hover ekedi up ekata move wenawa + shadow wadi wenawa */
    .signout-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(255, 0, 51, 0.8);
      cursor: pointer;
    }

    /* Signout button ekata shine ekak animate karanawa hover ekedi */
    .signout-btn::after {
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

    /* Hover ekedi shine ekak signout button eke athule yanna denna */
    .signout-btn:hover::after {
      transform: translateX(0);
    }

    /* Admin Dashboard Container ekata flex ekak denna */
    .admin-container {
      display: flex;
      min-height: calc(100vh - 80px);
    }

    /* Sidebar ekata cyber terminal style ekak denna */
    .sidebar {
      width: 250px;
      background: rgba(11, 13, 27, 0.8);
      border-right: 1px solid rgba(0, 255, 255, 0.2);
      padding: 30px 0;
      backdrop-filter: blur(5px);
      position: relative;
      z-index: 10;
    }

    /* Sidebar eke background ekata SVG grid ekak denna (light lines) */
    .sidebar::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none" stroke="%2300ffff" stroke-width="0.5" opacity="0.05"/></svg>');
      opacity: 0.3;
      z-index: -1;
    }

    /* Admin profile section ekata flex ekak denna + border ekak denna */
    .admin-profile {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 0 20px 30px;
      border-bottom: 1px solid rgba(0, 255, 255, 0.2);
      margin-bottom: 30px;
    }

    /* Admin avatar ekata border ekak + shadow ekak denna */
    .admin-avatar {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      border: 3px solid #00ffff;
      object-fit: cover;
      margin-bottom: 15px;
      box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
    }

    /* Admin name ekata font ekak + color ekak denna */
    .admin-name {
      font-size: 1.3rem;
      font-weight: bold;
      color: #00ffff;
      margin-bottom: 5px;
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 1px;
    }

    /* Admin role ekata font ekak + background ekak denna */
    .admin-role {
      font-size: 0.9rem;
      color: #aaa;
      background: rgba(0, 0, 0, 0.3);
      padding: 3px 10px;
      border-radius: 15px;
      border: 1px solid rgba(0, 255, 255, 0.3);
    }

    /* Sidebar menu ekata style ekak denna */
    .sidebar-menu {
      list-style: none;
      padding: 0 20px;
    }

    /* Sidebar menu item ekata margin denna */
    .menu-item {
      margin-bottom: 15px;
      position: relative;
    }

    /* Sidebar menu link ekata flex ekak denna + icon ekak denna */
    .menu-item a {
      display: flex;
      align-items: center;
      padding: 12px 15px;
      color: #ccc;
      text-decoration: none;
      border-radius: 5px;
      transition: all 0.3s ease;
      font-size: 0.95rem;
    }

    /* Sidebar menu icon ekata neon color ekak denna */
    .menu-item a i {
      margin-right: 10px;
      font-size: 1.1rem;
      color: #00ffff;
      width: 20px;
      text-align: center;
    }

    /* Sidebar menu link hover ekedi background + color change wenawa */
    .menu-item a:hover {
      background: rgba(0, 255, 255, 0.1);
      color: white;
      box-shadow: 0 0 10px rgba(0, 255, 255, 0.2);
    }

    /* Active menu item ekata highlight ekak denna */
    .menu-item.active a {
      background: rgba(0, 255, 255, 0.2);
      color: white;
      font-weight: bold;
    }

    /* Active menu item ekata neon line ekak denna */
    .menu-item.active a::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 3px;
      background: #00ffff;
      box-shadow: 0 0 10px rgba(0, 255, 255, 0.7);
    }

    /* Main Content Area ekata flex ekak denna + padding denna */
    .main-content {
      flex: 1;
      padding: 30px;
      position: relative;
    }

    /* Dashboard header ekata flex ekak denna + border ekak denna */
    .dashboard-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 1px solid rgba(0, 255, 255, 0.2);
    }

    /* Dashboard title ekata font ekak + color ekak denna */
    .dashboard-title {
      font-size: 2rem;
      color: #00ffff;
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 2px;
      text-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
    }

    /* Stats Cards Grid ekata grid ekak denna */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }

    /* Stat card ekata background ekak + border ekak denna */
    .stat-card {
      background: rgba(11, 13, 27, 0.6);
      border: 1px solid rgba(0, 255, 255, 0.2);
      border-radius: 10px;
      padding: 20px;
      transition: all 0.3s ease;
      backdrop-filter: blur(5px);
      position: relative;
      overflow: hidden;
    }

    /* Stat card eke background ekata shine ekak denna */
    .stat-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(0, 255, 255, 0.05), transparent);
      z-index: -1;
    }

    /* Stat card hover ekedi up ekata move wenawa + shadow wadi wenawa */
    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0, 255, 255, 0.2);
      border-color: rgba(0, 255, 255, 0.5);
    }

    /* Stat card eke icon ekata neon color ekak denna */
    .stat-card i {
      font-size: 2rem;
      margin-bottom: 15px;
      color: #00ffff;
    }

    /* Stat title ekata font ekak denna */
    .stat-title {
      font-size: 0.9rem;
      color: #aaa;
      margin-bottom: 10px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    /* Stat value ekata font ekak denna */
    .stat-value {
      font-size: 2rem;
      font-weight: bold;
      color: white;
      font-family: 'Orbitron', sans-serif;
      margin-bottom: 5px;
    }

    /* Stat change ekata color ekak denna (up/down) */
    .stat-change {
      font-size: 0.8rem;
      display: flex;
      align-items: center;
    }

    .stat-change.up {
      color: #00ff88;
    }

    .stat-change.down {
      color: #ff3366;
    }

    /* Main Content Sections ekata background ekak denna */
    .content-section {
      background: rgba(11, 13, 27, 0.6);
      border: 1px solid rgba(0, 255, 255, 0.2);
      border-radius: 10px;
      padding: 25px;
      margin-bottom: 30px;
      backdrop-filter: blur(5px);
    }

    /* Section header ekata flex ekak denna + border ekak denna */
    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 1px solid rgba(0, 255, 255, 0.2);
    }

    /* Section title ekata font ekak denna */
    .section-title {
      font-size: 1.5rem;
      color: #00ffff;
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 1px;
    }

    /* Section actions button walata style ekak denna */
    .section-actions button {
      background: rgba(0, 255, 255, 0.1);
      border: 1px solid rgba(0, 255, 255, 0.3);
      color: #00ffff;
      padding: 8px 20px;
      border-radius: 30px;
      font-family: 'Orbitron', sans-serif;
      font-size: 0.9rem;
      cursor: pointer;
      transition: all 0.3s ease;
      letter-spacing: 1px;
    }

    /* Section actions button hover ekedi background + shadow denna */
    .section-actions button:hover {
      background: rgba(0, 255, 255, 0.2);
      box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
    }

    /* Games Table ekata style ekak denna */
    .games-table {
      width: 100%;
      border-collapse: collapse;
    }

    /* Games Table header ekata background ekak + color ekak denna */
    .games-table th {
      text-align: left;
      padding: 12px 15px;
      background: rgba(0, 0, 0, 0.3);
      color: #00ffff;
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 1px;
      font-size: 0.9rem;
      text-transform: uppercase;
    }

    /* Games Table data cell ekata padding denna + border denna */
    .games-table td {
      padding: 15px;
      border-bottom: 1px solid rgba(0, 255, 255, 0.1);
      color: #ddd;
    }

    /* Games Table last row ekata border bottom nathi karanawa */
    .games-table tr:last-child td {
      border-bottom: none;
    }

    /* Games Table row hover ekedi background + color change wenawa */
    .games-table tr:hover td {
      background: rgba(0, 255, 255, 0.05);
      color: white;
    }

    /* Game info ekata flex ekak denna */
    .game-info {
      display: flex;
      align-items: center;
    }

    /* Game cover image ekata border ekak denna */
    .game-cover {
      width: 50px;
      height: 50px;
      border-radius: 5px;
      object-fit: cover;
      margin-right: 15px;
      border: 1px solid rgba(0, 255, 255, 0.3);
    }

    /* Game name ekata font ekak denna */
    .game-name {
      font-weight: bold;
      margin-bottom: 3px;
    }

    /* Game category ekata font ekak + background ekak denna */
    .game-category {
      font-size: 0.8rem;
      color: #aaa;
      background: rgba(0, 0, 0, 0.3);
      padding: 2px 8px;
      border-radius: 10px;
      display: inline-block;
    }

    /* Status badge walata color ekak denna (active/pending/inactive) */
    .status-badge {
      display: inline-block;
      padding: 5px 10px;
      border-radius: 15px;
      font-size: 0.8rem;
      font-weight: bold;
    }

    .status-active {
      background: rgba(0, 255, 100, 0.1);
      color: #00ff88;
      border: 1px solid rgba(0, 255, 100, 0.3);
    }

    .status-pending {
      background: rgba(255, 200, 0, 0.1);
      color: #ffcc00;
      border: 1px solid rgba(255, 200, 0, 0.3);
    }

    .status-inactive {
      background: rgba(255, 50, 50, 0.1);
      color: #ff3366;
      border: 1px solid rgba(255, 50, 50, 0.3);
    }

    /* Action button walata transparent background ekak denna */
    .action-btn {
      background: transparent;
      border: none;
      color: #00ffff;
      cursor: pointer;
      margin: 0 5px;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    /* Action button hover ekedi color change + scale wenawa */
    .action-btn:hover {
      color: white;
      transform: scale(1.2);
    }

    /* Add New Game Form ekata background ekak denna */
    .add-game-form {
      background: rgba(11, 13, 27, 0.6);
      border: 1px solid rgba(0, 255, 255, 0.2);
      border-radius: 10px;
      padding: 25px;
      margin-bottom: 30px;
      backdrop-filter: blur(5px);
    }

    /* Form header ekata border ekak denna */
    .form-header {
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 1px solid rgba(0, 255, 255, 0.2);
    }

    /* Form title ekata font ekak denna */
    .form-title {
      font-size: 1.5rem;
      color: #00ffff;
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 1px;
    }

    /* Form group ekata margin denna */
    .form-group {
      margin-bottom: 20px;
    }

    /* Form label ekata font ekak denna */
    .form-label {
      display: block;
      margin-bottom: 8px;
      color: #00ffff;
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 1px;
      font-size: 0.9rem;
    }

    /* Form control (input, select, textarea) walata style ekak denna */
    .form-control {
      width: 100%;
      padding: 12px 15px;
      background: rgba(0, 0, 0, 0.3);
      border: 1px solid rgba(0, 255, 255, 0.3);
      border-radius: 5px;
      color: white;
      font-family: 'Segoe UI', sans-serif;
      transition: all 0.3s ease;
    }

    /* Form control focus ekedi border color + shadow denna */
    .form-control:focus {
      outline: none;
      border-color: #00ffff;
      box-shadow: 0 0 10px rgba(0, 255, 255, 0.3);
    }

    /* Form textarea ekata min-height denna + resize denna */
    .form-textarea {
      min-height: 120px;
      resize: vertical;
    }

    /* Form actions ekata flex ekak denna + gap denna */
    .form-actions {
      display: flex;
      justify-content: flex-end;
      gap: 15px;
      margin-top: 30px;
    }

    /* Submit button ekata gradient background ekak denna */
    .submit-btn {
      padding: 12px 30px;
      background: linear-gradient(135deg, #00ffff 0%, #0080ff 100%);
      color: #111;
      border: none;
      border-radius: 30px;
      font-weight: bold;
      letter-spacing: 1px;
      box-shadow: 0 4px 15px rgba(0, 255, 255, 0.4);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      text-transform: uppercase;
      font-family: 'Orbitron', sans-serif;
      cursor: pointer;
    }

    /* Submit button hover ekedi up ekata move wenawa + shadow wadi wenawa */
    .submit-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0, 255, 255, 0.8);
    }

    /* Cancel button ekata background ekak denna */
    .cancel-btn {
      padding: 12px 30px;
      background: rgba(0, 0, 0, 0.5);
      color: #ccc;
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 30px;
      font-weight: bold;
      letter-spacing: 1px;
      transition: all 0.3s ease;
      text-transform: uppercase;
      font-family: 'Orbitron', sans-serif;
      cursor: pointer;
    }

    /* Cancel button hover ekedi background + color change wenawa */
    .cancel-btn:hover {
      background: rgba(255, 255, 255, 0.1);
      color: white;
    }

     /* Image above footer ekata position ekak denna */
    .footer-image-container {
      position: relative;
      width: 100%;
      height: 0;
    }

    /* Footer side image ekata position ekak denna + animation denna */
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

    /* Footer side image hover ekedi scale wenawa + opacity wadi wenawa */
    .footer-side-image:hover {
      transform: scale(1.05) rotate(3deg);
      opacity: 1;
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

    /* --- THEME: DARK --- */
    body.theme-dark {
      background: #181a1b !important;
      color: #e0e0e0 !important;
    }
    .theme-dark .navbar,
    .theme-dark .sidebar,
    .theme-dark .main-content,
    .theme-dark .content-section,
    .theme-dark .add-game-form,
    .theme-dark .footer {
      background: #23272b !important;
      color: #e0e0e0 !important;
      border-color: #333 !important;
    }
    .theme-dark .section-title,
    .theme-dark .form-label,
    .theme-dark .dashboard-title {
      color: #00bfff !important;
    }
    .theme-dark .games-table th {
      background: #23272b !important;
      color: #00bfff !important;
    }
    .theme-dark .games-table td {
      color: #e0e0e0 !important;
    }
    .theme-dark .submit-btn {
      background: linear-gradient(135deg, #00bfff 0%, #0050a0 100%) !important;
      color: #fff !important;
    }
    .theme-dark .signout-btn {
      background: linear-gradient(135deg, #333 0%, #111 100%) !important;
      color: #fff !important;
    }
    .theme-dark .sidebar-menu .menu-item.active a {
      background: #1a1d1f !important;
      color: #00bfff !important;
    }
    .theme-dark .sidebar-menu .menu-item a:hover {
      background: #1a1d1f !important;
      color: #fff !important;
    }

    /* --- THEME: LIGHT --- */
    body.theme-light {
      background: #f5f7fa !important;
      color: #222 !important;
    }
    .theme-light .navbar,
    .theme-light .sidebar,
    .theme-light .main-content,
    .theme-light .content-section,
    .theme-light .add-game-form,
    .theme-light .footer {
      background: #fff !important;
      color: #222 !important;
      border-color: #e0e0e0 !important;
    }
    .theme-light .section-title,
    .theme-light .form-label,
    .theme-light .dashboard-title {
      color: #0078ff !important;
    }
    .theme-light .games-table th {
      background: #f0f4fa !important;
      color: #0078ff !important;
    }
    .theme-light .games-table td {
      color: #222 !important;
    }
    .theme-light .submit-btn {
      background: linear-gradient(135deg, #0078ff 0%, #00e0ff 100%) !important;
      color: #fff !important;
    }
    .theme-light .signout-btn {
      background: linear-gradient(135deg, #00e0ff 0%, #0078ff 100%) !important;
      color: #fff !important;
    }
    .theme-light .sidebar-menu .menu-item.active a {
      background: #e0f0ff !important;
      color: #0078ff !important;
    }
    .theme-light .sidebar-menu .menu-item a:hover {
      background: #e0f0ff !important;
      color: #0078ff !important;
    }
  </style>
  <style id="dynamic-theme-style">
    /* Light and Dark theme overrides will be injected here by JS */
  </style>
</head>
<body>
  <!-- Navigation bar ekak - site eke main links okkoma meka athule -->
  <nav class="navbar">
    <ul class="nav-links">
       <li><a href="home.php">Home</a></li>
      <li><a href="gamepage.php">Games</a></li>
      <li><a href="About.php">About</a></li>
      <li><a href="leardboard.php">Leaderboard</a></li>
    </ul>
    <div class="auth-buttons">
      <a href="home.php" class="signout-btn">SIGN OUT</a>
    </div>
  </nav>

  <div class="admin-container">
    <!-- Sidebar ekak - admin profile saha menu okkoma meka athule -->
    <aside class="sidebar">
      <div class="admin-profile">
        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin" class="admin-avatar">
        <div>
          <div class="admin-name">DILSHAN HASINDU</div>
          <div class="admin-role">SUPER ADMIN</div>
        </div>
      </div>
      
      <ul class="sidebar-menu">
        <li class="menu-item active" id="dashboardMenu">
          <a href="#">
            <i class="fas fa-tachometer-alt"></i>
            Dashboard
          </a>
        </li>
        <li class="menu-item" id="gamesMenu">
          <a href="#">
            <i class="fas fa-gamepad"></i>
            Games Management
          </a>
        </li>
        <li class="menu-item" id="usersMenu">
          <a href="#">
            <i class="fas fa-users"></i>
            Users
          </a>
        </li>
        <li class="menu-item" id="leaderboardsMenu">
          <a href="#">
            <i class="fas fa-trophy"></i>
            Leaderboards
          </a>
      
        </li>
        <li class="menu-item">
          <a href="#">
            <i class="fas fa-cog"></i>
            Settings
          </a>
        </li>
        
      </ul>
    </aside>

    <!-- Main Content ekak - dashboard, stats, form okkoma meka athule -->
    <main class="main-content">
      <div class="dashboard-header">
        <h1 class="dashboard-title">ADMIN DASHBOARD</h1>
        <!-- Search bar removed -->
      </div>

      <!-- Stats Cards ekak - games, users, revenue display karanawa -->
      <div class="stats-grid">
        <div class="stat-card">
          <i class="fas fa-gamepad"></i>
          <div class="stat-title">Total Games</div>
          <div class="stat-value">
            <?php
              $gamesCount = 0;
              $games = $conn->query("SELECT * FROM games ORDER BY id DESC");
              if ($games && $games->num_rows > 0) {
                $gamesCount = $games->num_rows;
                echo $gamesCount;
              } else {
                echo '0';
              }
            ?>
          </div>
          <div class="stat-change up">
            <i class="fas fa-arrow-up"></i> 3 new this week
          </div>
        </div>
        <div class="stat-card">
          <i class="fas fa-users"></i>
          <div class="stat-title">Active Users</div>
          <div class="stat-value" id="activeUsersCount">
            <?php
              $usersCount = 0;
              $users = $conn->query("SELECT * FROM users ORDER BY id DESC");
              if ($users && $users->num_rows > 0) {
                $usersCount = $users->num_rows;
                echo $usersCount;
              } else {
                echo '0';
              }
            ?>
          </div>
          <div class="stat-change up">
            <i class="fas fa-arrow-up"></i> 12% from last week
          </div>
        </div>
        <div class="stat-card">
          <i class="fas fa-dollar-sign"></i>
          <div class="stat-title">Revenue</div>
          <div class="stat-value">$3,245</div>
          <div class="stat-change down">
            <i class="fas fa-arrow-down"></i> 2% from last week
          </div>
        </div>
      </div>

      <!-- Add New Game Form ekak - adminla games add karanna -->
      <section class="add-game-form">
        <div class="form-header">
          <h2 class="form-title"><i class="fas fa-plus-circle"></i> ADD NEW GAME</h2>
        </div>
        
        <form id="gameForm">
          <div class="form-group">
            <label for="gameName" class="form-label">Game Name</label>
            <input type="text" id="gameName" class="form-control" placeholder="Enter game name" required>
          </div>
          
          <div class="form-group">
            <label for="gameDescription" class="form-label">Description</label>
            <textarea id="gameDescription" class="form-control form-textarea" placeholder="Enter game description" required></textarea>
          </div>
          
          <div class="form-group">
            <label for="gameCategory" class="form-label">Category</label>
            <select id="gameCategory" class="form-control" required>
              <option value="">Select category</option>
              <option value="action">Action</option>
              <option value="adventure">Adventure</option>
              <option value="puzzle">Puzzle</option>
              <option value="arcade">Arcade</option>
              <option value="sports">Sports</option>
              <option value="racing">Racing</option>
              <option value="strategy">Strategy</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="gameImage" class="form-label">Cover Image URL</label>
            <input type="text" id="gameImage" class="form-control" placeholder="Enter image URL" required>
          </div>
          
          <div class="form-group">
            <label for="gameFile" class="form-label">Game File</label>
            <input type="file" id="gameFile" class="form-control" required>
          </div>
          
          <div class="form-actions">
            <button type="button" class="cancel-btn">CANCEL</button>
            <button type="submit" class="submit-btn">ADD GAME</button>
          </div>
        </form>
      </section>

      <!-- Games Management Section (table only, initially hidden) -->
      <section class="content-section" id="gamesSection" style="display:none;">
        <div class="section-header">
          <h2 class="section-title"><i class="fas fa-gamepad"></i> Games Management</h2>
        </div>
        <table class="games-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Cover</th>
              <th>Name</th>
              <th>Description</th>
              <th>Created</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (isset($games) && $games && $games->num_rows > 0):
              while ($g = $games->fetch_assoc()): ?>
                <tr>
                  <td><?= $g['id'] ?></td>
                  <td>
                    <?php 
                      // Only show 'Run (4).png' for ID 1, 'RunShoot.png' for ID 2, otherwise show from DB
                      if ($g['id'] == 1) {
                        echo '<img src="Run (4).png" class="game-cover" alt="cover">';
                      } elseif ($g['id'] == 2) {
                        echo '<img src="RunShoot.png" class="game-cover" alt="cover">';
                      } else {
                        $images = explode(',', isset($g['image_url']) ? $g['image_url'] : '');
                        foreach($images as $img) {
                          $img = trim($img);
                          if ($img) {
                            echo '<img src="' . htmlspecialchars($img) . '" class="game-cover" alt="cover">';
                          }
                        }
                      }
                    ?>
                  </td>
                  <td><?= htmlspecialchars($g['name']) ?></td>
                  <td><?= isset($g['description']) ? htmlspecialchars($g['description']) : '' ?></td>
                  <td><?= date('Y-m-d', strtotime($g['created_at'])) ?></td>
                </tr>
              <?php endwhile;
            else: ?>
              <tr><td colspan="6">No games found.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </section>

      <!-- Users Management Section (table only, initially hidden) -->
      <section class="content-section" id="usersSection" style="display:none;">
        <div class="section-header">
          <h2 class="section-title"><i class="fas fa-users"></i> Users Management</h2>
        </div>
        <table class="games-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Username</th>
              <th>Email</th>
              <th>Registered</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $users = $conn->query("SELECT * FROM users ORDER BY id DESC");
            if ($users && $users->num_rows > 0):
              while ($u = $users->fetch_assoc()): ?>
                <tr>
                  <td><?= $u['id'] ?></td>
                  <td><?= isset($u['username']) ? htmlspecialchars($u['username']) : '' ?></td>
                  <td><?= isset($u['email']) ? htmlspecialchars($u['email']) : '' ?></td>
                  <td><?= isset($u['created_at']) ? date('Y-m-d', strtotime($u['created_at'])) : '' ?></td>
                </tr>
              <?php endwhile;
            else: ?>
              <tr><td colspan="4">No users found.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </section>

      <!-- Leaderboards Management Section (table only, initially hidden) -->
      <section class="content-section" id="leaderboardsSection" style="display:none;">
        <div class="section-header">
          <h2 class="section-title"><i class="fas fa-trophy"></i> Leaderboards</h2>
        </div>
        <table class="games-table">
          <thead>
            <tr>
              <th>Rank</th>
              <th>Username</th>
              <th>Game</th>
              <th>High Score</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Fetch leaderboard data with correct columns and join with games table
            $leaderboard = $conn->query("SELECT l.*, u.username, g.name AS game_name FROM leaderboard l LEFT JOIN users u ON l.user_id = u.id LEFT JOIN games g ON l.game_id = g.id ORDER BY l.high_score DESC, l.achieved_at ASC");
            if ($leaderboard && $leaderboard->num_rows > 0):
              $rank = 1;
              while ($row = $leaderboard->fetch_assoc()):
                $username = isset($row['username']) ? htmlspecialchars($row['username']) : 'Unknown';
                $gameName = isset($row['game_name']) ? htmlspecialchars($row['game_name']) : 'Unknown';
            ?>
              <tr>
                <td><?= $rank++ ?></td>
                <td><?= $username ?></td>
                <td><?= $gameName ?></td>
                <td><?= htmlspecialchars($row['high_score']) ?></td>
                <td><?= isset($row['achieved_at']) ? date('Y-m-d', strtotime($row['achieved_at'])) : '' ?></td>
              </tr>
            <?php endwhile;
            else: ?>
              <tr><td colspan="5">No leaderboard data found.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </section>

      <!-- Settings Section (initially hidden) -->
      <section class="content-section" id="settingsSection" style="display:none;">
        <div class="section-header">
          <h2 class="section-title"><i class="fas fa-cog"></i> Settings</h2>
        </div>
        <form class="settings-form">
          <div class="form-group">
            <label class="form-label" for="adminEmail">Admin Email</label>
            <input type="email" id="adminEmail" class="form-control" placeholder="Enter new email" value="hasidudilshan894@gmail.com">
          </div>
          <div class="form-group">
            <label class="form-label" for="adminPassword">Change Password</label>
            <input type="password" id="adminPassword" class="form-control" placeholder="Enter new password">
          </div>
          <div class="form-group">
            <label class="form-label" for="themeSelect">Theme</label>
            <select id="themeSelect" class="form-control">
              <option value="cyberpunk">Cyberpunk</option>
              <option value="dark">Dark</option>
              <option value="light">Light</option>
            </select>
          </div>
          <div class="form-actions">
            <button type="submit" class="submit-btn">Save Changes</button>
          </div>
        </form>
      </section>
    </main>
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
    // Admin panel eke main JS functionality okkoma meka athule
    document.addEventListener('DOMContentLoaded', function() {
      // Sidebar menu item select karama active class denna
      const menuItems = document.querySelectorAll('.menu-item');
      menuItems.forEach(item => {
        item.addEventListener('click', function() {
          menuItems.forEach(i => i.classList.remove('active'));
          this.classList.add('active');
        });
      });

      // Games table eke row ekak select karama highlight wenawa (future use)
      const gameRows = document.querySelectorAll('.games-table tbody tr');
      gameRows.forEach(row => {
        row.addEventListener('click', function(e) {
          // Action button ekak click nathnam row ekak select karanawa
          if (!e.target.classList.contains('action-btn')) {
            gameRows.forEach(r => r.classList.remove('selected'));
            this.classList.add('selected');
          }
        });
      });

      // Sign out button ekata click karama confirm ekak pennala home page ekata redirect karanawa
      document.querySelector('.signout-btn').addEventListener('click', function(e) {
        e.preventDefault();
        alert('Signed out successfully!');
        window.location.href = 'home.php';
      });

      // Add new game form submit karama alert ekak pennala form eka reset karanawa
      document.getElementById('gameForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Game added successfully!');
        this.reset();
      });

      // Cancel button ekata click karama confirm ekak pennala form eka reset karanawa
      document.querySelector('.cancel-btn').addEventListener('click', function() {
        if (confirm('Are you sure you want to cancel? All unsaved changes will be lost.')) {
          document.getElementById('gameForm').reset();
        }
      });

      // Page eka load unaama top ekata scroll karanawa
      window.scrollTo(0, 0);

      // Section switching logic
      const dashboardBtn = document.getElementById('dashboardMenu');
      const gamesBtn = document.getElementById('gamesMenu');
      const usersBtn = document.getElementById('usersMenu');
      const leaderboardsBtn = document.getElementById('leaderboardsMenu');
      const usersSection = document.getElementById('usersSection');
      const gamesSection = document.getElementById('gamesSection');
      const leaderboardsSection = document.getElementById('leaderboardsSection');
      const settingsSection = document.getElementById('settingsSection');
      const dashboardSections = [
        document.querySelector('.stats-grid'),
        document.querySelector('.add-game-form')
      ];
      // Helper to show only dashboard
      function showDashboard() {
        gamesSection.style.display = 'none';
        usersSection.style.display = 'none';
        leaderboardsSection.style.display = 'none';
        settingsSection.style.display = 'none';
        dashboardSections.forEach(sec => sec.style.display = '');
      }
      // Helper to show only games management
      function showGames() {
        dashboardSections.forEach(sec => sec.style.display = 'none');
        gamesSection.style.display = 'block';
        usersSection.style.display = 'none';
        leaderboardsSection.style.display = 'none';
        settingsSection.style.display = 'none';
      }
      // Helper to show only users management
      function showUsers() {
        dashboardSections.forEach(sec => sec.style.display = 'none');
        gamesSection.style.display = 'none';
        usersSection.style.display = 'block';
        leaderboardsSection.style.display = 'none';
        settingsSection.style.display = 'none';
      }
      // Helper to show only leaderboards
      function showLeaderboards() {
        dashboardSections.forEach(sec => sec.style.display = 'none');
        gamesSection.style.display = 'none';
        usersSection.style.display = 'none';
        leaderboardsSection.style.display = 'block';
        settingsSection.style.display = 'none';
      }
      // Helper to show only settings
      function showSettings() {
        dashboardSections.forEach(sec => sec.style.display = 'none');
        gamesSection.style.display = 'none';
        usersSection.style.display = 'none';
        leaderboardsSection.style.display = 'none';
        settingsSection.style.display = 'block';
      }
      // Initial view: show dashboard only
      showDashboard();
      // Dashboard button click
      dashboardBtn.addEventListener('click', function(e) {
        e.preventDefault();
        showDashboard();
      });
      // Games Management button click
      gamesBtn.addEventListener('click', function(e) {
        e.preventDefault();
        showGames();
      });
      // Users Management button click
      usersBtn.addEventListener('click', function(e) {
        e.preventDefault();
        showUsers();
      });
      // Leaderboards button click
      leaderboardsBtn.addEventListener('click', function(e) {
        e.preventDefault();
        showLeaderboards();
      });
      // Settings button click
      document.querySelector('.menu-item:last-child').addEventListener('click', function(e) {
        e.preventDefault();
        showSettings();
      });
      // THEME SWITCHER LOGIC
      const themeSelect = document.getElementById('themeSelect');
      function applyTheme(theme) {
        document.body.classList.remove('theme-dark', 'theme-light');
        if (theme === 'dark') {
          document.body.classList.add('theme-dark');
        } else if (theme === 'light') {
          document.body.classList.add('theme-light');
        }
        // cyberpunk = default (no extra class)
      }
      // On theme change
      if (themeSelect) {
        themeSelect.addEventListener('change', function() {
          const selected = this.value;
          applyTheme(selected);
          localStorage.setItem('adminTheme', selected);
        });
      }
      // On page load, restore theme
      const savedTheme = localStorage.getItem('adminTheme') || 'cyberpunk';
      themeSelect && (themeSelect.value = savedTheme);
      applyTheme(savedTheme);
      // Settings form submit: show alert (demo only)
      const settingsForm = document.querySelector('.settings-form');
      if (settingsForm) {
        settingsForm.addEventListener('submit', function(e) {
          e.preventDefault();
          alert('Settings saved successfully!');
        });
      }
    });
  </script>
</body>
</html>