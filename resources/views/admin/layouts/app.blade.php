<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>EcoTrack Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 font-sans">

    <nav class="bg-white shadow px-6 py-4 flex items-center font-Poppins">
        <div class="flex items-center gap-3">
            <img src="/logo.png" alt="EcoTrack Logo" class="h-10">
            <span class="text-xl font-semibold text-gray-800">EcoTrack</span>
        </div>

        <div class="flex-grow px-10">
            <input type="text" placeholder="Cari laporan..."
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition">
        </div>

        <div class="flex items-center gap-6">
            <button class="relative hover:text-green-600 transition">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M21 12H3m0 0l7-7m-7 7l7 7" />
                </svg>
            </button>

            <button class="relative hover:text-green-600 transition">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 01-6 0v-1m6 0H9" />
                </svg>
            </button>

            <div class="flex items-center gap-2">
                <span class="text-gray-700 font-medium">Admin EcoTrack</span>
                <img src="/admin-profile.jpg" alt="Admin Profile"
                    class="w-10 h-10 rounded-full border-2 border-green-500 object-cover">
            </div>
        </div>
    </nav>

    {{-- Main wrapper for sidebar and content --}}
    <div class="flex min-h-[calc(100vh-64px)]"> @include('admin.layouts.sidebar')

        <main class="flex-1 p-6 overflow-y-auto"> {{-- `overflow-y-auto` added here for specific content scrolling if needed --}}
            @yield('content')
        </main>
    </div>

    <script>
        const ctx = document.getElementById('laporanChart').getContext('2d');

        const dataSets = {
            harian: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                data: [100, 200, 150, 300, 250, 400, 350],
                max: 500,
                label: 'Ton / Hari'
            },
            bulanan: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                data: [600, 720, 800, 680, 950, 780, 900, 870, 940, 980, 760, 820],
                max: 1000,
                label: 'Ton / Bulan'
            },
            tahunan: {
                labels: ['2019', '2020', '2021', '2022', '2023', '2024'],
                data: [1200, 2500, 3000, 4500, 7000, 8500],
                max: 9000,
                label: 'Ton / Tahun'
            }
        };

        let current = 'harian';

        let laporanChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dataSets[current].labels,
                datasets: [{
                    label: dataSets[current].label,
                    data: dataSets[current].data,
                    backgroundColor: '#34d399'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: dataSets[current].max
                    }
                }
            }
        });

        document.getElementById('chartType').addEventListener('change', function() {
            const selected = this.value;
            laporanChart.data.labels = dataSets[selected].labels;
            laporanChart.data.datasets[0].data = dataSets[selected].data;
            laporanChart.data.datasets[0].label = dataSets[selected].label;
            laporanChart.options.scales.y.max = dataSets[selected].max;
            laporanChart.update();
        });
    </script>

    {{-- Script untuk toggling sidebar pada layar kecil (jika masih diperlukan) --}}
    <script>
        const sidebar = document.getElementById('sidebar');
        // Pastikan Anda memiliki tombol toggle di navbar atau di main content jika ini untuk mobile
        // Contoh: const toggleBtn = document.getElementById('sidebarToggle');
        // if (toggleBtn) {
        //     toggleBtn.addEventListener('click', () => {
        //         sidebar.classList.toggle('-translate-x-full');
        //     });
        // }
    </script>
</body>

</html>
