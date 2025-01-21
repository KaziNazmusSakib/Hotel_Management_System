<?php
require_once '../Controllers/roomController.php';

$action = $_GET['action'];

if ($action == 'list') {
    listRooms();
} elseif ($action == 'save') {
    $data = json_decode(file_get_contents('php://input'), true);
    createRoom($data['name'], $data['category'], $data['price'], $data['status']);
}
?>
