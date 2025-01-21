<?php
require_once('../Model/userModel.php');

// Check if the request is POST and contains the necessary data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get raw POST data
    $data = json_decode(file_get_contents('..View/signup.php'), true);

    if (isset($data['username']) && isset($data['email']) && isset($data['password'])) {
        // Hash the password before storing it
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        
        // Call the addUser function to insert the user
        $result = addUser($data['username'], $data['email'], $password);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'User registered successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to register user. Please try again.']);
        }
    } else {
        // Return error message if necessary data is missing
        echo json_encode(['success' => false, 'message' => 'Required fields are missing.']);
    }
} else {
    // Return error for invalid request method
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

?>
