<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-10">

    <div class="max-w-4xl mx-auto">

        <!-- Header -->
        <div class="mb-6">
            <p class="text-sm text-gray-500">Sales performance</p>
            <h1 class="text-2xl font-bold text-gray-800">Monthly Overview</h1>
        </div>

        <!-- Stat Cards -->
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                <p class="text-xs text-gray-500 mb-1">Total Revenue</p>
                <p class="text-2xl font-bold text-gray-800" id="totalRev">$0</p>
                <p class="text-xs text-gray-400 mt-1">All months combined</p>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                <p class="text-xs text-gray-500 mb-1">Best Month</p>
                <p class="text-2xl font-bold text-gray-800" id="bestMonth">—</p>
                <p class="text-xs text-gray-400 mt-1" id="bestVal"></p>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                <p class="text-xs text-gray-500 mb-1">Monthly Average</p>
                <p class="text-2xl font-bold text-gray-800" id="avgRev">$0</p>
                <p class="text-xs text-gray-400 mt-1">Per month</p>
            </div>
        </div>

        <!-- Chart Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm font-semibold text-gray-700">Total Sales ($)</p>
                <div class="flex items-center gap-3">
                    <span class="text-xs bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full font-medium">
                        ↑ Live data
                    </span>
                    <select id="chartType" class="text-sm border border-gray-200 rounded-lg px-2 py-1 text-gray-600 focus:outline-none focus:ring-2 focus:ring-emerald-300">
                        <option value="line">Line</option>
                        <option value="bar">Bar</option>
                    </select>
                </div>
            </div>
            <canvas id="salesChart" style="max-height: 280px;"></canvas>
        </div>

    </div>

    <script>
        const labels = @json($labels);
        const data = @json($data).map(Number);

        // Stat cards
        const total = data.reduce((a, b) => a + b, 0);
        const avg = Math.round(total / data.length);
        const maxIdx = data.indexOf(Math.max(...data));

        document.getElementById('totalRev').textContent = '$' + total.toLocaleString();
        document.getElementById('avgRev').textContent = '$' + avg.toLocaleString();
        document.getElementById('bestMonth').textContent = labels[maxIdx];
        document.getElementById('bestVal').textContent = '$' + data[maxIdx].toLocaleString();

        // Chart
        const ctx = document.getElementById('salesChart').getContext('2d');

        let chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Sales ($)',
                    data: data,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.08)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#10b981',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#374151',
                        bodyColor: '#6b7280',
                        borderColor: 'rgba(0,0,0,0.08)',
                        borderWidth: 1,
                        padding: 10,
                        callbacks: {
                            label: ctx => ' $' + ctx.parsed.y.toLocaleString()
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { color: 'rgba(0,0,0,0.04)' },
                        ticks: { color: '#9ca3af', font: { size: 12 } }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.04)' },
                        ticks: {
                            color: '#9ca3af',
                            font: { size: 12 },
                            callback: v => '$' + v.toLocaleString()
                        }
                    }
                }
            }
        });

        // Chart type toggle
        document.getElementById('chartType').addEventListener('change', function () {
            chart.config.type = this.value;
            chart.data.datasets[0].fill = this.value === 'line';
            chart.update();
        });
    </script>

</body>
</html>