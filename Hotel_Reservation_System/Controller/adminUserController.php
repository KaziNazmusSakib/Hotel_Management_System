<?php
require_once('../model/userModel.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    $isUpdated = updateUser($id, $username, $password, $email);
    if ($isUpdated) {
        header('Location: ../view/userlist.php?message=success');
    } else {
        echo "Failed to update user!";
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $isDeleted = deleteUser($id);
    if ($isDeleted) {
        header('Location: ../view/userlist.php?message=deleted');
    } else {
        echo "Failed to delete user!";
    }
}
?>
