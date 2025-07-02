<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include_once '../config.php'; // Include your database connection file


?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        function sanitizeInput($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }
        // Assuming you have a function to handle the registration logic
        $customerName = sanitizeInput($_POST['customer_name']);
        $customerEmail = sanitizeInput($_POST['customer_email']);
        $customerPhone = sanitizeInput($_POST['customer_phone']);

        // Here you would typically save this data to your database
        // For demonstration, we'll just set a session variable
        if(empty($customerName) || empty($customerEmail) || empty($customerPhone)) {
            $_SESSION['customer_register_error'] = "All fields are required.";
            header("Location: ../../Order.php");
            exit();
        }
        if(!filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['customer_register_error'] = "Invalid email format.";
            header("Location: ../../Order.php");
            exit();
        }

        // Check if the customer already exists in the database
        $checkCustomerQuery = "SELECT * FROM registercustomers WHERE customerEmail = '$customerEmail'";
        $result = mysqli_query($conn, $checkCustomerQuery);
        if(mysqli_num_rows($result) > 0) {
            $_SESSION['customer_register_error'] = "Customer with this email already exists.";
            header("Location: ../../Order.php");
            exit();
        }

        // Assuming you have a database connection established
        $sql = "INSERT INTO registercustomers (customerName, customerPhone, customerEmail) VALUES ('$customerName', '$customerPhone', '$customerEmail')";
        if(!mysqli_query($conn, $sql)) {
            $_SESSION['customer_register_error'] = "Error: " . mysqli_error($conn);
            header("Location: ../../Order.php");
            exit();
        }
        else  {
            $_SESSION['success'] = "Customer registered successfully!";
            $_SESSION['currentCustomer'] = [
            'name' => $customerName,
            'email' => $customerEmail,
            'phone' => $customerPhone
            ];
            header("Location: ../../Order.php");
            exit();

        }
        
    }
?>