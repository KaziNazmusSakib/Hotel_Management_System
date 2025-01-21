<?php

//require_once('db.php');

function getConnection(){
    $con = mysqli_connect('127.0.0.1', 'root', '', 'continental.db');
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $con;
} 
// CategoryModel.php
function addCategory($name, $description) {
    $con = getConnection();
    $sql = "INSERT INTO room_categories (name, description) VALUES ('{$name}', '{$description}')";
    return mysqli_query($con, $sql);
}


function getCategory($id) {
    $con = getConnection();
    $sql = "SELECT * FROM room_categories WHERE id = {$id}";
    $result = mysqli_query($con, $sql);
    return $result ? mysqli_fetch_assoc($result) : null;
}

function getAllCategories() {
    $con = getConnection();
    $sql = "SELECT * FROM room_categories";
    $result = mysqli_query($con, $sql);
    $categories = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
    return $categories;
}

function updateCategory($category) {
    $con = getConnection();
    $sql = "UPDATE room_categories SET 
            name = '{$category['name']}', 
            description = '{$category['description']}'
            WHERE id = {$category['id']}";
    return mysqli_query($con, $sql);
}

function deleteCategory($id) {
    $con = getConnection();
    $sql = "DELETE FROM room_categories WHERE id = {$id}";
    return mysqli_query($con, $sql);
}

?>