@extends('admin.layouts.app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 group">
            <div class="flex items-center space-x-4">
                <div class="bg-green-100 text-green-700 p-3 rounded-full text-2xl group-hover:scale-110 transition">
                    📄
                </div>
                <div>
                    <h3 class="text-gray-700 font-semibold text-sm">Laporan Masuk / titik sampah</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalReports ?? 7 }}</p> <!-- Nilai statis: 7 -->
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
                    <p class="text-2xl font-bold text-gray-900">{{ $activeWasteBanks ?? 32 }}</p> <!-- Nilai statis: 32 -->
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
                    <p class="text-2xl font-bold text-gray-900">{{ $registeredTPAs ?? 14 }}</p> <!-- Nilai statis: 14 -->
                </div>
            </div>
        </div>
    </div>

    <section class="mt-6 px-0 max-w-full font-poppins">
        <div class="bg-white rounded-xl shadow px-6 py-8">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Daftar Laporan</h2>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div class="w-full sm:w-1/2">
                    <input type="text" id="reportSearch" placeholder="Cari laporan berdasarkan lokasi atau ID..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition" />
                </div>

                <div class="w-full sm:w-1/4">
                    <select id="reportStatusFilter"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                        <option value="">Semua Status</option>
                        <option value="Menunggu">Menunggu</option>
                        <option value="Verifikasi">Verifikasi</option>
                        <option value="Ditinjau">Ditinjau</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
                <table class="min-w-full bg-white text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-6 py-3">ID Laporan</th>
                            <th class="px-6 py-3">Lokasi</th>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="reportsTableBody" class="divide-y divide-gray-200">
                        @if (isset($reports) && $reports->isNotEmpty())
                            @foreach ($reports as $report)
                                <tr>
                                    <td class="px-6 py-4">#LPR{{ str_pad($report->id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-6 py-4">{{ $report->location ?? '' }}</td>
                                    <td class="px-6 py-4">
                                        {{ $report->created_at ? $report->created_at->format('d M Y') : '' }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full
                                            {{ $report->status == 'Menunggu'
                                                ? 'bg-yellow-100 text-yellow-800'
                                                : ($report->status == 'Verifikasi'
                                                    ? 'bg-blue-100 text-blue-800'
                                                    : 'bg-green-100 text-green-800') }}">
                                            {{ $report->status ?? 'Menunggu' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button class="text-green-600 hover:underline text-sm">Lihat</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="px-6 py-4">#LPR00123</td>
                                <td class="px-6 py-4">Surabaya, Jawa Timur</td>
                                <td class="px-6 py-4">27 Mei 2025</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="text-green-600 hover:underline text-sm">Lihat</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">#LPR00124</td>
                                <td class="px-6 py-4">Malang, Jawa Timur</td>
                                <td class="px-6 py-4">26 Mei 2025</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Verifikasi</span>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="text-green-600 hover:underline text-sm">Lihat</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">#LPR00125</td>
                                <td class="px-6 py-4">Jakarta Selatan</td>
                                <td class="px-6 py-4">25 Mei 2025</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Ditinjau</span>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="text-green-600 hover:underline text-sm">Lihat</button>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('reportSearch');
            const statusFilter = document.getElementById('reportStatusFilter');
            const tableBody = document.getElementById('reportsTableBody');
            const tableRows = tableBody.querySelectorAll('tr');

            function filterReports() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedStatus = statusFilter.value.toLowerCase();

                tableRows.forEach(row => {
                    const idText = row.children[0].textContent.toLowerCase();
                    const locationText = row.children[1].textContent.toLowerCase();
                    const statusText = row.children[3].textContent.toLowerCase();

                    const matchesSearch = idText.includes(searchTerm) || locationText.includes(searchTerm);
                    const matchesStatus = selectedStatus === "" || statusText.includes(selectedStatus);

                    if (matchesSearch && matchesStatus) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('keyup', filterReports);
            statusFilter.addEventListener('change', filterReports);

            filterReports();
        });
    </script>
@endsection
