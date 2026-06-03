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
        $error = 'Passwords do not match!';
    } else {
        $result = registerUser($_POST['username'] ?? '', $_POST['email'] ?? '', $pass1);
        if($result === true) {
            $success = 'Account created successfully! You can now log in.';
        } else {
            $error = $result;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FierForjat</title>
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
        <h2>Register</h2>
        <p class="form-subtitle">Create your free account</p>

        <?php if($error): ?>
            <div class="msg error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if($success): ?>
            <div class="msg success"><?= htmlspecialchars($success) ?>
                <br><a href="login.php" style="color:inherit;font-weight:700;">→ Go to Login</a>
            </div>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <div class="form-group">
                <label>USERNAME</label>
                <input type="text" name="username" placeholder="RustPlayer123" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>EMAIL</label>
                <input type="email" name="email" placeholder="email@example.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>PASSWORD <span class="hint">(at least 6 characters)</span></label>
                <div class="input-wrapper">
                    <input type="password" name="password" id="pass1" placeholder="••••••••" required>
                    <button type="button" class="toggle-pass" onclick="togglePass('pass1')">👁️</button>
                </div>
            </div>
            <div class="form-group">
                <label>CONFIRM PASSWORD</label>
                <div class="input-wrapper">
                    <input type="password" name="password2" id="pass2" placeholder="••••••••" required>
                    <button type="button" class="toggle-pass" onclick="togglePass('pass2')">👁️</button>
                </div>
            </div>
            <button type="submit" class="btn-submit">CREATE ACCOUNT</button>
        </form>

        <div class="form-link">Already have an account? <a href="login.php">Log in</a></div>
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
