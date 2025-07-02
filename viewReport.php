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
                    <button class="flex items-center space-x-2 px-4 py-2 text-gray-600 hover:text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Today</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <button class="flex items-center space-x-2 px-4 py-2 text-gray-600 hover:text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-50">
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
            <!-- Filter Section -->
            <div class="flex items-center space-x-4 mb-8">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                    </svg>
                    <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-custom-green focus:border-transparent">
                        <option>Sales Report</option>
                        <option>Inventory Report</option>
                        <option>Customer Report</option>
                        <option>Financial Report</option>
                    </select>
                </div>
            </div>

            <!-- Metrics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
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
                    <p class="text-3xl font-bold text-gray-900 mb-2">$12,847</p>
                    <p class="text-sm text-custom-green">+12.5% from last period</p>
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
                    <p class="text-3xl font-bold text-gray-900 mb-2">234</p>
                    <p class="text-sm text-custom-green">+8.2% from last period</p>
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
                    <p class="text-3xl font-bold text-gray-900 mb-2">$54.89</p>
                    <p class="text-sm text-custom-green">+3.1% from last period</p>
                </div>

                <!-- Items Sold -->
                <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-sm font-medium text-gray-600">Items Sold</p>
                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 mb-2">1,456</p>
                    <p class="text-sm text-custom-green">+15.3% from last period</p>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Top Selling Products -->
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

                <!-- Sales by Category -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Sales by Category</h3>
                        <p class="text-sm text-gray-600 mt-1">Revenue breakdown by product category</p>
                    </div>
                    
                    <div class="space-y-6">
                        <!-- Dairy -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-900">Dairy</span>
                                <div class="text-right">
                                    <span class="text-lg font-bold text-custom-green">$3,245</span>
                                    <span class="text-xs text-gray-500 ml-2">25.3%</span>
                                </div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-custom-green h-2 rounded-full" style="width: 75%"></div>
                            </div>
                        </div>

                        <!-- Fruits -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-900">Fruits</span>
                                <div class="text-right">
                                    <span class="text-lg font-bold text-custom-green">$2,890</span>
                                    <span class="text-xs text-gray-500 ml-2">22.5%</span>
                                </div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-custom-green h-2 rounded-full" style="width: 67%"></div>
                            </div>
                        </div>

                        <!-- Vegetables -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-900">Vegetables</span>
                                <div class="text-right">
                                    <span class="text-lg font-bold text-custom-green">$2,156</span>
                                    <span class="text-xs text-gray-500 ml-2">16.8%</span>
                                </div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-custom-green h-2 rounded-full" style="width: 50%"></div>
                            </div>
                        </div>

                        <!-- Bakery -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-900">Bakery</span>
                                <div class="text-right">
                                    <span class="text-lg font-bold text-custom-green">$1,834</span>
                                    <span class="text-xs text-gray-500 ml-2">14.3%</span>
                                </div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-custom-green h-2 rounded-full" style="width: 42%"></div>
                            </div>
                        </div>

                        <!-- Beverages -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-900">Beverages</span>
                                <div class="text-right">
                                    <span class="text-lg font-bold text-custom-green">$1,376</span>
                                    <span class="text-xs text-gray-500 ml-2">10.7%</span>
                                </div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-custom-green h-2 rounded-full" style="width: 32%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sales Trend Chart -->
            <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Sales Trend</h3>
                    <p class="text-sm text-gray-600 mt-1">Daily sales performance over the last 30 days</p>
                </div>
                <div class="h-80">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </main>

        <script>
            // Sales Trend Chart
            const ctx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan 1', 'Jan 5', 'Jan 10', 'Jan 15', 'Jan 20', 'Jan 25', 'Jan 30'],
                    datasets: [{
                        label: 'Daily Sales',
                        data: [400, 450, 380, 520, 480, 550, 600],
                        borderColor: '#22c55e',
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#22c55e',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            border: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f3f4f6'
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                callback: function(value) {
                                    return '$' + value;
                                }
                            }
                        }
                    },
                    elements: {
                        point: {
                            hoverRadius: 8
                        }
                    }
                }
            });

            // Add interactivity
            document.addEventListener('DOMContentLoaded', function() {
                // Animate progress bars on load
                const progressBars = document.querySelectorAll('.bg-custom-green');
                progressBars.forEach((bar, index) => {
                    if (bar.parentElement.classList.contains('bg-gray-200')) {
                        const width = bar.style.width;
                        bar.style.width = '0%';
                        setTimeout(() => {
                            bar.style.transition = 'width 1s ease-in-out';
                            bar.style.width = width;
                        }, index * 200);
                    }
                });

                // Add click handlers for export functionality
                const exportBtn = document.querySelector('button:contains("Export")');
                if (exportBtn) {
                    exportBtn.addEventListener('click', function() {
                        alert('Export functionality would be implemented here');
                    });
                }
            });

            // Simulate real-time updates
            setInterval(() => {
                // Update metrics with slight variations
                const metrics = document.querySelectorAll('.text-3xl');
                metrics.forEach(metric => {
                    if (metric.textContent.includes('$')) {
                        const currentValue = parseFloat(metric.textContent.replace(/[$,]/g, ''));
                        const variation = (Math.random() - 0.5) * 10;
                        const newValue = Math.max(0, currentValue + variation);
                        metric.textContent = '$' + newValue.toLocaleString('en-US', {
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0
                        });
                    }
                });
            }, 10000);
        </script>
    </body>
</html>