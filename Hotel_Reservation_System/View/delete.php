<?php
session_start();
require_once('../Model/userModel.php');

if (isset($_COOKIE['flag'])) {
    if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        echo "User ID received: " . $id . "<br>";

        $status = deleteUser($id);
        if ($status) {
            echo "User successfully deleted! Redirecting...";
            header('location: userlist.php');
            exit();
        } else {
            echo "Failed to delete user. Please check the database query.";
        }
    } else {
        echo "Invalid or missing User ID!";
    }
} else {
    echo "You are not authorized. Please log in.";
    header('location: login.html');
    exit();
}
?>
