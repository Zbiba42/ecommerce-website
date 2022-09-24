<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update product</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="https://kit.fontawesome.com/6d60dbdd6c.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        require_once('includes/nav.php');
        
        if(isset($_POST['edit'])){
            require_once('includes/dbUsers.php');
            $editedprod=$_POST['prodname'];
            $sql=$pdoUsers->prepare('SELECT * FROM dbproducts WHERE productname=?');
            $sql->execute([$editedprod]);
            $editing=$sql->fetch(PDO::FETCH_OBJ);
            
            }
            if(isset($_POST['cancel'])){
                header('location:sellerPage.php');
            }
            if(isset($_POST['editt'])){
                $title=$_POST['title'];
                $desc=$_POST['desc'];
                $price=$_POST['price'];
                $file=$_FILES['image'];
                $userr=$_POST['user'];
                if(!empty($file) && !empty($title) && !empty($desc) && !empty($price) && strlen($desc)<100){
                    $imageFileName = basename($file['name']);
                    move_uploaded_file($file['tmp_name'],'uploads/'.$imageFileName);
                    require_once 'includes/dbUsers.php';
                    $sql=$pdoUsers->prepare('UPDATE dbproducts SET owner=?,productname=?,productDesc=?,productPic=?,productprice=? WHERE productname=?');
                    $sql->execute([$_SESSION['seller']['username'],$title,$desc,$imageFileName,$price,$userr]);
                    header('location:sellerPage.php');
                }else{
                    echo('error');
            }
        }

    ?>


    <div class="container">
        
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="user" value="<?= $editing->productname ?>">
            <label for="image" class="upload"><i class="fas fa-upload"></i>Add a New image For your product</label> <br>
            <input type="file" name="image" id="image" value='<?=$editing->productPic ?>'><br>

            <label>New Product Name</label><br>
            <input type="text" name='title' class='input' value="<?= $editing->productname?>" ><br>

            <label>New Product Description</label><br>
            <textarea name="desc" id="" cols="32" rows="4" placeholder='<?= $editing->productDesc?>'></textarea><br>

            <label>New Product Price</label><br>
            <input type="number" name="price" class='input' value='<?= $editing->productprice?>'><br>

            <input type="submit" value="submit" name="editt" class="sub" style="margin:5px 0 0 15px;">
            <input type="submit" value="cancel"name='cancel' class='sub' style="margin:5px 15px 0 0; float:right;">
        </form>
    </div>
</body>
</html>