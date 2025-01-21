<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
</head>
<body>
    <form method="post" action="../controller/contactController.php">
        <h2>Contact Us</h2>
        <label>Name: </label><input type="text" name="name"><br>
        <label>Email: </label><input type="email" name="email"><br>
        <label>Message: </label><textarea name="message"></textarea><br>
        <input type="submit" name="submit" value="Send">
    </form>
</body>
</html>
