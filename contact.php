<?php
session_start();
if(!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FierForjat</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar">
    <div class="nav-logo">🔥 FierForjat</div>
    <ul class="nav-links">
        <li><a href="index.php">Acasă</a></li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
    <button id="themeToggle" class="theme-toggle">🌙</button>
    <button id="langToggle" class="lang-toggle">RO</button>
</nav>

<div class="dashboard">
    <h1>Bun venit, <?= htmlspecialchars($user['username']) ?>! 🔥</h1>

    <div class="dash-cards">
        <div class="dash-card">
            <h3>SERVERE ACTIVE</h3>
            <div class="value">0</div>
        </div>
        <div class="dash-card">
            <h3>PLAN CURENT</h3>
            <div class="value" style="font-size:1.5rem;">Niciun plan</div>
        </div>
        <div class="dash-card">
            <h3>STATUS</h3>
            <div class="value" style="color:#5fca5f;">Online</div>
        </div>
    </div>

    <div class="plan-card" style="max-width:500px;">
        <h3 style="margin-bottom:1rem;">🚀 Comandă un server</h3>
        <p style="color:var(--text2); margin-bottom:1.5rem;">Nu ai niciun server activ. Alege un plan pentru a începe.</p>
        <a href="index.php#plans" class="btn-plan">Vezi Planurile</a>
    </div>
</div>

<script src="js/script.js"></script>
</body>
</html>