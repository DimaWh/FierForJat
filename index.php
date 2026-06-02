<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-ro="FierForjat - Rust Server Hosting" data-en="FierForjat - Rust Server Hosting" data-ru="FierForjat - Rust Server Hosting">FierForjat - Rust Server Hosting</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar">
    <div class="nav-logo" data-ro="🔥 FierForjat" data-en="🔥 FierForjat" data-ru="🔥 FierForjat">🔥 FierForjat</div>
    <ul class="nav-links">
        <li><a href="index.php" data-ro="Acasă" data-en="Home" data-ru="Главная">Acasă</a></li>
        <li><a href="#plans" data-ro="Planuri" data-en="Plans" data-ru="Планы">Planuri</a></li>
        <li><a href="contact.php" data-ro="Contact" data-en="Contact" data-ru="Контакты">Contact</a></li>
        <?php if(isset($_SESSION['user'])): ?>
            <li><a href="dashboard.php" data-ro="Dashboard" data-en="Dashboard" data-ru="Панель">Dashboard</a></li>
            <li><a href="logout.php" data-ro="Logout" data-en="Logout" data-ru="Выйти">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php" data-ro="Login" data-en="Login" data-ru="Вход">Login</a></li>
            <li><a href="register.php" class="btn-nav" data-ro="Register" data-en="Register" data-ru="Регистрация">Register</a></li>
        <?php endif; ?>
    </ul>
    <button id="themeToggle" class="theme-toggle">🌙</button>
    <button id="langToggle" class="lang-toggle">RO</button>
</nav>

<section class="hero">
    <div class="hero-content">
        <h1 class="hero-title" data-ro="Găzduire Servere Rust" data-en="Rust Server Hosting" data-ru="Хостинг серверов Rust">Găzduire Servere Rust</h1>
        <p class="hero-sub" data-ro="Performanță maximă. Uptime garantat. Pornit în 60 de secunde." data-en="Maximum performance. Guaranteed uptime. Online in 60 seconds." data-ru="Максимальная производительность. Гарантированный аптайм.">Performanță maximă. Uptime garantat. Pornit în 60 de secunde.</p>
        <a href="register.php" class="btn-hero" data-ro="Începe Acum" data-en="Get Started" data-ru="Начать">Începe Acum</a>
    </div>
</section>

<section class="plans" id="plans">
    <h2 data-ro="Planurile Noastre" data-en="Our Plans" data-ru="Наши планы">Planurile Noastre</h2>
    <div class="plans-grid">
        <div class="plan-card">
            <h3>Starter</h3>
            <p class="price">€5<span>/lună</span></p>
            <ul>
                <li>✅ 10 Sloturi</li>
                <li>✅ 4GB RAM</li>
                <li>✅ 50GB SSD</li>
                <li>✅ Uptime 99.9%</li>
            </ul>
            <a href="register.php" class="btn-plan">Alege</a>
        </div>
        <div class="plan-card featured">
            <span class="badge">Popular</span>
            <h3>Pro</h3>
            <p class="price">€12<span>/lună</span></p>
            <ul>
                <li>✅ 50 Sloturi</li>
                <li>✅ 8GB RAM</li>
                <li>✅ 100GB SSD</li>
                <li>✅ Uptime 99.9%</li>
                <li>✅ DDoS Protection</li>
            </ul>
            <a href="register.php" class="btn-plan">Alege</a>
        </div>
        <div class="plan-card">
            <h3>Elite</h3>
            <p class="price">€25<span>/lună</span></p>
            <ul>
                <li>✅ 200 Sloturi</li>
                <li>✅ 16GB RAM</li>
                <li>✅ 250GB SSD</li>
                <li>✅ Uptime 99.9%</li>
                <li>✅ DDoS Protection</li>
                <li>✅ Suport prioritar</li>
            </ul>
            <a href="register.php" class="btn-plan">Alege</a>
        </div>
    </div>
</section>

<footer class="footer">
    <p>© 2026 FierForjat. Toate drepturile rezervate.</p>
</footer>

<script src="js/script.js"></script>
</body>
</html>