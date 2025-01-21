<!-- checkoutView.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Checkout - Hotel Management</title>
</head>
<body>
    <h2>Checkout Guest</h2>
    
    <!-- Display error message if provided -->
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="post" action="../controller/checkoutController.php">
        <label for="guest_id">Guest ID:</label>
        <input type="text" id="guest_id" name="guest_id" required><br><br>

        <input type="submit" name="submit" value="Checkout">
    </form>
</body>
</html>
