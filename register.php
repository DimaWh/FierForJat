<?php
session_start();
require_once 'php/auth.php';

$error = '';
$success = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = registerUser($_POST['username'], $_POST['email'], $_POST['password']);
    if($result === true) {
        $success = 'Cont creat cu succes! Te poți autentifica.';
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
    <title>Register - FierForjat</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar">
    <div class="nav-logo">🔥 FierForjat</div>
    <ul class="nav-links">
        <li><a href="index.php">Acasă</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php" class="btn-nav">Register</a></li>
    </ul>
    <button id="themeToggle" class="theme-toggle">🌙</button>
    <button id="langToggle" class="lang-toggle">RO</button>
</nav>

<div class="form-page">
    <div class="form-box">
        <h2>Register</h2>
        <?php if($error): ?><div class="msg error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <?php if($success): ?><div class="msg success"><?= htmlspecialchars($success) ?></div><?php endif; ?>

        <div class="form-group">
            <label>NUME UTILIZATOR</label>
            <input type="text" name="username" placeholder="RustPlayer123" required>
        </div>
        <div class="form-group">
            <label>EMAIL</label>
            <input type="email" name="email" placeholder="email@exemplu.com" required>
        </div>
        <div class="form-group">
            <label>PAROLĂ</label>
            <input type="password" name="password" id="pass1" placeholder="Minim 6 caractere" required>
        </div>
        <div class="form-group">
            <label>CONFIRMĂ PAROLA</label>
            <input type="password" id="pass2" placeholder="Repetă parola" required>
        </div>
        <button type="button" class="btn-submit" onclick="handleRegister()">CREEAZĂ CONT</button>

        <div class="form-link">
            Ai deja cont? <a href="login.php">Autentifică-te</a>
        </div>
    </div>
</div>

<script src="js/script.js"></script>
<script>
function handleRegister() {
    const username = document.querySelector('input[name="username"]').value.trim();
    const email = document.querySelector('input[name="email"]').value.trim();
    const pass1 = document.getElementById('pass1').value;
    const pass2 = document.getElementById('pass2').value;

    if(!username || !email || !pass1 || !pass2) {
        alert('Completează toate câmpurile!');
        return;
    }
    if(pass1.length < 6) {
        alert('Parola trebuie să aibă minim 6 caractere!');
        return;
    }
    if(pass1 !== pass2) {
        alert('Parolele nu coincid!');
        return;
    }

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'register.php';

    [['username', username], ['email', email], ['password', pass1]].forEach(([n, v]) => {
        const i = document.createElement('input');
        i.name = n; i.value = v;
        form.appendChild(i);
    });

    document.body.appendChild(form);
    form.submit();
}
</script>
</body>
</html>