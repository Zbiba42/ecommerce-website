<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php 
    require_once('includes/nav.php');

        if(isset($_POST['log'])){
            $email=$_POST['email'];
            $password=$_POST['password'];
            if(!empty($email) && !empty($password)){
                include_once('includes/dbUsers.php');
                $sql=$pdoUsers->prepare('SELECT * FROM dbusers where email=? and password=?');
                $sql->execute([$email,$password]);
                $count = $sql->rowCount();
                if($count>=1){
                    
                    $user=$sql->fetch(PDO::FETCH_ASSOC);
                    if($user['usertype']=='client'){
                        $_SESSION['client']=$user;
                        header('location:clientPage.php');
                    }elseif($user['usertype']=='seller'){
                        $_SESSION['seller']=$user;
                        header('location:sellerPage.php');
                    }elseif($user['usertype']=='admin'){
                        $_SESSION['admin']=$user;
                        header('location:adminPage.php');
                    }
                    
                    

                    
                
            }else{
                ?><h2 style="color:orange; margin-left:70px;">undefined user</h2><?php
            }
        }else{
            ?> <h2 style="color:orange; margin-left:70px;">Required Fields</h2><?php
        }
        }
    
    
    ?>

    <div class="container">
        
        <form method="post">
             <h3>Log In</h3><br>
            <input type="email" name="email" placeholder="Email" class="input"><br>
            <input type="password" name="password" placeholder="Password" class="input"><br>
            <input type="submit" value="Log In" name='log' class='sub'>
        </form>
    </div>
</div>
</body>
</html>