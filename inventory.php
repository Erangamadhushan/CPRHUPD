<?php
    // session start if already not start a session
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // insert database connection
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
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'custom-green': '#22c55e',
                            'custom-blue': '#3b82f6',
                            'custom-red': '#ef4444',
                            'custom-orange': '#f97316',
                            'custom-yellow': '#eab308'
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="bg-gray-50 min-h-screen">
        <!-- Header -->
        <header class="bg-white border-b border-gray-200 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-custom-green rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h1 class="text-xl font-semibold text-gray-900">Stock Management</h1>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="border border-green-500 group rounded px-3 py-2 hover:bg-green-500 flex items-center space-x-1">
                        <i class="fas fa-home mr-1"></i>
                        <a href="dashboard.php" class="group-hover:text-white">Dashboard</a>
                    </span>
                    <button class="flex items-center space-x-2 px-4 py-2 text-gray-600 hover:text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-50" onclick="javascript:window.print();">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Generate Report</span>
                    </button>
                    <button class="flex items-center space-x-2 px-4 py-2 bg-custom-green text-white rounded-lg hover:bg-green-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Stock Adjustment</span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="p-6">
            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Products -->
                <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Products</p>
                            <p class="text-3xl font-bold text-gray-900">
                                <?php
                                    // Fetch total products from the database
                                    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM products");
                                    $row = mysqli_fetch_assoc($result);
                                    echo htmlspecialchars($row['total']);
                                ?>
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-custom-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Low Stock Items -->
                <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Low Stock Items</p>
                            <p class="text-3xl font-bold text-gray-900">
                                <?php
                                    // Fetch low stock items from the database
                                    $result = mysqli_query($conn, "SELECT COUNT(stock_quantity) AS total FROM products WHERE stock_quantity < 50");
                                    $row = mysqli_fetch_assoc($result);
                                    echo htmlspecialchars($row['total']);
                                ?>
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-custom-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Out of Stock -->
                <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Out of Stock</p>
                            <p class="text-3xl font-bold text-gray-900">
                                <?php
                                    // Fetch out stock items from the database
                                    $result = mysqli_query($conn, "SELECT COUNT(stock_quantity) AS total FROM products WHERE stock_quantity = 0");
                                    $row = mysqli_fetch_assoc($result);
                                    echo htmlspecialchars($row['total']);
                                ?>
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-custom-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Overstocked -->
                <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Overstocked</p>
                            <p class="text-3xl font-bold text-gray-900">
                                <?php
                                    // Fetch over stock items from the database
                                    $result = mysqli_query($conn, "SELECT COUNT(stock_quantity) AS total FROM products WHERE stock_quantity > 100");
                                    $row = mysqli_fetch_assoc($result);
                                    echo htmlspecialchars($row['total']);
                                ?>
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-custom-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inventory Overview -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Inventory Overview</h2>
                    <p class="text-sm text-gray-600 mt-1">Monitor stock levels and manage inventory across all products</p>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Stock</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Restocked</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Fetch data from the products table -->

                            <?php
                                $sql = "SELECT * FROM products";
                                $result = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        $productName = htmlspecialchars($row['name']);
                                        $category = htmlspecialchars($row['category']);
                                        $currentStock = htmlspecialchars($row['stock_quantity']);
                                        $currentPrice = htmlspecialchars($row['price']);
                                        $lastRestocked = date("Y-m-d", strtotime($row['updated_at']));
                                        $supplier = htmlspecialchars($row['manufactureName']);

                                        // Determine stock status
                                        if ($currentStock < 5) {
                                            $statusClass = 'bg-red-100 text-red-800';
                                            $statusText = 'Out of Stock';
                                        } elseif ($currentStock < 50) {
                                            $statusClass = 'bg-yellow-100 text-yellow-800';
                                            $statusText = 'Low Stock';
                                        }
                                        elseif ($currentStock <= 100) {
                                            $statusClass = 'bg-green-100 text-green-800';
                                            $statusText = 'Normal Stock';

                                        }
                                         elseif ($currentStock > 100) {
                                            $statusClass = 'bg-orange-100 text-orange-800 font-bold text-md';
                                            $statusText = 'Overstocked';
                                        } else {
                                            $statusClass = 'bg-gray-200 text-gray-600';
                                            $statusText = 'Unknown';
                                        }

                                        echo '
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">'.$productName.'</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'.$category.'</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <span class="font-medium">'.$currentStock.'</span>
                                                    <span class="text-gray-500">/ 100 max</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">'.$currentPrice.'</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 py-1 text-xs font-medium rounded-full'.$statusClass.'">'.$statusText.'</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'.$lastRestocked.'</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'.$supplier.'</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <form action="./transactions/adjust_stock.php" method="POST" class="inline-flex items-center space-x-2">
                                                        <input type="hidden" name="product_id" value="'.$row['id'].'"/>
                                                        <input type="hidden" name="product_name" value="'.$productName.'"/>
                                                        <input type="hidden" name="current_stock" value="'.$currentStock.'"/>
                                                        <input type="hidden" name="current_price" value="'.$currentPrice.'"/>
                                                        <button type="sumit" class="text-sm text-blue-600 hover:text-blue-900 font-medium adjust_button" name="adjustStock">Adjust</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        ';
                                    }
                                }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <script>
            // Add some interactivity
            document.addEventListener('DOMContentLoaded', function() {
                // Add hover effects for table rows
                const tableRows = document.querySelectorAll('tbody tr');
                tableRows.forEach(row => {
                    row.addEventListener('mouseenter', function() {
                        this.style.backgroundColor = '#f9fafb';
                    });
                    row.addEventListener('mouseleave', function() {
                        this.style.backgroundColor = '';
                    });
                });
            });
        </script>
    </body>
</html>