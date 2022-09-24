<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add products</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="https://kit.fontawesome.com/6d60dbdd6c.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        require_once('includes/nav.php');
        if(isset($_POST['sub'])){
            $title=$_POST['title'];
            $desc=$_POST['desc'];
            $price=$_POST['price'];
            $file=$_FILES['image'];
            if(!empty($title) && !empty($desc) && !empty($price) && strlen($desc)<100){
                $imageFileName = basename($file['name']);
                move_uploaded_file($file['tmp_name'],'uploads/'.$imageFileName);
                require_once 'includes/dbUsers.php';
                $sql=$pdoUsers->prepare('INSERT INTO dbproducts values(?,?,?,?,?)');
                $sql->execute([$_SESSION['seller']['username'],$title,$desc,$imageFileName,$price]);
            }else{
                echo('error');
            }
            
        }
    ?>


    <div class="container">
        <form method="post" enctype="multipart/form-data">
            <label for="image" class="upload"><i class="fas fa-upload"></i>add an image for your product</label> <br>
            <input type="file" name="image" id="image"><br>
            <label>Product Name</label><br>
            <input type="text" name='title' class='input' placeholder='Product Name'><br>
            <label>Product Description</label><br>
            <textarea name="desc" id="" cols="32" rows="4" placeholder="Product Description"></textarea><br>
            <label>Product Price</label><br>
            <input type="number" name="price" class='input' placeholder="0.00"><br>
            <input type="submit" value="submit" name="sub" class="sub">
        </form>
    </div>
</body>
</html>


