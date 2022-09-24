<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css">
    
</head>
<body>
    <nav>
        <?php 
            
        session_start();
            if(isset($_SESSION['client'])){
                ?> <a href="clientPage.php">Home</a>
                   <a href="cart.php">Cart</a>
                   <a href="logOut.php">Log out</a>
                   
                   <?php
                        if($_SERVER["PHP_SELF"]=='/projectPHP/clientPage.php'){
                            ?>
                                <form action="search.php" method="post">
                                    <input type="text" class="search" name='search' placeholder="Search Products...">
                                    <input type="submit" value="search" name="sirch" id="search" class="subb">
                                    <label for="search"><i class="fas fa-search"></i></label>
                                </form>
                            <?php
                        }
                   
            }elseif(isset($_SESSION['seller'])){
                ?> 
                   <a href="sellerPage.php">Home</a>
                   <a href="addproducts.php">Add products</a>
                   <a href="logOut.php">Log out</a><?php

            }elseif(isset($_SESSION['admin'])){
                ?> 
                   <a href="adminPage.php">Users</a>
                   <a href="adminproducts.php">products</a>
                   <a href="logOut.php">Log out</a><?php

            }else{
                ?> <a href="signUp.php">Sign Up</a>
                   <a href="logIn.php">Log In</a><?php
            }
        
        ?>
    </nav>
</body>
</html>