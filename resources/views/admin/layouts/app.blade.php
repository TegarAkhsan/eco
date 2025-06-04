<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EcoTrack Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 font-sans font-Poppins">

    <nav class="bg-white shadow px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/EcoTrack_Logo.png') }}" alt="EcoTrack Logo" class="h-10">
        </div>

        <div class="flex items-center gap-6">

            <!-- Ikon notifikasi tetap ada, tetapi tanpa dropdown -->
            <div class="relative">
                <button class="relative hover:text-green-600 transition focus:outline-none">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 01-6 0v-1m6 0H9" />
                    </svg>
                </button>
            </div>

            <!-- Profile user dengan dropdown logout -->
            <div class="relative">
                <button id="profileDropdownButton" class="flex items-center gap-2 focus:outline-none">
                    <span class="text-gray-700 font-medium">{{ Auth::user()->first_name }}</span>
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-blue-500 text-white">
                        {{ substr(Auth::user()->first_name, 0, 1) }}
                    </div>
                </button>
                <div id="profileDropdownMenu"
                    class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                    <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                        @csrf
                        <a href="#" onclick="confirmLogout(event)"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main wrapper for sidebar and content -->
    <div class="flex min-h-[calc(100vh-64px)]">
        @include('admin.layouts.sidebar')

        <main class="flex-1 p-6 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    <script>
        // Dropdown toggle untuk profile user
        document.getElementById('profileDropdownButton').addEventListener('click', function(e) {
            e.preventDefault();
            const dropdown = document.getElementById('profileDropdownMenu');
            dropdown.classList.toggle('hidden');
        });

        // Tutup dropdown profile user saat klik di luar
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdownMenu');
            const button = document.getElementById('profileDropdownButton');
            if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Konfirmasi logout sebelum submit
        function confirmLogout(event) {
            event.preventDefault();
            if (confirm('Apakah Anda yakin ingin logout?')) {
                document.getElementById('logoutForm').submit();
            }
        }

        // Chart logic
        const ctx = document.getElementById('laporanChart')?.getContext('2d');
        if (ctx) {
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

            document.getElementById('chartType')?.addEventListener('change', function() {
                const selected = this.value;
                laporanChart.data.labels = dataSets[selected].labels;
                laporanChart.data.datasets[0].data = dataSets[selected].data;
                laporanChart.data.datasets[0].label = dataSets[selected].label;
                laporanChart.options.scales.y.max = dataSets[selected].max;
                laporanChart.update();
            });
        }

        // Script untuk toggling sidebar pada layar kecil
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.querySelector('.sidebar-toggle');
        if (toggleBtn && sidebar) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
            });
        }
    </script>
</body>

</html>
