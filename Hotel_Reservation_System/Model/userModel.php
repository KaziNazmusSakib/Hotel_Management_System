<?php

function getConnection() {
    $con = mysqli_connect('127.0.0.1', 'root', '', 'continental.db');
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $con;
}

// UserModel.php
function login($username, $password) {
    $con = getConnection();
    $sql = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'";
    $result = mysqli_query($con, $sql);
    return mysqli_num_rows($result) > 0;
}

function addUser($username, $email, $password, $role = 'user') {
    $con = getConnection();
    
    // Check if the username or email already exists
    $sql_check = "SELECT * FROM users WHERE username = '{$username}' OR email = '{$email}'";
    $result_check = mysqli_query($con, $sql_check);
    
    if (mysqli_num_rows($result_check) > 0) {
        // Username or email already exists
        echo json_encode(['success' => false, 'message' => 'Username or Email already exists.']);
        return;
    }

    // Insert the new user into the database
    $sql = "INSERT INTO users (username, email, password, role) 
            VALUES ('{$username}', '{$email}', '{$password}', '{$role}')";
    
    if (mysqli_query($con, $sql)) {
        // Successfully inserted user
        echo json_encode(['success' => true, 'message' => 'User registered successfully.']);
    } else {
        // Error during insertion
        echo json_encode(['success' => false, 'message' => 'Error during registration.']);
    }
}

function getUser($id) {
    $con = getConnection();
    $sql = "SELECT * FROM users WHERE id = {$id}";
    $result = mysqli_query($con, $sql);
    return $result ? mysqli_fetch_assoc($result) : null;
}

function getAllUsers() {
    $con = getConnection();
    $sql = "SELECT * FROM users";
    $result = mysqli_query($con, $sql);
    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    return $users;
}

function updateUser($user) {
    $con = getConnection();
    $sql = "UPDATE users SET 
            username = '{$user['username']}', 
            email = '{$user['email']}',
            password = '{$user['password']}', 
            role = '{$user['role']}' 
            WHERE id = {$user['id']}";
    return mysqli_query($con, $sql);
}

function deleteUser($id) {
    $con = getConnection();
    $sql = "DELETE FROM users WHERE id = {$id}";
    return mysqli_query($con, $sql);
}

?>
