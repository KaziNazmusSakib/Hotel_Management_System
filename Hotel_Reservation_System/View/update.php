<?php
session_start();
require_once('../Model/userModel.php'); // Assuming userModel.php handles database operations

if (isset($_COOKIE['flag'])) {
    if (isset($_POST['submit'])) {
        // Retrieve the user ID from the form or session
        $id = isset($_POST['id']) ? $_POST['id'] : $_SESSION['id'];

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $email = trim($_POST['email']);
        $user_role = trim($_POST['user_role']);
        $hotel_branch = trim($_POST['hotel_branch']);

        // Validate that all fields are filled
        if (empty($username) || empty($password) || empty($email) || empty($user_role) || empty($hotel_branch)) {
            echo "All fields are required!";
        } else {
            // Prepare the updated user data
            $user = [
                'id' => $id,
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'user_role' => $user_role,
                'hotel_branch' => $hotel_branch,
            ];

            // Update the user in the database
            $status = updateUser($user); // updateUser function defined in userModel.php
            if ($status) {
                // Redirect to userlist.php to show updated list
                header('location: userlist.php');
            } else {
                echo "Failed to update user.";
            }
        }
    } else {
        header('location: edit.php?id=' . $_SESSION['id']);
    }
} else {
    header('location: login.html');
}
?>
