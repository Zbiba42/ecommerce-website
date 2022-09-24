<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="https://kit.fontawesome.com/6d60dbdd6c.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
    require_once('includes/nav.php');
    require_once 'includes/dbUsers.php';
     if(!isset($_SESSION['seller'])){
        session_destroy();
        header('location:logIn.php');
     }
    $user=$_SESSION['seller']['username'];
    $sql=$pdoUsers->prepare('SELECT * FROM dbproducts where owner=?');
    $sql->execute([$user]);  
    $products=$sql->fetchAll(PDO::FETCH_OBJ);
     
    
    ?>
    <div class="contain">
        <h3 class='text'>Products added</h3>
            <?php 
                foreach($products as $product){
                    ?>
                    <div class="box">
                        <?php 
                            if($product->productPic!=''){?>
                                <div class="img" style='background:url(uploads/<?= $product->productPic?>); background-size:100% 100%;'>
                                    <form action="editproduct.php" method="post">
                                        <input type="hidden" name="prodname" value='<?= $product->productname?>'>
                                        <label for="<?= $product->productname . 'edit'?>" class="label"><i class="fas fa-pen"></i></label>
                                        <input type="submit" value="edit" name='edit' id="<?= $product->productname . 'edit'?>" class='subb'>
                                    </form>
                                    <form action="deleteproduct.php" method="post">
                                        <input type="hidden" name="prodname" value='<?= $product->productname?>'>
                                        <label for="<?= $product->productname . 'delete'?>" class="label" style='float:left;'><i class="fas fa-trash"></i></label>
                                        <input type="submit" value="delete" name='deletee' id="<?= $product->productname . 'delete'?>" class='subb'>
                                    </form>
                                </div> <?php
                            }else{ ?>
                                <div class="img" style='background:url(style/No_Image_Available.jpg);background-size:100% 100%;'>
                                <form action="editproduct.php" method="post">
                                        <input type="hidden" name="prodname" value='<?= $product->productname?>'>
                                        <label for="<?= $product->productname . 'edit'?>" class="label"><i class="fas fa-pen"></i></label>
                                        <input type="submit" value="edit" name='edit' id="<?= $product->productname . 'edit'?>" class='subb'>
                                    </form>
                                    <form action="deleteproduct.php" method="post">
                                        <input type="hidden" name="prodname" value='<?= $product->productname?>'>
                                        <label for="<?= $product->productname . 'delete'?>" class="label" style='float:left;'><i class="fas fa-trash"></i></label>
                                        <input type="submit" value="delete" name='deletee' id="<?= $product->productname . 'delete'?>" class='subb'>
                                    </form>
                                </div> <?php
                            }
                        ?>
                        
                        <div class="content">
                            <h2 class="title"><?=$product->productname ?></h2>
                            <p><?=$product->productDesc ?></p>
                            
                            <h2 class="price"><?=$product->productprice ?>$</h2>
                        </div>
                    </div>                    
                    
                    
                    <?php
                }
            
            ?>

       
    </div>
</body>
</html>

