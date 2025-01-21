<?php

//require_once('db.php');

function getConnection(){
    $con = mysqli_connect('127.0.0.1', 'root', '', 'continental.db');
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $con;
}

// ContactModel.php
function submitQuery($data) {
    $con = getConnection();
    $sql = "INSERT INTO contacts (name, email, message) VALUES ('{$data['name']}', '{$data['email']}', '{$data['message']}')";
    return mysqli_query($con, $sql);
}

function getQuery($id) {
    $con = getConnection();
    $sql = "SELECT * FROM contacts WHERE id = {$id}";
    $result = mysqli_query($con, $sql);
    return $result ? mysqli_fetch_assoc($result) : null;
}

function getAllQueries() {
    $con = getConnection();
    $sql = "SELECT * FROM contacts";
    $result = mysqli_query($con, $sql);
    $queries = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $queries[] = $row;
    }
    return $queries;
}

function deleteQuery($id) {
    $con = getConnection();
    $sql = "DELETE FROM contacts WHERE id = {$id}";
    return mysqli_query($con, $sql);
}

?>
