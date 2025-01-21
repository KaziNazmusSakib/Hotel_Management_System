<?php
    require_once('../Model/userModel.php');  // Make sure to include the necessary model file

    if (isset($_REQUEST['submit'])) {
        $ref_no = trim($_REQUEST['ref_no']);
        $room_id = trim($_REQUEST['room_id']);
        $name = trim($_REQUEST['name']);
        $contact_no = trim($_REQUEST['contact_no']);
        $date_in = trim($_REQUEST['date_in']);
        $date_out = trim($_REQUEST['date_out']);
        $booked_cid = trim($_REQUEST['booked_cid']);  // Booked customer ID if available

        // Check if all fields are filled
        if ($ref_no == '' || $room_id == '' || $name == '' || $contact_no == '' || $date_in == '' || $date_out == '') {
            echo "Please fill all the fields!";
        } else {
            // Attempt to check in the guest
            $status = checkInGuest($ref_no, $room_id, $name, $contact_no, $date_in, $date_out, $booked_cid);
            if ($status) {
                echo "Check-in successful!";
                header('Location: ../view/home.php');  // Redirect to home or dashboard
            } else {
                echo "Check-in failed! Try again.";
            }
        }
    }
    ?>