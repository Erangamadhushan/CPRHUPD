// Sample product data
// const products = [
//     { id: 1, name: "Fresh Milk (1L)", category: "Dairy", price: 3.99, stock: 45 },
//     { id: 2, name: "Whole Wheat Bread", category: "Bakery", price: 2.49, stock: 8 },
//     { id: 3, name: "Organic Bananas (1kg)", category: "Fruits", price: 4.99, stock: 67 },
//     { id: 4, name: "Free Range Eggs (12pc)", category: "Dairy", price: 5.99, stock: 23 },
//     { id: 5, name: "Olive Oil (500ml)", category: "Pantry", price: 8.99, stock: 34 },
//     { id: 6, name: "Tomatoes (1kg)", category: "Vegetables", price: 3.49, stock: 45 },
//     { id: 7, name: "Chicken Breast (1kg)", category: "Meat", price: 12.99, stock: 15 },
//     { id: 8, name: "Greek Yogurt (500g)", category: "Dairy", price: 4.49, stock: 28 }
// ];

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
    // productsGrid.innerHTML = filteredProducts.map(product => `
    //     <div class="product-card bg-white rounded-lg shadow-sm border hover:shadow-md cursor-pointer" onclick="addToCart(${product.id})">
    //         <div class="p-4">
    //             <div class="flex justify-between items-start mb-2">
    //                 <h4 class="font-medium text-gray-900">${product.name}</h4>
    //                 <span class="text-xs px-2 py-1 rounded-full ${categoryColors[product.category] || 'bg-gray-100 text-gray-800'}">${product.category}</span>
    //             </div>
    //             <div class="flex justify-between items-center">
    //                 <span class="text-lg font-bold text-green-600">$${product.price.toFixed(2)}</span>
    //                 <span class="text-sm text-gray-500">${product.stock} in stock</span>
    //             </div>
    //         </div>
    //     </div>
    // `).join('');
}

// Add to cart
function addToCart(productId, productName, productPrice) {

    const product = cart.find(p => p.id === parseInt(productId));
    if (product) {
        product.quantity += 1;
    } else {
        // add product into the cart
        quantity = 1;
        productId = parseInt(productId);
        productPrice = parseFloat(productPrice);
        cart.push({productId, productName, productPrice, quantity})
    }

    updateCart();
}
// Update cart display
function updateCart() {
    cartCount.textContent = cart.reduce((sum, item) => sum + item.quantity, 0);
    
    cartItems.innerHTML = cart.map(item => `
        <div class="cart-item bg-gray-50 rounded-lg p-3">
            <div class="flex justify-between items-start mb-2">
                <h5 class="font-medium text-sm text-gray-900">${item.productName}</h5>
                <button onclick="removeFromCart(${item.productId})" class="text-red-500 hover:text-red-700 text-sm">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-lg font-bold text-green-600">$${item.productPrice.toFixed(2)}</span>
                <span class="text-sm text-gray-500">Qty: ${item.quantity}</span>
                <span class="text-sm text-gray-500">Total: $${(item.productPrice * item.quantity).toFixed(2)}</span>
                <button onclick="updateQuantity(${item.productId}, 1)" class="text-blue-500 hover:text-blue-700 text-sm"> +</button>
                <button onclick="updateQuantity(${item.productId}, -1)" class="text-blue-500 hover:text-blue-700 text-sm"> -</button>
            </div>
        </div>
    `).join('');

    updateTotals();
}

function updateQuantity(productId, change) {

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