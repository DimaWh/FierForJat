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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FierForjat</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar">
    <a href="index.php" class="nav-logo">🔥 FierForjat</a>
    <ul class="nav-links">
            <li><a href="index.php" data-i18n="home">Home</a></li>
            <li><a href="index.php#plans" data-i18n="plans">Plans</a></li>
            <li><a href="contact.php" data-i18n="contact">Contact</a></li>
            <li><a href="login.php" data-i18n="login">Login</a></li>
            <li><a href="register.php" class="btn-nav" data-i18n="register">Register</a></li>
        </ul>
        <div class="nav-controls">
            <button id="themeToggle" class="theme-toggle">🌙</button>
            <select id="langSelect" class="lang-toggle" aria-label="Site language">
                <option value="en">EN</option>
                <option value="ro">RO</option>
                <option value="ru">RU</option>
            </select>
        </div>
    </nav>

<div class="form-page">
    <div class="form-box">
        <div class="form-logo">🔥</div>
        <h2 data-i18n="login.title">Login</h2>
        <p class="form-subtitle" data-i18n="login.subtitle">Welcome back!</p>

        <form method="POST" action="login.php">
            <div class="form-group">
                <label data-i18n="login.email">EMAIL</label>
                <input type="email" name="email" placeholder="email@example.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required data-i18n-placeholder="login.email">
            </div>
            <div class="form-group">
                <label data-i18n="login.password">PASSWORD</label>
                <div class="input-wrapper">
                    <input type="password" name="password" id="passInput" placeholder="••••••••" required data-i18n-placeholder="login.password.placeholder">
                    <button type="button" class="toggle-pass" onclick="togglePass()">👁️</button>
                </div>
            </div>
            <button type="submit" class="btn-submit" data-i18n="login.submit">LOGIN</button>
        </form>

        <div class="form-link"><span data-i18n="login.noAccount">Don't have an account? </span><a href="register.php" data-i18n="login.register">Register</a></div>
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
