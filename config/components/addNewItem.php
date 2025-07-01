<?php
// config/components/addNewItem.php
// This script handles the addition of new products to the inventory
    // Start the session if not already started
    if(session_status() == PHP_SESSION_NONE) {
        session_start();

    }
?>
<?php
    // Include the database connection file
    include '../config.php';
    include '../authentication.php';

    
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script>alert('Add New Item script started');</script>";
        function sanitize_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $product_name = sanitize_input($_POST['product_name']);
        $product_price = sanitize_input($_POST['product_price']);
        $product_category = sanitize_input($_POST['category']);
        $product_quantity = sanitize_input($_POST['quantity']);

        $manufcture_name = sanitize_input(trim($_POST['manufacture_name']));
        echo "<script>alert('Product Name: $product_name, Price: $product_price, Category: $product_category, Quantity: $product_quantity, Manufacture Name: $manufcture_name');</script>";
        //echo "<script>alert('product_name: " . $_POST['product_name'] . ", product_price: " . $_POST['product_price'] . ", category: " . $_POST['category'] . ", quantity: " . $_POST['quantity'] . ", manufacture_name: " . $_POST['manufacture_name'] . "');</script>";

        // check if the product already exists
        $check_sql = "SELECT * FROM products WHERE name='$product_name'";
        $check_result = mysqli_query($conn, $check_sql);
        if(mysqli_num_rows($check_result) > 0) {
            echo "<script>alert('Product already exists!');</script>";
            $_SESSION['new_product_insert_error'] = "Product already exists!";
            header("Location: ../../dashboard.php");
            exit();
        }
        
        // Prepare the SQL statement to prevent SQL injection
        $sql = "INSERT INTO products (name, category, price, stock_quantity, manufactureName) VALUES ('$product_name', '$product_category', '$product_price', '$product_quantity', '$manufcture_name')";
        $result = mysqli_query($conn, $sql);
        if($result) {
            echo "<script>alert('New product added successfully!');</script>";
            header("Location: ../../dashboard.php");
            exit();
        } else {
            echo "<script>alert('Error adding product: " . mysqli_error($conn) . "');</script>";
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


