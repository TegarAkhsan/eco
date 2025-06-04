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
                    <p class="text-2xl font-bold text-gray-900">{{ $totalReports ?? 0 }}</p>
                </div>
            </div>
        </div>

        {{-- <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 group">
            <div class="flex items-center space-x-4">
                <div class="bg-blue-100 text-blue-700 p-3 rounded-full text-2xl group-hover:scale-110 transition">
                    🗑️
                </div>
                <div>
                    <h3 class="text-gray-700 font-semibold text-sm">Titik Sampah</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $trashPoints ?? 0 }}</p>
                </div>
            </div>
        </div> --}}

        <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 group">
            <div class="flex items-center space-x-4">
                <div class="bg-green-100 text-green-700 p-3 rounded-full text-2xl group-hover:scale-110 transition">
                    ♻️
                </div>
                <div>
                    <h3 class="text-gray-700 font-semibold text-sm">Bank Sampah Aktif</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $activeWasteBanks ?? 0 }}</p>
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
                    <p class="text-2xl font-bold text-gray-900">{{ $registeredTPAs ?? 0 }}</p>
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
                    @if (isset($reports) && $reports->isNotEmpty())
                        @foreach ($reports as $report)
                            <tr class="border-t hover:bg-gray-50" data-report-id="{{ $report->id }}">
                                <td class="px-3 py-2 border border-gray-200">{{ $report->id }}</td>
                                <td class="px-3 py-2 border border-gray-200">{{ $report->name ?? '' }}</td>
                                <td class="px-3 py-2 border border-gray-200">{{ $report->email ?? '' }}</td>
                                <td class="px-3 py-2 border border-gray-200">{{ $report->location ?? '' }}</td>
                                <td class="px-3 py-2 border border-gray-200">
                                    {{ $report->type ? ucfirst($report->type) : '' }}</td>
                                <td class="px-3 py-2 border border-gray-200">
                                    {{ $report->size ? ucfirst($report->size) : '' }}</td>
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
                    @else
                        <tr>
                            <td colspan="10" class="text-center py-4 text-gray-500">Tidak ada laporan yang tersedia.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="bg-white rounded-lg shadow p-6 w-full lg:w-1/3 max-h-[480px] overflow-y-auto">
            <h2 class="text-xl font-semibold mb-6 text-green-700">Aktivitas Petugas</h2>
            @if ($activities->isEmpty())
                <p class="text-gray-500">Belum ada aktivitas petugas saat ini.</p>
            @else
                <ul class="space-y-6 text-gray-700 text-base">
                    @foreach ($activities as $activity)
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
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let isFetching = true;
        let laporanChart;

        // Inisialisasi grafik dengan data kosong
        const ctx = document.getElementById('laporanChart')?.getContext('2d');
        if (ctx) {
            laporanChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'], // Default untuk harian
                    datasets: [{
                        label: 'Jumlah Laporan/Hari',
                        data: [0, 0, 0, 0, 0, 0, 0],
                        backgroundColor: '#34d399'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Laporan'
                            },
                            suggestedMax: 10
                        }
                    }
                }
            });
        }

        function updateChart(data, type) {
            if (!laporanChart || !data.chart_data) {
                console.error('No chart or chart_data available:', data);
                return;
            }

            console.log('Updating chart with chart_data:', data.chart_data);

            // Tentukan label berdasarkan tipe
            let labels;
            if (type === 'harian') {
                labels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
            } else if (type === 'bulanan') {
                labels = Array.from({
                    length: new Date().daysInMonth
                }, (_, i) => (i + 1).toString());
            } else if (type === 'tahunan') {
                labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            }

            // Reset dan perbarui data grafik
            laporanChart.data.labels = labels;
            laporanChart.data.datasets[0].data = Object.values(data.chart_data);

            console.log('New chart data:', laporanChart.data.datasets[0].data);

            const maxValue = Math.max(...laporanChart.data.datasets[0].data, 10) * 1.2;
            laporanChart.options.scales.y.suggestedMax = maxValue;
            laporanChart.update();
        }

        function fetchReports(type = 'harian') {
            if (!isFetching) return;

            fetch(`/admin/dashboard/refresh?type=${type}`, {
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
                    console.log('Data received from /admin/dashboard/refresh:', data);

                    if (!data.reports) {
                        console.error('Data does not contain reports:', data);
                        return;
                    }

                    const reportsTableBody = document.getElementById('reportsTableBody');
                    reportsTableBody.innerHTML = '';
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

                    if (data.reports.length === 0) {
                        reportsTableBody.innerHTML =
                            `<tr><td colspan="10" class="text-center py-4 text-gray-500">Tidak ada laporan yang tersedia.</td></tr>`;
                    }

                    updateChart(data, type);
                })
                .catch(error => {
                    console.error('Error fetching reports:', error);
                    const reportsTableBody = document.getElementById('reportsTableBody');
                    reportsTableBody.innerHTML =
                        `<tr><td colspan="10" class="text-center py-4 text-red-600">Gagal memuat laporan. Silakan coba lagi nanti.</td></tr>`;
                });
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchReports();
        });

        const intervalId = setInterval(() => fetchReports(document.getElementById('chartType').value), 10000);

        window.addEventListener('beforeunload', () => {
            isFetching = false;
            clearInterval(intervalId);
        });

        document.getElementById('chartType')?.addEventListener('change', function() {
            const selected = this.value;
            fetchReports(selected);
        });
    </script>
@endpush
