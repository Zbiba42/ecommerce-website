<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update user</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php
        include_once('includes/dbusers.php');
        $username=$_POST['username'];
        $sql=$pdoUsers->prepare('SELECT * FROM dbusers WHERE username=?');
        $sql->execute([$username]);
        $user=$sql->fetch(PDO::FETCH_OBJ);
        if(isset($_POST['cancel'])){
            header('location:adminPage.php');
        }
        if(isset($_POST['update'])){
            $username=$_POST['username'];
            $email=$_POST['email'];
            $usertype=$_POST['usertype'];
            $password=$_POST['password'];
            $userr=$_POST['userr'];
            if(!empty($username) && !empty($email) && !empty($usertype) && !empty($password)){
                include_once('includes/dbUsers.php');
                $sql=$pdoUsers->prepare('UPDATE dbusers SET usertype=?,username=?,email=?,password=? WHERE username=?');
                $sql->execute([$usertype,$username,$email,$password,$userr]);
                header('location:adminPage.php');
            }else{
                ?> <h3>Required Rields</h3> <?php
            }
        }

    ?>








<div class="container">
        
    <form method="post" >
        <h3>Update User</h3><br>
        <input type="hidden" name="userr" value='<?=$user->username ?>'>
        <input type="text" name="username" class="input" value='<?= $user->username ?>'><br>
        <input type="email" name="email" class="input" value='<?= $user->email ?>'><br>
        <label>choose the new account type</label><br>
        <?php 
            if($user->usertype=='client'){ ?>

                <input type="radio" name="usertype" value="client" checked>
                <label for="usertype">Client</label><br>
                <input type="radio" name="usertype" value="seller">
                <label for="usertype">Seller</label><br>
                <input type="radio" name="usertype" value="admin">
                <label for="usertype">Admin</label><br>

            <?php }elseif($user->usertype=='seller'){ ?>
                <input type="radio" name="usertype" value="client">
                <label for="usertype">Client</label><br>
                <input type="radio" name="usertype" value="seller" checked>
                <label for="usertype">Seller</label><br>
                <input type="radio" name="usertype" value="admin">
                <label for="usertype">Admin</label><br>
            <?php }elseif($user->usertype=='admin'){ ?>
                <input type="radio" name="usertype" value="client">
                <label for="usertype">Client</label><br>
                <input type="radio" name="usertype" value="seller">
                <label for="usertype">Seller</label><br>
                <input type="radio" name="usertype" value="admin" checked>
                <label for="usertype">Admin</label><br>
            <?php }

        ?>
        <input type="password" name="password" class="input" value='<?= $user->password ?>'><br>
        <input type="submit" value="Update" name='update' class="sub" style="margin:5px 0 0 15px;">
        <input type="submit" value="cancel" name='cancel' class="sub" style="margin:5px 15px 0 0; float:right;">
    </form>
    </div>
</body>
</html>