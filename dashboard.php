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
    <title data-ro="Dashboard - FierForjat" data-en="Dashboard - FierForjat" data-ru="Панель управления - FierForjat">Dashboard - FierForjat</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar">
    <a href="index.php" class="nav-logo" data-ro="🔥 FierForjat" data-en="🔥 FierForjat" data-ru="🔥 FierForjat">🔥 FierForjat</a>
    <ul class="nav-links">
        <li><a href="index.php" data-ro="Acasă" data-en="Home" data-ru="Главная">Acasă</a></li>
        <li><a href="index.php#plans" data-ro="Planuri" data-en="Plans" data-ru="Планы">Planuri</a></li>
        <li><a href="contact.php" data-ro="Contact" data-en="Contact" data-ru="Контакты">Contact</a></li>
        <li><a href="logout.php" data-ro="Logout" data-en="Logout" data-ru="Выйти">Logout</a></li>
    </ul>
    <button id="themeToggle" class="theme-toggle">🌙</button>
    <button id="langToggle" class="lang-toggle">RO</button>
</nav>

<section class="dashboard">
    <h1 data-ro="Bine ai venit în dashboard" data-en="Welcome to your dashboard" data-ru="Добро пожаловать в панель управления">Bine ai venit în dashboard</h1>
    <div class="dash-cards">
        <div class="dash-card">
            <h3 data-ro="Nume utilizator" data-en="Username" data-ru="Имя пользователя">Nume utilizator</h3>
            <div class="value"><?= htmlspecialchars($user['username']) ?></div>
        </div>
        <div class="dash-card">
            <h3 data-ro="Email" data-en="Email" data-ru="Электронная почта">Email</h3>
            <div class="value"><?= htmlspecialchars($user['email']) ?></div>
        </div>
        <div class="dash-card">
            <h3 data-ro="Acțiune" data-en="Action" data-ru="Действие">Acțiune</h3>
            <div class="value"><a href="logout.php" class="btn-plan" style="display:inline-block;">Logout</a></div>
        </div>
    </div>
</section>

<script src="js/script.js"></script>
</body>
</html>
