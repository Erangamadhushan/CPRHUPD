<?php
    session_start();
    include_once 'config/authentication.php';

    // connec database;
    include_once 'config/config.php';
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>FreshMart Management</title>
            <script src="https://cdn.tailwindcss.com"></script>
            <style>
                .card-hover:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
                }
                .metric-card {
                    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
                }
                .action-card {
                    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
                    border: 1px solid #bbf7d0;
                }
                .sales-item:hover {
                    background-color: #f8fafc;
                }
                .low-stock-item {
                    background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
                    border-left: 4px solid #ef4444;
                }
                .status-indicator {
                    animation: pulse 2s infinite;
                }
            </style>
        </head>
        <body class="bg-gray-50 min-h-screen">
            <!-- Header -->
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
                                            <li><a href="./config/profile.php" class="text-gray-700 hover:text-green-500">Profile</a></li>
                                            <li><a href="./config/logout.php" class="text-gray-700 hover:text-red-500"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
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

            <!-- Main Content -->
            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Metrics Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Products -->
                    <div class="metric-card rounded-xl p-6 shadow-sm border card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Products</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1" id="totalProducts">
                                    <?php
                                        // Fetch total products from the database
                                        $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM products");
                                        $row = mysqli_fetch_assoc($result);
                                        echo htmlspecialchars($row['total']);
                                    ?>
                                </p>
                                <p class="text-sm text-green-600 mt-1" id="productsChange">+12% from last month</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Daily Sales -->
                    <div class="metric-card rounded-xl p-6 shadow-sm border card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Daily Sales</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1" id="dailySales">
                                    <?php
                                        // Fetch daily sales from the database
                                        $result = mysqli_query($conn, "SELECT SUM(paymentTotal) AS total FROM transaction WHERE DATE(created_at) = CURDATE()");
                                        $row = mysqli_fetch_assoc($result);
                                        echo '$' . htmlspecialchars(number_format($row['total'], 2));
                                    ?>
                                </p>
                                <p class="text-sm text-green-600 mt-1" id="salesChange">+8% from last month</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8m-8 0a2 2 0 100 4 2 2 0 000-4zm8 0a2 2 0 100 4 2 2 0 000-4z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Customers -->
                    <div class="metric-card rounded-xl p-6 shadow-sm border card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Customers</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1" id="totalCustomers">
                                    <?php
                                        // Fetch total customers from the database
                                        $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM registercustomers");
                                        $row = mysqli_fetch_assoc($result);
                                        echo htmlspecialchars($row['total']);
                                    ?>
                                </p>
                                <p class="text-sm text-green-600 mt-1" id="customersChange">+23% from last month</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Low Stock Items -->
                    <div class="metric-card rounded-xl p-6 shadow-sm border card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Low Stock Items</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1" id="lowStockCount">
                                    <?php
                                        // Fetch low stock items from the database
                                        $result = mysqli_query($conn, "SELECT COUNT(stock_quantity) AS total FROM products WHERE stock_quantity < 50");
                                        $row = mysqli_fetch_assoc($result);
                                        echo htmlspecialchars($row['total']);
                                    ?>
                                </p>
                                <p class="text-sm text-red-600 mt-1" id="lowStockChange">-5% from last month</p>
                            </div>
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border p-6 mb-8">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Welcome to FreshMart Management</h2>
                        <span class="text-sm text-gray-500">Your one-stop solution for managing your grocery store</span>
                    </div>
                    <p class="text-gray-700">This dashboard provides real-time insights into your store's performance, including sales metrics, inventory levels, and customer data. Use the quick actions below to manage products, process sales, and view reports.</p>
                    <?php
                        if (isset($_SESSION['username'])) {
                            if( $_SESSION['role'] === 'staff' ) {
                                echo '
                                    <div class="metric-card rounded-xl p-6 mt-5 shadow-sm border card-hover transition-all duration-300">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-sm font-medium text-gray-600">Total Products</p>
                                                <p class="text-3xl font-bold text-gray-900 mt-1" id="totalProducts">1,234</p>
                                                <p class="text-sm text-green-600 mt-1" id="productsChange">+12% from last month</p>
                                            </div>
                                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            }else {

                            }
                        } 
                    ?>
                </div>

                <!-- Quick Actions -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h2>
                    <p class="text-md font-bold text-red-500 mb-4" id="errorMessage">
                        <?php
                            if (isset($_SESSION['new_product_insert_error'])) {
                                echo htmlspecialchars($_SESSION['new_product_insert_error']);
                                unset($_SESSION['new_product_insert_error']);
                            }
                        ?>
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        
                        <?php
                            if($_SESSION['role'] === 'admins') {
                                echo '
                                    <button class="action-card rounded-xl p-6 text-left card-hover transition-all duration-300" onclick="showModal(\'addProductModal\')">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                            </div>
                                            <span class="font-medium text-gray-900">Add New Product</span>
                                        </div>
                                    </button>

                                    <a class="action-card rounded-xl p-6 text-left card-hover transition-all duration-300" href="Order.php">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8m-8 0a2 2 0 100 4 2 2 0 000-4zm8 0a2 2 0 100 4 2 2 0 000-4z"></path>
                                                </svg>
                                            </div>
                                            <span class="font-medium text-gray-900">Process Sale</span>
                                        </div>
                                    </a>

                                    <a class="action-card rounded-xl p-6 text-left card-hover transition-all duration-300" href="inventory.php">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                                </svg>
                                            </div>
                                            <span class="font-medium text-gray-900">Manage Stocks</span>
                                        </div>
                                    </a>

                                    <a class="action-card rounded-xl p-6 text-left card-hover transition-all duration-300" href="viewReport.php">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                                </svg>
                                            </div>
                                            <span class="font-medium text-gray-900">View Reports</span>
                                        </div>
                                    </a>
                                ';
                            }
                            elseif($_SESSION['role'] === 'manager') {
                                echo '
                                    <a class="action-card rounded-xl p-6 text-left card-hover transition-all duration-300" href="inventory.php">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                                </svg>
                                            </div>
                                            <span class="font-medium text-gray-900">Manage Inventory</span>
                                        </div>
                                    </a>

                                    <a class="action-card rounded-xl p-6 text-left card-hover transition-all duration-300" href="viewReport.php">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                                </svg>
                                            </div>
                                            <span class="font-medium text-gray-900">View Reports</span>
                                        </div>
                                    </a>
                                ';
                            }
                            else {
                                echo '
                                    <a class="action-card rounded-xl p-6 text-left card-hover transition-all duration-300" href="Order.php">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8m-8 0a2 2 0 100 4 2 2 0 000-4zm8 0a2 2 0 100 4 2 2 0 000-4z"></path>
                                                </svg>
                                            </div>
                                            <span class="font-medium text-gray-900">Process Sale</span>
                                        </div>
                                    </a>
                                ';
                            }
                        ?>
                    </div>
                </div>

                <!-- Recent Sales and Low Stock Alert -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Recent Sales -->
                    <div class="bg-white rounded-xl shadow-sm border p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Recent Sales</h3>
                            <span class="text-sm text-gray-500">Latest transactions from today</span>
                        </div>
                        <div class="space-y-3" id="recentSales">
                            <?php
                                $sql = "SELECT transactionID, customerId, paymentTotal, created_at FROM transaction WHERE DATE(created_at) = CURDATE() ORDER BY created_at DESC LIMIT 5";
                                $result = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        $transactionID = htmlspecialchars($row['transactionID']);
                                        $customerId = htmlspecialchars($row['customerId']);
                                        $paymentTotal = htmlspecialchars(number_format($row['paymentTotal'], 2));
                                        $createdAt = date('H:i', strtotime($row['created_at']));
                                        // Fetch customer name from registercustomers table
                                        $customerQuery = "SELECT customerName FROM registercustomers WHERE customerId = '$customerId' LIMIT 1" ;
                                        $customerNameResult = mysqli_query($conn, $customerQuery);
                                        while($customerRow = mysqli_fetch_assoc($customerNameResult)) {
                                            $customerName = htmlspecialchars($customerRow['customerName']);
                                        };
                                        echo '
                                            <div class="sales-item flex items-center justify-between p-3 rounded-lg transition-colors duration-200 bg-green-100   hover:bg-green-200">
                                                <div>
                                                    <p class="font-medium text-gray-900">'.$transactionID.' - '.$customerName.'</p>
                                                    <p class="text-sm text-gray-500">'.$createdAt.'</p>
                                                </div>
                                                <span class="text-green-600 font-semibold">$45.67</span>
                                            </div>
                                        ';
                                    }
                                }
                            ?>
                            
                        </div>
                    </div>

                    <!-- Low Stock Alert -->
                    <div class="bg-white rounded-xl shadow-sm border p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Low Stock Alert</h3>
                            <span class="text-sm text-gray-500">Items that need restocking</span>
                        </div>
                        <div class="space-y-3" id="lowStockItems">
                            <?php
                                // Fetch low stock items from the database
                                $lowStockQuery = "SELECT name, category, stock_quantity FROM products WHERE stock_quantity < 50 ORDER BY stock_quantity ASC";
                                $lowStockResult = mysqli_query($conn, $lowStockQuery);

                                if (mysqli_num_rows($lowStockResult) > 0) {
                                    while ($row = mysqli_fetch_assoc($lowStockResult)) {
                                        echo '
                                            <div class="low-stock-item p-4 rounded-lg">
                                                <div class="flex items-center justify-between">
                                                    <div>
                                                        <p class="font-medium text-gray-900">'.$row['name'].'</p>
                                                        <p class="text-sm text-gray-600">'.$row['category'].'</p>
                                                    </div>
                                                    <div class="flex items-center space-x-2">
                                                        <span class="text-red-600 font-semibold">'.$row['stock_quantity'].'units</span>
                                                        <div class="status-indicator w-2 h-2 bg-red-500 rounded-full"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                    }
                                } else {
                                    echo '<p class="text-gray-500">No low stock items.</p>';
                                }

                            ?>
                            
                        </div>
                    </div>
                </div>
            </main>

            <!-- Modal Backdrop -->
            <div id="modalBackdrop" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

            <!-- Add Product Modal -->
            <div id="addProductModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
                <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-4 p-6">
                    
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Add New Product</h3>
                    <p class="text-sm text-gray-600 mb-4">Fill in the details below to add a new product to the inventory.</p>
                    
                    <form id="addProductForm" action="./config/components/addNewItem.php" method="post">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                                <input type="text" name="product_name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                                    <option value="">Select Category</option>
                                    <option value="dairy">Dairy</option>
                                    <option value="bakery">Bakery</option>
                                    <option value="fruits">Fruits</option>
                                    <option value="vegetables">Vegetables</option>
                                    <option value="beverages">Beverages</option>
                                    <option value="cereals">Cereals</option>
                                    <option value="snacks">Snacks</option>
                                    <option value="meat">Meat</option>
                                    <option value="seafood">Seafood</option>
                                    <option value="pantry">Pantry</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                                <input type="number" step="0.01" name="product_price" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Manufacture ID</label>
                                <select name="manufacture_name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                                    <?php
                                        $sql = "SELECT manufactureName FROM manufacture";
                                        $result = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . htmlspecialchars($row['manufactureName']) . '">' . htmlspecialchars($row['manufactureName']) . '</option>';
                                        }
                                        $conn->close();
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity</label>
                                <input type="number" min="0" max="1000" name="quantity" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                            </div>
                        </div>
                        <div class="flex space-x-3 mt-6">
                            <button type="submit" class="flex-1 bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition-colors">Add Product</button>
                            <button type="button" onclick="hideModal('addProductModal')" class="flex-1 bg-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-400 transition-colors">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Process Sale Modal -->
            <div id="processSaleModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
                <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-4 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Process Sale</h3>
                    <form id="processSaleForm">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Customer Name</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Product</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                                    <option value="">Select Product</option>
                                    <option value="milk">Fresh Milk (1L) - $4.99</option>
                                    <option value="bread">Whole Wheat Bread - $2.50</option>
                                    <option value="eggs">Organic Eggs (12pc) - $5.99</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                <input type="number" min="1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Total Amount</label>
                                <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50" readonly>
                            </div>
                        </div>
                        <div class="flex space-x-3 mt-6">
                            <button type="submit" class="flex-1 bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition-colors">Process Sale</button>
                            <button type="button" onclick="hideModal('processSaleModal')" class="flex-1 bg-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-400 transition-colors">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <script src="./scripts/main.js"> </script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        </body>
</html>