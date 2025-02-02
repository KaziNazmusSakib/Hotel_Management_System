<!-- checkinView.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Check-in - Hotel Management</title>
</head>
<body>
    <h2>Check-in Guest</h2>
    
    <!-- Error message section, if any -->
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="post" action="../controller/checkinController.php">
        <label for="ref_no">Reference Number:</label>
        <input type="text" id="ref_no" name="ref_no" required><br><br>

        <label for="room_id">Room ID:</label>
        <input type="text" id="room_id" name="room_id" required><br><br>

        <label for="name">Guest Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="contact_no">Contact Number:</label>
        <input type="text" id="contact_no" name="contact_no" required><br><br>

        <label for="date_in">Check-in Date:</label>
        <input type="date" id="date_in" name="date_in" required><br><br>

        <label for="date_out">Check-out Date:</label>
        <input type="date" id="date_out" name="date_out" required><br><br>

        <label for="booked_cid">Booked Customer ID (optional):</label>
        <input type="text" id="booked_cid" name="booked_cid"><br><br>

        <input type="submit" name="submit" value="Check-in">
    </form>
</body>
</html>
