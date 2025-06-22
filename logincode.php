<?php include('db/config.php'); ?>
<?php
    if($_SERVER['REQUREST_METHOD'] == 'POST') {
        $name = mysqli_real_escape_string($connection, $_POST['username']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
    }
?>