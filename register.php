<?php
    session_start();
    include 'config/config.php';
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
    <body>
        <!-- Create Register Form -->
        <div class="grid grid-cols-1 md:grid-cols-2 h-screen">
            <div class="w-full h-screen flex items-center justify-between p-4 bg-gray-200">
                <form action="config/register.php" method="post" class="bg-white p-8 w-[380px] mx-auto rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
                    <p class="text-center text-red-500 text-[18px]"><?php echo $_SESSION['error'] ? $_SESSION['error'] : ''; ?></p>
                    <div class="mb-2">
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" id="username" name="username" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    </div>
                    <div class="mb-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    </div>
                    <div class="mb-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    </div>
                    <div class="mb-2">
                        <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    </div>
                    <div class="mb-2">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="phone" id="phone" name="phone" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    </div>
                    <div class="mb-2">
                        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                        <select id="role" name="role" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            <option value="" disabled selected>Select your role</option>
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                            <option value="staff">Staff</option>
                            <option value="customer">Customer</option>
                        </select>
                    </div>
                    <button type="submit" name="register" class="w-full bg-green-400 text-white py-2 px-4 rounded-md hover:bg-green-700 transition duration-200">Register</button>
                    <p class="mt-4 text-sm text-gray-600 text-center">Already have an account? <a href="index.php" class="text-green-500 hover:text-green-700">Login here</a></p>
                </form>
            </div>
            <div>
                <div class="w-full h-screen flex items-center justify-center">
                    <div class="bg-white min-h-[50vh] flex justify-center">
                        <div class="p-4">
                            <h1 class="text-xl md:text-3xl text-center py-5 font-bold text-green-500">FreshMart Management</h1>
                            <p class="text-lg md:text-xl p-5 text-center">FreshMart is a grocery store that offers a wide range of products, including fresh produce, dairy, meat, and household items. Our mission is to provide high-quality products at affordable prices while ensuring excellent customer service.</p> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
    