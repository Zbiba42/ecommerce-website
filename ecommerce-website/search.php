<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search resuls</title>
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
    if(isset($_POST['sirch'])){
        $search=$_POST['search'];
        $_SESSION['search']=$search;
        $sql=$pdoUsers->prepare('SELECT * FROM dbproducts where productname=?');
        $sql->execute([$search]);
        $products=$sql->fetchAll(PDO::FETCH_OBJ);
    }elseif(isset($_SESSION['search'])){
        $sql=$pdoUsers->prepare('SELECT * FROM dbproducts where productname=?');
        $sql->execute([$_SESSION['search']]);
        $products=$sql->fetchAll(PDO::FETCH_OBJ);
    }
    if(isset($_POST['cart'])){
        $prodadd=$_POST['prodname'];
        $sql=$pdoUsers->prepare('SELECT * FROM dbcart where productname=?');
        $sql->execute([$prodadd]);
        $already=$sql->fetchAll(PDO::FETCH_ASSOC);
        
        
        if(count($already)>0){
            ?> <h2>Already added</h2><?php
        }else{
            $sql=$pdoUsers->prepare('SELECT * FROM dbproducts where productname=?');
            $sql->execute([$prodadd]);
            $added=$sql->fetch(PDO::FETCH_ASSOC);
            $prodname=$added['productname'];
            $proddesc=$added['productDesc'];
            $prodpic=$added['productPic'];
            $prodprice=$added['productprice'];
            $sql=$pdoUsers->prepare('INSERT INTO dbcart values(?,?,?,?,?)');
            $sql->execute([$_SESSION['client']['username'],$prodname,$proddesc,$prodpic,$prodprice]);
        }
    }
    ?>
    <div class="contain">
        <h3 class='text'>Search results</h3>
        <?php 
                if(count($products)>0){
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
                                        <form method="post">
                                            <input type="hidden" name="prodname" value='<?= $product->productname?>'>
                                            <input type="submit" value="Add to cart" name='cart'  class='sub cli'>
                                        </form>
                                </div>
                                <h2 class="price"><?=$product->productprice ?>$</h2>
                            </div>
                        </div>                    
                        
                        
                        <?php
                    }
                }else{
                    ?> <h2 style="color:orange; margin-left:70px;">No products match your search !</h2><?php
                }
            
            ?>

       
    </div>
</body>
</html>

