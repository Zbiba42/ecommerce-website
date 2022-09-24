<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php
    require_once('includes/nav.php');
    if(isset($_POST['submit'])){
        $username=$_POST['username'];
        $email=$_POST['email'];
        
        $password=$_POST['password'];
        if(!empty($username) && !empty($email) && !empty($password)){
            $usertype=$_POST['usertype'];
            include_once('includes/dbUsers.php');




            $sql=$pdoUsers->query("INSERT INTO dbusers values('$usertype','$username','$email','$password')");




            $sql->execute([$usertype,$username,$email,$password]);
            header('location:logIn.php');
        }else{
            ?> <h3 style="color:orange; margin-left:70px;">Required Rields</h3> <?php
        }
    }
    
    
    ?> 






    <div class="container">
        
    <form method="post" >
        <h3>Sign Up</h3><br>
        <input type="text" name="username" placeholder='Username' class="input"><br>
        <input type="email" name="email" placeholder='Email' class="input"><br>
        <label>choose your account type</label><br>
        <input type="radio" name="usertype" value="client">
        <label for="usertype">Client</label><br>
        <input type="radio" name="usertype" value="seller">
        <label for="usertype">Seller</label><br>
        <input type="radio" name="usertype" value="admin">
        <label for="usertype">Admin</label><br>
        <input type="password" name="password" placeholder='Password' class="input"><br>
        <input type="submit" value="sign up" name='submit' class="sub">
    </form>
    </div>
</bodyd>
</html>