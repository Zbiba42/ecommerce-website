<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="https://kit.fontawesome.com/6d60dbdd6c.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
    require_once('includes/nav.php');
    require_once 'includes/dbUsers.php';
     if(!isset($_SESSION['client'])){
        session_destroy();
        header('location:logIn.php');
     }
     if(isset($_SESSION['search'])){
        unset($_SESSION['search']);
     }
    $sql=$pdoUsers->query('SELECT * FROM dbcart');
    $products=$sql->fetchAll(PDO::FETCH_OBJ);
     
    
    ?>
    <div class="contain">
        <h3 class='text'>Products Available in your cart</h3>
            <?php 
                foreach($products as $product){
                    ?>
                    <div class="box">
                        <?php 
                            if($product->productPic!=''){?>
                                <div class="img" style='background:url(uploads/<?= $product->productPic?>); background-size:100% 100%;'>
                                </div> <?php
                            }else{ ?>
                                <div class="img" style='background:url(style/No_Image_Available.jpg);background-size:100% 100%;'>
                                </div> <?php
                            }
                        ?>
                        
                        <div class="content">
                            <h2 class="title"><?=$product->productname ?></h2>
                            <p><?=$product->productDesc ?></p>
                            <div class="links">
                                    <form action="buy.php" method="post">
                                        <input type="submit" value="Buy now" name='buy' class='sub cli'>
                                    </form>
                                    <form action="deletecart.php" method="post">
                                        <input type="hidden" name="prodname" value='<?= $product->productname?>'>
                                        <input type="submit" value="Remove" name='cart'  class='sub cli'>
                                    </form>
                                 
                            </div>
                            <h2 class="price"><?=$product->productprice ?>$</h2>
                        </div>
                    </div>                    
                    
                    
                    <?php
                }
            
            ?>

       
    </div>
</body>
</html>

