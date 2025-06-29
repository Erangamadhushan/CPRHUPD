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
    if ($_SESSION['role'] == 'admin') {
        // If the user is an admin, include the admin dashboard file
        $sql = "SELECT * FROM admins WHERE username='" . mysqli_real_escape_string($conn, $_SESSION['username']) . "'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $username = $user['username'];
            $email = $user['email'];
            $phone = $user['phone'];
        } else {
            $_SESSION['error'] = "User not found.";
            header("Location: ../index.php");
            exit();
        }


    }
    elseif ($_SESSION['role'] == 'manager') {
        // If the user is a manager, include the manager dashboard file
        $sql = "SELECT * FROM manager WHERE username='" . mysqli_real_escape_string($conn, $_SESSION['username']) . "'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $username = $user['username'];
            $email = $user['email'];
            $phone = $user['phone'];
        } else {
            $_SESSION['error'] = "User not found.";
            header("Location: ../index.php");
            exit();
        }
    }
    elseif ($_SESSION['role'] == 'staff') {
        // If the user is a staff member, include the staff dashboard file
        $sql = "SELECT * FROM staffs WHERE username='" . mysqli_real_escape_string($conn, $_SESSION['username']) . "'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $username = $user['username'];
            $email = $user['email'];
            $phone = $user['phone'];
        } else {
            $_SESSION['error'] = "User not found.";
            header("Location: ../index.php");
            exit();
        }
    }
    elseif($_SESSION['role'] == 'customer') {
        // If the user is a customer, include the customer dashboard file
        $sql = "SELECT * FROM customers WHERE username='" . mysqli_real_escape_string($conn, $_SESSION['username']) . "'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $username = $user['username'];
            $email = $user['email'];
            $phone = $user['phone'];
            $_SESSION['email'] = $email; // Store email in session for customer
        } else {
            $_SESSION['error'] = "User not found.";
            header("Location: ../index.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Invalid user role.";
        header("Location: ../index.php");
        exit();
    }

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
        <div class="container grid grid-cols-1 md:grid-cols-2 mx-auto p-6">
            <div class="bg-white p-6 rounded-lg shadow-md ">
                <h1 class="text-3xl font-bold mb-4 text-center">Profile</h1>
                <div class="bg-white p-6 rounded-lg min-h-[50vh]">
                    <h2 class="text-2xl font-semibold mb-4">User Information</h2>
                    <p class="text-lg text-green-500 py-2"><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
                    <p class="text-lg text-green-500 py-2"><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                    <p class="text-lg text-green-500 py-2"><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></p>
                    <p class="text-lg text-green-500 py-2"><strong>Role:</strong> <?php echo htmlspecialchars($_SESSION['role']); ?></p>
                </div>
                <div>
                    <button class="mt-4 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-200">
                        <a href="./edit_profile.php" class="text-white">Edit Profile</a>
                    </button>

                </div>
            </div>
            <div>

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