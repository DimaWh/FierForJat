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
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php#plans">Plans</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php" class="btn-nav">Register</a></li>
    </ul>
    <button id="themeToggle" class="theme-toggle">🌙</button></nav>

<div class="form-page">
    <div class="form-box">
        <div class="form-logo">🔥</div>
        <h2>Login</h2>
        <p class="form-subtitle">Welcome back!</p>

        <?php if($error): ?>
            <div class="msg error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="form-group">
                <label>EMAIL</label>
                <input type="email" name="email" placeholder="email@example.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>PASSWORD</label>
                <div class="input-wrapper">
                    <input type="password" name="password" id="passInput" placeholder="••••••••" required>
                    <button type="button" class="toggle-pass" onclick="togglePass()">👁️</button>
                </div>
            </div>
            <button type="submit" class="btn-submit">LOGIN</button>
        </form>

        <div class="form-link">Don't have an account? <a href="register.php">Register</a></div>
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
