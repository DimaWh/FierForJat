<?php
require_once 'functions.php';

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

function registerUser($username, $email, $password) {
    $username = trim($username);
    $email = strtolower(trim($email));

    if(empty($username) || empty($email) || empty($password)) {
        return 'Please fill in all fields!';
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'Invalid email address!';
    }
    if(strlen($password) < 6) {
        return 'Password must be at least 6 characters long!';
    }

    $usersFile = __DIR__ . '/../data/users.json';
    $users = readJSON($usersFile);

    foreach($users as $u) {
        if(strtolower($u['email']) === $email) return 'This email is already in use!';
        if($u['username'] === $username) return 'This username is already taken!';
    }

    $users[] = [
        'id' => uniqid(),
        'username' => $username,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'created_at' => date('Y-m-d H:i:s')
    ];

    writeJSON($usersFile, $users);
    return true;
}

function loginUser($email, $password) {
    $email = strtolower(trim($email));

    if(empty($email) || empty($password)) {
        return 'Please fill in all fields!';
    }

    $usersFile = __DIR__ . '/../data/users.json';
    $users = readJSON($usersFile);

    foreach($users as $u) {
        if(strtolower($u['email']) === $email && password_verify($password, $u['password'])) {
            $_SESSION['user'] = [
                'id' => $u['id'],
                'username' => $u['username'],
                'email' => $u['email']
            ];
            return true;
        }
    }

    return 'Incorrect email or password!';
}
?>