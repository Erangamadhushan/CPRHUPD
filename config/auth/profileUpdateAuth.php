<?php
    // Check if the session is already started
    if (session_status() == PHP_SESSION_NONE) {
        // Start the session if not already started
        session_start();
    }
    
    // Check User Role
    include './auth/profileAuth.php';
?>