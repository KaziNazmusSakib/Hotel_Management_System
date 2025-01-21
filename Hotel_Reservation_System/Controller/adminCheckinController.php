<?php
require_once('../model/bookingModel.php');
if (isset($_POST['checkin'])) {
    $userId = $_POST['user_id'];
    $roomId = $_POST['room_id'];
    $checkinDate = $_POST['checkin_date'];
    $checkoutDate = $_POST['checkout_date'];

    $result = bookRoom($userId, $roomId, $checkinDate, $checkoutDate);
    if ($result) {
        echo "Check-in successful!";
    } else {
        echo "Failed to check in.";
    }
}
?>
