<?php

//require_once('db.php');

function getConnection(){
    $con = mysqli_connect('127.0.0.1', 'root', '', 'continental.db');
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $con;
}

// RoomModel.php
function addRoom($name, $category_id, $price, $availability) {
    $con = getConnection();
    $sql = "INSERT INTO rooms (name, category_id, price, availability) 
            VALUES ('{$name}', {$category_id}, {$price}, '{$availability}')";
    return mysqli_query($con, $sql);
}


function getRoom($id) {
    $con = getConnection();
    $sql = "SELECT * FROM rooms WHERE id = {$id}";
    $result = mysqli_query($con, $sql);
    return $result ? mysqli_fetch_assoc($result) : null;
}

function getAllRooms() {
    $con = getConnection();
    $sql = "SELECT * FROM rooms";
    $result = mysqli_query($con, $sql);
    $rooms = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rooms[] = $row;
    }
    return $rooms;
}

function updateRoom($room) {
    $con = getConnection();
    $sql = "UPDATE rooms SET 
            name = '{$room['name']}', 
            category_id = {$room['category_id']}, 
            price = {$room['price']}, 
            availability = '{$room['availability']}'
            WHERE id = {$room['id']}";
    return mysqli_query($con, $sql);
}

function deleteRoom($id) {
    $con = getConnection();
    $sql = "DELETE FROM rooms WHERE id = {$id}";
    return mysqli_query($con, $sql);
}

?>
