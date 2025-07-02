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
        $customerName = $_POST['customerName'] ;
        $paymentMethod = $_POST['paymentMethod'];
        $paymentSubTotal = $_POST['subTotal'];
        $paymentTax = $_POST['tax'];
        $paymentTotal = $_POST['total'];
        
        // Here you would typically process the payment and save the order details to your database
        // For demonstration, we'll just set a session variable
        if(empty($customerName) || empty($paymentMethod)) {
            $_SESSION['payment_error'] = "All fields are required.";
            header("Location: ../Order.php");
            exit();
        }
        echo "<script>alert('Processing payment for $customerName with method $paymentMethod. Subtotal: $paymentSubTotal, Tax: $paymentTax, Total: $paymentTotal');</script>";


        //get register customerId

        $customerQuery = "SELECT customerId FROM registercustomers WHERE customerName = '$customerName'";
        $customerResult = mysqli_query($conn, $customerQuery);
        if(mysqli_num_rows($customerResult) > 0) {
            $customerRow = mysqli_fetch_assoc($customerResult);
            $customerId = $customerRow['customerId'];
        } else {
            $_SESSION['payment_error'] = "Customer not found.";
            header("Location: ../Order.php");
            exit();
        }

        // Insert order details into the database
        $orderQuery = "INSERT INTO transaction (paymentMethod, paymentSubTotal, paymentTax, paymentTotal, customerId) VALUES ('$paymentMethod', '$paymentSubTotal', '$paymentTax', '$paymentTotal', '$customerId')";

        // Check if the order was successfully inserted
        if(!mysqli_query($conn, $orderQuery)) {
            $_SESSION['payment_error'] = "Error processing payment: " . mysqli_error($conn);
            header("Location: ../Order.php");
            exit();
        }
        else {
            // If payment processing is successful, you can redirect or show a success message
            $_SESSION['success'] = "Payment processed successfully!";
            $_SESSION['currentCustomer'] = [
                'name' => $customerName,
                'paymentMethod' => $paymentMethod,
                'subTotal' => $paymentSubTotal,
                'tax' => $paymentTax,
                'total' => $paymentTotal
            ];
            header("Location: ../Order.php");
            exit();
        }
        
    }

?>