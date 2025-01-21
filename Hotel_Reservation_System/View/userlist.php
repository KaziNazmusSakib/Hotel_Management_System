<?php
    session_start();
    require_once('../Model/userModel.php'); 

    if(isset($_COOKIE['flag'])){

    /*$users = [
        ['id'=>1, 'username'=>'Sakib', 'email'=>'n@aiub.edu', 'password'=>123,'user_role'=>'customer','hotel_branch'=>'Dhaka'],
        ['id'=>2, 'username'=>'Nazmus', 'email'=>'nazmus@aiub.edu', 'password'=>1234,'user_role'=>'customer','hotel_branch'=>'Dhaka'],
        ['id'=>3, 'username'=>'alamin', 'email'=>'alamin@aiub.edu', 'password'=>123,'user_role'=>'customer','hotel_branch'=>'Dhaka'],
        ['id'=>4, 'username'=>'noor', 'email'=>'noor@aiub.edu', 'password'=>123,'user_role'=>'customer','hotel_branch'=>'Dhaka']
    ];*/
     
    $users = getAllUser();
      
    /*foreach ($users as $user) {
            echo "<tr>
                    <td>{$user['id']}</td>
                    <td>{$user['username']}</td>
                    <td>{$user['email']}</td>
                    <td>{$user['user_role']}</td>
                    <td>{$user['hotel_branch']}</td>
                    <td><a href='delete.php?id={$user['id']}'>Delete</a></td>
                </tr>";
            }*/
 

?>

<html lang="en">
<head>
    <title>User List</title>
</head>
<body>
        <h2>User List </h2>
        <a href="home.php">Back</a> |
        <a href="../Controller/logout.php">logout</a>

        <table border=1> 
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>User_role</th>
                <th>Hotel_branch</th>
                <th>Action</th>
            </tr>
            <?php 
                    for($i=0; $i< count($users); $i++){
            ?>
            <tr>
                <td><?php echo $users[$i]['id']; ?></td>
                <td><?php echo $users[$i]['username']; ?></td>
                <td><?=$users[$i]['email']?></td>
                <td><?=$users[$i]['user_role']?></td>
                <td><?=$users[$i]['hotel_branch']?></td>
                <td>
                    <a href='edit.php?id=<?=$users[$i]['id']?>'> EDIT </a> |
                    <a href='delete.php?id=<?=$users[$i]['id']?>'> DELETE </a>
                   <!-- <td>
                        <a href="delete.php?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                    </td>-->
 
                </td>
            </tr>

            <?php } ?>
        </table>
</body>
</html>

<?php
    }else{
        header('location: login.html'); 
    }
?>