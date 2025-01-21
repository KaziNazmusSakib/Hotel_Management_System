<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hotel Management System</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script>
        // Login form validation
        function validateLoginForm() {
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;

            if (username === "" || password === "") {
                alert("All fields are required!");
                return false;
            }

            // AJAX request to loginCheck.php
            submitLogin(username, password);
            return false; // Prevent default form submission    
        }

        function submitLogin(username, password) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'loginCheck.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');

            const data = JSON.stringify({
                username: username,
                password: password
            });

            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert("Login successful!");

                        // Redirect based on user role
                        if (response.role === "admin") {
                            window.location.href = 'dashboard.php'; // Admin dashboard
                        } else if (response.role === "user") {
                            window.location.href = 'rooms.php'; // User browsing
                        }
                    } else {
                        alert("Login failed: " + response.message);
                    }
                } else {
                    alert("Error occurred. Please try again.");
                }
            };

            xhr.send(data);
        }
    </script>
</head>
<body>
     

    <!-- Main Content -->
    <main id="main-content">
        <h2>Login</h2>
        <form id="login-form" onsubmit="return validateLoginForm()">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit">Login</button>
        </form>
    </main>

     
</body>
</html>
