<?php
    if($_SESSION['role'] == 'admins') {
        
        //If the user is an admin, include the admin dashboard file
        $sql = "SELECT * FROM admins WHERE username='" . $_SESSION['username'] . "'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $username = $user['username'];
            $userid = $user['id'];
            $_SESSION['userid'] = $userid;
            $email = $user['email'];
            $phone = $user['phone'];
            
        } else {
            $_SESSION['error'] = "User not found.";
            header("Location: ../index.php");
            exit();
        }
    }
    elseif($_SESSION['role'] == 'customers') {
        // If the user is a customer, include the customer dashboard file
        $sql = "SELECT * FROM customers WHERE username='" . mysqli_real_escape_string($conn, $_SESSION['username']) . "'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $username = $user['username'];
            $userid = $user['id'];
            $_SESSION['userid'] = $userid;
            $email = $user['email'];
            $phone = $user['phone'];
        } else {
            $_SESSION['error'] = "User not found.";
            header("Location: ../index.php");
            exit();
        }
    }
    elseif($_SESSION['role'] == 'manager') {
        // If the user is a manager, include the manager dashboard file
        $sql = "SELECT * FROM manager WHERE username='" . mysqli_real_escape_string($conn, $_SESSION['username']) . "'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $username = $user['username'];
            $userid = $user['id'];
            $_SESSION['userid'] = $userid;
            $email = $user['email'];
            $phone = $user['phone'];
        } else {
            $_SESSION['error'] = "User not found.";
            header("Location: ../index.php");
            exit();
        }
    } elseif($_SESSION['role'] == 'staffs') {
        // If the user is a staff member, include the staff dashboard file
        $sql = "SELECT * FROM staffs WHERE username='" . mysqli_real_escape_string($conn, $_SESSION['username']) . "'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $username = $user['username'];
            $userid = $user['id'];
            $_SESSION['userid'] = $userid;
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