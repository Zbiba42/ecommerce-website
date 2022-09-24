<?php 
if(isset($_POST['deletee'])){
    include_once 'includes/dbusers.php';
    $deluser=$_POST['prodname'];
    $sql =$pdoUsers->prepare('DELETE FROM dbproducts WHERE productname = ?');
    $sql->execute([$deluser]);
    session_start();
    if(isset($_SESSION['seller'])){
        header('Location: sellerPage.php');
    }elseif($_SESSION['admin']){
        header('Location: adminproducts.php');
    };
}

?>