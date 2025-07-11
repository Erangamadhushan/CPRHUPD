<?php
    // check if the session is already started
    if (session_status() == PHP_SESSION_NONE) {
        // Start the session if not already started
        session_start();
    }

    if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
        $_SESSION['error'] = "You must be logged in to access this page.";
        header("Location: ../index.php");
        exit();
    }
?>