<?php

//require_once('db.php');

function getConnection(){
    $con = mysqli_connect('127.0.0.1', 'root', '', 'continental.db');
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $con;
}

function bookRoom($data) {
    $con = getConnection();
    $sql = "INSERT INTO bookings (room_id, user_id, date_in, date_out, status) 
            VALUES ({$data['room_id']}, {$data['user_id']}, '{$data['date_in']}', '{$data['date_out']}', 'Booked')";
    return mysqli_query($con, $sql);
}

function getBooking($id) {
    $con = getConnection();
    $sql = "SELECT * FROM bookings WHERE id = {$id}";
    $result = mysqli_query($con, $sql);
    return $result ? mysqli_fetch_assoc($result) : null;
}

function getAllBookings() {
    $con = getConnection();
    $sql = "SELECT * FROM bookings";
    $result = mysqli_query($con, $sql);
    $bookings = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $bookings[] = $row;
    }
    return $bookings;
}

function updateBooking($booking) {
    $con = getConnection();
    $sql = "UPDATE bookings SET 
            room_id = {$booking['room_id']}, 
            user_id = {$booking['user_id']}, 
            date_in = '{$booking['date_in']}', 
            date_out = '{$booking['date_out']}', 
            status = '{$booking['status']}'
            WHERE id = {$booking['id']}";
    return mysqli_query($con, $sql);
}

function deleteBooking($id) {
    $con = getConnection();
    $sql = "DELETE FROM bookings WHERE id = {$id}";
    return mysqli_query($con, $sql);
}

?>
