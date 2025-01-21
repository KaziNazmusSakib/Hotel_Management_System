<?php
require_once('../Model/roomModel.php');
require_once('../Model/categoryModel.php');

// Fetch data
$rooms = getAllRooms();
$categories = getAllCategories();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Available Rooms</title>
    <script>
        // Validate filter input
        function validateFilterInput(category) {
            if (!category.match(/^\d*$/)) {
                alert("Invalid category selection. Please try again.");
                return false;
            }
            return true;
        }

        // Filter rooms by category
        function filterRooms() {
            const category = document.getElementById('categoryFilter').value;

            // Input validation
            if (!validateFilterInput(category)) {
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../Controller/roomController.php?action=filter', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        updateRoomTable(response.rooms);
                    } else {
                        alert('Failed to fetch rooms.');
                    }
                }
            };
            xhr.send(JSON.stringify({ category: category }));
        }

        // Validate room booking input
        function validateRoomBookingInput(roomId) {
            if (!roomId || isNaN(roomId)) {
                alert("Invalid room ID. Please try again.");
                return false;
            }
            return true;
        }

        // Update table dynamically
        function updateRoomTable(rooms) {
            const tableBody = document.getElementById('roomTableBody');
            tableBody.innerHTML = '';
            rooms.forEach(room => {
                const row = `<tr>
                    <td>${room.room_number}</td>
                    <td>${room.category_name}</td>
                    <td>${room.price}</td>
                    <td>${room.status}</td>
                    <td>
                        <button ${room.status === 'Occupied' ? 'disabled' : ''} onclick="bookRoom(${room.id})">
                            ${room.status === 'Occupied' ? 'Unavailable' : 'Book Now'}
                        </button>
                    </td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        }

        // Book room
        function bookRoom(roomId) {
            // Input validation
            if (!validateRoomBookingInput(roomId)) {
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../Controller/roomController.php?action=book', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert('Room booked successfully!');
                        filterRooms(); // Refresh room list
                    } else {
                        alert('Booking failed.');
                    }
                }
            };
            xhr.send(JSON.stringify({ roomId: roomId }));
        }
    </script>
</head>
<body>
    <header>
        <h1>Rooms</h1>
        <div>
            <label for="categoryFilter">Filter by Category:</label>
            <select id="categoryFilter" onchange="filterRooms()">
                <option value="">All</option>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="roomTableBody">
                <?php foreach ($rooms as $room) { ?>
                    <tr>
                        <td><?= $room['room_number'] ?></td>
                        <td><?= $room['category_name'] ?></td>
                        <td><?= $room['price'] ?></td>
                        <td><?= $room['status'] ?></td>
                        <td>
                            <button <?= $room['status'] === 'Occupied' ? 'disabled' : '' ?>
                                onclick="bookRoom(<?= $room['id'] ?>)">
                                <?= $room['status'] === 'Occupied' ? 'Unavailable' : 'Book Now' ?>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; 2025 Hotel Management System</p>
    </footer>
</body>
</html>
