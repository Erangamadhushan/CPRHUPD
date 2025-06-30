<?php
    // Check if the session is already started
    if (session_status() == PHP_SESSION_NONE) {
        // Start the session if not already started
        session_start();
    }

    if($_SESSION['role'] === 'admin') {
        $currentUserRole = "admins";
    }
    elseif($_SESSION['role'] === 'customer') {
        $currentUserRole = "customers";
    }
    elseif($_SESSION['role'] === 'manager') {
        $currentUserRole = "manager";
    }
    elseif($_SESSION['role'] === 'staff') {
        $currentUserRole = "staffs";
    }
    else {
        $_SESSION['error'] = "You must be logged in to access this page.";
        header("Location: ../index.php");
        exit();
    }

?>