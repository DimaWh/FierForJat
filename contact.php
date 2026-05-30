<?php
session_start();
$success = '';
$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if(!$name || !$email || !$message) {
        $error = 'Completează toate câmpurile obligatorii!';
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Adresa de email nu este validă!';
    } else {
        $file = __DIR__ . '/data/items.json';
        $data = [];
        if(file_exists($file)) {
            $data = json_decode(file_get_contents($file), true) ?? [];
        }
        if(!isset($data['messages'])) $data['messages'] = [];
        $data['messages'][] = [
            'id'      => uniqid(),
            'name'    => $name,
            'email'   => $email,
            'subject' => $subject,
            'message' => $message,
            'date'    => date('Y-m-d H:i:s')
        ];
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $success = 'Mesajul tău a fost trimis cu succes! Te vom contacta în curând.';
    }
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - FierForjat</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar">
    <a href="index.php" class="nav-logo">🔥 FierForjat</a>
    <ul class="nav-links">
        <li><a href="index.php">Acasă</a></li>
        <li><a href="index.php#plans">Planuri</a></li>
        <li><a href="contact.php">Contact</a></li>
        <?php if(isset($_SESSION['user'])): ?>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php" class="btn-nav">Register</a></li>
        <?php endif; ?>
    </ul>
    <button id="themeToggle" class="theme-toggle">🌙</button>
    <button id="langToggle" class="lang-toggle">RO</button>
</nav>

<div class="form-page">
    <div class="form-box" style="max-width:520px;">
        <div class="form-logo">📨</div>
        <h2>Contact</h2>
        <p class="form-subtitle">Suntem aici să te ajutăm</p>

        <?php if($error): ?>
            <div class="msg error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if($success): ?>
            <div class="msg success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST" action="contact.php">
            <div class="form-group">
                <label>NUME <span class="required">*</span></label>
                <input type="text" name="name" placeholder="Numele tău" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>EMAIL <span class="required">*</span></label>
                <input type="email" name="email" placeholder="email@exemplu.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>SUBIECT</label>
                <select name="subject">
                    <option value="">Alege un subiect...</option>
                    <option value="Suport tehnic" <?= ($_POST['subject'] ?? '') === 'Suport tehnic' ? 'selected' : '' ?>>Suport tehnic</option>
                    <option value="Facturare" <?= ($_POST['subject'] ?? '') === 'Facturare' ? 'selected' : '' ?>>Facturare</option>
                    <option value="Întrebare generală" <?= ($_POST['subject'] ?? '') === 'Întrebare generală' ? 'selected' : '' ?>>Întrebare generală</option>
                    <option value="Alt subiect" <?= ($_POST['subject'] ?? '') === 'Alt subiect' ? 'selected' : '' ?>>Alt subiect</option>
                </select>
            </div>
            <div class="form-group">
                <label>MESAJ <span class="required">*</span></label>
                <textarea name="message" rows="5" placeholder="Descrie problema sau întrebarea ta..." required style="resize:vertical;"><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
            </div>
            <button type="submit" class="btn-submit">TRIMITE MESAJ</button>
        </form>

        <div class="contact-info">
            <div class="contact-item">📧 <span>support@fierforjat.md</span></div>
            <div class="contact-item">⏰ <span>Luni - Vineri, 09:00 - 18:00</span></div>
        </div>
    </div>
</div>

<script src="js/script.js"></script>
</body>
</html>
