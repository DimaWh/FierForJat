<?php
require_once 'functions.php';

// Generic save endpoint - can be extended later
// Example: save server order, update user data, etc.

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$type = $_POST['type'] ?? '';

switch($type) {
    case 'order':
        // TODO: handle server orders in next weeks
        echo json_encode(['success' => true, 'message' => 'Comanda a fost salvată']);
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Tip necunoscut']);
}
?>