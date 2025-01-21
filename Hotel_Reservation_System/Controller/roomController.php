<?php
require_once('../Model/roomModel.php');
require_once('../Model/categoryModel.php');

$action = $_GET['action'] ?? null;

if ($action === 'filter') {
    $data = json_decode(file_get_contents('php://input'), true);
    $category = $data['category'] ?? null;
    $rooms = $category ? getRoomsByCategory($category) : getAllRooms();
    echo json_encode(['success' => true, 'rooms' => $rooms]);
    exit;
}

if ($action === 'book') {
    $data = json_decode(file_get_contents('php://input'), true);
    $roomId = $data['roomId'] ?? null;
    if (bookRoom($roomId)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Booking failed.']);
    }
    exit;
}
?>
