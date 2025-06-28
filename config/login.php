<?php
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        function sanitizeInput($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        $username = sanitizeInput($_POST['username']);
        $password = sanitizeInput($_POST['password']);
        $role = sanitizeInput($_POST['role']);

        // Here you would typically check the credentials against a database
        // For demonstration, we'll assume the credentials are valid
        if($username == 'admin' && $password == 'password' && $role == 'admin') {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            if($role == 'admin' || $role == 'cashier' || $role == 'manager') {
                header("Location: ../dashboard.php");
            }else {
                header("Location: ../market.php");
            }
        } else {
            echo "<script>alert('Invalid credentials');</script>";
            header("Location: ../index.php");
        }
    }
?>