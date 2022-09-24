<?php 
if(isset($_POST['delete'])){
    include_once 'includes/dbusers.php';
    $deluser=$_POST['username'];
    $sqlState =$pdoUsers->prepare('DELETE FROM dbusers WHERE username=?');
    $sqlState->execute([$deluser]);
    header('Location: adminPage.php');
}

?>