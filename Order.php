<?php
    session_start();
?>
<?php
    include('./components/common/header.php')
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Point of Sale System</title>
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
                    <h1 class="text-xl font-semibold text-gray-800">Point of Sale</h1>
                </div>
                <div class="flex items-center space-x-4 text-sm text-gray-600">
                    <span>Cashier: <strong>Admin</strong></span>
                    <span>Terminal: <strong>001</strong></span>
                </div>
            </div>
        </header>

        <div class="flex h-screen pt-16">
            <div class="flex-1 p-6 overflow-y-auto">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Product Search</h2>
                    <div class="relative">
                        <input 
                            type="text" 
                            id="searchInput"
                            placeholder="Search products or scan barcode..." 
                            class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        >
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Products Grid -->
                <div id="productsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Products will be populated here -->
                </div>
            </div>

            <!-- Cart Sidebar -->
            <div class="w-96 bg-white shadow-lg border-l">
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
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span>Subtotal:</span>
                            <span id="subtotal">$0.00</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>Tax (8%):</span>
                            <span id="tax">$0.00</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold border-t pt-2">
                            <span>Total:</span>
                            <span id="total" class="text-green-600">$0.00</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <input 
                            type="text" 
                            id="customerName"
                            placeholder="Enter customer name" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm"
                        >
                        <button 
                            id="processPayment"
                            class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-medium transition-colors flex items-center justify-center"
                        >
                            <i class="fas fa-credit-card mr-2"></i>
                            Process Payment
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script type="module" src="scripts/main.js"></script>
        <script>
            // Sample product data
            const products = [
                { id: 1, name: "Fresh Milk (1L)", category: "Dairy", price: 3.99, stock: 45 },
                { id: 2, name: "Whole Wheat Bread", category: "Bakery", price: 2.49, stock: 8 },
                { id: 3, name: "Organic Bananas (1kg)", category: "Fruits", price: 4.99, stock: 67 },
                { id: 4, name: "Free Range Eggs (12pc)", category: "Dairy", price: 5.99, stock: 23 },
                { id: 5, name: "Olive Oil (500ml)", category: "Pantry", price: 8.99, stock: 34 },
                { id: 6, name: "Tomatoes (1kg)", category: "Vegetables", price: 3.49, stock: 45 },
                { id: 7, name: "Chicken Breast (1kg)", category: "Meat", price: 12.99, stock: 15 },
                { id: 8, name: "Greek Yogurt (500g)", category: "Dairy", price: 4.49, stock: 28 }
            ];

            let cart = [];
            let filteredProducts = [...products];

            // DOM Elements
            const productsGrid = document.getElementById('productsGrid');
            const cartItems = document.getElementById('cartItems');
            const cartCount = document.getElementById('cartCount');
            const subtotal = document.getElementById('subtotal');
            const tax = document.getElementById('tax');
            const total = document.getElementById('total');
            const searchInput = document.getElementById('searchInput');
            const clearCart = document.getElementById('clearCart');
            const processPayment = document.getElementById('processPayment');

            // Category colors
            const categoryColors = {
                'Dairy': 'bg-blue-100 text-blue-800',
                'Bakery': 'bg-yellow-100 text-yellow-800',
                'Fruits': 'bg-green-100 text-green-800',
                'Vegetables': 'bg-green-100 text-green-800',
                'Meat': 'bg-red-100 text-red-800',
                'Pantry': 'bg-purple-100 text-purple-800'
            };

            // Render products
            function renderProducts() {
                productsGrid.innerHTML = filteredProducts.map(product => `
                    <div class="product-card bg-white rounded-lg shadow-sm border hover:shadow-md cursor-pointer" onclick="addToCart(${product.id})">
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-medium text-gray-900">${product.name}</h4>
                                <span class="text-xs px-2 py-1 rounded-full ${categoryColors[product.category] || 'bg-gray-100 text-gray-800'}">${product.category}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-green-600">$${product.price.toFixed(2)}</span>
                                <span class="text-sm text-gray-500">${product.stock} in stock</span>
                            </div>
                        </div>
                    </div>
                `).join('');
            }

            // Add to cart
            function addToCart(productId) {
                const product = products.find(p => p.id === productId);
                const existingItem = cart.find(item => item.id === productId);
                
                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    cart.push({ ...product, quantity: 1 });
                }
                
                updateCart();
            }

            // Remove from cart
            function removeFromCart(productId) {
                cart = cart.filter(item => item.id !== productId);
                updateCart();
            }

            // Update quantity
            function updateQuantity(productId, change) {
                const item = cart.find(item => item.id === productId);
                if (item) {
                    item.quantity += change;
                    if (item.quantity <= 0) {
                        removeFromCart(productId);
                    } else {
                        updateCart();
                    }
                }
            }

            // Update cart display
            function updateCart() {
                cartCount.textContent = cart.reduce((sum, item) => sum + item.quantity, 0);
                
                cartItems.innerHTML = cart.map(item => `
                    <div class="cart-item bg-gray-50 rounded-lg p-3">
                        <div class="flex justify-between items-start mb-2">
                            <h5 class="font-medium text-sm text-gray-900">${item.name}</h5>
                            <button onclick="removeFromCart(${item.id})" class="text-red-500 hover:text-red-700 text-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">$${item.price.toFixed(2)} each</span>
                            <span class="font-bold">$${(item.price * item.quantity).toFixed(2)}</span>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center space-x-2">
                                <button onclick="updateQuantity(${item.id}, -1)" class="w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center">
                                    <i class="fas fa-minus text-xs"></i>
                                </button>
                                <span class="w-8 text-center font-medium">${item.quantity}</span>
                                <button onclick="updateQuantity(${item.id}, 1)" class="w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center">
                                    <i class="fas fa-plus text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `).join('');

                updateTotals();
            }

            // Update totals
            function updateTotals() {
                const subtotalAmount = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                const taxAmount = subtotalAmount * 0.08;
                const totalAmount = subtotalAmount + taxAmount;

                subtotal.textContent = `$${subtotalAmount.toFixed(2)}`;
                tax.textContent = `$${taxAmount.toFixed(2)}`;
                total.textContent = `$${totalAmount.toFixed(2)}`;
            }

            // Search functionality
            searchInput.addEventListener('input', (e) => {
                const query = e.target.value.toLowerCase();
                filteredProducts = products.filter(product => 
                    product.name.toLowerCase().includes(query) ||
                    product.category.toLowerCase().includes(query)
                );
                renderProducts();
            });

            // Clear cart
            clearCart.addEventListener('click', () => {
                cart = [];
                updateCart();
            });

            // Process payment
            processPayment.addEventListener('click', () => {
                if (cart.length === 0) {
                    alert('Cart is empty!');
                    return;
                }
                
                const customerName = document.getElementById('customerName').value;
                const totalAmount = document.getElementById('total').textContent;
                
                // Here you would integrate with your PHP backend
                alert(`Payment processed!\nCustomer: ${customerName || 'Walk-in'}\nTotal: ${totalAmount}`);
                
                // Clear cart after payment
                cart = [];
                updateCart();
                document.getElementById('customerName').value = '';
            });

            // Initialize
            renderProducts();
            updateCart();
        </script>
    </body>
</html>