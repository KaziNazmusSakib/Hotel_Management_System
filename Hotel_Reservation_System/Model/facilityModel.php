<?php

 

function getConnection(){
    $con = mysqli_connect('127.0.0.1', 'root', '', 'continental.db');
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $con;
}
// FacilityModel.php
function addFacility($name, $description) {
    $con = getConnection();
    $sql = "INSERT INTO facilities (name, description) VALUES ('{$name}', '{$description}')";
    return mysqli_query($con, $sql);
}

function getFacility($id) {
    $con = getConnection();
    $sql = "SELECT * FROM facilities WHERE id = {$id}";
    $result = mysqli_query($con, $sql);
    return $result ? mysqli_fetch_assoc($result) : null;
}

function getAllFacilities() {
    $con = getConnection();
    $sql = "SELECT * FROM facilities";
    $result = mysqli_query($con, $sql);
    $facilities = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $facilities[] = $row;
    }
    return $facilities;
}

function updateFacility($facility) {
    $con = getConnection();
    $sql = "UPDATE facilities SET 
            name = '{$facility['name']}', 
            description = '{$facility['description']}'
            WHERE id = {$facility['id']}";
    return mysqli_query($con, $sql);
}

function deleteFacility($id) {
    $con = getConnection();
    $sql = "DELETE FROM facilities WHERE id = {$id}";
    return mysqli_query($con, $sql);
}

?>
