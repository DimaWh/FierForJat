<?php
session_start();
if(!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
$user = $_SESSION['user'];

// Load user's servers from JSON
$itemsFile = __DIR__ . '/data/items.json';
$data = [];
if(file_exists($itemsFile)) {
    $data = json_decode(file_get_contents($itemsFile), true) ?? [];
}
$servers = [];
foreach($data['orders'] ?? [] as $order) {
    if($order['userId'] === $user['id']) {
        $servers[] = $order;
    }
}

// Handle server rename and delete safely
$msg = '';
if(isset($_GET['order']) && $_GET['order'] === 'success') {
    $msg = 'Serverul a fost comandat cu succes!';
}
$postAction = $_POST['action'] ?? '';
$postServerId = trim((string)($_POST['server_id'] ?? ''));
$postNewName = trim((string)($_POST['new_name'] ?? ''));

if($_SERVER['REQUEST_METHOD'] === 'POST' && $postAction) {
    if($postAction === 'rename' && $postServerId !== '' && $postNewName !== '') {
        foreach($data['orders'] as &$order) {
            if($order['id'] === $postServerId && $order['userId'] === $user['id']) {
                $order['name'] = htmlspecialchars($postNewName);
                break;
            }
        }
        file_put_contents($itemsFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        header('Location: dashboard.php');
        exit;
    }
    if($postAction === 'delete' && $postServerId !== '') {
        $data['orders'] = array_values(array_filter($data['orders'] ?? [], function($o) use ($postServerId, $user) {
            return !($o['id'] === $postServerId && $o['userId'] === $user['id']);
        }));
        file_put_contents($itemsFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        header('Location: dashboard.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FierForjat</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        .server-card {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 1.2rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .server-info { flex: 1; }
        .server-name { font-family: 'Bebas Neue', sans-serif; font-size: 1.3rem; color: var(--accent); letter-spacing: 1px; }
        .server-meta { color: var(--text2); font-size: 0.9rem; }
        .server-status { display: inline-block; padding: 0.2rem 0.7rem; border-radius: 20px; font-size: 0.8rem; font-weight: 700; }
        .status-online { background: rgba(95,202,95,0.15); color: #5fca5f; border: 1px solid #5fca5f; }
        .server-actions { display: flex; gap: 0.5rem; flex-wrap: wrap; }
        .btn-sm { padding: 0.3rem 0.8rem; border-radius: 4px; font-size: 0.85rem; font-weight: 600; cursor: pointer; border: 1px solid var(--border); background: var(--card); color: var(--text); transition: all 0.2s; text-decoration: none; }
        .btn-sm:hover { border-color: var(--accent); color: var(--accent); }
        .btn-sm.danger:hover { border-color: var(--error-color); color: var(--error-color); }
        .rename-form { display: none; margin-top: 0.5rem; gap: 0.5rem; }
        .rename-form.open { display: flex; }
        .rename-form input { flex: 1; padding: 0.3rem 0.7rem; background: var(--bg2); border: 1px solid var(--border); border-radius: 4px; color: var(--text); font-family: 'Rajdhani', sans-serif; }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="index.php" class="nav-logo">🔥 FierForjat</a>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php#plans">Plans</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
    <div class="nav-controls">
        <button id="themeToggle" class="theme-toggle">🌙</button>
        <button id="hamburger" class="hamburger">☰</button>
    </div>
</nav>

<div class="dashboard">
    <div class="dashboard-header">
        <h1>Dashboard</h1>
        <span style="color:var(--text2);">👋 <?= htmlspecialchars($user['username']) ?></span>
    </div>

    <?php if($msg): ?>
        <div class="msg success"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <div class="dash-cards">
        <div class="dash-card">
            <div class="card-icon">👤</div>
            <h3>Username</h3>
            <div class="value small"><?= htmlspecialchars($user['username']) ?></div>
        </div>
        <div class="dash-card">
            <div class="card-icon">📧</div>
            <h3>Email</h3>
            <div class="value small"><?= htmlspecialchars($user['email']) ?></div>
        </div>
        <div class="dash-card">
            <div class="card-icon">🖥️</div>
            <h3>Active servers</h3>
            <div class="value"><?= count($servers) ?></div>
        </div>
        <div class="dash-card">
            <div class="card-icon">✅</div>
            <h3>Status</h3>
            <div class="value" style="color:#5fca5f;font-size:1.2rem;">Online</div>
        </div>
    </div>

    <div class="dash-section">
        <h2>🖥️ My Servers</h2>
        <div class="terminal-panel">
            <div class="terminal-header">
                <span>></span>
                <div>
                    <div class="terminal-title">CMD Dashboard</div>
                    <div class="terminal-subtitle">Type <code>help</code> for quick commands.</div>
                </div>
            </div>
            <div id="terminalOutput" class="terminal-output"></div>
            <form id="terminalForm" class="terminal-form" onsubmit="return handleTerminalCommand(event)">
                <span class="prompt">></span>
                <input id="terminalInput" type="text" autocomplete="off" placeholder="help, status, servers, details <id>, clear">
            </form>
        </div>
        <?php if(empty($servers)): ?>
            <div class="server-empty">
                <p>You have no active servers.</p>
                <a href="order.php" class="btn-plan" style="display:inline-block;width:auto;padding:0.6rem 2rem;">Buy a server</a>
            </div>
        <?php else: ?>
            <?php foreach($servers as $server): ?>
            <div class="server-card">
                <div class="server-info">
                    <div class="server-name"><?= htmlspecialchars($server['name'] ?? 'Server Rust') ?></div>
                    <div class="server-meta">
                        <div>Plan: <strong><?= htmlspecialchars($server['plan'] ?? 'N/A') ?></strong></div>
                        <div><?= htmlspecialchars($server['slots'] ?? '') ?> · <?= htmlspecialchars($server['ram'] ?? '') ?> · <?= htmlspecialchars($server['disk'] ?? '') ?></div>
                        <div><span class="server-status status-online">● Online</span> · <?= htmlspecialchars($server['created_at'] ?? '') ?></div>
                    </div>
                    <form class="rename-form" id="rename-<?= $server['id'] ?>" method="POST">
                        <input type="hidden" name="action" value="rename">
                        <input type="hidden" name="server_id" value="<?= $server['id'] ?>">
                        <input type="text" name="new_name" placeholder="New name..." value="<?= htmlspecialchars($server['name'] ?? '') ?>">
                        <button type="submit" class="btn-sm">Save</button>
                        <button type="button" class="btn-sm" onclick="toggleRename('<?= $server['id'] ?>')">Cancel</button>
                    </form>
                </div>
                <div class="server-actions">
                    <button class="btn-sm" onclick="toggleRename('<?= $server['id'] ?>')">Rename</button>
                    <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this server?')">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="server_id" value="<?= $server['id'] ?>">
                        <button type="submit" class="btn-sm danger">Delete</button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script src="js/script.js"></script>
<script>
function toggleRename(id) {
    const form = document.getElementById('rename-' + id);
    form.classList.toggle('open');
}
</script>
<script>
const dashboardServers = <?= json_encode(array_values(array_map(function($server){
    return [
        'id' => $server['id'] ?? '',
        'name' => $server['name'] ?? 'Server Rust',
        'plan' => $server['plan'] ?? 'N/A',
        'status' => $server['status'] ?? 'Online',
        'slots' => $server['slots'] ?? '',
        'ram' => $server['ram'] ?? '',
        'disk' => $server['disk'] ?? '',
        'ddos' => $server['ddos'] ?? '',
        'support' => $server['support'] ?? '',
        'created_at' => $server['created_at'] ?? '',
    ];
}, $servers)), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;

function appendTerminalLine(text, cls = '') {
    const output = document.getElementById('terminalOutput');
    const line = document.createElement('div');
    line.className = cls;
    line.textContent = text;
    output.appendChild(line);
    output.scrollTop = output.scrollHeight;
}

function showTerminalHelp() {
    appendTerminalLine('Available commands:');
    appendTerminalLine('  help                      - Show this command list');
    appendTerminalLine('  status                    - Check the status of all servers');
    appendTerminalLine('  servers                   - List your servers with their IDs');
    appendTerminalLine('  details <id>              - Show server details by ID');
    appendTerminalLine('  clear                     - Clear the terminal');
}

function handleTerminalCommand(event) {
    event.preventDefault();
    const input = document.getElementById('terminalInput');
    const value = input.value.trim();
    if(!value) return false;
    appendTerminalLine('> ' + value, 'terminal-command');
    input.value = '';

    const parts = value.split(' ').filter(Boolean);
    const cmd = parts[0].toLowerCase();
    const arg = parts.slice(1).join(' ');

    switch(cmd) {
        case 'help':
            showTerminalHelp();
            break;
        case 'status':
            if(dashboardServers.length === 0) {
                appendTerminalLine('You have not created any servers yet.');
                break;
            }
            dashboardServers.forEach(server => {
                appendTerminalLine(`${server.name} [${server.plan}] — ${server.status}`);
                appendTerminalLine(`  ${server.slots} · ${server.ram} · ${server.disk}`);
            });
            break;
        case 'servers':
            if(dashboardServers.length === 0) {
                appendTerminalLine('You have no servers in your account.');
                break;
            }
            dashboardServers.forEach(server => {
                appendTerminalLine(`${server.id}: ${server.name} (${server.plan})`);
            });
            break;
        case 'details':
            if(!arg) {
                appendTerminalLine('Use: details <id>');
                break;
            }
            const server = dashboardServers.find(s => s.id === arg);
            if(!server) {
                appendTerminalLine(`Server with id '${arg}' was not found.`);
                break;
            }
            appendTerminalLine(`Name: ${server.name}`);
            appendTerminalLine(`Plan: ${server.plan}`);
            appendTerminalLine(`Config: ${server.slots} · ${server.ram} · ${server.disk}`);
            appendTerminalLine(`DDoS: ${server.ddos || 'Not specified'}`);
            appendTerminalLine(`Support: ${server.support || 'Standard'}`);
            appendTerminalLine(`Created at: ${server.created_at}`);
            break;
        case 'clear':
            document.getElementById('terminalOutput').innerHTML = '';
            break;
        default:
            appendTerminalLine(`Unknown command: ${cmd}. Type help for a list.`);
            break;
    }
    return false;
}

window.addEventListener('DOMContentLoaded', () => {
    appendTerminalLine('Welcome to the FierForjat console!');
    appendTerminalLine('Type help for commands.');
    const input = document.getElementById('terminalInput');
    if(input) input.focus();
});
</script>
</body>
</html>