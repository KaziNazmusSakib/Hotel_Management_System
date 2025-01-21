<?php
require_once('../model/facilityModel.php');

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $isAdded = addFacility($name, $description);
    if ($isAdded) {
        header('Location: ../view/facilityList.php?message=success');
    } else {
        echo "Failed to add facility!";
    }
}
?>
