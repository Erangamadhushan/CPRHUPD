<?php
    session_start();
    include 'config.php';
?>
<?php 
    // Register From Validation
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
        function sanitizeInput($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        $username = sanitizeInput($_POST['username']);
        $password = sanitizeInput($_POST['password']);
        $email = sanitizeInput($_POST['email']);
        $confirm_password = sanitizeInput($_POST['confirm_password']);
        $phone = sanitizeInput($_POST['phone']);
        $role = sanitizeInput($_POST['role']);

        
        if(!empty($username) && !empty($password) && !empty($email) && !empty($confirm_password) && !empty($phone) && !empty($role)) {
            if(preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username) === 0) {
                echo "<script>alert('Username must be alphanumeric and between 3 to 20 characters long!');</script>";
                header("Location: ../register.php");
                exit();
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<script>alert('Invalid email format!');</script>";
                header("Location: ../register.php");
                exit();
            }
            if($password === $confirm_password) {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Determine the system role based on the selected role
                if($role == 'Admin') {
                    $system_role = 'admins';
                } elseif($role == 'Manager') {
                    $system_role = 'manager';
                } elseif($role == 'Staff') {
                    $system_role = 'staff';
                } elseif($role == 'Customer') {
                    $system_role = 'customers';
                }else {
                    echo "<script>alert('Invalid role selected!');</script>";
                    header("Location: ../register.php");
                    exit();
                }
                
                if($role == 'Admin') {

                }

                if($role == 'Manager') {
                    // Check if the username already exists
                    $check_sql = "SELECT * FROM manager WHERE username='$username'";
                    $result = mysqli_query($conn, $check_sql);
                    if(mysqli_num_rows($result) > 0) {
                        echo "<script>alert('Username already exists!');</script>";
                        header("Location: ../register.php");
                        exit();
                    }

                    // Check if the email already exists
                    $check_email_sql = "SELECT * FROM users WHERE email='$email'";
                    $email_result = mysqli_query($conn, $check_email_sql);
                    if(mysqli_num_rows($email_result) > 0) {
                        echo "<script>alert('Email already exists!');</script>";
                        header("Location: ../register.php");
                        exit();
                    }

                    // Insert into database
                    $sql = "INSERT INTO users (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$hashed_password')";
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

                if($role == 'Staff') {
                    // Check if the username already exists
                    $check_sql = "SELECT * FROM staff WHERE username='$username'";
                    $result = mysqli_query($conn, $check_sql);
                    if(mysqli_num_rows($result) > 0) {
                        echo "<script>alert('Username already exists!');</script>";
                        header("Location: ../register.php");
                        exit();
                    }

                    // Check if the email already exists
                    $check_email_sql = "SELECT * FROM users WHERE email='$email'";
                    $email_result = mysqli_query($conn, $check_email_sql);
                    if(mysqli_num_rows($email_result) > 0) {
                        echo "<script>alert('Email already exists!');</script>";
                        header("Location: ../register.php");
                        exit();
                    }

                    // Insert into database
                    $sql = "INSERT INTO users (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$hashed_password')";
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

                if($role == 'Customer') {
                    // Check if the username already exists
                    $check_sql = "SELECT * FROM customers WHERE username='$username'";
                    $result = mysqli_query($conn, $check_sql);
                    if(mysqli_num_rows($result) > 0) {
                        echo "<script>alert('Username already exists!');</script>";
                        header("Location: ../register.php");
                        exit();
                    }

                    // Check if the email already exists
                    $check_email_sql = "SELECT * FROM users WHERE email='$email'";
                    $email_result = mysqli_query($conn, $check_email_sql);
                    if(mysqli_num_rows($email_result) > 0) {
                        echo "<script>alert('Email already exists!');</script>";
                        header("Location: ../register.php");
                        exit();
                    }

                    // Insert into database
                    $sql = "INSERT INTO users (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$hashed_password')";
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
            }
        } else {
            echo "<script>alert('All fields are required!');</script>";
        }
    }
?>