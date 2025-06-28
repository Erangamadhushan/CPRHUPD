<?php
    session_start();
    include_once 'config/authentication.php';
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
                        <span class="text-sm">
                            <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest'; ?>
                        </span>
                    </button>
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-medium text-sm">A</span>
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
                        <p class="text-3xl font-bold text-gray-900 mt-1" id="dailySales">$2,847</p>
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
                        <p class="text-3xl font-bold text-gray-900 mt-1" id="totalCustomers">456</p>
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
                        <p class="text-3xl font-bold text-gray-900 mt-1" id="lowStockCount">23</p>
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
                    if( $_SESSION['role'] === 'cashier' ) {
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
                    } else if( $_SESSION['role'] === 'manager' ) {
                        echo '
                            <div class="metric-card rounded-xl p-6 mt-5 shadow-sm border card-hover transition-all duration-300">
                                <div class="flex items-center">
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <button class="action-card rounded-xl p-6 text-left card-hover transition-all duration-300" onclick="showModal('addProductModal')">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <span class="font-medium text-gray-900">Add New Product</span>
                    </div>
                </button>

                <button class="action-card rounded-xl p-6 text-left card-hover transition-all duration-300" onclick="showModal('processSaleModal')">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8m-8 0a2 2 0 100 4 2 2 0 000-4zm8 0a2 2 0 100 4 2 2 0 000-4z"></path>
                            </svg>
                        </div>
                        <span class="font-medium text-gray-900">Process Sale</span>
                    </div>
                </button>

                <button class="action-card rounded-xl p-6 text-left card-hover transition-all duration-300" onclick="showModal('manageInventoryModal')">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                            </svg>
                        </div>
                        <span class="font-medium text-gray-900">Manage Inventory</span>
                    </div>
                </button>

                <button class="action-card rounded-xl p-6 text-left card-hover transition-all duration-300" onclick="showModal('viewReportsModal')">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <span class="font-medium text-gray-900">View Reports</span>
                    </div>
                </button>
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
                    <div class="sales-item flex items-center justify-between p-3 rounded-lg transition-colors duration-200">
                        <div>
                            <p class="font-medium text-gray-900">#001 - John Doe</p>
                            <p class="text-sm text-gray-500">2 min ago</p>
                        </div>
                        <span class="text-green-600 font-semibold">$45.67</span>
                    </div>
                    <div class="sales-item flex items-center justify-between p-3 rounded-lg transition-colors duration-200">
                        <div>
                            <p class="font-medium text-gray-900">#002 - Jane Smith</p>
                            <p class="text-sm text-gray-500">5 min ago</p>
                        </div>
                        <span class="text-green-600 font-semibold">$23.45</span>
                    </div>
                    <div class="sales-item flex items-center justify-between p-3 rounded-lg transition-colors duration-200">
                        <div>
                            <p class="font-medium text-gray-900">#003 - Mike Johnson</p>
                            <p class="text-sm text-gray-500">8 min ago</p>
                        </div>
                        <span class="text-green-600 font-semibold">$67.89</span>
                    </div>
                </div>
            </div>

            <!-- Low Stock Alert -->
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Low Stock Alert</h3>
                    <span class="text-sm text-gray-500">Items that need restocking</span>
                </div>
                <div class="space-y-3" id="lowStockItems">
                    <div class="low-stock-item p-4 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">Fresh Milk (1L)</p>
                                <p class="text-sm text-gray-600">Dairy</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-red-600 font-semibold">5 units</span>
                                <div class="status-indicator w-2 h-2 bg-red-500 rounded-full"></div>
                            </div>
                        </div>
                    </div>
                    <div class="low-stock-item p-4 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">Whole Wheat Bread</p>
                                <p class="text-sm text-gray-600">Bakery</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-red-600 font-semibold">8 units</span>
                                <div class="status-indicator w-2 h-2 bg-red-500 rounded-full"></div>
                            </div>
                        </div>
                    </div>
                    <div class="low-stock-item p-4 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">Organic Eggs (12pc)</p>
                                <p class="text-sm text-gray-600">Dairy</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-red-600 font-semibold">3 units</span>
                                <div class="status-indicator w-2 h-2 bg-red-500 rounded-full"></div>
                            </div>
                        </div>
                    </div>
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
            <form id="addProductForm">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                            <option value="">Select Category</option>
                            <option value="dairy">Dairy</option>
                            <option value="bakery">Bakery</option>
                            <option value="fruits">Fruits</option>
                            <option value="vegetables">Vegetables</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                        <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity</label>
                        <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
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

    <script>
        // Modal functions
        function showModal(modalId) {
            document.getElementById('modalBackdrop').classList.remove('hidden');
            document.getElementById(modalId).classList.remove('hidden');
        }

        function hideModal(modalId) {
            document.getElementById('modalBackdrop').classList.add('hidden');
            document.getElementById(modalId).classList.add('hidden');
        }

        // Close modal when clicking backdrop
        document.getElementById('modalBackdrop').addEventListener('click', function() {
            const modals = ['addProductModal', 'processSaleModal', 'manageInventoryModal', 'viewReportsModal'];
            modals.forEach(modalId => {
                document.getElementById(modalId).classList.add('hidden');
            });
            this.classList.add('hidden');
        });

        // Form submissions
        document.getElementById('addProductForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Product added successfully!');
            hideModal('addProductModal');
            this.reset();
        });

        document.getElementById('processSaleForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Sale processed successfully!');
            hideModal('processSaleModal');
            this.reset();
        });

        // Simulate real-time updates
        function updateDashboard() {
            // Simulate metric updates
            const metrics = {
                totalProducts: Math.floor(Math.random() * 100) + 1200,
                dailySales: Math.floor(Math.random() * 1000) + 2500,
                totalCustomers: Math.floor(Math.random() * 50) + 400,
                lowStockCount: Math.floor(Math.random() * 10) + 20
            };

            // Update only if elements exist
            const elements = {
                totalProducts: document.getElementById('totalProducts'),
                dailySales: document.getElementById('dailySales'),
                totalCustomers: document.getElementById('totalCustomers'),
                lowStockCount: document.getElementById('lowStockCount')
            };

            if (elements.totalProducts) elements.totalProducts.textContent = metrics.totalProducts.toLocaleString();
            if (elements.dailySales) elements.dailySales.textContent = '$' + metrics.dailySales.toLocaleString();
            if (elements.totalCustomers) elements.totalCustomers.textContent = metrics.totalCustomers.toLocaleString();
            if (elements.lowStockCount) elements.lowStockCount.textContent = metrics.lowStockCount.toString();
        }

        // Update dashboard every 30 seconds
        setInterval(updateDashboard, 30000);

        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            console.log('FreshMart Management Dashboard loaded');
        });
    </script>
</body>
</html>