<?php
    
    // Check if the session is already started
    if (session_status() == PHP_SESSION_NONE) {
        // Start the session if not already started
        session_start();
    }

    // Include the authentication file

    include 'authentication.php';
    if(!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
        $_SESSION['error'] = "You must be logged in to access this page.";
        header("Location: ../index.php");
        exit();
    }

    // Include the database connection file
    include 'config.php';

    
    // Check User Role
    include './auth/profileAuth.php';

    // Include the profile view file
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile - FreshMart Management</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100">
        <header class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8m-8 0a2 2 0 100 4 2 2 0 000-4zm8 0a2 2 0 100 4 2 2 0 000-4z"></path>
                            </svg>
                        </div>
                        <h1 class="text-xl font-semibold text-gray-900">FreshMart Management</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-gray-900">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-md group">
                                <p><?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest'; ?></p>
                                <div class="hidden group-hover:block hover:block flex justify-center items-center w-[200px] h-[100px] p-3 bg-white  shadow-lg absolute top-[45px] right-20 z-10">
                                    <ul class="space-y-2 ">
                                        <li><a href="./profile.php" class="text-gray-700 hover:text-green-500">Profile</a></li>
                                        <li><a href="./logout.php" class="text-gray-700 hover:text-red-500"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </span>
                        </button>
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-medium text-sm"><a href="./config/profile.php" class="font-medium">A</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container bg-white p-6 rounded-lg grid grid-cols-1 md:grid-cols-2 mx-auto p-6">
            <div class=" ">
                <!-- Set Profile Information -->
                <h1 class="text-3xl font-bold mb-4 text-center">Profile</h1>
                <p class="text-center text-gray-600 mb-6 text-lg">
                    Welcome, <?php echo htmlspecialchars($username); ?>! Here you can view and manage your profile information. 
                    Your role is: <strong><?php echo htmlspecialchars($_SESSION['role']); ?></strong>.
                    <br>
                    If you need to update your information, please click the "Edit Profile" button below.<br/>
                    <span class="text-red-500 my-3"><b>Note:</b> Only Admins and Managers can edit profiles.</span>
                    <span class="text-red-500">If you are a staff member, you can only view your profile information.</span>

                </p>
                
            </div>
            <div class="overflow-auto">
                <div class="bg-white p-6 rounded-lg min-h-[50vh]">
                    <h2 class="text-2xl font-semibold mb-4">User Information</h2>
                    <form >
                        <div class="mb-4">
                            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" readonly class="mt-1 block w-[90%] px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly class="mt-1 block w-[90%] px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" readonly class="mt-1 block w-[90%] px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <input type="text" id="role" name="role" value="<?php echo htmlspecialchars($_SESSION['role']); ?>" readonly class="mt-1 block w-[90%] px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                    </form>
                </div>
                <div class="px-6">
                    <button class="mt-4 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-200">
                        <a href="./edit_profile.php" class="text-white">Edit Profile</a>
                    </button>
                </div>
            </div>
        </div>
        <div class="fixed bottom-0 left-0 w-full bg-white shadow-md p-4 flex justify-between items-center">
            <a href="../dashboard.php" class="text-green-500 hover:text-green-700">
                <i class="fas fa-home"></i> <p class="hidden sm:block">Dashboard</p>
            </a>
            <a href="./logout.php" class="text-red-500 hover:text-red-700">
                <i class="fas fa-sign-out-alt"></i> <p class="hidden sm:block">Logout</p>
            </a>
            <a href="../index.php" class="text-blue-500 hover:text-blue-700">
                <i class="fas fa-sign-in-alt"></i> <p class="hidden sm:block">Back to Login</p>
            </a>
        </div>
    </body>
</html>
<?php
    // Close the database connection
    mysqli_close($conn);
    
?>