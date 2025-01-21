// checkinController.php
<?php
require_once('../model/userModel.php');  // Include the model

if (isset($_REQUEST['submit'])) {
    // Gather and sanitize user inputs
    $ref_no = trim($_REQUEST['ref_no']);
    $room_id = trim($_REQUEST['room_id']);
    $name = trim($_REQUEST['name']);
    $contact_no = trim($_REQUEST['contact_no']);
    $date_in = trim($_REQUEST['date_in']);
    $date_out = trim($_REQUEST['date_out']);
    $booked_cid = trim($_REQUEST['booked_cid']);  // Booked customer ID if available

    // Check if any of the required fields are empty
    if ($ref_no == '' || $room_id == '' || $name == '' || $contact_no == '' || $date_in == '' || $date_out == '') {
        $error_message = "Please fill all the fields!";
        include('../view/checkinView.php');
    } else {
        // Call the model's check-in function
        $status = checkInGuest($ref_no, $room_id, $name, $contact_no, $date_in, $date_out, $booked_cid);
        if ($status) {
            header('Location: ../view/home.php');  // Redirect to home page
            exit();
        } else {
            $error_message = "Check-in failed! Try again.";
            include('../view/checkinView.php');
        }
    }
} else {
    include('../view/checkinView.php');  // Display the check-in form if the submit is not clicked
}
?>
