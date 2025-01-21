<?php
session_start();
require_once('../Model/userModel.php');

// Read JSON data from the AJAX request
$requestPayload = file_get_contents("../View/login.php");
$data = json_decode($requestPayload, true);

// Check if the request contains username and password
if (isset($data['username']) && isset($data['password'])) {
    $username = trim($data['username']);
    $password = trim($data['password']);

    if ($username == null || empty($password)) {
        // Respond with an error if any field is empty
        echo json_encode([
            "success" => false,
            "message" => "Username or password cannot be empty!"
        ]);
        exit;
    } else {
        // Validate user credentials
        $status = login($username, $password);

        if ($status) {
            // Fetch user details to determine role
            $user = getUserByUsername($username);

            if ($user) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $user['role']; // Assume 'role' is returned by getUserByUsername

                // Set cookie and success response
                setcookie('flag', 'true', time() + 3600, '/');
                
                echo json_encode([
                    "success" => true,
                    "role" => $user['role']
                ]);
            } else {
                // If user details are not found
                echo json_encode([
                    "success" => false,
                    "message" => "User role not found."
                ]);
            }
        } else {
            // Respond with an error for invalid credentials
            echo json_encode([
                "success" => false,
                "message" => "Invalid username or password."
            ]);
        }
    }
} else {
    // Respond with an error for invalid request
    echo json_encode([
        "success" => false,
        "message" => "Invalid request. Please provide valid credentials."
    ]);
    exit;
}
?>
