<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php 
    require_once('includes/nav.php');

        
        if(!isset($_SESSION['admin'])){
            session_destroy();
            header('location:logIn.php');
        }
        include_once('includes/dbUsers.php');
        $sql=$pdoUsers->query('SELECT * FROM dbusers');
        $users=$sql->fetchAll(PDO::FETCH_OBJ);
    ?>

    <div class="containerr">
        <table>
            <tr>
                <th>user Type</th>
                <th>username</th>
                <th>email</th>
                <th>password</th>
                <th>operations</th>
            </tr>
            <?php 
                foreach($users as $user){ ?> 
                    <tr>
                        <td><?= $user->usertype ?></td>
                        <td><?= $user->username ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->password ?></td>
                        <td><form action="deleteusers.php" method="POST">
                          <input type="hidden" name="username" value="<?= $user->username ?>">
                          <input type="submit" value="delete" name="delete" class='but' style="margin-left:19%;margin-right:0.5%;">
                        </form>
                        <form action="editusers.php" method="post">
                        <input type="hidden" name="username" value="<?= $user->username ?>">
                        <input type="submit" value="edit" name='edit' class='but' style="margin-right:19% ;margin-left:0.5%;">
                        </form>
                      </td>
                    </tr>
                <?php }
            ?>
        </table>

    </div>
</body>
</html>