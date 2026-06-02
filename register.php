<?php
session_start();
if(isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}
require_once 'php/auth.php';

$error = '';
$success = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pass1 = $_POST['password'] ?? '';
    $pass2 = $_POST['password2'] ?? '';

    if($pass1 !== $pass2) {
        $error = 'Parolele nu coincid!';
    } else {
        $result = registerUser($_POST['username'] ?? '', $_POST['email'] ?? '', $pass1);
        if($result === true) {
            $success = 'Cont creat cu succes! Te poți autentifica.';
        } else {
            $error = $result;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-ro="Înregistrare - FierForjat" data-en="Register - FierForjat" data-ru="Регистрация - FierForjat">Register - FierForjat</title>
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
        <h2 data-ro="Înregistrare" data-en="Register" data-ru="Регистрация">Register</h2>
        <p class="form-subtitle" data-ro="Creează-ți contul gratuit" data-en="Create your free account" data-ru="Создайте бесплатный аккаунт">Creează-ți contul gratuit</p>

        <?php if($error): ?>
            <div class="msg error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if($success): ?>
            <div class="msg success"><?= htmlspecialchars($success) ?>
                <br><a href="login.php" style="color:inherit;font-weight:700;" data-ro="→ Mergi la Login" data-en="→ Go to Login" data-ru="→ Перейти к входу">→ Mergi la Login</a>
            </div>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <div class="form-group">
                <label data-ro="NUME UTILIZATOR" data-en="USERNAME" data-ru="ИМЯ ПОЛЬЗОВАТЕЛЯ">NUME UTILIZATOR</label>
                <input type="text" name="username" placeholder="RustPlayer123" data-ro-placeholder="RustPlayer123" data-en-placeholder="RustPlayer123" data-ru-placeholder="RustPlayer123" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label data-ro="EMAIL" data-en="EMAIL" data-ru="EMAIL">EMAIL</label>
                <input type="email" name="email" placeholder="email@exemplu.com" data-ro-placeholder="email@exemplu.com" data-en-placeholder="email@example.com" data-ru-placeholder="email@example.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label data-ro="PAROLĂ" data-en="PASSWORD" data-ru="ПАРОЛЬ">PAROLĂ <span class="hint" data-ro="(minim 6 caractere)" data-en="(at least 6 characters)" data-ru="(не менее 6 символов)">(minim 6 caractere)</span></label>
                <div class="input-wrapper">
                    <input type="password" name="password" id="pass1" placeholder="••••••••" data-ro-placeholder="••••••••" data-en-placeholder="••••••••" data-ru-placeholder="••••••••" required>
                    <button type="button" class="toggle-pass" onclick="togglePass('pass1')">👁️</button>
                </div>
            </div>
            <div class="form-group">
                <label data-ro="CONFIRMĂ PAROLA" data-en="CONFIRM PASSWORD" data-ru="ПОДТВЕРДИТЕ ПАРОЛЬ">CONFIRMĂ PAROLA</label>
                <div class="input-wrapper">
                    <input type="password" name="password2" id="pass2" placeholder="••••••••" data-ro-placeholder="••••••••" data-en-placeholder="••••••••" data-ru-placeholder="••••••••" required>
                    <button type="button" class="toggle-pass" onclick="togglePass('pass2')">👁️</button>
                </div>
            </div>
            <button type="submit" class="btn-submit" data-ro="CREEAZĂ CONT" data-en="CREATE ACCOUNT" data-ru="СОЗДАТЬ АККАУНТ">CREEAZĂ CONT</button>
        </form>

        <div class="form-link" data-ro="Ai deja cont?" data-en="Already have an account?" data-ru="Уже есть аккаунт?">Ai deja cont? <a href="login.php" data-ro="Autentifică-te" data-en="Log in" data-ru="Войти">Autentifică-te</a></div>
    </div>
</div>

<script src="js/script.js"></script>
<script>
function togglePass(id) {
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
</body>
</html>
