<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Management System</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <h1>Hotel Management System</h1>
        </div>
        <nav>
            <ul id="nav-menu">
                <li><a href="#" onclick="loadSection('rooms')">Rooms</a></li>
                <li><a href="#" onclick="loadSection('facilities')">Facilities</a></li>
                <li><a href="#" onclick="loadSection('contact')">Contact Us</a></li>
                <li id="admin-menu" style="display:none;"><a href="#" onclick="loadSection('admin')">Admin Dashboard</a></li>
                <li><a href="#" onclick="loadSection('login')">Login</a></li>
                <li><a href="#" onclick="loadSection('signup')">Signup</a></li>
            </ul>
        </nav>
    </header>

    <!--<center>
        <img src="C:\\xampp\\htdocs\\Hotel_Reservation_System\\assets\\img\\hotel-cover.jpg" width="800px" height="800px" />
    </center>-->

    <!-- Main Content -->
    <main id="main-content">
        <!-- Dynamic sections will load here -->
    </main>

     

    <script>
        // Function to load content into the main content area
        function loadSection(section) {
            const mainContent = document.getElementById('main-content');
            const xhr = new XMLHttpRequest();
            xhr.open('GET', section + '.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    mainContent.innerHTML = xhr.responseText;
                } else {
                    mainContent.innerHTML = '<p>Error loading content. Please try again.</p>';
                }
            };
            xhr.send();
        }
    </script>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2025 Hotel Management System. All Rights Reserved.</p>
    </footer>
    
</body>
</html>
