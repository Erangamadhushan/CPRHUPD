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