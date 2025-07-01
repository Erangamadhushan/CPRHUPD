<?php
    // If session is not started, start it
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include 'config.php';
    echo "<script>console.log('Login script started');</script>";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        echo "<script>console.log('Username: $username, Role: $role');</script>";

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            function sanitize_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $username = sanitize_input($username);
            $password = sanitize_input($password);
            $role = sanitize_input($role);
            echo "<script>console.log('Sanitized Username: $username, Role: $role');</script>";

            if($role == 'admins') {
               $hashed_password = password_hash($password, PASSWORD_DEFAULT);
               $sql = "SELECT * FROM admins WHERE username='$username'";
               $result = mysqli_query($conn, $sql);

                if(!$result) {
                    echo "<script>alert('Error executing query: " . mysqli_error($conn) . "');</script>";
                    header("Location: ../index.php");
                    exit();
                }
            
               while($row = mysqli_fetch_assoc($result)) {
                    if(password_verify($password, $row['password'])) {
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['role'] = 'admins';
                        echo "<script>alert('Login successful!');</script>";
                        header("Location: ../dashboard.php");
                        exit();
                    } else {
                        echo "<script>alert('Invalid username or password!');</script>";
                        $_SESSION['error'] = "Invalid username or password!";
                        header("Location: ../index.php");
                        exit();
                    }
                }
            }
            if($role == 'manager') {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "SELECT * FROM manager WHERE username='$username'";
                $result = mysqli_query($conn, $sql);

                if(!$result) {
                    echo "<script>alert('Error executing query: " . mysqli_error($conn) . "');</script>";
                    header("Location: ../index.php");
                    exit();
                }
            
                while($row = mysqli_fetch_assoc($result)) {
                    if(password_verify($password, $row['password'])) {
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['role'] = 'manager';
                        echo "<script>alert('Login successful!');</script>";
                        header("Location: ../dashboard.php");
                        exit();
                    } else {
                        echo "<script>alert('Invalid username or password!');</script>";
                        $_SESSION['error'] = "Invalid username or password!";
                        header("Location: ../index.php");
                        exit();
                    }
                }
            }

            if($role == 'staffs') {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "SELECT * FROM staffs WHERE username='$username'";
                $result = mysqli_query($conn, $sql);

                if(!$result) {
                    echo "<script>alert('Error executing query: " . mysqli_error($conn) . "');</script>";
                    header("Location: ../index.php");
                    exit();
                }
            
                while($row = mysqli_fetch_assoc($result)) {
                    if(password_verify($password, $row['password'])) {
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['role'] = 'staffs';
                        echo "<script>alert('Login successful!');</script>";
                        header("Location: ../dashboard.php");
                        exit();
                    } else {
                        echo "<script>alert('Invalid username or password!');</script>";
                        $_SESSION['error'] = "Invalid username or password!";
                        header("Location: ../index.php");
                        exit();
                    }
                }
            }
            if($role == 'customers') {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "SELECT * FROM customers WHERE username='$username'";
                $result = mysqli_query($conn, $sql);

                if(!$result) {
                    echo "<script>alert('Error executing query: " . mysqli_error($conn) . "');</script>";
                    header("Location: ../index.php");
                    exit();
                }
            
                while($row = mysqli_fetch_assoc($result)) {
                    if(password_verify($password, $row['password'])) {
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['role'] = 'customers';
                        echo "<script>alert('Login successful!');</script>";
                        header("Location: ../dashboard.php");
                        exit();
                    } else {
                        echo "<script>alert('Invalid username or password!');</script>";
                        $_SESSION['error'] = "Invalid username or password!";
                        header("Location: ../index.php");
                        exit();
                    }
                }
            }

            
        }

        
        
    }
?>