<?php
    session_start();
    if(isset($_COOKIE['flag'])){

        if(isset($_REQUEST['id'])){
            echo $_REQUEST['id'];
            $_SESSION['id'] = $_REQUEST['id'];
        }
        $user = ['id'=>1, 'username'=>'Sakib', 'email'=>'n@aiub.edu', 'password'=>123,'user_role'=>'customer','hotel_branch'=>'Dhaka'];
?>

<html>
<head>
    <title>Signup</title>
</head>
<body>
        <h2> Edit User </h2>
        <form method="post" action="update.php" enctype="">
            Username: <input type="text" name="username" value="<?=$user['username']?>" /> <br>
            Password: <input type="password" name="password" value="<?=$user['password']?>" /> <br>
            Email: <input type="email" name="email" value="<?=$user['email']?>" /> <br>
            User_role: <input type="text" name="user_role" value="<?=$user['user_role']?>" /> <br>
            Hotel_branch: <input type="text" name="hotel_branch" value="<?=$user['hotel_branch']?>" /> <br>
                    <input type="submit" name="submit" value="Update" />
        </form>
</body>
</html>

<?php
    }else{
        header('location: login.html'); 
    }
?>