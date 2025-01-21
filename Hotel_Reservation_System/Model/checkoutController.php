<!-- checkoutController.php -->
<?php
require_once('../model/userModel.php');  // Make sure to include the necessary model file

// Initialize error message for the view
$error_message = '';

// Check if the form is submitted
if (isset($_REQUEST['submit'])) {
    // Collect and sanitize form inputs
    $guest_id = trim($_REQUEST['guest_id']);

    // Validate if guest ID is provided
    if ($guest_id == '') {
        $error_message = "Please provide the Guest ID!";
        include('../view/checkoutView.php');  // Render the form again with error message
    } else {
        // Attempt to check out the guest
        $status = checkOutGuest($guest_id);
        
        if ($status) {
            header('Location: ../view/home.php');  // Redirect to home or dashboard if checkout is successful
        } else {
            $error_message = "Checkout failed! Try again.";
            include('../view/checkoutView.php');  // Render the form again with failure message
        }
    }
} else {
    include('../view/checkoutView.php');  // If no form submission, just render the form
}
?>
