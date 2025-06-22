<?php
    include_once('./db/config.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($connection, $_POST['confirm_password']);

        if($password !== $confirm_password) {
            echo "<script>console.log('Passwords do not match !');</script>";
            exit();
        }

        $md5_password = md5($password);
        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sqlQuery = "INSERT INTO users (name, email, password) VALUES ('$username', '$email', '$md5_password')";
        if(mysqli_query($connection, $sqlQuery)) {
            echo "<script>console.log('User registered successfully');</script>";
            header("Location: login.php");
        } else {
            echo "<script>console.log('Error registering user: " . mysqli_error($connection) . "');</script>";
        }
    }
?>