<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>EcoTrack Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 font-sans">

    <!-- NAVBAR -->
    <nav class="bg-white shadow px-6 py-4 flex items-center font-Poppins">
        <!-- Kiri: Logo + EcoTrack -->
        <div class="flex items-center gap-3">
            <img src="/logo.png" alt="EcoTrack Logo" class="h-10">
            <span class="text-xl font-semibold text-gray-800">EcoTrack</span>
        </div>

        <!-- Tengah: Field Pencarian yang fleksibel -->
        <div class="flex-grow px-10">
            <input type="text" placeholder="Cari laporan..."
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition">
        </div>

        <!-- Kanan: Ikon dan Profil -->
        <div class="flex items-center gap-6">
            <!-- Icon Pesan -->
            <button class="relative hover:text-green-600 transition">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M21 12H3m0 0l7-7m-7 7l7 7" />
                </svg>
            </button>

            <!-- Icon Notifikasi -->
            <button class="relative hover:text-green-600 transition">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 01-6 0v-1m6 0H9" />
                </svg>
            </button>

            <!-- Nama dan Foto Admin -->
            <div class="flex items-center gap-2">
                <span class="text-gray-700 font-medium">Admin EcoTrack</span>
                <img src="/admin-profile.jpg" alt="Admin Profile"
                    class="w-10 h-10 rounded-full border-2 border-green-500 object-cover">
            </div>
        </div>
    </nav>


    <div class="flex">

        <!-- SIDEBAR -->
        <aside class="w-64 h-screen bg-blue-700 rounded-tr-[60px] flex flex-col justify-between p-4 font-poppins">
            <!-- Navigation -->
            <nav class="mt-10 space-y-5">
                <!-- Dashboard (Active) -->
                <a href="#"
                    class="flex items-center gap-3 bg-white text-green-700 rounded-lg px-4 py-3 font-semibold">
                    <svg class="w-4 h-4" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 16.5H0V0.5H16V16.5Z" stroke="#E5E7EB" />
                        <path
                            d="M14.7063 5.20625C15.0969 4.81563 15.0969 4.18125 14.7063 3.79063C14.3156 3.4 13.6812 3.4 13.2906 3.79063L10 7.08437L8.20625 5.29063C7.81563 4.9 7.18125 4.9 6.79063 5.29063L3.29063 8.79062C2.9 9.18125 2.9 9.81563 3.29063 10.2063C3.68125 10.5969 4.31563 10.5969 4.70625 10.2063L7.5 7.41563L9.29375 9.20938C9.68437 9.6 10.3188 9.6 10.7094 9.20938L14.7094 5.20937L14.7063 5.20625Z"
                            fill="#1E7F55" />
                    </svg>
                    Dashboard
                </a>

                <!-- Data Laporan -->
                <a href="#" class="flex items-center gap-3 text-white px-4 py-2 hover:text-green-300 transition">
                    <svg class="w-3 h-4" viewBox="0 0 12 17" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2 0.5C0.896875 0.5 0 1.39688 0 2.5V14.5C0 15.6031 0.896875 16.5 2 16.5H10C11.1031 16.5 12 15.6031 12 14.5V5.5H8C7.44688 5.5 7 5.05312 7 4.5V0.5H2Z" />
                    </svg>
                    Data Laporan
                </a>

                <!-- EcoTrack Map -->
                <a href="#" class="flex items-center gap-3 text-white px-4 py-2 hover:text-green-300 transition">
                    <svg class="w-4 h-4" viewBox="0 0 18 16" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 16H0V0H18V16Z" stroke="#E5E7EB" />
                        <path d="M12 14.878L6 13.1624V1.12175L12 2.83738V14.878Z" fill="white" />
                    </svg>
                    EcoTrack Map
                </a>

                <!-- Mitra Bank Sampah -->
                <a href="#" class="flex items-center gap-3 text-white px-4 py-2 hover:text-green-300 transition">
                    <svg class="w-4 h-4" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.459 1.41C6.006 0.53 6.969 0 8 0C9.031 0 9.994 0.531 10.541 1.41L11.747 3.337L12.591 2.85C12.853 2.697 13.181 2.719 13.422 2.903C13.663 3.088 13.769 3.4 13.691 3.694L12.959 6.425C12.853 6.825 12.441 7.063 12.041 6.956L9.309 6.225C9.016 6.147 8.8 5.9 8.759 5.6C8.719 5.3 8.866 5.003 9.128 4.853L10.016 4.341L8.844 2.469C8.662 2.178 8.344 2 8 2C7.656 2 7.338 2.178 7.156 2.469L6.609 3.344C6.322 3.806 5.716 3.953 5.247 3.672C4.769 3.384 4.616 2.759 4.912 2.284L5.459 1.41Z" />
                    </svg>
                    Mitra Bank Sampah
                </a>

                <!-- Setting Akun -->
                <a href="#" class="flex items-center gap-3 text-white px-4 py-2 hover:text-green-300 transition">
                    <svg class="w-4 h-4" fill="white" viewBox="0 0 24 24">
                        <path
                            d="M12 14.25A2.25 2.25 0 1 0 12 9.75a2.25 2.25 0 0 0 0 4.5ZM21 12c0-.63-.06-1.24-.17-1.83l2.05-1.6a1 1 0 0 0 .24-1.32l-2-3.46a1 1 0 0 0-1.26-.45l-2.42 1a7.97 7.97 0 0 0-1.96-1.13l-.37-2.6A1 1 0 0 0 14 0h-4a1 1 0 0 0-.99.86l-.37 2.6a8.015 8.015 0 0 0-1.96 1.13l-2.42-1a1 1 0 0 0-1.26.45l-2 3.46a1 1 0 0 0 .24 1.32l2.05 1.6c-.11.59-.17 1.22-.17 1.83s.06 1.24.17 1.83l-2.05 1.6a1 1 0 0 0-.24 1.32l2 3.46a1 1 0 0 0 1.26.45l2.42-1c.57.45 1.21.84 1.96 1.13l.37 2.6A1 1 0 0 0 10 24h4a1 1 0 0 0 .99-.86l.37-2.6a7.97 7.97 0 0 0 1.96-1.13l2.42 1a1 1 0 0 0 1.26-.45l2-3.46a1 1 0 0 0-.24-1.32l-2.05-1.6c.11-.59.17-1.22.17-1.83Z" />
                    </svg>
                    Setting Akun
                </a>
            </nav>

            <!-- Download Button -->
            <div class="p-4">
                <button
                    class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition font-medium">
                    Download Data
                </button>
            </div>
        </aside>




        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6">

            <!-- 4 CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="flex items-center space-x-4">
                        <div class="bg-green-100 text-green-700 p-2 rounded-full">
                            📄
                        </div>
                        <div>
                            <h3 class="text-gray-800 font-semibold">Laporan Masuk</h3>
                            <p class="text-xl font-bold">120</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-100 text-blue-700 p-2 rounded-full">
                            🗑️
                        </div>
                        <div>
                            <h3 class="text-gray-800 font-semibold">Titik Sampah</h3>
                            <p class="text-xl font-bold">85</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="flex items-center space-x-4">
                        <div class="bg-green-100 text-green-700 p-2 rounded-full">
                            ♻️
                        </div>
                        <div>
                            <h3 class="text-gray-800 font-semibold">Bank Sampah Aktif</h3>
                            <p class="text-xl font-bold">32</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-100 text-blue-700 p-2 rounded-full">
                            🏭
                        </div>
                        <div>
                            <h3 class="text-gray-800 font-semibold">TPA Terdaftar</h3>
                            <p class="text-xl font-bold">14</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- STATISTIK -->
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-green-700">Statistik Laporan</h2>
                    <select id="chartType" class="border rounded px-3 py-2 text-sm">
                        <option value="harian">Harian</option>
                        <option value="bulanan">Bulanan</option>
                        <option value="tahunan">Tahunan</option>
                    </select>
                </div>
                <canvas id="laporanChart" height="100"></canvas>
            </div>

            <!-- DAFTAR LAPORAN & AKTIVITAS -->
            <div class="flex flex-col lg:flex-row gap-6">

                <!-- Laporan Masuk -->
                <div class="bg-white rounded-lg shadow p-4 flex-1 overflow-auto max-w-full">
                    <h2 class="text-lg font-semibold mb-4 text-green-700">Daftar Laporan Masuk</h2>
                    <table class="w-full text-sm text-left table-auto border-collapse border border-gray-200">
                        <thead class="bg-gray-50 text-gray-600">
                            <tr>
                                <th class="px-3 py-2 border border-gray-200">ID</th>
                                <th class="px-3 py-2 border border-gray-200">Nama</th>
                                <th class="px-3 py-2 border border-gray-200">Email</th>
                                <th class="px-3 py-2 border border-gray-200">Lokasi</th>
                                <th class="px-3 py-2 border border-gray-200">Jenis Sampah</th>
                                <th class="px-3 py-2 border border-gray-200">Ukuran</th>
                                <th class="px-3 py-2 border border-gray-200">Urgensi</th>
                                <th class="px-3 py-2 border border-gray-200 max-w-xs">Deskripsi</th>
                                <th class="px-3 py-2 border border-gray-200">Foto</th>
                                <th class="px-3 py-2 border border-gray-200">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-t hover:bg-gray-50">
                                <td>#101</td>
                                <td>Andi</td>
                                <td>andi@mail.com</td>
                                <td>Surabaya, Rungkut</td>
                                <td>Organik</td>
                                <td>1 Karung</td>
                                <td><span class="text-red-600 font-semibold">Tinggi</span></td>
                                <td>Sampah menumpuk di selokan depan rumah warga.</td>
                                <td>
                                    <img src="/foto-sampah1.jpg" alt="Foto Sampah"
                                        class="w-16 h-16 object-cover rounded">
                                </td>
                                <td class="py-2 px-3 space-y-1">
                                    <button
                                        class="w-full max-w-[100px] text-center px-2 py-1 text-xs font-semibold rounded-md
                                            transition-colors duration-200
                                            bg-green-600 hover:bg-green-700 text-white
                                            focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-1"
                                        type="button">
                                        Tangani
                                    </button>
                                </td>
                            </tr>


                            <tr class="border-t hover:bg-gray-50">
                                <td>#102</td>
                                <td>Siti</td>
                                <td>siti@mail.com</td>
                                <td>Malang, Blimbing</td>
                                <td>Anorganik</td>
                                <td>3 Karung</td>
                                <td><span class="text-yellow-500 font-semibold">Sedang</span></td>
                                <td>Botol plastik dan sampah rumah tangga lainnya di pinggir jalan.</td>
                                <td>
                                    <img src="/foto-sampah2.jpg" alt="Foto Sampah"
                                        class="w-16 h-16 object-cover rounded">
                                </td>
                                <td class="py-2 px-3 space-y-1">
                                    <button
                                        class="w-full max-w-[100px] text-center px-2 py-1 text-xs font-semibold rounded-md
                                        transition-colors duration-200
                                        bg-green-600 hover:bg-green-700 text-white
                                        focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-1"
                                        type="button">
                                        Tangani
                                    </button>
                                </td>
                            </tr>

                            <!-- Baris lain... -->
                        </tbody>
                    </table>
                </div>

                <!-- Aktivitas Petugas -->
                <div class="bg-white rounded-lg shadow p-6 w-full lg:w-1/3 max-h-[480px] overflow-y-auto">
                    <h2 class="text-xl font-semibold mb-6 text-green-700">Aktivitas Petugas</h2>
                    <ul class="space-y-6 text-gray-700 text-base">
                        <li class="flex items-center space-x-5">
                            <img src="/petugas-fajar.jpg" alt="Fajar"
                                class="w-14 h-14 rounded-full object-cover border-4 border-green-500 flex-shrink-0" />
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">
                                    Fajar <span class="font-normal text-lg text-green-600">menyelesaikan laporan
                                        #102</span>
                                </p>
                                <p class="text-sm text-gray-500">2 jam lalu</p>
                            </div>
                        </li>
                        <li class="flex items-center space-x-5">
                            <img src="/petugas-nina.jpg" alt="Nina"
                                class="w-14 h-14 rounded-full object-cover border-4 border-yellow-400 flex-shrink-0" />
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">
                                    Nina <span class="font-normal text-lg text-yellow-600">meninjau laporan #102</span>
                                </p>
                                <p class="text-sm text-gray-500">45 menit lalu</p>
                            </div>
                        </li>
                        <li class="flex items-center space-x-5">
                            <img src="/petugas-budi.jpg" alt="Budi"
                                class="w-14 h-14 rounded-full object-cover border-4 border-red-500 flex-shrink-0" />
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">
                                    Budi <span class="font-normal text-lg text-red-600">membersihkan laporan
                                        #103</span>
                                </p>
                                <p class="text-sm text-gray-500">30 menit lalu</p>
                            </div>
                        </li>
                        <!-- Tambah aktivitas lainnya -->
                    </ul>
                </div>



            </div>


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

</body>

</html>
