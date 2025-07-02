<?php
    session_start();
    include_once 'config/authentication.php';

    // Include the database connection file
    include_once 'config/config.php';
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FreshMart Management</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <style>
            .product-card:hover {
                transform: translateY(-2px);
                transition: all 0.2s ease-in-out;
            }
            .cart-item {
                animation: slideIn 0.3s ease-out;
            }
            @keyframes slideIn {
                from { transform: translateX(20px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        </style>
    </head>
    <body class="bg-gray-50 min-h-screen">
        <header class="bg-white shadow-sm border-b px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-green-500 rounded flex items-center justify-center">
                        <i class="fas fa-cash-register text-white text-sm"></i>
                    </div>
                    <h1 class="text-xl font-semibold text-gray-800">FreshMart Management</h1>
                </div>
                <div class="flex items-center space-x-4 text-sm text-gray-600">
                    <span class="border border-green-500 group rounded px-3 py-3 hover:bg-green-500 flex items-center space-x-1">
                        <i class="fas fa-home mr-1"></i>
                        <a href="dashboard.php" class="group-hover:text-white">Dashboard</a>
                    </span>
                    <span><strong>
                        <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest'; ?>
                    </strong></span>
                    <span>role: <strong>
                        <?php echo isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) : 'Customer'; ?>
                    </strong></span>
                </div>
            </div>
        </header>

        <div class="flex items-center justify-end space-x-4">
            <?php
                // If check user is registered user
                if(!isset($_SESSION['currentCustomer'])) {
                    echo '
                        <form action="./config/customerRegister.php" class="flex items-center justify-end p-4 space-x-4" method="post">
                            <div>
                                <h1 class="text-xl md:text-3xl text-green-400 font-bold">FreshMart</h1>
                                <p class="text-md text-gray-500">Welcome to FreshMart! Please register or assign a customer to start shopping.</p>
                            </div>
                            <button type="submit" name="register_customer" class="flex items-center space-x-2 text-gray-600 border border-green-400 p-3  px-5 hover:text-green-600">
                                <span class="text-md group gap-2 flex items-center">
                                    <i class="fas fa-user"></i>Register
                                </span>
                            </button>
                            <button type="submit" name="Assign_customer" class="flex items-center space-x-2 text-gray-600 border border-green-400 p-3 px-5 hover:text-green-600">
                                <span class="text-md group">
                                    <i class="fas fa-register"></i>Assign Customer
                                </span>
                            </button>
                        </form>
                    ';
                }
                else {

                }
            ?>
        </div>

        <div class="flex h-screen pt-5">
            <div class="flex-1 p-6 overflow-y-auto">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Product Search</h2>
                    <div class="relative">
                        <input 
                            type="text" 
                            id="searchInput"
                            onchange="searchProducts()"
                            placeholder="Search products or scan barcode..." 
                            class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus: outline-none focus:border-transparent"
                        >
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Products Grid -->
                <div id="product_grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Products will be populated here -->
                     <?php
                        // Fetch products from the database
                        $sql = "SELECT * FROM products";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($product = mysqli_fetch_assoc($result)) {
                                $categoryColors = [
                                    'Fruits' => 'bg-red-100 text-red-800',
                                    'Vegetables' => 'bg-green-100 text-green-800',
                                    'Dairy' => 'bg-blue-100 text-blue-800',
                                    'Meat' => 'bg-yellow-100 text-yellow-800',
                                    'Beverages' => 'bg-purple-100 text-purple-800',
                                    'Snacks' => 'bg-pink-100 text-pink-800',
                                    'Household' => 'bg-gray-100 text-gray-800'
                                ];
                                echo "
                                <div class='product-card bg-white rounded-lg shadow-sm border hover:shadow-md cursor-pointer' onclick=\"addToCart('{$product['id']}', '{$product['name']}', '{$product['price']}')\">
                                    <div class='p-4'>
                                        <div class='flex justify-between items-start mb-2'>
                                            <h4 class='font-medium text-gray-900'>{$product['name']}</h4>
                                            <span class='text-xs px-2 py-1 rounded-full '>{$product['category']}</span>
                                        </div>
                                        <div class='flex justify-between items-center'>
                                            <span class='text-lg font-bold text-green-600'>\${$product['price']}</span>
                                            <span class='text-sm text-gray-500'>{$product['stock_quantity']} in stock</span>
                                        </div>
                                    </div>
                                </div>";
                            }
                        } else {
                            echo "<p class='text-gray-500'>No products found.</p>";
                        }
                     ?>
                     
                </div>
            </div>

            <!-- Cart Sidebar -->
            <div class="w-96 bg-white shadow-lg border-l min-h-[100vh]">
                <div class="p-6 border-b">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Cart (<span id="cartCount">0</span>)
                        </h3>
                        <button id="clearCart" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>

                <!-- Cart Items -->
                <div id="cartItems" class="flex-1 overflow-y-auto p-6 space-y-4 max-h-96">
                    <!-- Cart items will be populated here -->
                </div>

                <!-- Cart Summary -->
                <div class="border-t p-6 space-y-4">
                    <form action="./transactions/cartAction.php" method="post">
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span>Subtotal:</span>
                                <span id="subtotal" name="subTotal">$0.00</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span>Tax (8%):</span>
                                <span id="tax" name="tax">$0.00</span>
                            </div>
                            <div class="flex justify-between text-lg font-bold border-t pt-2">
                                <span>Total:</span>
                                <span id="total" class="text-green-600" name="total">$0.00</span>
                            </div>
                        </div>

                        <div class="space-y-3 min-h-[300px]">
                            <input 
                                type="text" 
                                id="customerName"
                                name="customerName"
                                placeholder="Enter customer name" 
                                value="<?php echo isset($_SESSION['currentCustomer']) ? htmlspecialchars($_SESSION['currentCustomer']['name']) : ''; ?>"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm" disabled="true" required
                            />
                            <select name="paymentMethod" id="paymentMethod" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm " disabled="true" required>
                                <option value="" disabled selected>Select Payment Method</option>
                                <option value="cash">Cash</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="debit_card">Debit Card</option>
                                <option value="mobile_payment">Mobile Payment</option>
                                <option value="bank_transfer">Bank Transfer</option>
                            </select>
                            <button 
                                type="submit"
                                id="processPayment"
                                name="processPayment"
                                class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-medium transition-colors flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed" disabled="true" 
                            >
                                <i class="fas fa-credit-card mr-2"></i>
                                Process Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- <script type="module" src="scripts/main.js"></script> -->
        <script src="./scripts/orderFunctionality.js"> </script>
    </body>
</html>