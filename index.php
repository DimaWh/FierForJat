<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FierForjat - Rust Server Hosting</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar">
    <a href="index.php" class="nav-logo">🔥 FierForjat</a>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="#plans">Plans</a></li>
        <li><a href="contact.php">Contact</a></li>
        <?php if(isset($_SESSION['user'])): ?>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php" class="btn-nav">Register</a></li>
        <?php endif; ?>
    </ul>
    <div class="nav-controls">
        <button id="themeToggle" class="theme-toggle">🌙</button>
        <button id="hamburger" class="hamburger">☰</button>
    </div>
</nav>

<section class="hero">
    <div class="hero-content">
        <div class="hero-copy">
            <h1 class="hero-title">Rust Server Hosting</h1>
            <p class="hero-sub">Maximum performance. Guaranteed uptime. Online in 60 seconds.</p>
            <div class="hero-badges">
                <span class="hero-badge">⚡ NVMe SSD</span>
                <span class="hero-badge">🛡️ DDoS Protection</span>
                <span class="hero-badge">🕐 99.9% Uptime</span>
                <span class="hero-badge">🚀 Setup instant</span>
            </div>
            <div class="hero-actions">
                <a href="<?= isset($_SESSION['user']) ? 'order.php?plan=Starter' : 'register.php' ?>" class="btn-hero">Get Started</a>
                <a href="#plans" class="btn-ghost">View plans</a>
            </div>
        </div>
        <aside class="hero-panel">
            <div class="panel-head">
                <span>🔥</span>
                <div>
                    <p class="panel-label">Instant plans</p>
                    <h3>Choose the perfect server</h3>
                </div>
            </div>
            <ul class="panel-list">
                <li><strong>Starter</strong> <span>€5/month</span> • 10 player slots • 4GB RAM</li>
                <li><strong>Pro</strong> <span>€12/month</span> • 50 player slots • 8GB RAM</li>
                <li><strong>Elite</strong> <span>€25/month</span> • 200 player slots • 16GB RAM</li>
            </ul>
            <p class="panel-note">Order fast, get dashboard access immediately, and manage the server from one place.</p>
        </aside>
    </div>
</section>

<div class="features-strip">
    <div class="feature-item"><span>🌍</span><span>European Servers</span></div>
    <div class="feature-item"><span>💳</span><span>Monthly billing</span></div>
    <div class="feature-item"><span>🎮</span><span>Rust only</span></div>
    <div class="feature-item"><span>📞</span><span>24/7 Support</span></div>
</div>

<section class="plans" id="plans">
    <h2>Our Plans</h2>
    <p class="plans-subtitle">Choose the right plan for your community</p>
    <div class="plans-grid">
        <div class="plan-card">
            <h3>Starter</h3>
            <p class="price">€5<span>/month</span></p>
            <hr class="plan-divider">
            <ul>
                <li>✅ 10 player slots</li>
                <li>✅ 4GB RAM</li>
                <li>✅ 50GB NVMe SSD</li>
                <li>✅ 99.9% uptime</li>
                <li>✅ Control panel</li>
                <li>❌ DDoS Protection</li>
            </ul>
            <a href="<?= isset($_SESSION['user']) ? 'order.php?plan=Starter' : 'register.php' ?>" class="btn-plan">Choose Starter</a>
        </div>
        <div class="plan-card featured">
            <span class="badge">Popular</span>
            <h3>Pro</h3>
            <p class="price">€12<span>/month</span></p>
            <hr class="plan-divider">
            <ul>
                <li>✅ 50 player slots</li>
                <li>✅ 8GB RAM</li>
                <li>✅ 100GB NVMe SSD</li>
                <li>✅ 99.9% uptime</li>
                <li>✅ Control panel</li>
                <li>✅ DDoS Protection</li>
            </ul>
            <a href="<?= isset($_SESSION['user']) ? 'order.php?plan=Pro' : 'register.php' ?>" class="btn-plan">Choose Pro</a>
        </div>
        <div class="plan-card">
            <h3>Elite</h3>
            <p class="price">€25<span>/month</span></p>
            <hr class="plan-divider">
            <ul>
                <li>✅ 200 player slots</li>
                <li>✅ 16GB RAM</li>
                <li>✅ 250GB NVMe SSD</li>
                <li>✅ 99.9% uptime</li>
                <li>✅ Control panel</li>
                <li>✅ DDoS Protection</li>
                <li>✅ Priority support</li>
            </ul>
            <a href="<?= isset($_SESSION['user']) ? 'order.php?plan=Elite' : 'register.php' ?>" class="btn-plan">Choose Elite</a>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="footer-links">
        <a href="index.php">Home</a>
        <a href="#plans">Plans</a>
        <a href="contact.php">Contact</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </div>
    <p>© 2026 FierForjat. All rights reserved.</p>
</footer>

<script src="js/script.js"></script>
</body>
</html>