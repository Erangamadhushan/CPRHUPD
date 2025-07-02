<?php
    include 'config/config.php';
    session_start();
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
        <div class="grid grid-cols-1 md:grid-cols-2 h-screen">
            <div class="w-full h-screen flex items-center justify-between p-4" >
                <nav class="bg-white min-h-[50vh] flex justify-center">
                    <div class="p-4">
                        <h1 class="text-xl md:text-3xl text-center py-5 font-bold text-green-500">FreshMart Management</h1>
                        <p class="text-lg md:text-xl p-5 text-center">FreshMart is a grocery store that offers a wide range of products, including fresh produce, dairy, meat, and household items. Our mission is to provide high-quality products at affordable prices while ensuring excellent customer service.</p>
                    </div>
                </nav>
            </div>
            <div class="w-full h-screen flex items-center justify-center bg-gray-200">
                <form action="config/login.php" method="post">
                    <div class="flex items-center justify-center h-screen w-full">
                        <div class="bg-white p-8 w-[380px] mx-auto rounded-lg shadow-md">
                            <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
                            <p class="text-center text-red-500 text-[18px]"><?php echo isset($_SESSION['error']) ? $_SESSION['error'] : ''; ?></p>
                            <div class="mb-4">
                                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                <input type="text" id="username" name="username" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            </div>
                            <div class="mb-6">
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            </div>
                            <div class="mb-6">
                                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                <select id="role" name="role" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    <option value="" disabled selected>Select your role</option>
                                    <option value="admins">Admin</option>
                                    <option value="manager">Manager</option>
                                    <option value="staffs">Cashier</option>
                                    <option value="customers">Customer</option>
                                </select>
                            </div>
                            <button type="submit" name="login" class="w-full bg-green-400 text-white py-2 px-4 rounded-md hover:bg-green-700 transition duration-200">Login</button>
                            <p class="mt-4 text-sm text-gray-600 text-center">Don't have an account? <a href="register.php" class="text-green-500 hover:text-green-700">Register here</a></p>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </body>
</html>
