@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold mb-6">Dashboard Data</h1>

        <div class="bg-[#0b1121]/50 p-6 rounded-lg mb-8">
            <div class="flex flex-col md:flex-row gap-4 mb-4">
                <div class="md:w-1/4">
                    <label for="region" class="block text-sm font-medium mb-2">Wilayah</label>
                    <select id="region" name="region"
                        class="w-full px-4 py-2 rounded-lg bg-[#1e293b] border border-gray-700 focus:outline-none focus:ring-2 focus:ring-[#22b07d]">
                        <option value="all">Semua Wilayah</option>
                        <option value="jakarta">Jakarta</option>
                        <option value="bandung">Bandung</option>
                        <option value="surabaya">Surabaya</option>
                        <option value="medan">Medan</option>
                        <option value="makassar">Makassar</option>
                    </select>
                </div>
                <div class="md:w-1/4">
                    <label for="period" class="block text-sm font-medium mb-2">Periode</label>
                    <select id="period" name="period"
                        class="w-full px-4 py-2 rounded-lg bg-[#1e293b] border border-gray-700 focus:outline-none focus:ring-2 focus:ring-[#22b07d]">
                        <option value="week">Minggu Ini</option>
                        <option value="month" selected>Bulan Ini</option>
                        <option value="quarter">3 Bulan Terakhir</option>
                        <option value="year">Tahun Ini</option>
                        <option value="custom">Kustom</option>
                    </select>
                </div>
                <div class="md:w-1/4">
                    <label for="type" class="block text-sm font-medium mb-2">Jenis Data</label>
                    <select id="type" name="type"
                        class="w-full px-4 py-2 rounded-lg bg-[#1e293b] border border-gray-700 focus:outline-none focus:ring-2 focus:ring-[#22b07d]">
                        <option value="all">Semua Jenis</option>
                        <option value="reports">Laporan Titik Sampah</option>
                        <option value="collections">Pengumpulan Sampah</option>
                        <option value="recycling">Daur Ulang</option>
                    </select>
                </div>
                <div class="md:w-1/4">
                    <label for="format" class="block text-sm font-medium mb-2">Format</label>
                    <select id="format" name="format"
                        class="w-full px-4 py-2 rounded-lg bg-[#1e293b] border border-gray-700 focus:outline-none focus:ring-2 focus:ring-[#22b07d]">
                        <option value="chart">Grafik</option>
                        <option value="table">Tabel</option>
                        <option value="map">Peta</option>
                    </select>
                </div>
            </div>
            <button class="bg-[#22b07d] hover:bg-[#1c9d6e] text-white px-6 py-2 rounded-lg transition duration-300">Terapkan
                Filter</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-[#0b1121]/50 p-6 rounded-lg">
                <h3 class="text-lg font-medium mb-2">Total Laporan</h3>
                <p class="text-3xl font-bold">1,247</p>
                <p class="text-sm text-green-500">+12.5% dari bulan lalu</p>
            </div>
            <div class="bg-[#0b1121]/50 p-6 rounded-lg">
                <h3 class="text-lg font-medium mb-2">Titik Ditangani</h3>
                <p class="text-3xl font-bold">876</p>
                <p class="text-sm text-green-500">+8.3% dari bulan lalu</p>
            </div>
            <div class="bg-[#0b1121]/50 p-6 rounded-lg">
                <h3 class="text-lg font-medium mb-2">Total Sampah (kg)</h3>
                <p class="text-3xl font-bold">24,680</p>
                <p class="text-sm text-green-500">+15.2% dari bulan lalu</p>
            </div>
            <div class="bg-[#0b1121]/50 p-6 rounded-lg">
                <h3 class="text-lg font-medium mb-2">Didaur Ulang (kg)</h3>
                <p class="text-3xl font-bold">12,345</p>
                <p class="text-sm text-green-500">+18.7% dari bulan lalu</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="bg-[#0b1121]/50 p-6 rounded-lg">
                <h3 class="text-xl font-bold mb-4">Tren Laporan Titik Sampah</h3>
                <div class="bg-[#d9d9d9] h-64 rounded-lg">
                    <!-- This would be replaced with an actual chart implementation -->
                    <div
                        class="w-full h-full flex items-center justify-center bg-gray-300 text-gray-700 text-lg font-medium">
                        Chart: Tren Laporan Titik Sampah
                    </div>
                </div>
            </div>
            <div class="bg-[#0b1121]/50 p-6 rounded-lg">
                <h3 class="text-xl font-bold mb-4">Komposisi Jenis Sampah</h3>
                <div class="bg-[#d9d9d9] h-64 rounded-lg">
                    <!-- This would be replaced with an actual chart implementation -->
                    <div
                        class="w-full h-full flex items-center justify-center bg-gray-300 text-gray-700 text-lg font-medium">
                        Chart: Komposisi Jenis Sampah
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-[#0b1121]/50 p-6 rounded-lg mb-8">
            <h3 class="text-xl font-bold mb-4">Heatmap Titik Sampah</h3>
            <div class="bg-[#d9d9d9] h-96 rounded-lg">
                <!-- This would be replaced with an actual heatmap implementation -->
                <div class="w-full h-full flex items-center justify-center bg-gray-300 text-gray-700 text-lg font-medium">
                    Heatmap: Persebaran Titik Sampah
                </div>
            </div>
        </div>

        <div class="bg-[#0b1121]/50 p-6 rounded-lg">
            <h3 class="text-xl font-bold mb-4">Laporan Terbaru</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b border-gray-700">
                            <th class="pb-3">ID</th>
                            <th class="pb-3">Lokasi</th>
                            <th class="pb-3">Jenis</th>
                            <th class="pb-3">Ukuran</th>
                            <th class="pb-3">Status</th>
                            <th class="pb-3">Tanggal</th>
                            <th class="pb-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-700">
                            <td class="py-3">#12345</td>
                            <td class="py-3">Jakarta Timur</td>
                            <td class="py-3">Organik</td>
                            <td class="py-3">Sedang</td>
                            <td class="py-3"><span
                                    class="px-2 py-1 bg-yellow-600 text-white text-xs rounded-full">Proses</span></td>
                            <td class="py-3">2023-05-10</td>
                            <td class="py-3"><a href="#" class="text-[#22b07d] hover:underline">Detail</a></td>
                        </tr>
                        <tr class="border-b border-gray-700">
                            <td class="py-3">#12344</td>
                            <td class="py-3">Jakarta Selatan</td>
                            <td class="py-3">B3</td>
                            <td class="py-3">Kecil</td>
                            <td class="py-3"><span
                                    class="px-2 py-1 bg-green-600 text-white text-xs rounded-full">Selesai</span></td>
                            <td class="py-3">2023-05-09</td>
                            <td class="py-3"><a href="#" class="text-[#22b07d] hover:underline">Detail</a></td>
                        </tr>
                        <tr class="border-b border-gray-700">
                            <td class="py-3">#12343</td>
                            <td class="py-3">Jakarta Barat</td>
                            <td class="py-3">Anorganik</td>
                            <td class="py-3">Besar</td>
                            <td class="py-3"><span
                                    class="px-2 py-1 bg-blue-600 text-white text-xs rounded-full">Verifikasi</span></td>
                            <td class="py-3">2023-05-08</td>
                            <td class="py-3"><a href="#" class="text-[#22b07d] hover:underline">Detail</a></td>
                        </tr>
                        <tr class="border-b border-gray-700">
                            <td class="py-3">#12342</td>
                            <td class="py-3">Jakarta Utara</td>
                            <td class="py-3">Campuran</td>
                            <td class="py-3">Sedang</td>
                            <td class="py-3"><span
                                    class="px-2 py-1 bg-red-600 text-white text-xs rounded-full">Kritis</span></td>
                            <td class="py-3">2023-05-07</td>
                            <td class="py-3"><a href="#" class="text-[#22b07d] hover:underline">Detail</a></td>
                        </tr>
                        <tr>
                            <td class="py-3">#12341</td>
                            <td class="py-3">Jakarta Pusat</td>
                            <td class="py-3">Organik</td>
                            <td class="py-3">Kecil</td>
                            <td class="py-3"><span
                                    class="px-2 py-1 bg-green-600 text-white text-xs rounded-full">Selesai</span></td>
                            <td class="py-3">2023-05-06</td>
                            <td class="py-3"><a href="#" class="text-[#22b07d] hover:underline">Detail</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-4 text-center">
                <a href="#" class="text-[#22b07d] hover:underline">Lihat Semua Laporan</a>
            </div>
        </div>
    </div>
@endsection
