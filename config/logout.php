<?php
    // Check if the session is already started
    if (session_status() == PHP_SESSION_NONE) {
        // Start the session if not already started
        session_start();
    }
    // Include the authentication file

    include 'authentication.php';
    
    // clear all session variables
    session_destroy();
    // Redirect to the login page
    header("Location: ../index.php");
?>