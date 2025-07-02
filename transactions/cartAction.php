<?php
    // This file is used to handle customer registration and assignment
    if(!isset($_SESSION)) {
        session_start();
    }
    // include database connection or any necessary files
    include_once '../config/config.php';
?>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['processPayment'])) {
        // Assuming you have a function to handle the payment processing logic
        $customerName = $_POST['customerName'] ?? '';
        $paymentMethod = $_POST['paymentMethod'] ?? '';
        $paymentSubTotal = $_POST['subTotal'] ?? '';
        $paymentTax = $_POST['tax'] ?? '';
        $paymentTotal = $_POST['total'] ?? '';
        
        // Here you would typically process the payment and save the order details to your database
        // For demonstration, we'll just set a session variable
        if(empty($customerName) || empty($paymentMethod)) {
            $_SESSION['payment_error'] = "All fields are required.";
            header("Location: ../Order.php");
            exit();
        }
        echo "<script>alert('Processing payment for $customerName with method $paymentMethod. Subtotal: $paymentSubTotal, Tax: $paymentTax, Total: $paymentTotal');</script>";

        // Assuming payment processing is successful
        // $_SESSION['success'] = "Payment processed successfully!";
        // header("Location: ../Order.php");
        // exit();
    }

?>