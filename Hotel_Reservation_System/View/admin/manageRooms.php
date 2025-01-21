<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rooms</title>
    <link rel="stylesheet" href="assets/css/manageRoom.css">
    <script src="assets/js/manageRoom.js"></script>
</head>
<body>
    <header>
        <h1>Manage Rooms</h1>
    </header>

    <button onclick="openRoomForm()">Add New Room</button>

    <div id="roomForm" class="form-popup">
        <form id="addRoomForm" onsubmit="return handleRoomForm(event)">
            <h2>Add Room</h2>

            <label for="roomName">Room Name:</label>
            <input type="text" id="roomName" name="roomName" required>

            <label for="category">Category ID:</label>
            <input type="number" id="category" name="category" required>

            <label for="roomPrice">Price:</label>
            <input type="number" id="roomPrice" name="roomPrice" required>

            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="available">Available</option>
                <option value="occupied">Occupied</option>
            </select>

            <button type="submit">Add Room</button>
            <button type="button" onclick="closeRoomForm()">Cancel</button>
        </form>
    </div>

    <table id="roomsTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data populated via AJAX -->
        </tbody>
    </table>

     <script>
        document.addEventListener('DOMContentLoaded', () => {
    fetchRooms(); // Fetch rooms on page load
});

function openRoomForm() {
    document.getElementById('roomForm').style.display = 'block';
}

function closeRoomForm() {
    document.getElementById('roomForm').style.display = 'none';
    document.getElementById('addRoomForm').reset();
}

function validateRoomForm(room) {
    if (!room.name || !room.category_id || !room.price || !room.status) {
        alert('All fields are required.');
        return false;
    }
    return true;
}

function handleRoomForm(event) {
    event.preventDefault();

    const room = {
        name: document.getElementById('roomName').value,
        category_id: parseInt(document.getElementById('category').value, 10),
        price: parseFloat(document.getElementById('roomPrice').value),
        status: document.getElementById('status').value,
    };

    if (!validateRoomForm(room)) return false;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'roomController.php?action=create', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = () => {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert('Room added successfully!');
                fetchRooms();
                closeRoomForm();
            } else {
                alert('Failed to add room.');
            }
        }
    };
    xhr.send(JSON.stringify(room));
}

function fetchRooms() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'roomController.php?action=list', true);
    xhr.onload = () => {
        if (xhr.status === 200) {
            const rooms = JSON.parse(xhr.responseText);
            const tableBody = document.querySelector('#roomsTable tbody');
            tableBody.innerHTML = '';
            rooms.forEach((room) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${room.id}</td>
                    <td>${room.name}</td>
                    <td>${room.category_id}</td>
                    <td>${room.price}</td>
                    <td>${room.status}</td>
                    <td>
                        <button onclick="deleteRoom(${room.id})">Delete</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }
    };
    xhr.send();
}

function deleteRoom(id) {
    if (!confirm('Are you sure you want to delete this room?')) return;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'roomController.php?action=delete', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = () => {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert('Room deleted successfully!');
                fetchRooms();
            } else {
                alert('Failed to delete room.');
            }
        }
    };
    xhr.send(JSON.stringify({ id }));
}

     </script>
</body>
</html>
