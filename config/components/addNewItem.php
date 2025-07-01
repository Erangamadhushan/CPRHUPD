<?php
// config/components/addNewItem.php
// This script handles the addition of new products to the inventory
    // Start the session if not already started
    if(session_status() == PHP_SESSION_NONE) {
        session_start();

    }
?>
<?php
    // // Include the database connection file
    // include 'config/config.php';
    // include 'config/authentication.php';

    
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script>alert('Add New Item script started');</script>";
        function sanitize_input($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        $product_name = sanitize_input($_POST['product_name']);
        $product_price = sanitize_input($_POST['product_price']);
        $product_category = sanitize_input($_POST['category']);
        $product_quantity = sanitize_input($_POST['quantity']);

        $manufcture_name = sanitize_input(trim($_POST['manufacture_name']));
        echo "<script>alert('Product Name: $product_name, Price: $product_price, Category: $product_category, Quantity: $product_quantity, Manufacture Name: $manufcture_name');</script>";
        if(!empty($product_name) && !empty($product_price) && !empty($product_category) && !empty($product_quantity)) {
            
            $sql = "INSERT INTO products (name , category, price,stock_quantity, manufactureName) VALUES ('$product_name', '$product_category', '$product_price', , '$stock_quantity' '$manufcture_name')";
            if(mysqli_query($conn, $sql)) {
                echo "<script>alert('New item added successfully!');</script>";
                header("Location: ../../dashboard.php");
                exit();
            } else {
                echo "<script>alert('Error adding new item: " . mysqli_error($conn) . "');</script>";
                header("Location: ../../dashboard.php");
                exit();
            }
        } else {
            echo "<script>alert('All fields are required!');</script>";
            header("Location: ../../dashboard.php");
            exit();
        }
        
    }
    else {
        echo "<script>alert('Invalid request method!');</script>";
        header("Location: ../../dashboard.php");
        exit();
    }
?>


