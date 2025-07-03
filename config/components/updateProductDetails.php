<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // include database connection or any necessary files
    include_once '../config.php';

    // Check if the form is submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateProduct'])) {
        // Validate the form data
        function sanitizeInput($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }
        echo "<script>alert('Processing product update...');</script>";

        // Get the product details from the form
        $productId = sanitizeInput($_POST['product_id']);
        $productName = sanitizeInput($_POST['productname']);
        $newStock = sanitizeInput($_POST['newStock']);
        $newPrice = sanitizeInput($_POST['adjustmentPrice']);
        

        // Validate the new stock and price
        if(!is_numeric($newStock) || !is_numeric($newPrice)) {
            $_SESSION['update_error'] = "Invalid stock or price.";
            header("Location: ../../inventory.php");
            exit();
        }

        // Update the product details in the database
        $updateQuery = "UPDATE products SET stock_quantity = '$newStock', price = '$newPrice' WHERE id = '$productId'";

        if(mysqli_query($conn, $updateQuery)) {
            $_SESSION['success'] = "Product details updated successfully for $productName.";
            header("Location: ../../inventory.php");
            exit();
        } else {
            $_SESSION['update_error'] = "Error updating product details: " . mysqli_error($conn);
            header("Location: ../../inventory.php");
            exit();
        }
    } else {
        $_SESSION['update_error'] = "Invalid request.";
        header("Location: ../../inventory.php");
        exit();
    }
?>