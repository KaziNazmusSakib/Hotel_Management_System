<?php
require_once('../model/contactModel.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (saveContactMessage($name, $email, $message)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message!";
    }
}
?>
