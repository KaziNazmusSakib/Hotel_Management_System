<?php
session_start();
// Ensure only admin can access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Hotel Management System</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script>
        // Load sections dynamically
        function loadAdminSection(section) {
            const mainContent = document.getElementById("admin-main-content");
            const xhr = new XMLHttpRequest();
            xhr.open('GET', section + '.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    mainContent.innerHTML = xhr.responseText;
                } else {
                    mainContent.innerHTML = '<p>Error loading content. Please try again.</p>';
                }
            };
            xhr.send();
        }

        // Logout functionality
        function handleLogout() {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'authController.php?action=logout', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert("Logged out successfully!");
                        window.location.href = 'login.php';
                    } else {
                        alert("Logout failed. Please try again.");
                    }
                }
            };
            xhr.send();
        }
    </script>
</head>
<body>
    <!-- Header -->
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="#" onclick="loadAdminSection('roomsManage')">Manage Rooms</a></li>
                <li><a href="#" onclick="loadAdminSection('facilitiesManage')">Manage Facilities</a></li>
                <li><a href="#" onclick="loadAdminSection('contactManage')">Manage Contact Us</a></li>
                <li><a href="#" onclick="handleLogout()">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main id="admin-main-content">
        <h2>Welcome to the Admin Dashboard</h2>
        <p>Select an option from the menu to manage rooms, facilities, or contact us inquiries.</p>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Hotel Management System. All Rights Reserved.</p>
    </footer>
</body>
</html>
