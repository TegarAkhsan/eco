@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-12 font-['Poppins']">
        <h1 class="text-4xl font-extrabold text-white mb-8 tracking-tight text-center">
            Peta Interaktif Sampah
        </h1>

        <div id="notification-area" class="fixed top-24 right-4 z-[2000] w-80 space-y-2"></div>

        <div class="bg-[#0b1121]/70 backdrop-blur-md p-6 rounded-2xl mb-8 shadow-[0px_6px_20px_rgba(0,0,0,0.4)]">
            <div class="grid md:grid-cols-4 gap-x-6 gap-y-4 mb-6">
                {{-- Kolom 1: Lokasi Saat Ini (Input + Tombol GPS) --}}
                <div>
                    <label for="currentLocationInput" class="block text-sm font-medium text-gray-300 mb-2">Lokasi Anda Saat
                        Ini</label>
                    <div class="flex items-center">
                        <input type="text" id="currentLocationInput"
                            class="w-full px-4 py-3 rounded-l-xl bg-[#1e293b]/80 border border-gray-600 text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 transition duration-300"
                            placeholder="Ketik atau gunakan GPS">
                        <button id="fetchCurrentLocationButton" title="Gunakan GPS Lokasi Saat Ini"
                            class="p-3 bg-cyan-500 hover:bg-cyan-600 rounded-r-xl border border-l-0 border-cyan-500 text-white transition duration-300 h-[46px]">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001zm.612-1.426a.75.75 0 0 1-.612 0l-.003-.001a17.394 17.394 0 0 1-4.964-5.162C1.906 8.305 3.11 4.514 7.45 4.514s5.545 3.79 2.787 7.83l-.005.007a17.354 17.354 0 0 1-4.964 5.162zM10 12.125a2.125 2.125 0 1 0 0-4.25 2.125 2.125 0 0 0 0 4.25Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Kolom 2: Lokasi Tujuan Pencarian --}}
                <div>
                    <label for="targetLocationInput" class="block text-sm font-medium text-gray-300 mb-2">Lokasi Tujuan
                        Pencarian</label>
                    <input type="text" id="targetLocationInput"
                        class="w-full px-4 py-3 rounded-xl bg-[#1e293b]/80 border border-gray-600 text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 transition duration-300 h-[46px]"
                        placeholder="Ketik nama tempat atau alamat">
                </div>

                {{-- Kolom 3: Jenis Sampah --}}
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-300 mb-2">Jenis Sampah</label>
                    <div class="relative">
                        <select id="type" name="type"
                            class="w-full appearance-none pr-10 px-4 py-3 rounded-xl bg-[#1e293b]/80 border border-gray-600 text-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-400 transition duration-300 h-[46px]">
                            <option value="">Semua</option>
                            <option value="organik">Organik</option>
                            <option value="anorganik">Anorganik</option>
                            <option value="b3">B3</option>
                            <option value="campuran">Campuran</option>
                        </select>
                        <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">▼</div>
                    </div>
                </div>

                {{-- Kolom 4: Radius (km) --}}
                <div>
                    <label for="radius" class="block text-sm font-medium text-gray-300 mb-2">Radius (km)</label>
                    <input type="number" id="radius" name="radius" min="0.1" step="0.1" value="10"
                        class="w-full px-4 py-3 rounded-xl bg-[#1e293b]/80 border border-gray-600 text-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-400 transition duration-300 h-[46px]"
                        placeholder="Otomatis atau isi manual">
                </div>
            </div>
            <button id="searchButton"
                class="flex items-center justify-center gap-2 bg-gradient-to-r from-cyan-400 to-cyan-600 hover:from-cyan-500 hover:to-cyan-700 text-white px-6 py-3 rounded-xl transition duration-300 shadow-md font-semibold">
                <span id="searchButtonIcon">🔍</span> <span id="searchButtonText">Cari</span>
            </button>
        </div>

        <div class="bg-[#d9d9d9]/10 rounded-xl overflow-hidden h-[700px] shadow-[0px_6px_20px_rgba(0,0,0,0.3)] relative">
            <div id="map" class="w-full h-full"></div>
            <button id="resetMapButton" class="custom-reset-button">Reset Peta</button>
        </div>

        {{-- Konten Lainnya (Lokasi Terdekat, Statistik, Laporkan) --}}
        <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-[#0b1121]/80 backdrop-blur-lg p-6 rounded-2xl shadow-xl">
                <h3 class="text-2xl font-semibold text-white mb-5 flex items-center gap-2"><svg
                        class="w-6 h-6 text-[#22d3ee]" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M17.657 16.657L13.414 12l4.243-4.243M6.343 7.343L10.586 12l-4.243 4.243" />
                    </svg>Lokasi Terdekat</h3>
                <ul id="nearest-locations" class="space-y-5 text-gray-300 text-sm"></ul>
            </div>
            <div class="bg-[#0b1121]/80 backdrop-blur-lg p-6 rounded-2xl shadow-xl">
                <h3 class="text-2xl font-semibold text-white mb-5 flex items-center gap-2"><svg
                        class="w-6 h-6 text-[#22d3ee]" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M11 3v18m-4-4l4 4 4-4" />
                    </svg>Statistik Area</h3>
                <div id="area-statistics" class="space-y-5"></div>
            </div>
            <div class="bg-[#0b1121]/80 backdrop-blur-lg p-6 rounded-2xl shadow-xl flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl font-semibold text-white mb-5 flex items-center gap-2"><svg
                            class="w-6 h-6 text-[#22d3ee]" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M12 4v16m8-8H4" />
                        </svg>Laporkan Titik Baru</h3>
                    <p class="text-sm text-gray-300 mb-6 leading-relaxed">Temukan titik sampah liar yang belum terpetakan?
                        Laporkan sekarang untuk membantu lingkungan kita menjadi lebih bersih.</p>
                </div><a href="{{ route('report') }}"
                    class="mt-auto bg-gradient-to-r from-[#22d3ee] to-[#06b6d4] hover:from-[#06b6d4] hover:to-[#0891b2] text-white px-6 py-3 rounded-lg inline-block transition duration-300 shadow-lg text-center font-medium">Laporkan
                    Titik Sampah</a>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

    {{-- Leaflet Routing Machine --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>

    <style>
        /* Style notifikasi dan Leaflet (sebagian besar sama) */
        .app-notification {
            padding: 12px 16px;
            border-radius: 8px;
            color: white;
            font-size: 0.875rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            opacity: 0;
            transform: translateX(100%);
            animation: slideInNotification 0.5s forwards, fadeOutNotification 0.5s 4.5s forwards;
        }

        .app-notification.success {
            background-color: #28a745;
        }

        .app-notification.error {
            background-color: #dc3545;
        }

        .app-notification.warning {
            background-color: #ffc107;
            color: #333;
        }

        .app-notification.info {
            background-color: #17a2b8;
        }

        @keyframes slideInNotification {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeOutNotification {
            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }

        .leaflet-container {
            background: #f5f6f5 !important;
            border-radius: 12px;
        }

        .leaflet-control-container .leaflet-control {
            background: #ffffff !important;
            border-radius: 8px !important;
            padding: 4px !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15) !important;
        }

        .leaflet-control-zoom a {
            background: #ffffff !important;
            color: #333333 !important;
            border-radius: 6px !important;
            width: 28px !important;
            height: 28px !important;
            line-height: 28px !important;
            font-size: 16px !important;
            transition: all 0.2s ease !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 2px !important;
            border: 1px solid #d1d5db !important;
        }

        .leaflet-control-zoom a:hover {
            background: #e5e7eb !important;
            color: #1e40af !important;
        }

        .leaflet-control-zoom {
            display: flex !important;
            flex-direction: column !important;
            gap: 4px !important;
            top: 10px !important;
            left: 10px !important;
        }

        .leaflet-control-attribution {
            background: #ffffff !important;
            color: #4b5563 !important;
            border-radius: 6px !important;
            font-size: 11px !important;
            padding: 2px 6px !important;
            bottom: 10px !important;
            right: 10px !important;
            opacity: 0.8;
        }

        .leaflet-popup-content-wrapper {
            background: #ffffff !important;
            border-radius: 8px !important;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.2) !important;
            padding: 0 !important;
        }

        .leaflet-popup-content {
            margin: 12px !important;
            font-family: 'Poppins', sans-serif !important;
            font-size: 13px !important;
            max-width: 280px !important;
            line-height: 1.5 !important;
        }

        .leaflet-popup-tip {
            background: #ffffff !important;
        }

        .custom-reset-button {
            position: absolute;
            bottom: 15px;
            right: 15px;
            background: #ffffff !important;
            color: #1e40af !important;
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            transition: all 0.2s ease;
            z-index: 1000;
        }

        .custom-reset-button:hover {
            background: #e5e7eb !important;
            color: #1e3a8a !important;
            transform: scale(1.03);
        }

        .marker-cluster-small {
            background: #f59e0b !important;
            border-radius: 50% !important;
            opacity: 0.9;
        }

        .marker-cluster-medium {
            background: #f59e0b !important;
            border-radius: 50% !important;
            opacity: 0.9;
        }

        .marker-cluster-large {
            background: #f59e0b !important;
            border-radius: 50% !important;
            opacity: 0.9;
        }

        .marker-cluster div {
            background: #ffffff !important;
            color: #1f2937 !important;
            font-weight: 600 !important;
            border-radius: 50% !important;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
            font-size: 12px;
        }

        .waste-circle {
            border-radius: 50%;
            opacity: 0.7;
            text-align: center;
            color: #fff;
            font-weight: bold;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .waste-circle-label {
            position: absolute;
            color: white;
            font-weight: bold;
            font-size: 14px;
            text-align: center;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }

        .info {
            padding: 6px 8px;
            font: 14px/16px 'Poppins', Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .info h4 {
            margin: 0 0 5px;
            color: #777;
            font-weight: 600;
        }

        .legend {
            line-height: 18px;
            color: #555;
        }

        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }

        .leaflet-tooltip {
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 4px 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .leaflet-tooltip-permanent {
            background-color: rgba(0, 0, 0, 0.65) !important;
            color: white !important;
            border: none !important;
            padding: 3px 7px !important;
            white-space: nowrap !important;
            border-radius: 4px !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3) !important;
        }

        #fetchCurrentLocationButton svg.animate-spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* Styling untuk Leaflet Routing Machine */
        .leaflet-routing-container {
            background-color: rgba(255, 255, 255, 0.95) !important;
            /* Background sedikit lebih solid */
            border-radius: 8px !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2) !important;
            max-height: 300px;
            overflow-y: auto;
        }

        /* Ganti warna teks di panel rute menjadi hitam */
        .leaflet-routing-container,
        .leaflet-routing-container .leaflet-routing-summary span,
        .leaflet-routing-container .leaflet-routing-instruction,
        .leaflet-routing-container .leaflet-routing-instruction span,
        .leaflet-routing-container .leaflet-routing-distance,
        .leaflet-routing-container .leaflet-routing-time,
        .leaflet-routing-container .leaflet-routing-alt h2,
        .leaflet-routing-container .leaflet-routing-alt td,
        .leaflet-routing-container table td {
            color: black !important;
            /* Warna teks hitam */
        }

        .leaflet-routing-icon {
            /* Pastikan ikon juga terlihat jika warnanya default putih */
            filter: invert(10%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(0%) contrast(100%);
            /* Membuat ikon jadi hitam */
        }
    </style>

    <script>
        // --- Konstanta Aplikasi & Variabel Global & Elemen UI ---
        // ... (sebagian besar variabel sama)
        const API_REPORTS_URL = '/api/reports';
        const DEFAULT_MAP_CENTER = [-2.5489, 118.0149];
        const DEFAULT_MAP_ZOOM = 5;
        const MIN_ZOOM = 3;
        const MAX_ZOOM = 18;
        const NOMINATIM_SEARCH_URL = 'https://nominatim.openstreetmap.org/search';
        const NOMINATIM_REVERSE_URL = 'https://nominatim.openstreetmap.org/reverse';
        const MARKER_ICON_URL = 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png';
        const MARKER_SHADOW_URL = 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png';
        const PROVINCE_GEOJSON_PATH = '{{ asset('storage/gadm41_IDN_1.json') }}';
        const CITY_GEOJSON_PATH = '{{ asset('storage/gadm41_IDN_2.json') }}';
        let currentLocationCoords = {
            lat: null,
            lon: null,
            displayName: ''
        };
        let targetLocationCoords = {
            lat: null,
            lon: null,
            displayName: ''
        };
        let map;
        let markers;
        let osmLayer, satelliteLayer, provinceChoroplethLayer, cityChoroplethLayer, provinceCircleLayerGroup,
            cityCircleLayerGroup, info, legend;
        let currentLocationMapMarker = null;
        let targetLocationMapMarker = null;
        let routeLine = null;
        let routingControl = null;
        const searchButtonEl = document.getElementById('searchButton');
        const searchButtonIconEl = document.getElementById('searchButtonIcon');
        const searchButtonTextEl = document.getElementById('searchButtonText');
        const notificationAreaEl = document.getElementById('notification-area');
        const nearestLocationsListEl = document.getElementById('nearest-locations');
        const statsContainerEl = document.getElementById('area-statistics');
        const currentLocationInputEl = document.getElementById('currentLocationInput');
        const fetchCurrentLocationButtonEl = document.getElementById('fetchCurrentLocationButton');
        const targetLocationInputEl = document.getElementById('targetLocationInput');
        const typeInputEl = document.getElementById('type');
        const radiusInputEl = document.getElementById('radius');

        // ... (fungsi showAppNotification, updateInputLocationMarker, geocodeLocation, tryAutoCalculateRadius, handleFetchCurrentLocation tetap sama)
        function showAppNotification(message, type = 'info', duration = 5000) {
            if (!notificationAreaEl) return;
            const notifElement = document.createElement('div');
            notifElement.className = `app-notification ${type}`;
            notifElement.textContent = message;
            notificationAreaEl.appendChild(notifElement);
            setTimeout(() => {
                notifElement.style.animation = 'fadeOutNotification 0.5s forwards';
                setTimeout(() => notifElement.remove(), 500);
            }, duration - 500);
        }

        function updateInputLocationMarker(locationObj, existingMarker, isCurrentLocationMarker, mapInstance) {
            if (existingMarker && mapInstance.hasLayer(existingMarker)) {
                mapInstance.removeLayer(existingMarker);
            }
            if (locationObj && locationObj.lat !== null && locationObj.lon !== null) {
                const icon = L.icon({
                    iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
                    shadowUrl: MARKER_SHADOW_URL,
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    tooltipAnchor: [16, -28],
                    shadowSize: [41, 41]
                });
                const newMarker = L.marker([locationObj.lat, locationObj.lon], {
                    icon: icon
                }).addTo(mapInstance);
                let labelText = locationObj.displayName ? (locationObj.displayName.length > 50 ? locationObj.displayName
                        .substring(0, 47) + '...' : locationObj.displayName) :
                    `Koordinat: ${locationObj.lat.toFixed(4)}, ${locationObj.lon.toFixed(4)}`;
                if (isCurrentLocationMarker) {
                    newMarker.bindTooltip(`<b>Anda:</b> ${labelText}`, {
                        permanent: true,
                        direction: 'top',
                        className: 'leaflet-tooltip-permanent'
                    }).openTooltip();
                } else {
                    newMarker.bindPopup(`<b>Tujuan:</b> ${labelText}`);
                }
                return newMarker;
            }
            return null;
        }

        async function geocodeLocation(query, inputElement, locationStorageObject, isForCurrentLocationMarker) {
            if (!query) {
                locationStorageObject.lat = null;
                locationStorageObject.lon = null;
                locationStorageObject.displayName = '';
                if (inputElement) inputElement.value = '';
                if (isForCurrentLocationMarker && currentLocationMapMarker && map.hasLayer(currentLocationMapMarker)) {
                    map.removeLayer(currentLocationMapMarker);
                    currentLocationMapMarker = null;
                } else if (!isForCurrentLocationMarker && targetLocationMapMarker && map.hasLayer(
                        targetLocationMapMarker)) {
                    map.removeLayer(targetLocationMapMarker);
                    targetLocationMapMarker = null;
                }
                tryAutoCalculateRadius();
                return false;
            }
            const coordsMatch = query.match(/^([-+]?\d{1,3}(?:\.\d+)?),\s*([-+]?\d{1,3}(?:\.\d+)?)$/);
            if (coordsMatch) {
                const latCandidate = parseFloat(coordsMatch[1]);
                const lonCandidate = parseFloat(coordsMatch[2]);
                if (latCandidate >= -90 && latCandidate <= 90 && lonCandidate >= -180 && lonCandidate <= 180) {
                    locationStorageObject.lat = latCandidate;
                    locationStorageObject.lon = lonCandidate;
                    locationStorageObject.displayName =
                        `Koordinat: ${latCandidate.toFixed(5)}, ${lonCandidate.toFixed(5)}`;
                    if (inputElement) inputElement.value = locationStorageObject
                        .displayName;
                    showAppNotification(`Menggunakan koordinat langsung: ${locationStorageObject.displayName}`,
                        'success');
                    if (isForCurrentLocationMarker) {
                        currentLocationMapMarker = updateInputLocationMarker(locationStorageObject,
                            currentLocationMapMarker, true, map);
                        if (map && currentLocationMapMarker) map.setView([locationStorageObject.lat,
                            locationStorageObject.lon
                        ], 13);
                    } else {
                        targetLocationMapMarker = updateInputLocationMarker(locationStorageObject,
                            targetLocationMapMarker, false, map);
                        if (map && targetLocationMapMarker) map.setView([locationStorageObject.lat,
                            locationStorageObject.lon
                        ], 13);
                    }
                    tryAutoCalculateRadius();
                    return true;
                } else {
                    showAppNotification(`Format koordinat "${query}" tidak valid.`, 'warning');
                }
            }
            showAppNotification(`Mencari alamat "${query}"...`, 'info', 3000);
            try {
                const response = await fetch(
                    `${NOMINATIM_SEARCH_URL}?q=${encodeURIComponent(query)}&format=json&limit=1&countrycodes=id&addressdetails=1`
                );
                if (!response.ok) throw new Error('Respon Geocoding tidak OK');
                const data = await response.json();
                if (data && data.length > 0) {
                    locationStorageObject.lat = parseFloat(data[0].lat);
                    locationStorageObject.lon = parseFloat(data[0].lon);
                    locationStorageObject.displayName = data[0].display_name;
                    if (inputElement) inputElement.value = data[0]
                        .display_name;
                    showAppNotification(`Lokasi "${data[0].display_name}" ditemukan.`, 'success');
                    if (isForCurrentLocationMarker) {
                        currentLocationMapMarker = updateInputLocationMarker(locationStorageObject,
                            currentLocationMapMarker, true, map);
                        if (map && currentLocationMapMarker) map.setView([locationStorageObject.lat,
                            locationStorageObject.lon
                        ], 13);
                    } else {
                        targetLocationMapMarker = updateInputLocationMarker(locationStorageObject,
                            targetLocationMapMarker, false, map);
                        if (map && targetLocationMapMarker) map.setView([locationStorageObject.lat,
                            locationStorageObject.lon
                        ], 13);
                    }
                    tryAutoCalculateRadius();
                    return true;
                } else {
                    showAppNotification(
                        `Alamat "${query}" tidak ditemukan oleh layanan geocoding. Coba sederhanakan atau gunakan format lain.`,
                        'warning', 6000);
                    locationStorageObject.lat = null;
                    locationStorageObject.lon = null;
                    locationStorageObject.displayName = query;
                    if (isForCurrentLocationMarker && currentLocationMapMarker && map.hasLayer(
                            currentLocationMapMarker)) {
                        map.removeLayer(currentLocationMapMarker);
                        currentLocationMapMarker = null;
                    } else if (!isForCurrentLocationMarker && targetLocationMapMarker && map.hasLayer(
                            targetLocationMapMarker)) {
                        map.removeLayer(targetLocationMapMarker);
                        targetLocationMapMarker = null;
                    }
                    tryAutoCalculateRadius();
                    return false;
                }
            } catch (error) {
                console.error('Error geocoding:', error);
                showAppNotification(`Gagal mencari alamat "${query}". Periksa koneksi atau coba lagi.`, 'error');
                locationStorageObject.lat = null;
                locationStorageObject.lon = null;
                locationStorageObject.displayName = query;
                if (isForCurrentLocationMarker && currentLocationMapMarker && map.hasLayer(currentLocationMapMarker)) {
                    map.removeLayer(currentLocationMapMarker);
                    currentLocationMapMarker = null;
                } else if (!isForCurrentLocationMarker && targetLocationMapMarker && map.hasLayer(
                        targetLocationMapMarker)) {
                    map.removeLayer(targetLocationMapMarker);
                    targetLocationMapMarker = null;
                }
                tryAutoCalculateRadius();
                return false;
            }
        }

        function tryAutoCalculateRadius() {
            if (currentLocationCoords.lat !== null && currentLocationCoords.lon !== null && targetLocationCoords.lat !==
                null && targetLocationCoords.lon !== null) {
                const distance = calculateDistance(currentLocationCoords.lat, currentLocationCoords.lon,
                    targetLocationCoords.lat, targetLocationCoords.lon);
                const roundedDistance = Math.max(0.1, parseFloat(distance.toFixed(1)));
                radiusInputEl.value = roundedDistance;
                showAppNotification(`Radius otomatis dihitung: ${roundedDistance} km.`, 'info');
            }
        }
        async function handleFetchCurrentLocation() {
            if (!navigator.geolocation) {
                showAppNotification('Geolocation tidak didukung browser Anda.', 'error');
                return;
            }
            showAppNotification('Mendapatkan lokasi GPS Anda...', 'info', 4000);
            fetchCurrentLocationButtonEl.disabled = true;
            const originalButtonContent = fetchCurrentLocationButtonEl.innerHTML;
            fetchCurrentLocationButtonEl.innerHTML =
                `<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>`;
            navigator.geolocation.getCurrentPosition(async (position) => {
                currentLocationCoords.lat = position.coords.latitude;
                currentLocationCoords.lon = position.coords.longitude;
                try {
                    const response = await fetch(
                        `${NOMINATIM_REVERSE_URL}?format=json&lat=${currentLocationCoords.lat}&lon=${currentLocationCoords.lon}&accept-language=id&addressdetails=1`
                    );
                    if (!response.ok) throw new Error('Gagal reverse geocoding');
                    const data = await response.json();
                    currentLocationCoords.displayName = data && data.display_name ? data.display_name :
                        `Koordinat: ${currentLocationCoords.lat.toFixed(5)}, ${currentLocationCoords.lon.toFixed(5)}`;
                    currentLocationInputEl.value = currentLocationCoords.displayName;
                    showAppNotification(data && data.display_name ? 'Lokasi GPS ditemukan & diisi.' :
                        'Lokasi GPS (koordinat) ditemukan.', data && data.display_name ? 'success' :
                        'warning');
                    currentLocationMapMarker = updateInputLocationMarker(currentLocationCoords,
                        currentLocationMapMarker, true, map);
                    if (map && currentLocationMapMarker) map.setView([currentLocationCoords.lat,
                        currentLocationCoords.lon
                    ], 13);
                    tryAutoCalculateRadius();
                } catch (error) {
                    console.error('Error reverse geocoding GPS:', error);
                    currentLocationCoords.displayName =
                        `Koordinat: ${currentLocationCoords.lat.toFixed(5)}, ${currentLocationCoords.lon.toFixed(5)}`;
                    currentLocationInputEl.value = currentLocationCoords.displayName;
                    showAppNotification('Gagal dapat nama alamat dari GPS. Menggunakan koordinat.',
                        'warning');
                    currentLocationMapMarker = updateInputLocationMarker(currentLocationCoords,
                        currentLocationMapMarker, true, map);
                    if (map && currentLocationMapMarker) map.setView([currentLocationCoords.lat,
                        currentLocationCoords.lon
                    ], 13);
                    tryAutoCalculateRadius();
                } finally {
                    fetchCurrentLocationButtonEl.disabled = false;
                    fetchCurrentLocationButtonEl.innerHTML = originalButtonContent;
                }
            }, (error) => {
                let message = 'Gagal mendapatkan lokasi GPS: ';
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        message += 'Anda menolak izin Geolocation.';
                        break;
                    case error.POSITION_UNAVAILABLE:
                        message += 'Informasi lokasi tidak tersedia.';
                        break;
                    case error.TIMEOUT:
                        message += 'Permintaan lokasi timed out.';
                        break;
                    default:
                        message += 'Kesalahan tidak diketahui.';
                        break;
                }
                showAppNotification(message, 'error');
                fetchCurrentLocationButtonEl.disabled = false;
                fetchCurrentLocationButtonEl.innerHTML = originalButtonContent;
                currentLocationCoords.lat = null;
                currentLocationCoords.lon = null;
                currentLocationCoords.displayName = '';
                currentLocationInputEl.value = '';
                if (currentLocationMapMarker && map.hasLayer(currentLocationMapMarker)) {
                    map.removeLayer(currentLocationMapMarker);
                    currentLocationMapMarker = null;
                }
                tryAutoCalculateRadius();
            }, {
                timeout: 10000,
                enableHighAccuracy: true
            });
        }

        // --- Fungsi Inti Peta (fetchWastePoints, getMarkerIcon, updateAreaStatistics, addMarkers, calculateDistance, initializeMap) ---
        // ... (fetchWastePoints, getMarkerIcon, updateAreaStatistics, addMarkers, calculateDistance, initializeMap sebagian besar sama)
        async function fetchWastePoints() {
            try {
                const response = await fetch(API_REPORTS_URL);
                if (!response.ok) {
                    const errorText = await response.text();
                    throw new Error(
                        `Gagal mengambil data laporan: ${response.status} ${response.statusText} - ${errorText}`);
                }
                const data = await response.json();
                const validReports = data.reports.map(report => {
                    const lat = parseFloat(report.coords?.[0]);
                    const lon = parseFloat(report.coords?.[1]);
                    if (isNaN(lat) || isNaN(lon)) {
                        console.warn(`Laporan "${report.name}" dilewati karena koordinat tidak valid:`, report
                            .coords);
                        return null;
                    }
                    return {
                        id: report.id || null,
                        name: report.name || 'Unknown',
                        coords: [lat, lon],
                        type: report.type || 'Unknown',
                        address: report.location || 'Unknown',
                        capacity: report.size || 'Unknown',
                        urgency: report.urgency || 'Unknown',
                        description: report.description || 'No description',
                        photos: report.photos || [],
                        province: report.province || 'UnknownProvince',
                        city: report.city || 'UnknownCity'
                    };
                }).filter(report => report !== null);
                return {
                    reports: validReports,
                    provinceReports: data.provinceReports,
                    cityReports: data.cityReports
                };
            } catch (error) {
                console.error('Error fetching waste points:', error);
                showAppNotification('Gagal memuat data laporan: ' + error.message, 'error');
                return {
                    reports: [],
                    provinceReports: {},
                    cityReports: {}
                };
            }
        }

        function getMarkerIcon() {
            /* ... sama ... */
            return L.icon({
                iconUrl: MARKER_ICON_URL,
                shadowUrl: MARKER_SHADOW_URL,
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [0, -41],
                shadowSize: [41, 41],
                shadowAnchor: [12, 41]
            });
        }

        function updateAreaStatistics(wastePoints) {
            /* ... sama ... */
            const types = ['organik', 'anorganik', 'b3', 'campuran'];
            const reportCounts = types.map(type => ({
                label: type.charAt(0).toUpperCase() + type.slice(1),
                count: wastePoints.filter(point => point.type === type).length,
                unit: 'lokasi'
            }));
            const totalReports = wastePoints.length;
            statsContainerEl.innerHTML = '';
            if (totalReports === 0) {
                statsContainerEl.innerHTML =
                    `<p class="text-gray-400 text-center py-4">Tidak ada statistik untuk area ini.</p>`;
                return;
            }
            reportCounts.forEach(({
                label,
                count,
                unit
            }) => {
                const statDiv = document.createElement('div');
                statDiv.innerHTML =
                    `<p class="text-sm text-gray-300 mb-2">${label}</p><div class="w-full bg-gray-800 rounded-full h-3"><div class="bg-gradient-to-r from-[#22d3ee] to-[#06b6d4] h-3 rounded-full transition-all duration-500" style="width: ${totalReports > 0 ? (count / totalReports) * 100 : 0}%"></div></div><p class="text-right text-xs text-gray-400 mt-1">${count} ${unit}</p>`;
                statsContainerEl.appendChild(statDiv);
            });
        }
        async function addMarkers(filteredLocations, userLatLon) {
            /* ... sama ... */
            markers.clearLayers();
            nearestLocationsListEl.innerHTML = '';
            if (filteredLocations.length === 0) {
                nearestLocationsListEl.innerHTML =
                    `<li class="text-gray-400 text-center py-4">Tidak ada laporan ditemukan.</li>`;
            }
            const uniqueLocationKeys = new Set();
            filteredLocations.forEach(loc => {
                if (!loc.coords || loc.coords.length !== 2 || isNaN(loc.coords[0]) || isNaN(loc.coords[1])) {
                    return;
                }
                const [lat, lon] = loc.coords;
                const locationKey = `${lat},${lon}`;
                if (uniqueLocationKeys.has(locationKey)) return;
                uniqueLocationKeys.add(locationKey);
                const distance = userLatLon ? calculateDistance(userLatLon[0], userLatLon[1], lat, lon) : 0;
                const popupContent =
                    `<div class="p-3"><h4 class="font-bold text-gray-900 text-base mb-2">${loc.name}</h4><p class="text-gray-700 text-sm mb-1"><strong>Alamat:</strong> ${loc.address}</p><p class="text-gray-700 text-sm mb-1"><strong>Jenis:</strong> ${loc.type.charAt(0).toUpperCase() + loc.type.slice(1)}</p><p class="text-gray-700 text-sm mb-1"><strong>Ukuran:</strong> ${loc.capacity}</p><p class="text-gray-700 text-sm mb-1"><strong>Urgensi:</strong> ${loc.urgency}</p><p class="text-gray-700 text-sm mb-2"><strong>Deskripsi:</strong> ${loc.description}</p>${loc.photos && loc.photos.length > 0 ? '<p class="text-gray-700 text-sm mb-1"><strong>Foto:</strong></p>' + loc.photos.map(photo => `<img src="${photo}" alt="Waste Photo" class="w-full mt-1 rounded-md shadow-sm">`).join('') : ''}</div>`;
                const marker = L.marker([lat, lon], {
                    icon: getMarkerIcon()
                }).bindPopup(popupContent, {
                    className: 'popup-content',
                    autoPanPadding: [50, 50]
                });
                markers.addLayer(marker);
                const radiusFilter = parseFloat(radiusInputEl.value);
                if (!userLatLon || distance <= radiusFilter || radiusFilter === 0 || isNaN(radiusFilter)) {
                    const li = document.createElement('li');
                    li.className =
                        'border-b border-gray-700 pb-3 transition hover:bg-gray-800 rounded-md px-2 py-2 cursor-pointer text-gray-300 hover:text-white';
                    li.innerHTML =
                        `<h4 class="font-semibold text-base">${loc.name}</h4><p class="text-xs">${loc.address}</p><p class="text-xs">Jenis: ${loc.type.charAt(0).toUpperCase() + loc.type.slice(1)}</p><p class="text-xs">Ukuran: ${loc.capacity}</p><p class="text-xs">Urgensi: ${loc.urgency}</p>${userLatLon ? `<p class="text-xs">${distance.toFixed(1)} km dari lokasi Anda</p>` : ''}${loc.city && loc.city !== 'UnknownCity' ? `<p class="text-xs">Kota: ${loc.city}</p>` : ''}${loc.province && loc.province !== 'UnknownProvince' ? `<p class="text-xs">Provinsi: ${loc.province}</p>` : ''}`;
                    li.addEventListener('click', () => {
                        if (map) map.setView([lat, lon], 14);
                        marker.openPopup();
                    });
                    nearestLocationsListEl.appendChild(li);
                }
            });
            let boundsToFit = null;
            if (markers.getLayers().length > 0) {
                boundsToFit = markers.getBounds();
            }
            if (routeLine && map.hasLayer(routeLine)) {
                boundsToFit = boundsToFit ? boundsToFit.extend(routeLine.getBounds()) : routeLine.getBounds();
            }
            if (boundsToFit && map) {
                map.fitBounds(boundsToFit, {
                    padding: [50, 50],
                    maxZoom: 16
                });
            } else if (!userLatLon && map && !routeLine && !routingControl) {
                map.setView(DEFAULT_MAP_CENTER, DEFAULT_MAP_ZOOM);
            }
        }

        function calculateDistance(lat1, lon1, lat2, lon2) {
            /* ... sama ... */
            const R = 6371;
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI /
                180) * Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }
        async function initializeMap() {
            /* ... sama, hanya update atribusi ... */
            map = L.map('map', {
                center: DEFAULT_MAP_CENTER,
                zoom: DEFAULT_MAP_ZOOM,
                minZoom: MIN_ZOOM,
                maxZoom: MAX_ZOOM,
                zoomControl: false
            });
            L.control.zoom({
                position: 'topleft'
            }).addTo(map);
            osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors & OSRM',
                maxZoom: MAX_ZOOM
            });
            satelliteLayer = L.tileLayer(
                'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                    attribution: 'Tiles © Esri & OSRM',
                    maxZoom: MAX_ZOOM
                });
            let initialLayer = localStorage.getItem('mapLayer') === 'satellite' ? satelliteLayer : osmLayer;
            initialLayer.addTo(map);
            markers = L.markerClusterGroup({
                maxClusterRadius: 60,
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
                zoomToBoundsOnClick: true,
                disableClusteringAtZoom: 14,
                iconCreateFunction: function(cluster) {
                    const count = cluster.getChildCount();
                    let sc = 'small';
                    if (count >= 10 && count < 100) sc = 'medium';
                    else if (count >= 100) sc = 'large';
                    return L.divIcon({
                        html: `<div><span>${count}</span></div>`,
                        className: `marker-cluster marker-cluster-${sc}`,
                        iconSize: L.point(40, 40)
                    });
                }
            });
            map.addLayer(markers);
            showAppNotification('Memuat data peta awal...', 'info', 2000);
            const {
                reports,
                provinceReports,
                cityReports
            } = await fetchWastePoints();
            addMarkers(reports, null);
            updateAreaStatistics(reports);
            const provinceGeoJsonPromise = fetch(PROVINCE_GEOJSON_PATH).then(response => {
                if (!response.ok) throw new Error('Gagal memuat GeoJSON Provinsi: ' + response.statusText);
                return response.json();
            }).catch(error => {
                console.error('Error loading Province GeoJSON:', error);
                showAppNotification(error.message, 'error');
                return null;
            });
            const cityGeoJsonPromise = fetch(CITY_GEOJSON_PATH).then(response => {
                if (!response.ok) throw new Error('Gagal memuat GeoJSON Kota: ' + response.statusText);
                return response.json();
            }).catch(error => {
                console.error('Error loading City GeoJSON:', error);
                showAppNotification(error.message, 'error');
                return null;
            });
            Promise.all([provinceGeoJsonPromise, cityGeoJsonPromise]).then(([provinceGeoJson, cityGeoJson]) => {
                if (!provinceGeoJson || !cityGeoJson) {
                    showAppNotification('Gagal memuat GeoJSON. Fitur peta wilayah mungkin tidak berfungsi.',
                        'warning');
                    return;
                }
                const provinceCentroids = {};
                provinceGeoJson.features.forEach(feature => {
                    const bounds = L.geoJSON(feature).getBounds();
                    if (bounds.isValid()) provinceCentroids[feature.properties.NAME_1] = bounds
                        .getCenter();
                });
                const cityCentroids = {};
                cityGeoJson.features.forEach(feature => {
                    const bounds = L.geoJSON(feature).getBounds();
                    if (bounds.isValid()) cityCentroids[feature.properties.NAME_2] = bounds.getCenter();
                });

                function getCircleOptions(reports) {
                    if (reports >= 16) return {
                        color: '#b30000',
                        fillColor: '#b30000',
                        radius: 60000
                    };
                    if (reports >= 8) return {
                        color: '#ff4500',
                        fillColor: '#ff4500',
                        radius: 50000
                    };
                    if (reports >= 4) return {
                        color: '#ff8c00',
                        fillColor: '#ff8c00',
                        radius: 45000
                    };
                    if (reports > 0) return {
                        color: '#ffd700',
                        fillColor: '#ffd700',
                        radius: 40000
                    };
                    return {
                        color: '#32cd32',
                        fillColor: '#32cd32',
                        radius: 30000
                    };
                }
                provinceCircleLayerGroup = L.layerGroup();
                cityCircleLayerGroup = L.layerGroup();

                function updateMapFeatures() {
                    provinceCircleLayerGroup.clearLayers();
                    cityCircleLayerGroup.clearLayers();
                    map.eachLayer(layer => {
                        if (layer instanceof L.Marker && !markers.hasLayer(layer) && !(layer ===
                                currentLocationMapMarker || layer === targetLocationMapMarker) && layer
                            .options.icon && layer.options.icon.options.iconUrl.includes(
                            'marker-icon') && !layer.options.className?.includes('waste-circle-label')
                            ) {}
                    });
                    provinceGeoJson.features.forEach(feature => {
                        const provinceName = feature.properties.NAME_1;
                        const reportCount = provinceReports[provinceName] || 0;
                        const centroid = provinceCentroids[provinceName];
                        if (centroid && map.getZoom() < 8) {
                            const circle = L.circle(centroid, {
                                ...getCircleOptions(reportCount),
                                fillOpacity: 0.5,
                                className: 'waste-circle'
                            });
                            const numberIcon = L.divIcon({
                                className: 'waste-circle-label',
                                html: `<span>${reportCount}</span>`,
                                iconSize: [40, 40],
                                iconAnchor: [20, 20]
                            });
                            const numberMarker = L.marker(centroid, {
                                icon: numberIcon,
                                interactive: false
                            });
                            circle.bindTooltip(`<b>${provinceName}</b><br>${reportCount} laporan`, {
                                permanent: false,
                                className: 'leaflet-tooltip',
                                direction: 'center',
                                opacity: 0.9
                            }).bindPopup(`<b>${provinceName}</b><br>Jumlah Laporan: ${reportCount}`);
                            provinceCircleLayerGroup.addLayer(circle).addLayer(numberMarker);
                        }
                    });
                    cityGeoJson.features.forEach(feature => {
                        const cityName = feature.properties.NAME_2;
                        const reportCount = cityReports[cityName] || 0;
                        const centroid = cityCentroids[cityName];
                        if (centroid && map.getZoom() >= 8) {
                            const circle = L.circle(centroid, {
                                ...getCircleOptions(reportCount),
                                fillOpacity: 0.5,
                                className: 'waste-circle'
                            });
                            const numberIcon = L.divIcon({
                                className: 'waste-circle-label',
                                html: `<span>${reportCount}</span>`,
                                iconSize: [40, 40],
                                iconAnchor: [20, 20]
                            });
                            const numberMarker = L.marker(centroid, {
                                icon: numberIcon,
                                interactive: false
                            });
                            circle.bindTooltip(`<b>${cityName}</b><br>${reportCount} laporan`, {
                                permanent: false,
                                className: 'leaflet-tooltip',
                                direction: 'center',
                                opacity: 0.9
                            }).bindPopup(`<b>${cityName}</b><br>Jumlah Laporan: ${reportCount}`);
                            cityCircleLayerGroup.addLayer(circle).addLayer(numberMarker);
                        }
                    });
                }
                updateMapFeatures();
                map.on('zoomend', updateMapFeatures);

                function getChoroplethColor(d) {
                    return d > 100 ? '#800000' : d > 50 ? '#b30000' : d > 20 ? '#e34a33' : d > 10 ? '#fc8d59' :
                        d > 0 ? '#fdcc8a' : '#f7f7f7';
                }

                function styleProvince(feature) {
                    const reports = provinceReports[feature.properties.NAME_1] || 0;
                    return {
                        fillColor: getChoroplethColor(reports),
                        weight: 2,
                        opacity: 1,
                        color: 'white',
                        dashArray: '3',
                        fillOpacity: 0.7
                    };
                }

                function styleCity(feature) {
                    const reports = cityReports[feature.properties.NAME_2] || 0;
                    return {
                        fillColor: getChoroplethColor(reports),
                        weight: 2,
                        opacity: 1,
                        color: 'white',
                        dashArray: '3',
                        fillOpacity: 0.7
                    };
                }
                info = L.control();
                info.onAdd = function(map) {
                    this._div = L.DomUtil.create('div', 'info');
                    this.update();
                    return this._div;
                };
                info.update = function(props) {
                    const name = props ? (props.NAME_1 || props.NAME_2) : null;
                    const reportCount = name ? (provinceReports[props.NAME_1] || cityReports[props
                        .NAME_2] || 0) : 0;
                    this._div.innerHTML = '<h4>Jumlah Laporan Sampah</h4>' + (props ?
                        `<b>${name}</b><br />${reportCount} laporan` : 'Arahkan kursor');
                };

                function highlightFeature(e) {
                    const layer = e.target;
                    layer.setStyle({
                        weight: 5,
                        color: '#22d3ee',
                        dashArray: '',
                        fillOpacity: 0.7
                    });
                    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) layer.bringToFront();
                    info.update(layer.feature.properties);
                }

                function resetHighlightProvince(e) {
                    if (provinceChoroplethLayer) provinceChoroplethLayer.resetStyle(e.target);
                    info.update();
                }

                function resetHighlightCity(e) {
                    if (cityChoroplethLayer) cityChoroplethLayer.resetStyle(e.target);
                    info.update();
                }

                function zoomToFeature(e) {
                    map.fitBounds(e.target.getBounds());
                }
                provinceChoroplethLayer = L.geoJSON(provinceGeoJson, {
                    style: styleProvince,
                    onEachFeature: (feature, layer) => {
                        const reports = provinceReports[feature.properties.NAME_1] || 0;
                        layer.bindTooltip(
                            `<b>${feature.properties.NAME_1}</b><br>${reports} laporan`, {
                                sticky: true,
                                className: 'leaflet-tooltip',
                                opacity: 0.9
                            });
                        layer.on({
                            mouseover: highlightFeature,
                            mouseout: resetHighlightProvince,
                            click: zoomToFeature
                        });
                    }
                });
                cityChoroplethLayer = L.geoJSON(cityGeoJson, {
                    style: styleCity,
                    onEachFeature: (feature, layer) => {
                        const reports = cityReports[feature.properties.NAME_2] || 0;
                        layer.bindTooltip(
                            `<b>${feature.properties.NAME_2}</b><br>${reports} laporan`, {
                                sticky: true,
                                className: 'leaflet-tooltip',
                                opacity: 0.9
                            });
                        layer.on({
                            mouseover: highlightFeature,
                            mouseout: resetHighlightCity,
                            click: zoomToFeature
                        });
                    }
                });
                legend = L.control({
                    position: 'bottomright'
                });
                legend.onAdd = function(map) {
                    const div = L.DomUtil.create('div', 'info legend');
                    const labels = ['<i style="background:#32cd32"></i> 0 laporan',
                        '<i style="background:#fdcc8a"></i> 1–10 laporan',
                        '<i style="background:#fc8d59"></i> 11–20 laporan',
                        '<i style="background:#e34a33"></i> 21–50 laporan',
                        '<i style="background:#b30000"></i> 51–100 laporan',
                        '<i style="background:#800000"></i> > 100 laporan'
                    ];
                    div.innerHTML = labels.join('<br>');
                    return div;
                };
                const baseMaps = {
                    "Peta": osmLayer,
                    "Satelit": satelliteLayer
                };
                const overlayMaps = {
                    "Marker Laporan Sampah": markers,
                    "Choropleth (Provinsi)": provinceChoroplethLayer,
                    "Choropleth (Kota)": cityChoroplethLayer,
                    "Lingkaran Laporan (Provinsi)": provinceCircleLayerGroup,
                    "Lingkaran Laporan (Kota)": cityCircleLayerGroup
                };
                L.control.layers(baseMaps, overlayMaps).addTo(map);
                map.on('overlayadd overlayremove', function(e) {
                    const isChoropleth = e.name.includes('Choropleth');
                    const isProvCircle = e.name.includes('Lingkaran Laporan (Provinsi)');
                    const isCityCircle = e.name.includes('Lingkaran Laporan (Kota)');
                    if (isChoropleth) {
                        if (e.type === 'overlayadd') {
                            if (info) info.addTo(map);
                            if (legend) legend.addTo(map);
                        } else if (!map.hasLayer(provinceChoroplethLayer) && !map.hasLayer(
                                cityChoroplethLayer)) {
                            if (info && map.hasControl(info)) map.removeControl(info);
                            if (legend && map.hasControl(legend)) map.removeControl(legend);
                        }
                    }
                    if (isProvCircle || isCityCircle) {
                        if (e.type === 'overlayadd') updateMapFeatures();
                        else {
                            if (isProvCircle) provinceCircleLayerGroup.clearLayers();
                            if (isCityCircle) cityCircleLayerGroup.clearLayers();
                        }
                    }
                });
                map.on('baselayerchange', e => localStorage.setItem('mapLayer', e.name.toLowerCase()));
                if (provinceChoroplethLayer) provinceChoroplethLayer.addTo(map);
                if (info) info.addTo(map);
                if (legend) legend.addTo(map);
            });
        }


        // --- Event Listeners untuk Input Lokasi & Tombol ---
        fetchCurrentLocationButtonEl.addEventListener('click', handleFetchCurrentLocation);
        currentLocationInputEl.addEventListener('change', (event) => geocodeLocation(event.target.value,
            currentLocationInputEl, currentLocationCoords, true));
        targetLocationInputEl.addEventListener('change', (event) => geocodeLocation(event.target.value,
            targetLocationInputEl, targetLocationCoords, false));

        searchButtonEl.addEventListener('click', async () => {
            searchButtonIconEl.textContent = '⏳';
            searchButtonTextEl.textContent = 'Mencari...';
            searchButtonEl.disabled = true;

            if (routeLine && map.hasLayer(routeLine)) {
                map.removeLayer(routeLine);
                routeLine = null;
            }
            if (routingControl) {
                map.removeControl(routingControl);
                routingControl = null;
            }

            let searchCenterLatLon = null;
            let searchDisplayName = "data umum";
            const manualTargetQuery = targetLocationInputEl.value.trim();
            const currentLocQuery = currentLocationInputEl.value.trim();

            // ... (logika validasi dan penentuan searchCenterLatLon tetap sama)
            if (targetLocationCoords.lat !== null && targetLocationCoords.lon !== null) {
                searchCenterLatLon = [targetLocationCoords.lat, targetLocationCoords.lon];
                searchDisplayName = targetLocationCoords.displayName || manualTargetQuery;
                showAppNotification(`Pencarian difokuskan pada: "${searchDisplayName}"`, 'info', 3000);
                if (map && !(currentLocationCoords.lat && targetLocationCoords.lat)) {
                    map.setView(searchCenterLatLon, map.getZoom() < 10 ? 10 : map.getZoom());
                }
            } else if (manualTargetQuery !== "" && (targetLocationCoords.lat === null || targetLocationCoords
                    .lon === null)) {
                showAppNotification(`Lokasi Tujuan "${manualTargetQuery}" tidak valid.`, 'error', 6000);
                searchButtonIconEl.textContent = '🔍';
                searchButtonTextEl.textContent = 'Cari';
                searchButtonEl.disabled = false;
                return;
            } else if (currentLocationCoords.lat !== null && currentLocationCoords.lon !== null) {
                searchCenterLatLon = [currentLocationCoords.lat, currentLocationCoords.lon];
                searchDisplayName = currentLocationCoords.displayName || currentLocQuery;
                showAppNotification(`Lokasi Tujuan kosong, pencarian difokuskan pada: "${searchDisplayName}"`,
                    'info', 3000);
                if (map) map.setView(searchCenterLatLon, 12);
            } else if (currentLocQuery !== "" && (currentLocationCoords.lat === null || currentLocationCoords
                    .lon === null)) {
                showAppNotification(`Lokasi Anda Saat Ini "${currentLocQuery}" tidak valid.`, 'error', 6000);
                searchButtonIconEl.textContent = '🔍';
                searchButtonTextEl.textContent = 'Cari';
                searchButtonEl.disabled = false;
                return;
            } else {
                showAppNotification('Tidak ada lokasi valid untuk pusat pencarian.', 'warning');
            }


            if (currentLocationCoords.lat !== null && currentLocationCoords.lon !== null &&
                targetLocationCoords.lat !== null && targetLocationCoords.lon !== null) {

                const latlngsStraight = [
                    [currentLocationCoords.lat, currentLocationCoords.lon],
                    [targetLocationCoords.lat, targetLocationCoords.lon]
                ];
                routeLine = L.polyline(latlngsStraight, {
                    color: 'red', // UBAH WARNA GARIS LURUS MENJADI MERAH
                    weight: 3,
                    opacity: 0.7,
                    dashArray: '5, 5'
                }).addTo(map);
                showAppNotification('Garis lurus antara lokasi Anda dan tujuan ditampilkan.', 'info', 3000);

                try {
                    routingControl = L.Routing.control({
                        waypoints: [
                            L.latLng(currentLocationCoords.lat, currentLocationCoords.lon),
                            L.latLng(targetLocationCoords.lat, targetLocationCoords.lon)
                        ],
                        router: L.Routing.osrmv1({
                            serviceUrl: 'https://router.project-osrm.org/route/v1'
                        }),
                        lineOptions: {
                            styles: [{
                                color: '#06b6d4',
                                opacity: 0.8,
                                weight: 5
                            }]
                        },
                        show: true,
                        addWaypoints: false,
                        draggableWaypoints: false,
                        fitSelectedRoutes: 'smart',
                        createMarker: function() {
                            return null;
                        }
                    }).on('routesfound', function(e) {
                        const routes = e.routes;
                        if (routes.length > 0) {
                            const summary = routes[0].summary;
                            showAppNotification(
                                `Rute jalan ditemukan: ${ (summary.totalDistance / 1000).toFixed(1)} km, sekitar ${(summary.totalTime / 60).toFixed(0)} menit.`,
                                'success');
                        }
                    }).on('routingerror', function(e) {
                        console.error("Routing error:", e.error);
                        showAppNotification(
                            `Gagal mendapatkan rute jalan: ${e.error.message || 'Error OSRM.'}`,
                            'error');
                        if (routingControl) {
                            map.removeControl(routingControl);
                            routingControl = null;
                        }
                    }).addTo(map);
                } catch (error) {
                    console.error("Error membuat routing control:", error);
                    showAppNotification("Error membuat rute jalan.", "error");
                }
            }

            const typeFilter = typeInputEl.value;
            const radiusToSearch = parseFloat(radiusInputEl.value);

            if (!searchCenterLatLon && (currentLocQuery !== "" || manualTargetQuery !== "")) {
                showAppNotification(`Input lokasi ada tapi tidak dapat diproses.`, 'error', 5000);
                searchButtonIconEl.textContent = '🔍';
                searchButtonTextEl.textContent = 'Cari';
                searchButtonEl.disabled = false;
                return;
            }

            try {
                const {
                    reports
                } = await fetchWastePoints();
                let filteredLocations = reports;
                if (typeFilter) {
                    filteredLocations = filteredLocations.filter(loc => loc.type === typeFilter);
                }

                if (searchCenterLatLon && radiusToSearch > 0 && !isNaN(radiusToSearch)) {
                    const centerForRadiusFilter = (currentLocationCoords.lat && targetLocationCoords.lat) ? [
                            currentLocationCoords.lat, currentLocationCoords.lon
                        ] :
                        searchCenterLatLon;
                    if (centerForRadiusFilter) {
                        filteredLocations = filteredLocations.filter(loc => {
                            if (loc.coords && loc.coords.length === 2 && !isNaN(loc.coords[0]) && !
                                isNaN(loc.coords[1])) {
                                const distance = calculateDistance(centerForRadiusFilter[0],
                                    centerForRadiusFilter[1], loc.coords[0], loc.coords[1]);
                                return distance <= radiusToSearch;
                            }
                            return false;
                        });
                    }
                } else if (searchCenterLatLon && (isNaN(radiusToSearch) || radiusToSearch <= 0)) {
                    showAppNotification('Radius tidak valid. Filter radius dilewati.', 'warning');
                }

                const referencePointForDistanceList = currentLocationCoords.lat ? [currentLocationCoords.lat,
                    currentLocationCoords.lon
                ] : searchCenterLatLon;
                addMarkers(filteredLocations, referencePointForDistanceList);
                updateAreaStatistics(filteredLocations);

            } catch (error) {
                console.error('Error pada proses pencarian laporan:', error);
                showAppNotification('Gagal memproses pencarian laporan.', 'error');
                const {
                    reports
                } = await fetchWastePoints();
                addMarkers(reports, null);
                updateAreaStatistics(reports);
            } finally {
                searchButtonIconEl.textContent = '🔍';
                searchButtonTextEl.textContent = 'Cari';
                searchButtonEl.disabled = false;
            }
        });

        document.getElementById('resetMapButton').addEventListener('click', async () => {
            showAppNotification('Mereset peta & filter...', 'info', 2000);
            if (map) {
                map.setView(DEFAULT_MAP_CENTER, DEFAULT_MAP_ZOOM);
                if (map.closePopup) map.closePopup();
            }
            if (routeLine && map.hasLayer(routeLine)) {
                map.removeLayer(routeLine);
                routeLine = null;
            }
            if (routingControl) {
                map.removeControl(routingControl);
                routingControl = null;
            }

            const {
                reports
            } = await fetchWastePoints();
            addMarkers(reports, null);
            updateAreaStatistics(reports);
            currentLocationInputEl.value = '';
            targetLocationInputEl.value = '';
            typeInputEl.value = '';
            radiusInputEl.value = '10';
            currentLocationCoords = {
                lat: null,
                lon: null,
                displayName: ''
            };
            targetLocationCoords = {
                lat: null,
                lon: null,
                displayName: ''
            };
            if (currentLocationMapMarker && map.hasLayer(currentLocationMapMarker)) {
                map.removeLayer(currentLocationMapMarker);
                currentLocationMapMarker = null;
            }
            if (targetLocationMapMarker && map.hasLayer(targetLocationMapMarker)) {
                map.removeLayer(targetLocationMapMarker);
                targetLocationMapMarker = null;
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            initializeMap();
        });
    </script>
@endsection
