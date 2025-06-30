<?php
    // check if the session is already started
    if(session_status() == PHP_SESSION_NONE) {
        // Start the session if not already started
        session_start();
    }
    // Include the authentication file
    include 'authentication.php';

    // Include the database connection file
    include 'config.php';
   
    // Check User Role
    include './auth/profileUpdateAuth.php';
    
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
    <body>
        <div class="bg-gray-100 min-h-screen flex items-center justify-center">
            <div class="container mx-auto w-[90%] max-w-[600px] p-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h1 class="text-3xl font-bold mb-4 text-center">Profile</h1>
                    <p class="text-center text-red-500 text-[18px]"> <?php echo isset($_SESSION['update_error']) ? $_SESSION['update_error'] : ''; ?></p>
                        <?php 
                            if(isset($_SESSION['update_error'])) {
                                echo $_SESSION['update_error']; 
                                unset($_SESSION['update_error']);
                            }
                        ?>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                        <div class="mb-4">
                            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                            <input type="text" id="username" readonly name="username" value="<?php echo htmlspecialchars($username); ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <input type="text" id="role" readonly name="role" value="<?php echo htmlspecialchars($_SESSION['role']); ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <p> 
                                <strong class="text-lg text-green-500">Note:</strong> You can only update your email and phone number. Username and role cannot be changed.
                            </p>
                            <p> <a href="#" class="text-blue-500 hover:underline">change password</a></p>
                        </div>
                        <button type="submit" name="update_profile" class="w-full bg-green-400 text-white py-2 px-4 rounded-md hover:bg-green-700 transition duration-200">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>


        <?php
            // Handle profile update
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
                // Sanitize and validate inputs
                function sanitizeInput($data) {
                    return htmlspecialchars(stripslashes(trim($data)));
                }
                $email = sanitizeInput(trim($_POST['email']));
                $phone = sanitizeInput(trim($_POST['phone']));

                // Validate inputs
                if (!empty($username) && !empty($email) && !empty($phone)) {
                    // Update the user profile in the database
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $_SESSION['update_error'] = "Invalid email format!";
                        echo "<script>alert('Invalid email format!');</script>";  
                        exit();
                    }
                    if(!preg_match('/^[0-9]{10,15}$/', $phone)) {
                        $_SESSION['update_error'] = "Invalid phone number format!";
                        echo "<script>alert('Invalid phone number format!');</script>";
                        exit();
                    }
                    // Determine the current user role table
                    include './auth/updateProfileInformation.php';
                    echo "alert('Current user role: $currentUserRole');";
                    $update_sql = "UPDATE $currentUserRole SET username='$username', email='$email', phone='$phone' WHERE id='{$_SESSION['userid']}'";
                    if (mysqli_query($conn, $update_sql)) {
                        echo "<script>alert('Profile updated successfully!');</script>";
                        $_SESSION['update_success'] = "Profile updated successfully!";
                        // Redirect to the profile page or dashboard
                        header("Location: ./profile.php");
                        exit();
                    } else {
                        echo "<script>alert('Error updating profile: " . mysqli_error($conn) . "');</script>";
                        $_SESSION['update_error'] = "Error updating profile: " . mysqli_error($conn);
                    }
                } else {
                    echo "<script>alert('All fields are required!');</script>";
                    $_SESSION['update_error'] = "All fields are required!";
                }
            }
        ?>
    </body>
</form>