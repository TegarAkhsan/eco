@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-cover bg-center px-4 py-12 font-['Poppins']"
        style="background-image: url('{{ asset('images/earth.png') }}')">
        <div class="bg-[#0b1121]/90 rounded-xl max-w-6xl mx-auto p-10 shadow-xl">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">Ada beberapa masalah dengan input Anda:</span>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h1 class="text-3xl font-bold text-white text-center mb-2">Report Your Trash</h1>
            <p class="text-center text-gray-300 mb-10">Empowering communities with innovative tools for waste management and
                environmental protection</p>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-blue-700/90 text-white p-6 rounded-lg space-y-6">
                    <h2 class="text-xl font-semibold">Contact Information</h2>
                    <p class="text-sm text-gray-200">Empowering communities with innovative tools for waste management and
                        environmental protection</p>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4 4h16v16H4z" fill="none" />
                            <path
                                d="M20 4H4v16h16V4zM5 5h14v14H5V5zm7 3a3 3 0 1 1-3 3c0-1.66 1.34-3 3-3zM6 17c0-2 4-3.1 6-3.1S18 15 18 17v1H6v-1z" />
                        </svg>
                        <span>ecotrack@gmail.com</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M6.62 10.79a15.53 15.53 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1-.27 11.36 11.36 0 0 0 3.58.57 1 1 0 0 1 1 1v3.61a1 1 0 0 1-1 1A16 16 0 0 1 4 4a1 1 0 0 1 1-1h3.61a1 1 0 0 1 1 1 11.36 11.36 0 0 0 .57 3.58 1 1 0 0 1-.27 1z" />
                        </svg>
                        <span>+62 812-3456-7890</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C8.13 lw 2 5 5.13 5 9c0 4.25 5.4 11.74 6.17 12.74.39.5 1.28.5 1.67 0C13.6 20.74 19 13.25 19 9c0-3.87-3.13-7-7-7z" />
                        </svg>
                        <span>Indonesia, Surabaya</span>
                    </div>
                </div>

                <form action="{{ route('report.submit') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-5 text-white relative" id="reportForm">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nama
                            Laporan/Pelapor</label>
                        <input type="text" name="name" id="name" placeholder="Mis: Tumpukan Sampah Depan Toko"
                            required value="{{ old('name') }}"
                            class="w-full px-4 py-3 pr-10 rounded-xl bg-[#1e293b] border border-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                            aria-label="Nama">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email (Opsional)</label>
                        <input type="email" name="email" id="email" placeholder="Email Anda (opsional)"
                            value="{{ old('email') }}"
                            class="w-full px-4 py-3 pr-10 rounded-xl bg-[#1e293b] border border-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                            aria-label="Email">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="location_text" class="block text-sm font-medium text-gray-300 mb-1">Alamat/Detail Lokasi
                            Sampah</label>
                        <textarea name="location" id="location_text" rows="3" placeholder="Masukkan alamat atau detail lokasi sampah"
                            required
                            class="w-full px-4 py-3 rounded-xl bg-[#1e293b] border border-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('location') border-red-500 @enderror"
                            aria-label="Lokasi Titik Sampah">{{ old('location') }}</textarea>
                        <div class="flex items-center space-x-3 mt-2">
                            <button type="button" id="getLocationButton"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-full transition duration-300 text-sm">
                                📍 Gunakan Lokasi GPS
                            </button>
                            <button type="button" id="geocodeAddressButton"
                                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-full transition duration-300 text-sm">
                                Cari Alamat di Peta
                            </button>
                        </div>
                        <p id="geolocation_status" class="text-xs mt-2 min-h-[1em]"></p>
                        @error('location')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Pinpoint di Peta (Klik atau Geser
                            Marker):</label>
                        <div id="reportMap" style="height: 300px; border-radius: 10px;" class="mb-2"></div>
                    </div>

                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
                    <input type="hidden" name="province" id="province" value="{{ old('province') }}">
                    <input type="hidden" name="city" id="city" value="{{ old('city') }}">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="relative">
                            <label for="type" class="block text-sm font-medium text-gray-300 mb-1">Jenis Sampah</label>
                            <select name="type" id="type" required
                                class="w-full px-4 py-3 pr-10 rounded-xl bg-[#1e293b] border border-gray-700 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 @error('type') border-red-500 @enderror"
                                aria-label="Pilih Jenis Sampah">
                                <option value="">Pilih Jenis</option>
                                <option value="organik" {{ old('type') == 'organik' ? 'selected' : '' }}>Organik</option>
                                <option value="anorganik" {{ old('type') == 'anorganik' ? 'selected' : '' }}>Anorganik
                                </option>
                                <option value="b3" {{ old('type') == 'b3' ? 'selected' : '' }}>B3</option>
                                <option value="campuran" {{ old('type') == 'campuran' ? 'selected' : '' }}>Campuran
                                </option>
                            </select>
                            <div class="absolute inset-y-0 right-4 top-6 flex items-center pointer-events-none"><svg
                                    class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M19 9l-7 7-7-7" />
                                </svg></div>
                            @error('type')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="relative">
                            <label for="size" class="block text-sm font-medium text-gray-300 mb-1">Estimasi
                                Ukuran</label>
                            <select name="size" id="size" required
                                class="w-full px-4 py-3 pr-10 rounded-xl bg-[#1e293b] border border-gray-700 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 @error('size') border-red-500 @enderror"
                                aria-label="Pilih Estimasi Ukuran">
                                <option value="">Pilih Ukuran</option>
                                <option value="kecil" {{ old('size') == 'kecil' ? 'selected' : '' }}>Kecil</option>
                                <option value="sedang" {{ old('size') == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="besar" {{ old('size') == 'besar' ? 'selected' : '' }}>Besar</option>
                            </select>
                            <div class="absolute inset-y-0 right-4 top-6 flex items-center pointer-events-none"><svg
                                    class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M19 9l-7 7-7-7" />
                                </svg></div>
                            @error('size')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="relative">
                            <label for="urgency" class="block text-sm font-medium text-gray-300 mb-1">Urgensi</label>
                            <select name="urgency" id="urgency" required
                                class="w-full px-4 py-3 pr-10 rounded-xl bg-[#1e293b] border border-gray-700 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 @error('urgency') border-red-500 @enderror"
                                aria-label="Pilih Urgensi">
                                <option value="">Pilih Urgensi</option>
                                <option value="rendah" {{ old('urgency') == 'rendah' ? 'selected' : '' }}>Rendah</option>
                                <option value="sedang" {{ old('urgency') == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="tinggi" {{ old('urgency') == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                            </select>
                            <div class="absolute inset-y-0 right-4 top-6 flex items-center pointer-events-none"><svg
                                    class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M19 9l-7 7-7-7" />
                                </svg></div>
                            @error('urgency')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Deskripsi Tambahan
                            (Opsional)</label>
                        <textarea name="description" id="description" rows="3"
                            placeholder="Deskripsi tambahan mengenai tumpukan sampah..."
                            class="w-full px-4 py-3 rounded-xl bg-[#1e293b] border border-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                            aria-label="Deskripsi">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="photos" class="block text-sm font-medium text-gray-300 mb-1">Unggah Foto (Opsional,
                            maks 3 foto)</label>
                        <input type="file" name="photos[]" id="photos" multiple accept="image/*"
                            class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('photos.*') border-red-500 @enderror"
                            aria-label="Upload Foto Sampah">
                        @error('photos.*')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        @error('photos')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="terms" id="terms" required
                            class="w-5 h-5 text-blue-500 bg-gray-900 border-gray-700 rounded focus:ring-blue-500 @error('terms') border-red-500 @error"
                            {{ old('terms') ? 'checked' : '' }} aria-label="Setuju dengan syarat">
                        <label for="terms" class="ml-3 text-sm text-gray-300">Saya menyatakan bahwa data yang saya
                            berikan adalah benar dan dapat dipertanggungjawabkan *</label>
                        @error('terms')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-full transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                            id="submitButton">
                        Kirim Laporan
                        </button>
                </form>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        const latInput = document.getElementById('latitude');
        const lonInput = document.getElementById('longitude');
        const locationTextInput = document.getElementById('location_text');
        const provinceInput = document.getElementById('province');
        const cityInput = document.getElementById('city');
        const geolocationStatusEl = document.getElementById('geolocation_status');
        const NOMINATIM_REVERSE_URL = 'https://nominatim.openstreetmap.org/reverse';
        const NOMINATIM_SEARCH_URL = 'https://nominatim.openstreetmap.org/search';

        let reportMap;
        let reportMarker;

        function initializeReportMap(initialLat = -2.5489, initialLon = 118.0149, initialZoom = 5) {
            if (reportMap) return;

            reportMap = L.map('reportMap').setView([initialLat, initialLon], initialZoom);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(reportMap);

            reportMarker = L.marker([initialLat, initialLon], {
                draggable: true
            }).addTo(reportMap);
            updateHiddenCoords(initialLat, initialLon);

            reportMarker.on('dragend', function(e) {
                const position = reportMarker.getLatLng();
                updateHiddenCoords(position.lat, position.lng);
                doReverseGeocode(position.lat, position.lng, true);
            });

            reportMap.on('click', function(e) {
                reportMarker.setLatLng(e.latlng);
                const position = reportMarker.getLatLng();
                updateHiddenCoords(position.lat, position.lng);
                doReverseGeocode(position.lat, position.lng, true);
            });
        }

        function updateHiddenCoords(lat, lon) {
            latInput.value = lat.toFixed(6);
            lonInput.value = lon.toFixed(6);
        }

        async function doReverseGeocode(lat, lon, updateMapAndView = false) {
            geolocationStatusEl.textContent = 'Mendapatkan detail alamat...';
            geolocationStatusEl.className = 'text-yellow-400 text-xs mt-1';
            try {
                const response = await fetch(
                    `${NOMINATIM_REVERSE_URL}?format=json&lat=${lat}&lon=${lon}&zoom=18&addressdetails=1&accept-language=id`
                );
                if (!response.ok) throw new Error('Reverse geocoding gagal');
                const data = await response.json();

                const address = data.display_name || `Lat: ${lat.toFixed(5)}, Lon: ${lon.toFixed(5)}`;
                locationTextInput.value = address;

                if (data.address) {
                    provinceInput.value = data.address.state || data.address.province || '';
                    cityInput.value = data.address.city || data.address.county || data.address.town || data.address
                        .village || '';
                } else {
                    provinceInput.value = '';
                    cityInput.value = '';
                }
                geolocationStatusEl.textContent = 'Detail alamat berhasil didapatkan.';
                geolocationStatusEl.className = 'text-green-400 text-xs mt-1';

                if (updateMapAndView && reportMap && reportMarker) {
                    reportMarker.setLatLng([lat, lon]);
                    reportMap.setView([lat, lon], 16);
                }

            } catch (error) {
                console.error("Error reverse geocoding:", error);
                locationTextInput.value = `Koordinat: ${lat.toFixed(5)}, ${lon.toFixed(5)}`;
                provinceInput.value = '';
                cityInput.value = '';
                geolocationStatusEl.textContent = 'Detail alamat gagal diambil. Menggunakan koordinat.';
                geolocationStatusEl.className = 'text-yellow-400 text-xs mt-1';
            }
        }

        async function geocodeAddressFromText() {
            const addressQuery = locationTextInput.value.trim();
            if (!addressQuery) {
                geolocationStatusEl.textContent = 'Masukkan alamat untuk dicari.';
                geolocationStatusEl.className = 'text-red-400 text-xs mt-1';
                return;
            }
            geolocationStatusEl.textContent = `Mencari alamat "${addressQuery}"...`;
            geolocationStatusEl.className = 'text-yellow-400 text-xs mt-1';

            try {
                const response = await fetch(
                    `${NOMINATIM_SEARCH_URL}?q=${encodeURIComponent(addressQuery)}&format=json&limit=1&countrycodes=id&addressdetails=1`
                );
                if (!response.ok) throw new Error('Geocoding gagal');
                const data = await response.json();

                if (data && data.length > 0) {
                    const lat = parseFloat(data[0].lat);
                    const lon = parseFloat(data[0].lon);
                    updateHiddenCoords(lat, lon);
                    doReverseGeocode(lat, lon, true);
                    if (!reportMap) {
                        initializeReportMap(lat, lon, 16);
                    }
                } else {
                    throw new Error('Alamat tidak ditemukan');
                }
            } catch (error) {
                console.error("Error geocoding:", error);
                geolocationStatusEl.textContent = 'Alamat tidak ditemukan. Coba lagi atau gunakan GPS.';
                geolocationStatusEl.className = 'text-red-400 text-xs mt-1';
            }
        }

        function getCurrentPosition(successCallback, errorCallback, options) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(successCallback, errorCallback, options);
            } else {
                errorCallback(new Error("Geolocation is not supported by this browser."));
            }
        }

        function successCallback(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            updateHiddenCoords(latitude, longitude);
            doReverseGeocode(latitude, longitude, true);
            if (!reportMap) {
                initializeReportMap(latitude, longitude, 16);
            }
        }

        function errorCallback(error) {
            let errorMessage = 'Gagal mendapatkan lokasi GPS. ';
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    errorMessage += "Anda menolak permintaan Geolocation.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    errorMessage += "Informasi lokasi tidak tersedia.";
                    break;
                case error.TIMEOUT:
                    errorMessage += "Permintaan lokasi melebihi batas waktu.";
                    break;
                default:
                    errorMessage += "Terjadi kesalahan tidak diketahui.";
                    break;
            }
            geolocationStatusEl.textContent = errorMessage +
                ' Anda bisa memasukkan alamat manual dan klik "Cari Alamat di Peta".';
            geolocationStatusEl.className = 'text-red-400 text-xs mt-1';
            console.error('Geolocation error:', error);
            if (!reportMap) initializeReportMap();
        }

        document.getElementById('getLocationButton').addEventListener('click', function() {
            getCurrentPosition(successCallback, errorCallback, {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            });
        });

        document.getElementById('geocodeAddressButton').addEventListener('click', geocodeAddressFromText);

        document.getElementById('reportForm').addEventListener('submit', function(event) {
            const latVal = latInput.value;
            const lonVal = lonInput.value;

            if (!latVal || !lonVal || isNaN(parseFloat(latVal)) || isNaN(parseFloat(lonVal))) {
                event.preventDefault();
                geolocationStatusEl.textContent =
                    'KOORDINAT LOKASI WAJIB ADA. Gunakan GPS atau "Cari Alamat di Peta" untuk mendapatkan koordinat.';
                geolocationStatusEl.className = 'text-red-500 font-bold text-sm mt-1';

                geolocationStatusEl.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

                const submitButton = document.getElementById('submitButton');
                submitButton.disabled = false;
                submitButton.textContent = 'Kirim Laporan';
                return false;
            }

            const submitButton = document.getElementById('submitButton');
            submitButton.disabled = true;
            submitButton.textContent = 'Mengirim Laporan...';
        });

        document.addEventListener('DOMContentLoaded', () => {
            initializeReportMap();
            const oldLat = parseFloat(latInput.value);
            const oldLon = parseFloat(lonInput.value);
            if (!isNaN(oldLat) && !isNaN(oldLon) && reportMap && reportMarker) {
                const oldPosition = L.latLng(oldLat, oldLon);
                reportMarker.setLatLng(oldPosition);
                reportMap.setView(oldPosition, 16);
                if (!locationTextInput.value && oldLat !== -2.5489 && oldLon !== 118.0149) {
                    doReverseGeocode(oldLat, oldLon);
                }
            }
        });
    </script>
@endsection

@section('hideFooter', true)
