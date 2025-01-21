<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Hotel Management System</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script>
        // JS form validation
    function validateForm() {
        const username = document.getElementById("username").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmPassword").value;

        // Check if fields are empty
        if (username === "" || email === "" || password === "" || confirmPassword === "") {
            alert("All fields are required!");
            return false;
        }

        // Check if passwords match
        if (password !== confirmPassword) {
            alert("Passwords do not match!");
            return false;
        }

        // Email validation using regular expression
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!email.match(emailPattern)) {
            alert("Invalid email format!");
            return false;
        }

        // Submit form via AJAX if validation passes
        submitForm(username, email, password);
        return false; // Prevent form from submitting normally
    }

    // Submit form via AJAX
    function submitForm(username, email, password) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../Controller/signupCheck.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        const data = JSON.stringify({
            username: username,
            email: email,
            password: password
        });

        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert("Signup successful!");
                        // Open login popup
                        openLoginPopup();
                    } else {
                        alert("Signup failed: " + response.message);
                    }
                } catch (e) {
                    alert("Unexpected error occurred. Please try again.");
                }
            } else {
                alert("Error occurred. Please try again.");
            }
        };

        xhr.send(data);
    }

    // Function to open the login popup
    function openLoginPopup() {
        const loginWindow = window.open('login.php', '_blank', 'width=500,height=600');
        if (!loginWindow) {
            alert("Popup blocked. Please allow popups for this website.");
        }
    }
    </script>
</head>
<body>
     

    <!-- Main Content -->
    <main id="main-content">
        <h2>Signup</h2>
        <form id="signup-form" onsubmit="return validateForm()">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required><br><br>
            
            <button type="submit">Signup</button>
        </form>
    </main>

    
</body>
</html>
