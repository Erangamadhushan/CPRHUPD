// Modal functions
function showModal(modalId) {
    document.getElementById('modalBackdrop').classList.remove('hidden');
    document.getElementById(modalId).classList.remove('hidden');
}

function hideModal(modalId) {
    document.getElementById('modalBackdrop').classList.add('hidden');
    document.getElementById(modalId).classList.add('hidden');
}




document.getElementById('processSaleForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Sale processed successfully!');
    hideModal('processSaleModal');
    this.reset();
});



// Initialize dashboard
document.addEventListener('DOMContentLoaded', function() {
    console.log('FreshMart Management Dashboard loaded');
});