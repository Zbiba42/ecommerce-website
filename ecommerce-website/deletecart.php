<?php 
if(isset($_POST['cart'])){
    include_once 'includes/dbusers.php';
    $delprod=$_POST['prodname'];
    $sql =$pdoUsers->prepare('DELETE FROM dbcart WHERE productname = ?');
    $sql->execute([$delprod]);
    session_start();
    header('Location: cart.php');
}

?>