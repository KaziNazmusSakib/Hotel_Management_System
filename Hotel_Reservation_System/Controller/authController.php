<?php
session_start();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'login':
            handleLogin();
            break;
        case 'check':
            checkLogin();
            break;
        case 'logout':
            handleLogout();
            break;
    }
}

function handleLogin() {
    $data = json_decode(file_get_contents('php://input'), true);

    $username = $data['username'];
    $password = $data['password'];

    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['role'] = 'admin';
        echo json_encode(['success' => true, 'role' => 'admin']);
    } elseif (checkUserCredentials($username, $password)) {
        $_SESSION['role'] = 'user';
        echo json_encode(['success' => true, 'role' => 'user']);
    } else {
        echo json_encode(['success' => false]);
    }
}

function checkLogin() {
    if (isset($_SESSION['role'])) {
        echo json_encode(['loggedIn' => true, 'role' => $_SESSION['role']]);
    } else {
        echo json_encode(['loggedIn' => false]);
    }
}

function handleLogout() {
    session_destroy();
    echo json_encode(['success' => true]);
}

function checkUserCredentials($username, $password) {
    // Replace with database validation
    return $username === 'user' && $password === 'user123';
}
?>
