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
    <a href="index.php" class="nav-logo">FierForjat</a>
    <ul class="nav-links">
        <li><a href="index.php" data-i18n="home">Home</a></li>
        <li><a href="#plans" data-i18n="plans">Plans</a></li>
        <li><a href="contact.php" data-i18n="contact">Contact</a></li>
        <?php if(isset($_SESSION['user'])): ?>
            <li><a href="dashboard.php" data-i18n="dashboard">Dashboard</a></li>
            <li><a href="logout.php" data-i18n="logout">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php" data-i18n="login">Login</a></li>
            <li><a href="register.php" class="btn-nav" data-i18n="register">Register</a></li>
        <?php endif; ?>
    </ul>
    <div class="nav-controls">
        <button id="themeToggle" class="theme-toggle">🌙</button>
        <select id="langSelect" class="lang-toggle" aria-label="Site language">
            <option value="en">EN</option>
            <option value="ro">RO</option>
            <option value="ru">RU</option>
        </select>
        <button id="hamburger" class="hamburger">☰</button>
    </div>
</nav>

<section class="hero">
    <div class="hero-content">
        <div class="hero-copy">
            <h1 class="hero-title" data-i18n="hero.title">Rust Server Hosting</h1>
            <p class="hero-sub" data-i18n="hero.sub">Maximum performance. Guaranteed uptime. Online in 60 seconds.</p>
            <div class="hero-badges">
                <span class="hero-badge" data-i18n="feature.servers">NVMe SSD</span>
                <span class="hero-badge" data-i18n="feature.support">DDoS Protection</span>
                <span class="hero-badge" data-i18n="feature.billing">99.9% Uptime</span>
                <span class="hero-badge" data-i18n="feature.rust">Setup instant</span>
            </div>
            <div class="hero-actions">
                <a href="<?= isset($_SESSION['user']) ? 'order.php?plan=Starter' : 'register.php' ?>" class="btn-hero" data-i18n="hero.action.start">Get Started</a>
                <a href="#plans" class="btn-ghost" data-i18n="hero.action.view">View plans</a>
            </div>
        </div>
        <aside class="hero-panel">
            <div class="panel-head">
                <span>🔥</span>
                <div>
                    <p class="panel-label" data-i18n="panel.label">Instant plans</p>
                    <h3 data-i18n="panel.heading">Choose the perfect server</h3>
                </div>
            </div>
            <ul class="panel-list">
                <li><strong>Starter</strong> <span>€5/month</span> • 10 player slots • 4GB RAM</li>
                <li><strong>Pro</strong> <span>€12/month</span> • 50 player slots • 8GB RAM</li>
                <li><strong>Elite</strong> <span>€25/month</span> • 200 player slots • 16GB RAM</li>
            </ul>
            <p class="panel-note" data-i18n="panel.note">Order fast, get dashboard access immediately, and manage the server from one place.</p>
        </aside>
    </div>
</section>

<div class="features-strip">
    <div class="feature-item"><span> </span><span data-i18n="feature.servers">European Servers</span></div>
    <div class="feature-item"><span> </span><span data-i18n="feature.billing">Monthly billing</span></div>
    <div class="feature-item"><span> </span><span data-i18n="feature.rust">Rust only</span></div>
    <div class="feature-item"><span> </span><span data-i18n="feature.support">24/7 Support</span></div>
</div>

<section class="plans" id="plans">
    <h2 data-i18n="plans.heading">Our Plans</h2>
    <p class="plans-subtitle" data-i18n="plans.subtitle">Choose the right plan for your community</p>
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
            <a href="<?= isset($_SESSION['user']) ? 'order.php?plan=Starter' : 'register.php' ?>" class="btn-plan" data-i18n="plan.chooseStarter">Choose Starter</a>
        </div>
        <div class="plan-card featured">
            <span class="badge" data-i18n="plan.popular">Popular</span>
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
            <a href="<?= isset($_SESSION['user']) ? 'order.php?plan=Pro' : 'register.php' ?>" class="btn-plan" data-i18n="plan.choosePro">Choose Pro</a>
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
            <a href="<?= isset($_SESSION['user']) ? 'order.php?plan=Elite' : 'register.php' ?>" class="btn-plan" data-i18n="plan.chooseElite">Choose Elite</a>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="footer-links">
        <a href="index.php" data-i18n="home">Home</a>
        <a href="#plans" data-i18n="plans">Plans</a>
        <a href="contact.php" data-i18n="contact">Contact</a>
        <a href="login.php" data-i18n="login">Login</a>
        <a href="register.php" data-i18n="register">Register</a>
    </div>
    <p data-i18n="footer.copyright">© 2026 FierForjat. All rights reserved.</p>
</footer>

<script src="js/script.js"></script>
</body>
</html>