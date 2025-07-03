<?php
    // This file is used to handle customer registration and assignment
    if(!isset($_SESSION)) {
        session_start();
    }
    // include database connection or any necessary files
    include_once '../config/config.php';

    // Check if the form is submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adjustStock'])) {
        // Validate the form data
        function sanitizeInput($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }
        // Get the product details from the form
        $productId = sanitizeInput($_POST['product_id']);
        $productName = sanitizeInput($_POST['product_name']);
        $currentStock = sanitizeInput($_POST['current_stock']);
        $currentPrice = sanitizeInput($_POST['current_price']);
        
        $sql = "SELECT name FROM products WHERE id = '$productId'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $productName = $row['name'];
        } else {
            $_SESSION['error'] = "Product not found.";
            header("Location: ../inventory.php");
            exit();
        }
        
        // // Validate the adjustment amount
        // if(!is_numeric($adjustmentAmount) || $adjustmentAmount == 0) {
        //     $_SESSION['error'] = "Invalid adjustment amount.";
        //     header("Location: ../inventory.php");
        //     exit();
        // }

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
    <body class="bg-gray-100 min-h-screen flex items-center justify-center">
        <div class="container mx-auto w-[90%] max-w-[600px] p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Adjust Stock for <?php echo htmlspecialchars($productName); ?></h2>
            <form action="../config/components/updateProductDetails.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($productId); ?>"/>
                <div class="mb-4">
                    <label for="productname" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" id="productname" readonly name="productname" value="<?php echo htmlspecialchars($productName); ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <p>Current Stock </p>
                    <label for="currentStock" class="block text-sm font-medium text-gray-700"></label>
                    <input type="number" id="currentStock" name="currentStock" value="<?php echo htmlspecialchars($currentStock); ?>" readonly class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <p>New Stock </p>
                    <label for="newStock" class="block text-sm font-medium text-gray-700"></label>
                    <input type="number" id="newStock" name="newStock" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="currentPrice" class="block text-sm font-medium text-gray-700">Current Price</label>
                    <input type="text" id="currentPrice" name="currentPrice" value="<?php echo htmlspecialchars($currentPrice); ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="adjustmentPrice" class="block text-sm font-medium text-gray-700">Adjustment Amount</label>
                    <input type="number" id="adjustmentPrice" name="adjustmentPrice" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                </div>
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($productId); ?>">
                <button type="submit" name="updateProduct" class="w-full bg-green-400 text-white py-2 px-4 rounded-md hover:bg-green-700 transition duration-200">Update Stocks</button>
                <button type="reset"  class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200 mt-4">Discard Changes</button>
            </form>
        </div>


    </body>
</html>