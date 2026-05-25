<?php
require_once 'functions.php';

function registerUser($username, $email, $password) {
    if(empty($username) || empty($email) || empty($password)) {
        return 'Completează toate câmpurile!';
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'Email invalid!';
    }
    if(strlen($password) < 6) {
        return 'Parola trebuie să aibă minim 6 caractere!';
    }

    $users = readJSON('../data/users.json');

    foreach($users as $u) {
        if($u['email'] === $email) return 'Email-ul este deja folosit!';
        if($u['username'] === $username) return 'Username-ul este deja folosit!';
    }

    $users[] = [
        'id' => uniqid(),
        'username' => $username,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'created_at' => date('Y-m-d H:i:s')
    ];

    writeJSON('../data/users.json', $users);
    return true;
}

function loginUser($email, $password) {
    if(empty($email) || empty($password)) {
        return 'Completează toate câmpurile!';
    }

    $users = readJSON('../data/users.json');

    foreach($users as $u) {
        if($u['email'] === $email && password_verify($password, $u['password'])) {
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