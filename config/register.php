<?php
    session_start();
    include 'config.php';
    
?>
<?php 
    // Register From Validation
    echo "<script>alert('Welcome to FreshMart Management System');</script>";
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        function sanitizeInput($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        $username = sanitizeInput($_POST['username']);
        $password = sanitizeInput($_POST['password']);
        $email = sanitizeInput($_POST['email']);
        $confirm_password = sanitizeInput($_POST['confirm_password']);
        $phone = sanitizeInput($_POST['phone']);
        $role = sanitizeInput($_POST['role']);

        echo "<script>alert('Username: $username, Password: $password, Email: $email, Confirm Password: $confirm_password, Phone: $phone, Role: $role');</script>";
        if(!empty($username) && !empty($password) && !empty($email) && !empty($confirm_password) && !empty($phone) && !empty($role)) {
            if(!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username) === 0) {
                echo "<script>alert('Username must be alphanumeric and between 3 to 20 characters long!');</script>";
                $_SESSION['error'] = "Username must be alphanumeric and between 3 to 20 characters long!";
                header("Location: ../register.php");
                exit();
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<script>alert('Invalid email format!');</script>";
                $_SESSION['error'] = "Invalid email format!";
                header("Location: ../register.php");
                exit();
            }
            if($password === $confirm_password) {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                
                if($role == 'admin') {
                    // Check if the username already exists
                    $check_sql = "SELECT * FROM admins WHERE username='$username'";
                    $result = mysqli_query($conn, $check_sql);
                    if(mysqli_num_rows($result) > 0) {
                        echo "<script>alert('Username already exists!');</script>";
                        header("Location: ../register.php");
                        exit();
                    }

                    // Check if the email already exists
                    $check_email_sql = "SELECT * FROM admins WHERE email='$email'";
                    $email_result = mysqli_query($conn, $check_email_sql);
                    if(mysqli_num_rows($email_result) > 0) {
                        echo "<script>alert('Email already exists!');</script>";
                        header("Location: ../register.php");
                        exit();
                    }

                    // Insert into database
                    $sql = "INSERT INTO admins (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$hashed_password')";
                    if(mysqli_query($conn, $sql)) {
                        echo "<script>alert('Registration successful!');</script>";
                        echo "<script>console.log('Registration successful!');</script>";
                        $_SESSION['username'] = $username;
                        $_SESSION['role'] = $role;
                        header("Location: ../index.php");
                        exit();
                    } else {
                        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
                        header("Location: ../register.php");
                        exit();
                    }
                }

                if($role == 'manager') {
                    // Check if the username already exists
                    $check_sql = "SELECT * FROM manager WHERE username='$username'";
                    $result = mysqli_query($conn, $check_sql);
                    if(mysqli_num_rows($result) > 0) {
                        echo "<script>alert('Username already exists!');</script>";
                        header("Location: ../register.php");
                        exit();
                    }

                    // Check if the email already exists
                    $check_email_sql = "SELECT * FROM manager WHERE email='$email'";
                    $email_result = mysqli_query($conn, $check_email_sql);
                    if(mysqli_num_rows($email_result) > 0) {
                        echo "<script>alert('Email already exists!');</script>";
                        header("Location: ../register.php");
                        exit();
                    }

                    // Insert into database
                    $sql = "INSERT INTO manager (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$hashed_password')";
                    if(mysqli_query($conn, $sql)) {
                        echo "<script>console.log('Registration successful!');</script>";
                        echo "<script>alert('Registration successful!');</script>";
                        $_SESSION['username'] = $username;
                        $_SESSION['role'] = $role;
                        header("Location: ../index.php");
                        exit();
                    } else {
                        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
                        header("Location: ../register.php");
                        exit();
                    }
                }

                if($role == 'staff') {
                    // Check if the username already exists
                    $check_sql = "SELECT * FROM staffs WHERE username='$username'";
                    $result = mysqli_query($conn, $check_sql);
                    if(mysqli_num_rows($result) > 0) {
                        echo "<script>alert('Username already exists!');</script>";
                        $_SESSION['error'] = "Username already exists!";
                        header("Location: ../register.php");
                        exit();
                    }

                    // Check if the email already exists
                    $check_email_sql = "SELECT * FROM staffs WHERE email='$email'";
                    $email_result = mysqli_query($conn, $check_email_sql);
                    if(mysqli_num_rows($email_result) > 0) {
                        echo "<script>alert('Email already exists!');</script>";
                        $_SESSION['error'] = "Email already exists!";
                        header("Location: ../register.php");
                        exit();
                    }

                    // Insert into database
                    $sql = "INSERT INTO staffs (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$hashed_password')";
                    if(mysqli_query($conn, $sql)) {
                        echo "<script>console.log('Registration successful!');</script>";
                        $_SESSION['username'] = $username;
                        $_SESSION['role'] = $role;
                        header("Location: ../index.php");
                        exit();
                    } else {
                        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
                        header("Location: ../register.php");
                        exit();
                    }
                }

                if($role == 'customer') {
                    // Check if the username already exists
                    $check_sql = "SELECT * FROM customers WHERE username='$username'";
                    $result = mysqli_query($conn, $check_sql);
                    if(mysqli_num_rows($result) > 0) {
                        echo "<script>alert('Username already exists!');</script>";
                        header("Location: ../register.php");
                        exit();
                    }

                    // Check if the email already exists
                    $check_email_sql = "SELECT * FROM customers WHERE email='$email'";
                    $email_result = mysqli_query($conn, $check_email_sql);
                    if(mysqli_num_rows($email_result) > 0) {
                        echo "<script>alert('Email already exists!');</script>";
                        header("Location: ../register.php");
                        exit();
                    }

                    // Insert into database
                    $sql = "INSERT INTO customers (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$hashed_password')";
                    if(mysqli_query($conn, $sql)) {

                        echo "<script>console.log('Registration successful!');</script>";
                        $_SESSION['username'] = $username;
                        $_SESSION['role'] = $role;
                        header("Location: index.php");
                        exit();
                    } else {
                        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
                        header("Location: ../register.php");
                        exit();
                    }
                }

            } else {
                echo "<script>alert('Passwords do not match!');</script>";
                $_SESSION['error'] = "Passwords do not match!";
                header("Location: ../register.php");
                exit();
            }
        } else {
            echo "<script>alert('All fields are required!');</script>";
            $_SESSION['error'] = "All fields are required!";
            header("Location: ../register.php");
            exit();
        }
    }
?>