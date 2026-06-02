<?php
session_start();
if(isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}
require_once 'php/auth.php';

$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = loginUser($_POST['email'] ?? '', $_POST['password'] ?? '');
    if($result === true) {
        header('Location: dashboard.php');
        exit;
    } else {
        $error = $result;
    }
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-ro="Login - FierForjat" data-en="Login - FierForjat" data-ru="Вход - FierForjat">Login - FierForjat</title>
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
        <li><a href="login.php" data-ro="Login" data-en="Login" data-ru="Вход">Login</a></li>
        <li><a href="register.php" class="btn-nav" data-ro="Register" data-en="Register" data-ru="Регистрация">Register</a></li>
    </ul>
    <button id="themeToggle" class="theme-toggle">🌙</button>
    <button id="langToggle" class="lang-toggle">RO</button>
</nav>

<div class="form-page">
    <div class="form-box">
        <div class="form-logo">🔥</div>
        <h2 data-ro="Autentificare" data-en="Login" data-ru="Вход">Login</h2>
        <p class="form-subtitle" data-ro="Bine ai revenit!" data-en="Welcome back!" data-ru="С возвращением!">Bine ai revenit!</p>

        <?php if($error): ?>
            <div class="msg error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="form-group">
                <label data-ro="EMAIL" data-en="EMAIL" data-ru="EMAIL">EMAIL</label>
                <input type="email" name="email" placeholder="email@exemplu.com" data-ro-placeholder="email@exemplu.com" data-en-placeholder="email@example.com" data-ru-placeholder="email@example.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label data-ro="PAROLĂ" data-en="PASSWORD" data-ru="ПАРОЛЬ">PAROLĂ</label>
                <div class="input-wrapper">
                    <input type="password" name="password" id="passInput" placeholder="••••••••" data-ro-placeholder="••••••••" data-en-placeholder="••••••••" data-ru-placeholder="••••••••" required>
                    <button type="button" class="toggle-pass" onclick="togglePass()">👁️</button>
                </div>
            </div>
            <button type="submit" class="btn-submit" data-ro="INTRĂ" data-en="LOGIN" data-ru="ВОЙТИ">INTRĂ</button>
        </form>

        <div class="form-link" data-ro="Nu ai cont?" data-en="Don't have an account?" data-ru="Нет аккаунта?">Nu ai cont? <a href="register.php" data-ro="Înregistrează-te" data-en="Register" data-ru="Зарегистрируйся">Înregistrează-te</a></div>
    </div>
</div>

<script src="js/script.js"></script>
<script>
function togglePass() {
    const input = document.getElementById('passInput');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
</body>
</html>
