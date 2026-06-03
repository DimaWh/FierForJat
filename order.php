<?php
session_start();
require_once 'php/functions.php';

if(!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
$plans = [
    'Starter' => [
        'price' => '€5',
        'slots' => '10 player slots',
        'ram' => '4GB RAM',
        'disk' => '50GB NVMe SSD',
        'ddos' => false,
        'support' => 'Standard',
        'description' => 'Basic Rust server for small communities',
    ],
    'Pro' => [
        'price' => '€12',
        'slots' => '50 player slots',
        'ram' => '8GB RAM',
        'disk' => '100GB NVMe SSD',
        'ddos' => true,
        'support' => 'Standard',
        'description' => 'Balanced plan for medium communities',
    ],
    'Elite' => [
        'price' => '€25',
        'slots' => '200 player slots',
        'ram' => '16GB RAM',
        'disk' => '250GB NVMe SSD',
        'ddos' => true,
        'support' => 'Priority support',
        'description' => 'Maximum performance for large projects',
    ],
];

$selectedPlan = $_GET['plan'] ?? 'Starter';
if(!isset($plans[$selectedPlan])) {
    $selectedPlan = 'Starter';
}

$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedPlan = $_POST['plan'] ?? 'Starter';
    if(!isset($plans[$selectedPlan])) {
        $error = 'Invalid plan. Please choose a valid plan.';
    } else {
        $serverName = trim((string)($_POST['server_name'] ?? ''));
        if($serverName === '') {
            $serverName = $selectedPlan . ' Server';
        }

        $itemsFile = __DIR__ . '/data/items.json';
        $data = [];
        if(file_exists($itemsFile)) {
            $data = json_decode(file_get_contents($itemsFile), true) ?? [];
        }
        if(!isset($data['orders'])) {
            $data['orders'] = [];
        }

        $planData = $plans[$selectedPlan];
        $data['orders'][] = [
            'id' => uniqid(),
            'userId' => $user['id'],
            'name' => htmlspecialchars($serverName),
            'plan' => $selectedPlan,
            'price' => $planData['price'],
            'slots' => $planData['slots'],
            'ram' => $planData['ram'],
            'disk' => $planData['disk'],
            'ddos' => $planData['ddos'] ? 'Da' : 'Nu',
            'support' => $planData['support'],
            'status' => 'Active',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        file_put_contents($itemsFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        header('Location: dashboard.php?order=success');
        exit;
    }
}

$planData = $plans[$selectedPlan];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Server - FierForjat</title>
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
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
    <div class="nav-controls">
        <button id="themeToggle" class="theme-toggle">🌙</button>
        <button id="hamburger" class="hamburger">☰</button>
    </div>
</nav>

<section class="form-page" style="padding: 4rem 1rem;">
    <div class="form-box" style="max-width: 600px;">
        <div class="form-logo">🛒</div>
        <h2>Order Confirmation</h2>
        <p class="form-subtitle">Complete your Rust server order.</p>

        <?php if($error): ?>
            <div class="msg error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="dash-section" style="margin-bottom: 1.5rem;">
            <h2 style="margin-bottom: 1rem;">Selected plan: <?= htmlspecialchars($selectedPlan) ?></h2>
            <p style="color: var(--text2); margin-bottom: 1rem;"><?= htmlspecialchars($planData['description']) ?></p>
            <ul style="list-style:none; padding-left:0; color: var(--text);">
                <li>✅ <?= $planData['slots'] ?></li>
                <li>✅ <?= $planData['ram'] ?></li>
                <li>✅ <?= $planData['disk'] ?></li>
                <li>✅ DDoS Protection: <?= $planData['ddos'] ? 'Yes' : 'No' ?></li>
                <li>✅ Support: <?= htmlspecialchars($planData['support']) ?></li>
                <li>✅ Price: <strong><?= htmlspecialchars($planData['price']) ?>/month</strong></li>
        </div>

        <form method="POST" action="order.php">
            <input type="hidden" name="plan" value="<?= htmlspecialchars($selectedPlan) ?>">
            <div class="form-group">
                <label>Server name</label>
                <input type="text" name="server_name" placeholder="Ex: RustClan01">
            </div>
            <button type="submit" class="btn-submit">Place order</button>
        </form>

        <div class="form-link" style="margin-top:1rem;">
            <a href="dashboard.php">Back to Dashboard</a>
        </div>
    </div>
</section>

<script src="js/script.js"></script>
</body>
</html>
