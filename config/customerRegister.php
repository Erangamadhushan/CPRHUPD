<?php
    // This file is used to handle customer registration and assignment
    if(!isset($_SESSION)) {
        session_start();
    }

    // Include database connection or any necessary files
    require_once './config.php';
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FreshMart Management</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    </head>
    <body class="w-full h-screen ">

    <?php
        if(isset($_POST['register_customer'])) {
            // Handle customer registration logic here
            // For example, you can save the customer details to the database
            // and redirect to the order page or show a success message.
            $_SESSION['message'] = "Customer registered successfully!";
            echo "
                <div class='flex h-screen items-center justify-center p-4 flex-column space-x-4'>
                    <form action='./components/newCustomer.php' class='w-[95%] mx-auto' method='post'>
                        <div class='flex items-center justify-end flex-col p-4 space-x-4 border mx-auto max-w-[600px] border-green-400'>
                            <h1 class='text-xl md:text-3xl text-green-400 font-bold'>FreshMart</h1>
                            <p class='text-md text-gray-500'>Welcome to FreshMart! Please register or assign a customer to start shopping.</p>
                            <div class='flex flex-col items-center space-x-2 py-3'>
                                <label for='customer_name' class='text-gray-700 w-full'>Customer Name:</label>
                                <input type='text' name='customer_name' id='customer_name' class='border border-gray-300 p-2 w-[300px] rounded' required>
                            </div>
                            <div class='flex flex-col items-center space-x-2 py-3'>
                                <label for='customer_email' class='text-gray-700 w-full'>Customer Email:</label>
                                <input type='email' name='customer_email' id='customer_email' class='border border-gray-300 p-2 rounded w-[300px]' required>
                            </div>
                            <div class='flex flex-col items-center space-x-2 py-3'>
                                <label for='customer_phone' class='text-gray-700 w-full'>Customer Phone:</label>
                                <input type='text' name='customer_phone' id='customer_phone' class='border border-gray-300 p-2 rounded w-[300px]' required>
                            </div>
                            <button type='submit' name='register_customer' class='flex items-center space-x-2 text-gray-600 border border-green-400 p-3 px-5 hover:text-green-600'>
                                <span class='text-md group gap-2 flex items-center'>
                                    <i class='fas fa-user'></i>Register
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            ";
        } elseif(isset($_POST['Assign_customer'])) {
            // Handle customer assignment logic here
            // For example, you can assign an existing customer to the order
            $_SESSION['message'] = "Customer assigned successfully!";
            header("Location: ../Order.php");
            exit();
        }
    ?>
    

    </body>
</html>
