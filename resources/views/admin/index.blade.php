@extends('admin.layouts.app') {{-- Ini memberitahu Blade untuk menggunakan app.blade.php sebagai layout --}}

@section('content')
    {{-- Konten di dalam section ini akan dimasukkan ke dalam @yield('content') di app.blade.php --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 group">
            <div class="flex items-center space-x-4">
                <div class="bg-green-100 text-green-700 p-3 rounded-full text-2xl group-hover:scale-110 transition">
                    📄
                </div>
                <div>
                    <h3 class="text-gray-700 font-semibold text-sm">Laporan Masuk</h3>
                    <p class="text-2xl font-bold text-gray-900">120</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 group">
            <div class="flex items-center space-x-4">
                <div class="bg-blue-100 text-blue-700 p-3 rounded-full text-2xl group-hover:scale-110 transition">
                    🗑️
                </div>
                <div>
                    <h3 class="text-gray-700 font-semibold text-sm">Titik Sampah</h3>
                    <p class="text-2xl font-bold text-gray-900">85</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 group">
            <div class="flex items-center space-x-4">
                <div class="bg-green-100 text-green-700 p-3 rounded-full text-2xl group-hover:scale-110 transition">
                    ♻️
                </div>
                <div>
                    <h3 class="text-gray-700 font-semibold text-sm">Bank Sampah Aktif</h3>
                    <p class="text-2xl font-bold text-gray-900">32</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 group">
            <div class="flex items-center space-x-4">
                <div class="bg-blue-100 text-blue-700 p-3 rounded-full text-2xl group-hover:scale-110 transition">
                    🏭
                </div>
                <div>
                    <h3 class="text-gray-700 font-semibold text-sm">TPA Terdaftar</h3>
                    <p class="text-2xl font-bold text-gray-900">14</p>
                </div>
            </div>
        </div>
    </div>

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

    <div class="flex flex-col lg:flex-row gap-6">

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
                            <img src="/foto-sampah1.jpg" alt="Foto Sampah" class="w-16 h-16 object-cover rounded">
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
                            <img src="/foto-sampah2.jpg" alt="Foto Sampah" class="w-16 h-16 object-cover rounded">
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

                </tbody>
            </table>
        </div>

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
            </ul>
        </div>
    </div>
@endsection
