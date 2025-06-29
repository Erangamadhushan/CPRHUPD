<?php
    
    // Check if the session is already started
    if (session_status() == PHP_SESSION_NONE) {
        // Start the session if not already started
        session_start();
    }

    // Include the authentication file

    include 'authentication.php';
    if(!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
        $_SESSION['error'] = "You must be logged in to access this page.";
        header("Location: ../index.php");
        exit();
    }

    // Include the database connection file
    include 'config.php';

    // Check User Role
    if ($_SESSION['role'] == 'admin') {
        // If the user is an admin, include the admin dashboard file
        
    }
?>
    