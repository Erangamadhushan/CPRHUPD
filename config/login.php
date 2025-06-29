<?php
    session_start();
    include 'config.php';
    echo "<script>console.log('Login script started');</script>";
    
    if (isset($_POST['login'])) {
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

            if($role == 'admin') {
               $hashed_password = password_hash($password, PASSWORD_DEFAULT);
               $sql = "SELECT * FROM admins WHERE username='$username'";
               $result = mysqli_query($conn, $sql);
            
               while($row = mysqli_fetch_assoc($result)) {
                    if(password_verify($password, $row['password'])) {
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['role'] = 'admin';
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

            if($role == 'staff') {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "SELECT * FROM staffs WHERE username='$username'";
                $result = mysqli_query($conn, $sql);
            
                while($row = mysqli_fetch_assoc($result)) {
                    if(password_verify($password, $row['password'])) {
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['role'] = 'staff';
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
            if($role == 'customer') {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "SELECT * FROM customers WHERE username='$username'";
                $result = mysqli_query($conn, $sql);
            
                while($row = mysqli_fetch_assoc($result)) {
                    if(password_verify($password, $row['password'])) {
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['role'] = 'customer';
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