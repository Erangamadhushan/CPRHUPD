<?php
    session_start();
    include 'config.php';
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        function sanitizeInput($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        $username = sanitizeInput($_POST['username']);
        $password = sanitizeInput($_POST['password']);
        $role = sanitizeInput($_POST['role']);

        //$username = mysqli_real_escape_string($conn, $username);

        if(!empty($username) && !empty($password) && !empty($role)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // Check if the username exists in the database
            if($role == 'admin') {
                $check_sql = "SELECT * FROM admins WHERE username='$username'";
                // Check if the username already exists
                if(mysqli_num_rows(mysqli_query($conn, $check_sql)) > 0) {
                    while($row = mysqli_fetch_assoc(mysqli_query($conn, $check_sql))) {
                        if(password_verify($hashed_password, $row['password'])) {
                            $_SESSION['username'] = $row['username'];
                            $_SESSION['role'] = 'admin';
                            header("Location: ../dashboard.php");
                            exit();
                        } else {
                            
                        }
                    }
                    echo "<script>alert('Incorrect password!');</script>";
                    header("Location: ../index.php");
                    exit();
                }
            } elseif($role == 'manager') {
                $check_sql = "SELECT * FROM manager WHERE username='$username'";
            } elseif($role == 'staff') {
                $check_sql = "SELECT * FROM staffs WHERE username='$username'";
            } elseif($role == 'customer') {
                $check_sql = "SELECT * FROM customers WHERE username='$username'";
            } else {
                echo "<script>alert('Invalid role selected!');</script>";
                header("Location: ../index.php");
                exit();
            }


            // Check the role and query the corresponding table
            if($role == 'admin') {
                $sql = "SELECT * FROM admins WHERE username='$username'";
            } elseif($role == 'manager') {
                $sql = "SELECT * FROM managers WHERE username='$username'";
            } elseif($role == 'staff') {
                $sql = "SELECT * FROM staff WHERE username='$username'";
            } elseif($role == 'customer') {
                $sql = "SELECT * FROM customers WHERE username='$username'";
            } else {
                echo "<script>alert('Invalid role selected!');</script>";
                header("Location: ../index.php");
                exit();
            }

            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                if(password_verify($password, $row['password'])) {
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['role'] = $role;
                    header("Location: ../market.php");
                    exit();
                } else {
                    echo "<script>alert('Incorrect password!');</script>";
                    header("Location: ../index.php");
                    exit();
                }
            } else {
                echo "<script>alert('Username does not exist!');</script>";
                header("Location: ../index.php");
                exit();
            }
        } else {
            echo "<script>alert('Please fill in all fields!');</script>";
            header("Location: ../index.php");
            exit();
        }

        
    }
?>