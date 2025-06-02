@extends('admin.layouts.app')

@section('content')
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
            <table class="w-full text-sm text-left table-auto border-collapse border border-gray-200" id="reportsTable">
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
                <tbody id="reportsTableBody">
                    @foreach ($reports as $report)
                        <tr class="border-t hover:bg-gray-50" data-report-id="{{ $report->id }}">
                            <td class="px-3 py-2 border border-gray-200">{{ $report->id }}</td>
                            <td class="px-3 py-2 border border-gray-200">{{ $report->name ?? '' }}</td>
                            <td class="px-3 py-2 border border-gray-200">{{ $report->email ?? '' }}</td>
                            <td class="px-3 py-2 border border-gray-200">{{ $report->location ?? '' }}</td>
                            <td class="px-3 py-2 border border-gray-200">{{ $report->type ? ucfirst($report->type) : '' }}
                            </td>
                            <td class="px-3 py-2 border border-gray-200">{{ $report->size ? ucfirst($report->size) : '' }}
                            </td>
                            <td class="px-3 py-2 border border-gray-200">
                                <span
                                    class="text-{{ $report->urgency == 'tinggi' ? 'red' : ($report->urgency == 'sedang' ? 'yellow' : 'green') }}-600 font-semibold">{{ $report->urgency ? ucfirst($report->urgency) : '' }}</span>
                            </td>
                            <td class="px-3 py-2 border border-gray-200 max-w-xs">{{ $report->description ?? '' }}</td>
                            <td class="px-3 py-2 border border-gray-200">
                                @if (!empty($report->photos) && is_string($report->photos))
                                    @php
                                        $photoPaths = json_decode($report->photos, true);
                                        $firstPhoto =
                                            is_array($photoPaths) && !empty($photoPaths) ? $photoPaths[0] : null;
                                    @endphp
                                    @if ($firstPhoto)
                                        <img src="{{ asset($firstPhoto) }}" alt="Foto Sampah"
                                            class="w-16 h-16 object-cover rounded">
                                    @endif
                                @endif
                            </td>
                            <td class="px-3 py-2 border border-gray-200">
                                <button
                                    class="w-full max-w-[100px] text-center px-2 py-1 text-xs font-semibold rounded-md transition-colors duration-200 bg-green-600 hover:bg-green-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-1"
                                    type="button">Tangani</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-white rounded-lg shadow p-6 w-full lg:w-1/3 max-h-[480px] overflow-y-auto">
            <h2 class="text-xl font-semibold mb-6 text-green-700">Aktivitas Petugas</h2>
            @if ($activities->isEmpty())
                <p class="text-gray-500">Belum ada aktivitas untuk Anda.</p>
            @else
                @foreach ($activities as $activity)
                    <ul class="space-y-6 text-gray-700 text-base">
                        <li class="flex items-center space-x-4">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center bg-blue-500 text-white">
                                {{ substr($activity->user->first_name, 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">
                                    {{ $activity->user->first_name }} <span
                                        class="text-green-600">{{ $activity->description }}</span>
                                </p>
                                <p class="text-sm text-gray-500">
                                    @php
                                        $minutes = $activity->created_at->diffInMinutes(now());
                                        $displayTime =
                                            $minutes < 1 ? 'kurang dari 1 menit' : round($minutes) . ' menit';
                                    @endphp
                                    {{ $displayTime }} yang lalu
                                </p>
                            </div>
                        </li>
                    </ul>
                @endforeach
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function fetchReports() {
            fetch('/admin/dashboard/refresh', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if (!data.reports) {
                        console.error('Data does not contain reports:', data);
                        return;
                    }
                    const reportsTableBody = document.getElementById('reportsTableBody');
                    reportsTableBody.innerHTML = ''; // Bersihkan tabel
                    data.reports.forEach(report => {
                        const urgencyColor = report.urgency === 'tinggi' ? 'red' : (report.urgency ===
                            'sedang' ? 'yellow' : 'green');
                        const firstPhoto = report.photos && report.photos.length > 0 ? report.photos[0] : null;
                        const photoHtml = firstPhoto ?
                            `<img src="${firstPhoto}" alt="Foto Sampah" class="w-16 h-16 object-cover rounded">` :
                            '';

                        const row = document.createElement('tr');
                        row.className = 'border-t hover:bg-gray-50';
                        row.setAttribute('data-report-id', report.id);
                        row.innerHTML = `
                            <td class="px-3 py-2 border border-gray-200">${report.id}</td>
                            <td class="px-3 py-2 border border-gray-200">${report.name || ''}</td>
                            <td class="px-3 py-2 border border-gray-200">${report.email || ''}</td>
                            <td class="px-3 py-2 border border-gray-200">${report.location || ''}</td>
                            <td class="px-3 py-2 border border-gray-200">${report.type ? report.type.charAt(0).toUpperCase() + report.type.slice(1) : ''}</td>
                            <td class="px-3 py-2 border border-gray-200">${report.size ? report.size.charAt(0).toUpperCase() + report.size.slice(1) : ''}</td>
                            <td class="px-3 py-2 border border-gray-200">
                                <span class="text-${urgencyColor}-600 font-semibold">${report.urgency ? report.urgency.charAt(0).toUpperCase() + report.urgency.slice(1) : ''}</span>
                            </td>
                            <td class="px-3 py-2 border border-gray-200 max-w-xs">${report.description || ''}</td>
                            <td class="px-3 py-2 border border-gray-200">${photoHtml}</td>
                            <td class="px-3 py-2 border border-gray-200">
                                <button class="w-full max-w-[100px] text-center px-2 py-1 text-xs font-semibold rounded-md transition-colors duration-200 bg-green-600 hover:bg-green-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-1" type="button">Tangani</button>
                            </td>
                        `;
                        reportsTableBody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Error fetching reports:', error);
                });
        }

        // Refresh setiap 10 detik
        setInterval(fetchReports, 10000);

        // Load initial data
        fetchReports();
    </script>
@endpush
