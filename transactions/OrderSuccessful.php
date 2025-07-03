<?php
    // if session is not set, redirect to Order page
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    
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
    <body class="">
        <div class="grid grid-cols-1 h-screen">
            
            <div class="w-full h-screen flex justify-center">
                <div class="bg-white p-8 w-[95%] max-w-[880px] mx-auto rounded-lg">
                    <h2 class="text-2xl md:text-6xl font-bold mb-6 text-center">Order Successful</h2>
                    <p class="text-center text-green-500 text-[24px]">Your order has been processed successfully!</p>
                    <p class="text-center text-gray-600 mt-4">Thank you for shopping with us!</p>
                    <div class="mt-6 text-center">
                        <a href="../Order.php" class="bg-green-400 text-white py-2 px-4 rounded-md hover:bg-green-700 transition duration-200">Go to Home</a>
                    </div>
                </div>
            </div>
        </div>



    </body>
</html>