<?php
    // start session if does not start a session yet
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // include database connection
    include_once 'config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reports & Analytics</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'custom-green': '#22c55e',
                            'custom-blue': '#3b82f6',
                            'custom-gray': '#6b7280'
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
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-custom-green rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h1 class="text-xl font-semibold text-gray-900">Reports & Analytics</h1>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="border border-green-500 group rounded px-3 py-2 hover:bg-green-500 flex items-center space-x-1">
                        <i class="fas fa-home mr-1"></i>
                        <a href="dashboard.php" class="group-hover:text-white">Dashboard</a>
                    </span>
                    
                    <button class="flex items-center space-x-2 px-4 py-2 text-gray-600 hover:text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-50" onclick="javascript:window.print();">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Export</span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="p-6">
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-900">Sales Overview</h2>
                <p class="text-sm text-gray-600 mt-1">Analyze sales performance and trends over time</p>
            </div>

            <!-- Metrics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Total Sales -->
                <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-sm font-medium text-gray-600">Total Sales</p>
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-custom-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 mb-2">$
                        <!-- Fetch Summation of total transactions -->
                        <?php
                            $sql = "SELECT SUM(paymentTotal) AS totalSales FROM transaction";
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                echo number_format($row['totalSales'], 2);
                            } else {
                                echo "0.00";
                            }
                        ?>
                    </p>
                    <p class="text-sm text-custom-green">
                        <!-- Fetch Summation of total transactions -->
                        <?php
                            $sql = "SELECT SUM(paymentTotal) AS totalSales FROM transaction WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                echo "+".number_format($row['totalSales'] * 0.05, 2)." from last period";
                            } else {
                                echo "0.00";
                            }
                        ?>
                    </p>
                </div>

                <!-- Transactions -->
                <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-sm font-medium text-gray-600">Transactions</p>
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-custom-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17M17 13v4a2 2 0 01-2 2H9a2 2 0 01-2-2v-4m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 mb-2">
                        <!-- Fetch Summation of total transactions -->
                        <?php
                            $sql = "SELECT COUNT(distinct transactionId) AS totalSales FROM transaction";
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                echo number_format($row['totalSales'], 0);
                            } else {
                                echo "0.00";
                            }
                        ?>
                    </p>
                    <p class="text-sm text-custom-green">
                        <!-- Fetch Summation of total transactions -->
                        <?php
                            $sql = "SELECT SUM(distinct transactionId) AS totalSales FROM transaction WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                echo "+".number_format($row['totalSales'] * 0.05, 0)." from last period";
                            } else {
                                echo "0.00";
                            }
                        ?>
                    </p>
                </div>

                <!-- Average Sale -->
                <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-sm font-medium text-gray-600">Average Sale</p>
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 mb-2">$
                        <?php
                            $sql = "SELECT AVG(paymentTotal) AS averageSale FROM transaction";
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                echo number_format($row['averageSale'], 2);
                            } else {
                                echo "0.00";
                            }
                        ?>
                    </p>
                    <p class="text-sm text-custom-green">
                        <?php
                            $sql = "SELECT AVG(paymentTotal) AS averageSale FROM transaction WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                echo "+".number_format($row['averageSale'] * 0.05, 2)." from last period";
                            } else {
                                echo "0.00";
                            }
                        ?>
                    </p>
                </div>

            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Top Selling Products</h3>
                    <p class="text-sm text-gray-600 mt-1">Best performing products for the selected period</p>
                </div>
                
                <div class="space-y-6">
                    <!-- Fresh Milk -->
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Fresh Milk (1L)</p>
                            <p class="text-xs text-gray-500">Dairy</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900">45 sold</p>
                            <p class="text-xs text-custom-green">$179.55</p>
                        </div>
                    </div>

                    <!-- Whole Wheat Bread -->
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Whole Wheat Bread</p>
                            <p class="text-xs text-gray-500">Bakery</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900">38 sold</p>
                            <p class="text-xs text-custom-green">$94.62</p>
                        </div>
                    </div>

                    <!-- Organic Bananas -->
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Organic Bananas (1kg)</p>
                            <p class="text-xs text-gray-500">Fruits</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900">32 sold</p>
                            <p class="text-xs text-custom-green">$159.68</p>
                        </div>
                    </div>

                    <!-- Free Range Eggs -->
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Free Range Eggs (12pc)</p>
                            <p class="text-xs text-gray-500">Dairy</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900">28 sold</p>
                            <p class="text-xs text-custom-green">$167.72</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </main>

        <script src="scripts/report.js"></script>
    </body>
</html>