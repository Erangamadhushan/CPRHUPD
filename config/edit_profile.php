<?php
    // check if the session is already started
    if(session_status() == PHP_SESSION_NONE) {
        // Start the session if not already started
        session_start();
    }
    // Include the authentication file
    include 'authentication.php';

    // Include the database connection file
    include 'config.php';

    // Check User Role
    if($_SESSION['role'] == 'admin') {
        echo "alert('Admin role detected');";
        // If the user is an admin, include the admin dashboard file
        $sql = "SELECT * FROM admins WHERE username='" . mysqli_real_escape_string($conn, $_SESSION['username']) . "' AND email='" . mysqli_real_escape_string($conn, $_SESSION['email']) . "'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $username = $user['username'];
            $email = $user['email'];
            $phone = $user['phone'];
        } else {
            $_SESSION['error'] = "User not found.";
            header("Location: ../index.php");
            exit();
        }
    } elseif($_SESSION['role'] == 'manager') {
        // If the user is a manager, include the manager dashboard file
        $sql = "SELECT * FROM manager WHERE username='" . mysqli_real_escape_string($conn, $_SESSION['username']) . "' AND email='" . mysqli_real_escape_string($conn, $_SESSION['email']) . "'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $username = $user['username'];
            $email = $user['email'];
            $phone = $user['phone'];
        } else {
            $_SESSION['error'] = "User not found.";
            header("Location: ../index.php");
            exit();
        }
    } elseif($_SESSION['role'] == 'staff') {
        $sql = "SELECT * FROM staffs WHERE username='" . mysqli_real_escape_string($conn, $_SESSION['username']) . "' AND email='" . mysqli_real_escape_string($conn, $_SESSION['email']) . "'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $username = $user['username'];
            $email = $user['email'];
            $phone = $user['phone'];
        } else {
            $_SESSION['error'] = "User not found.";
            header("Location: ../index.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Invalid role.";
        header("Location: ../index.php");
        exit();
    }
?>