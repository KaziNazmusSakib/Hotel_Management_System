document.addEventListener("DOMContentLoaded", () => {
    const isAdmin = false; // Change based on authentication
    const mainContent = document.getElementById("main-content");
    const adminSection = document.getElementById("admin-section");

    // Show admin or user section
    if (isAdmin) {
        adminSection.style.display = "block";
    }

    // Load default user section
    loadSection('rooms');
    


// Attach event listeners for room form submission
const roomForm = document.getElementById("roomForm");
if (roomForm) {
    roomForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const name = document.getElementById("roomName").value;
        const category = document.getElementById("roomCategory").value;
        const price = document.getElementById("roomPrice").value;
        const status = document.getElementById("roomStatus").value;

        if (validateRoomForm(name, category, price, status)) {
            saveRoom({ name, category, price, status });
        }
    });
}
});

// Load sections dynamically
function loadSection(section) {
    const mainContent = document.getElementById("main-content");

    switch (section) {
        case 'rooms':
            fetch('ajax/roomAjax.php?action=list')
                .then(response => response.json())
                .then(data => {
                    mainContent.innerHTML = `
                        <h2>Available Rooms</h2>
                        ${data.map(room => `
                            <div class="room">
                                <p>${room.name} - ${room.price} - ${room.status}</p>
                                <button onclick="bookRoom(${room.id})">Book</button>
                            </div>
                        `).join('')}
                    `;
                });
            break;

        case 'categories':
            fetch('ajax/categoryAjax.php?action=list')
                .then(response => response.json())
                .then(data => {
                    mainContent.innerHTML = `
                        <h2>Room Categories</h2>
                        ${data.map(category => `
                            <div class="category">
                                <p>${category.name}</p>
                            </div>
                        `).join('')}
                    `;
                });
            break;

        case 'checkin':
            mainContent.innerHTML = `
                <h2>Check-In & Check-Out</h2>
                <form id="checkinForm">
                    <label>Room ID: <input type="number" id="roomId" required></label>
                    <label>Check-In Date: <input type="date" id="checkinDate" required></label>
                    <label>Check-Out Date: <input type="date" id="checkoutDate" required></label>
                    <button type="submit">Book</button>
                </form>
            `;
            document.getElementById("checkinForm").addEventListener("submit", handleCheckIn);
            break;

        case 'facilities':
            fetch('ajax/facilityAjax.php?action=list')
                .then(response => response.json())
                .then(data => {
                    mainContent.innerHTML = `
                        <h2>Facilities</h2>
                        ${data.map(facility => `
                            <div class="facility">
                                <h3>${facility.name}</h3>
                                <p>${facility.description}</p>
                            </div>
                        `).join('')}
                    `;
                });
            break;

        case 'contact':
            mainContent.innerHTML = `
                <h2>Contact Us</h2>
                <form id="contactForm">
                    <label>Your Message: <textarea id="userMessage" required></textarea></label>
                    <button type="submit">Send</button>
                </form>
            `;
            document.getElementById("contactForm").addEventListener("submit", handleContact);
            break;

        case 'login':
            mainContent.innerHTML = `
                <h2>Login</h2>
                <form id="loginForm">
                    <label>Email: <input type="email" id="loginEmail" required></label>
                    <label>Password: <input type="password" id="loginPassword" required></label>
                    <button type="submit">Login</button>
                </form>
            `;
            document.getElementById("loginForm").addEventListener("submit", handleLogin);
            break;

        case 'signup':
            mainContent.innerHTML = `
                <h2>Signup</h2>
                <form id="signupForm">
                    <label>Name: <input type="text" id="signupName" required></label>
                    <label>Email: <input type="email" id="signupEmail" required></label>
                    <label>Password: <input type="password" id="signupPassword" required></label>
                    <button type="submit">Signup</button>
                </form>
            `;
            document.getElementById("signupForm").addEventListener("submit", handleSignup);
            break;

        default:
            mainContent.innerHTML = `<h2>Page not found</h2>`;
    }
}

// Load rooms and update room list
function loadRooms() {
    fetch('../ajax/roomAjax.php?action=list')
        .then(response => response.json())
        .then(data => {
            const roomList = document.getElementById("room-list");
            roomList.innerHTML = data.map(room => `
                <div class="room">
                    <p>${room.name} - ${room.price} - ${room.status}</p>
                </div>
            `).join("");
        });
}

// Save a new room
function saveRoom(room) {
    fetch('../ajax/roomAjax.php?action=save', {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(room),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Room saved successfully!");
            loadRooms();
        } else {
            alert("Error saving room.");
        }
    });
}

// Validate room form input
function validateRoomForm(name, category, price, status) {
    if (!name || !category || !price || !status) {
        alert("All fields are required.");
        return false;
    }
    if (price <= 0) {
        alert("Price must be positive.");
        return false;
    }
    return true;
}

function showRoomForm() {
    document.getElementById("room-form").style.display = "block";
}

// Example handlers for other forms
function handleCheckIn(e) {
    e.preventDefault();
    alert("Check-in form submitted!");
}

function handleContact(e) {
    e.preventDefault();
    alert("Contact form submitted!");
}

function handleLogin(e) {
    e.preventDefault();
    alert("Login form submitted!");
}

function handleSignup(e) {
    e.preventDefault();
    alert("Signup form submitted!");
}


// Load admin sections dynamically
function loadAdminSection(section) {
    const adminContent = document.getElementById("admin-content");

    switch (section) {
        case 'manageRooms':
            // Load room management controls
            adminContent.innerHTML = `<h3>Manage Rooms</h3>`;
            break;

        case 'manageFacilities':
            // Load facility management controls
            adminContent.innerHTML = `<h3>Manage Facilities</h3>`;
            break;

        case 'manageContact':
            // Load contact management controls
            adminContent.innerHTML = `<h3>Manage Contact Us</h3>`;
            break;

        default:
            adminContent.innerHTML = `<h3>Admin section not found</h3>`;
    }
}

// Example handlers for form submissions
function handleCheckIn(e) {
    e.preventDefault();
    alert("Check-in form submitted!");
}

function handleContact(e) {
    e.preventDefault();
    alert("Contact form submitted!");
}

function handleLogin(e) {
    e.preventDefault();
    alert("Login form submitted!");
}

function handleSignup(e) {
    e.preventDefault();
    alert("Signup form submitted!");
}
