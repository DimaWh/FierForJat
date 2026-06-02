<?php
require_once 'functions.php';

function registerUser($username, $email, $password) {
    $username = trim($username);
    $email = strtolower(trim($email));

    if(empty($username) || empty($email) || empty($password)) {
        return 'Completează toate câmpurile!';
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'Email invalid!';
    }
    if(strlen($password) < 6) {
        return 'Parola trebuie să aibă minim 6 caractere!';
    }

    $usersFile = __DIR__ . '/../data/users.json';
    $users = readJSON($usersFile);

    foreach($users as $u) {
        if(strtolower($u['email']) === $email) return 'Email-ul este deja folosit!';
        if($u['username'] === $username) return 'Username-ul este deja folosit!';
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
        return 'Completează toate câmpurile!';
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

    return 'Email sau parolă incorectă!';
}
?>