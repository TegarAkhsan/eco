@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-12 font-['Poppins']">
        <h1 class="text-4xl font-extrabold text-white mb-8 tracking-tight text-center">
            Peta Interaktif Sampah
        </h1>

        <div class="bg-[#0b1121]/70 backdrop-blur-md p-6 rounded-2xl mb-8 shadow-[0px_6px_20px_rgba(0,0,0,0.4)]">
            <div class="grid md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-300 mb-2">Lokasi</label>
                    <input type="text" id="location" name="location"
                        class="w-full px-4 py-3 rounded-xl bg-[#1e293b]/80 border border-gray-600 text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 transition duration-300"
                        placeholder="Cari lokasi...">
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-300 mb-2">Jenis Lokasi</label>
                    <div class="relative">
                        <select id="type" name="type"
                            class="w-full appearance-none pr-10 px-4 py-3 rounded-xl bg-[#1e293b]/80 border border-gray-600 text-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-400 transition duration-300">
                            <option value="">Semua</option>
                            <option value="organik">Organik</option>
                            <option value="anorganik">Anorganik</option>
                            <option value="b3">B3</option>
                            <option value="campuran">Campuran</option>
                        </select>
                        <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                            ▼
                        </div>
                    </div>
                </div>
                <div>
                    <label for="radius" class="block text-sm font-medium text-gray-300 mb-2">Radius (km)</label>
                    <input type="number" id="radius" name="radius" min="1" max="50" value="10"
                        class="w-full px-4 py-3 rounded-xl bg-[#1e293b]/80 border border-gray-600 text-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-400 transition duration-300">
                </div>
            </div>
            <button id="searchButton"
                class="flex items-center justify-center gap-2 bg-gradient-to-r from-cyan-400 to-cyan-600 hover:from-cyan-500 hover:to-cyan-700 text-white px-6 py-3 rounded-xl transition duration-300 shadow-md font-semibold">
                🔍 Cari
            </button>
        </div>

        <div class="bg-[#d9d9d9]/10 rounded-xl overflow-hidden h-[700px] shadow-[0px_6px_20px_rgba(0,0,0,0.3)] relative">
            <div id="map" class="w-full h-full"></div>
            <button id="resetMapButton" class="custom-reset-button">
                Reset Peta
            </button>
        </div>

        <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-[#0b1121]/80 backdrop-blur-lg p-6 rounded-2xl shadow-xl">
                <h3 class="text-2xl font-semibold text-white mb-5 flex items-center gap-2">
                    <svg class="w-6 h-6 text-[#22d3ee]" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M17.657 16.657L13.414 12l4.243-4.243M6.343 7.343L10.586 12l-4.243 4.243" />
                    </svg>
                    Lokasi Terdekat
                </h3>
                <ul id="nearest-locations" class="space-y-5 text-gray-300 text-sm">
                </ul>
            </div>

            <div class="bg-[#0b1121]/80 backdrop-blur-lg p-6 rounded-2xl shadow-xl">
                <h3 class="text-2xl font-semibold text-white mb-5 flex items-center gap-2">
                    <svg class="w-6 h-6 text-[#22d3ee]" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M11 3v18m-4-4l4 4 4-4" />
                    </svg>
                    Statistik Area
                </h3>
                <div id="area-statistics" class="space-y-5">
                </div>
            </div>

            <div class="bg-[#0b1121]/80 backdrop-blur-lg p-6 rounded-2xl shadow-xl flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl font-semibold text-white mb-5 flex items-center gap-2">
                        <svg class="w-6 h-6 text-[#22d3ee]" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M12 4v16m8-8H4" />
                        </svg>
                        Laporkan Titik Baru
                    </h3>
                    <p class="text-sm text-gray-300 mb-6 leading-relaxed">Temukan titik sampah liar yang belum
                        terpetakan?
                        Laporkan sekarang untuk membantu lingkungan kita menjadi lebih bersih.</p>
                </div>
                <a href="{{ route('report') }}"
                    class="mt-auto bg-gradient-to-r from-[#22d3ee] to-[#06b6d4] hover:from-[#06b6d4] hover:to-[#0891b2] text-white px-6 py-3 rounded-lg inline-block transition duration-300 shadow-lg text-center font-medium">
                    Laporkan Titik Sampah
                </a>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

    <style>
        /* Existing styles remain unchanged */
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

        /* Circle styles */
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

        /* Custom styles for waste circles with numbers */
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

        /* Choropleth styles */
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

        /* Tooltip style */
        .leaflet-tooltip {
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 4px 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }
    </style>

    <script>
        // Fetch user-submitted waste points from the database dynamically
        async function fetchWastePoints() {
            try {
                const response = await fetch('/api/reports');
                if (!response.ok) {
                    const errorText = await response.text();
                    throw new Error(
                        `Gagal mengambil data laporan: ${response.status} ${response.statusText} - ${errorText}`);
                }
                const data = await response.json();
                console.log('API Response Data:', data);

                return {
                    reports: data.reports.map(report => ({
                        id: report.id || null,
                        name: report.name || 'Unknown',
                        coords: report.coords && report.coords.length === 2 ? [parseFloat(report.coords[0]),
                            parseFloat(report.coords[1])
                        ] : [0, 0],
                        type: report.type || 'Unknown',
                        address: report.location || 'Unknown',
                        capacity: report.size || 'Unknown',
                        urgency: report.urgency || 'Unknown',
                        description: report.description || 'No description',
                        photos: report.photos || [],
                        province: report.province || 'UnknownProvince',
                        city: report.city || 'UnknownCity'
                    })),
                    provinceReports: data.provinceReports,
                    cityReports: data.cityReports
                };
            } catch (error) {
                console.error('Error fetching waste points:', error);
                alert('Gagal memuat data laporan: ' + error.message);
                return {
                    reports: [],
                    provinceReports: {},
                    cityReports: {}
                };
            }
        }

        // Map initialization with Leaflet
        const map = L.map('map', {
            center: [-2.5489, 118.0149],
            zoom: 5,
            minZoom: 3,
            maxZoom: 18,
            zoomControl: false
        });

        // Add custom zoom control
        L.control.zoom({
            position: 'topleft'
        }).addTo(map);

        // Tile layers
        const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            tileSize: 256,
            maxZoom: 18
        });

        const satelliteLayer = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles © Esri — Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community',
                maxZoom: 18
            });

        // Set default layer and add to map
        let defaultLayer = localStorage.getItem('mapLayer') === 'satellite' ? satelliteLayer : osmLayer;
        defaultLayer.addTo(map);

        // Initialize marker cluster group with optimized settings
        const markers = L.markerClusterGroup({
            maxClusterRadius: 60,
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: true,
            zoomToBoundsOnClick: true,
            disableClusteringAtZoom: 14,
            iconCreateFunction: function(cluster) {
                const count = cluster.getChildCount();
                let sizeClass = 'small';
                if (count >= 10 && count < 100) sizeClass = 'medium';
                else if (count >= 100) sizeClass = 'large';
                return L.divIcon({
                    html: `<div><span>${count}</span></div>`,
                    className: `marker-cluster marker-cluster-${sizeClass}`,
                    iconSize: L.point(40, 40)
                });
            }
        });
        map.addLayer(markers);

        // Custom marker icon using the provided URL
        function getMarkerIcon() {
            return L.icon({
                iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
                shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [0, -41],
                shadowSize: [41, 41],
                shadowAnchor: [12, 41]
            });
        }

        // Update area statistics dynamically
        function updateAreaStatistics(wastePoints) {
            const types = ['organik', 'anorganik', 'b3', 'campuran'];
            const reportCounts = types.map(type => ({
                label: type.charAt(0).toUpperCase() + type.slice(1),
                count: wastePoints.filter(point => point.type === type).length,
                unit: 'lokasi'
            }));
            const totalReports = wastePoints.length;

            const statsContainer = document.getElementById('area-statistics');
            statsContainer.innerHTML = '';

            if (totalReports === 0) {
                statsContainer.innerHTML = `<p class="text-gray-400 text-center py-4">Tidak ada statistik.</p>`;
                return;
            }

            reportCounts.forEach(({
                label,
                count,
                unit
            }) => {
                const statDiv = document.createElement('div');
                statDiv.innerHTML = `
                    <p class="text-sm text-gray-300 mb-2">${label}</p>
                    <div class="w-full bg-gray-800 rounded-full h-3">
                        <div class="bg-gradient-to-r from-[#22d3ee] to-[#06b6d4] h-3 rounded-full transition-all duration-500"
                            style="width: ${totalReports > 0 ? (count / totalReports) * 100 : 0}%"></div>
                    </div>
                    <p class="text-right text-xs text-gray-400 mt-1">${count} ${unit}</p>
                `;
                statsContainer.appendChild(statDiv);
            });
        }

        // Add markers and update nearest locations list
        async function addMarkers(filteredLocations, userLatLon) {
            markers.clearLayers();
            const nearestLocationsList = document.getElementById('nearest-locations');
            nearestLocationsList.innerHTML = '';

            if (filteredLocations.length === 0) {
                nearestLocationsList.innerHTML =
                    `<li class="text-gray-400 text-center py-4">Tidak ada laporan ditemukan.</li>`;
            }

            const uniqueLocations = {};
            filteredLocations.forEach(loc => {
                if (!loc.coords || loc.coords.length !== 2 || isNaN(loc.coords[0]) || isNaN(loc.coords[1])) {
                    console.warn('Invalid coordinates for:', loc.name, loc.coords);
                    return;
                }

                const [lat, lon] = loc.coords;
                const key = `${lat},${lon}`;
                if (!uniqueLocations[key]) {
                    const distance = userLatLon ? calculateDistance(userLatLon[0], userLatLon[1], lat, lon) : 0;

                    const marker = L.marker([lat, lon], {
                        icon: getMarkerIcon()
                    }).bindPopup(`
                        <div class="p-3">
                            <h4 class="font-bold text-gray-900 text-base mb-2">${loc.name}</h4>
                            <p class="text-gray-700 text-sm mb-1"><strong>Alamat:</strong> ${loc.address}</p>
                            <p class="text-gray-700 text-sm mb-1"><strong>Jenis:</strong> ${loc.type.charAt(0).toUpperCase() + loc.type.slice(1)}</p>
                            <p class="text-gray-700 text-sm mb-1"><strong>Ukuran:</strong> ${loc.capacity}</p>
                            <p class="text-gray-700 text-sm mb-1"><strong>Urgensi:</strong> ${loc.urgency}</p>
                            <p class="text-gray-700 text-sm mb-2"><strong>Deskripsi:</strong> ${loc.description}</p>
                            ${loc.photos && loc.photos.length > 0 ? '<p class="text-gray-700 text-sm mb-1"><strong>Foto:</strong></p>' + loc.photos.map(photo => `<img src="${photo}" alt="Waste Photo" class="w-full mt-1 rounded-md shadow-sm">`).join('') : ''}
                        </div>
                    `, {
                        className: 'popup-content',
                        autoPanPadding: [50, 50]
                    });
                    markers.addLayer(marker);

                    const radius = parseInt(document.getElementById('radius').value);
                    if (!userLatLon || distance <= radius || radius === 0) {
                        const li = document.createElement('li');
                        li.className =
                            'border-b border-gray-200 pb-3 transition hover:bg-gray-100 rounded-md px-2 py-2 cursor-pointer text-gray-700';
                        li.innerHTML = `
                            <h4 class="font-semibold text-gray-900 text-sm">${loc.name}</h4>
                            <p class="text-gray-600 text-xs">${loc.address}</p>
                            <p class="text-gray-600 text-xs">Jenis: ${loc.type.charAt(0).toUpperCase() + loc.type.slice(1)}</p>
                            <p class="text-gray-600 text-xs">Ukuran: ${loc.capacity}</p>
                            <p class="text-gray-600 text-xs">Urgensi: ${loc.urgency}</p>
                            ${userLatLon ? `<p class="text-gray-600 text-xs">${distance.toFixed(1)} km dari lokasi Anda</p>` : ''}
                            ${loc.city && loc.city !== 'UnknownCity' ? `<p class="text-gray-600 text-xs">Kota: ${loc.city}</p>` : ''}
                            ${loc.province && loc.province !== 'UnknownProvince' ? `<p class="text-gray-600 text-xs">Provinsi: ${loc.province}</p>` : ''}
                        `;
                        li.addEventListener('click', () => {
                            map.setView([lat, lon], 14);
                            marker.openPopup();
                        });
                        nearestLocationsList.appendChild(li);
                    }
                    uniqueLocations[key] = true;
                }
            });

            if (markers.getLayers().length > 0) {
                map.fitBounds(markers.getBounds(), {
                    padding: [50, 50],
                    maxZoom: 14
                });
            } else {
                console.warn('No valid locations to display on the map after filtering.');
                map.setView([-2.5489, 118.0149], 5); // Center to Indonesia
            }
        }

        // Utility function to calculate distance (Haversine formula)
        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371; // Radius of Earth in kilometers
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c; // Distance in kilometers
        }

        // Initial data load and map setup
        async function initializeMap() {
            const {
                reports,
                provinceReports,
                cityReports
            } = await fetchWastePoints();
            console.log('Waste Points Loaded:', reports);
            addMarkers(reports, null);

            // Update area statistics
            updateAreaStatistics(reports);

            // Aggregate reports by province and city (already done in backend)
            console.log('Aggregated Province Reports:', provinceReports);
            console.log('Aggregated City Reports:', cityReports);

            // Load province GeoJSON (gadm41_IDN_1.json)
            const provinceGeoJsonPromise = fetch('{{ asset('storage/gadm41_IDN_1.json') }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to load Province GeoJSON: ' + response.statusText);
                    }
                    return response.json();
                })
                .catch(error => {
                    console.error('Error loading Province GeoJSON:', error);
                    return null;
                });

            // Load city GeoJSON (gadm41_IDN_2.json)
            const cityGeoJsonPromise = fetch('{{ asset('storage/gadm41_IDN_2.json') }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to load City GeoJSON: ' + response.statusText);
                    }
                    return response.json();
                })
                .catch(error => {
                    console.error('Error loading City GeoJSON:', error);
                    return null;
                });

            // Wait for both GeoJSON files to load
            Promise.all([provinceGeoJsonPromise, cityGeoJsonPromise])
                .then(([provinceGeoJson, cityGeoJson]) => {
                    if (!provinceGeoJson || !cityGeoJson) {
                        console.error('One or both GeoJSON files failed to load.');
                        return;
                    }

                    console.log('Province GeoJSON Data:', provinceGeoJson);
                    console.log('City GeoJSON Data:', cityGeoJson);

                    // Calculate centroids for provinces
                    const provinceCentroids = {};
                    provinceGeoJson.features.forEach(feature => {
                        const bounds = L.geoJSON(feature).getBounds();
                        if (bounds.isValid()) {
                            provinceCentroids[feature.properties.NAME_1] = bounds.getCenter();
                        } else {
                            console.warn("Invalid bounds for Province GeoJSON feature:", feature.properties
                                .NAME_1);
                        }
                    });

                    // Calculate centroids for cities
                    const cityCentroids = {};
                    cityGeoJson.features.forEach(feature => {
                        const bounds = L.geoJSON(feature).getBounds();
                        if (bounds.isValid()) {
                            cityCentroids[feature.properties.NAME_2] = bounds.getCenter();
                        } else {
                            console.warn("Invalid bounds for City GeoJSON feature:", feature.properties
                                .NAME_2);
                        }
                    });

                    // Function to get circle options based on report count
                    function getCircleOptions(reports) {
                        if (reports >= 16) {
                            return {
                                color: '#b30000',
                                fillColor: '#b30000',
                                radius: 60000
                            };
                        } else if (reports >= 8) {
                            return {
                                color: '#ff4500',
                                fillColor: '#ff4500',
                                radius: 50000
                            };
                        } else if (reports >= 4) {
                            return {
                                color: '#ff8c00',
                                fillColor: '#ff8c00',
                                radius: 45000
                            };
                        } else if (reports > 0) {
                            return {
                                color: '#ffd700',
                                fillColor: '#ffd700',
                                radius: 40000
                            };
                        } else {
                            return {
                                color: '#32cd32',
                                fillColor: '#32cd32',
                                radius: 30000
                            };
                        }
                    }

                    const provinceCircleLayerGroup = L.layerGroup();
                    const cityCircleLayerGroup = L.layerGroup();

                    function updateMapFeatures() {
                        provinceCircleLayerGroup.clearLayers();
                        cityCircleLayerGroup.clearLayers();
                        map.eachLayer(layer => {
                            if (layer instanceof L.Marker && !markers.hasLayer(layer) && layer.options
                                .icon &&
                                layer.options.icon.options.iconUrl ===
                                'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png') {
                                map.removeLayer(layer);
                            }
                        });

                        // Province circles
                        provinceGeoJson.features.forEach(feature => {
                            const provinceName = feature.properties.NAME_1;
                            const reports = provinceReports[provinceName] || 0;
                            const centroid = provinceCentroids[provinceName];
                            if (centroid && map.getZoom() < 8) {
                                const circle = L.circle(centroid, {
                                    ...getCircleOptions(reports),
                                    fillOpacity: 0.5,
                                    className: 'waste-circle'
                                });
                                const numberIcon = L.divIcon({
                                    className: 'waste-circle-label',
                                    html: `<span>${reports}</span>`,
                                    iconSize: [40, 40],
                                    iconAnchor: [20, 20]
                                });
                                const numberMarker = L.marker(centroid, {
                                    icon: numberIcon
                                });
                                circle.bindTooltip(`<b>${provinceName}</b><br>${reports} laporan`, {
                                    permanent: false,
                                    className: 'leaflet-tooltip',
                                    direction: 'center',
                                    opacity: 0.9
                                }).bindPopup(`<b>${provinceName}</b><br>Jumlah Laporan: ${reports}`);
                                provinceCircleLayerGroup.addLayer(circle);
                                provinceCircleLayerGroup.addLayer(numberMarker);
                            }
                        });

                        // City circles
                        cityGeoJson.features.forEach(feature => {
                            const cityName = feature.properties.NAME_2;
                            const reports = cityReports[cityName] || 0;
                            const centroid = cityCentroids[cityName];
                            if (centroid && map.getZoom() >= 8) {
                                const circle = L.circle(centroid, {
                                    ...getCircleOptions(reports),
                                    fillOpacity: 0.5,
                                    className: 'waste-circle'
                                });
                                const numberIcon = L.divIcon({
                                    className: 'waste-circle-label',
                                    html: `<span>${reports}</span>`,
                                    iconSize: [40, 40],
                                    iconAnchor: [20, 20]
                                });
                                const numberMarker = L.marker(centroid, {
                                    icon: numberIcon
                                });
                                circle.bindTooltip(`<b>${cityName}</b><br>${reports} laporan`, {
                                    permanent: false,
                                    className: 'leaflet-tooltip',
                                    direction: 'center',
                                    opacity: 0.9
                                }).bindPopup(`<b>${cityName}</b><br>Jumlah Laporan: ${reports}`);
                                cityCircleLayerGroup.addLayer(circle);
                                cityCircleLayerGroup.addLayer(numberMarker);
                            }
                        });
                    }

                    updateMapFeatures();
                    map.on('zoomend', updateMapFeatures);

                    // Choropleth color function
                    function getChoroplethColor(d) {
                        return d > 100 ? '#800000' :
                            d > 50 ? '#b30000' :
                            d > 20 ? '#e34a33' :
                            d > 10 ? '#fc8d59' :
                            d > 0 ? '#fdcc8a' :
                            '#f7f7f7';
                    }

                    // Province choropleth using gadm41_IDN_1.json
                    function styleProvince(feature) {
                        const provinceName = feature.properties.NAME_1;
                        const reports = provinceReports[provinceName] || 0;
                        return {
                            fillColor: getChoroplethColor(reports),
                            weight: 2,
                            opacity: 1,
                            color: 'white',
                            dashArray: '3',
                            fillOpacity: 0.7
                        };
                    }

                    // City choropleth using gadm41_IDN_2.json
                    function styleCity(feature) {
                        const cityName = feature.properties.NAME_2;
                        const reports = cityReports[cityName] || 0;
                        return {
                            fillColor: getChoroplethColor(reports),
                            weight: 2,
                            opacity: 1,
                            color: 'white',
                            dashArray: '3',
                            fillOpacity: 0.7
                        };
                    }

                    let info = L.control();
                    info.onAdd = function(map) {
                        this._div = L.DomUtil.create('div', 'info');
                        this.update();
                        return this._div;
                    };
                    info.update = function(props) {
                        this._div.innerHTML = '<h4>Jumlah Laporan Sampah</h4>' + (props ?
                            `<b>${props.NAME_1 || props.NAME_2}</b><br />${(provinceReports[props.NAME_1] || cityReports[props.NAME_2] || 0)} laporan` :
                            'Arahkan kursor ke provinsi/kota');
                    };

                    function highlightFeature(e) {
                        const layer = e.target;
                        layer.setStyle({
                            weight: 5,
                            color: '#22d3ee',
                            dashArray: '',
                            fillOpacity: 0.7
                        });
                        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                            layer.bringToFront();
                        }
                        info.update(layer.feature.properties);
                    }

                    function resetHighlightProvince(e) {
                        provinceChoroplethLayer.resetStyle(e.target);
                        info.update();
                    }

                    function resetHighlightCity(e) {
                        cityChoroplethLayer.resetStyle(e.target);
                        info.update();
                    }

                    function zoomToFeature(e) {
                        map.fitBounds(e.target.getBounds());
                    }

                    // Province choropleth layer using gadm41_IDN_1.json
                    const provinceChoroplethLayer = L.geoJSON(provinceGeoJson, {
                        style: styleProvince,
                        onEachFeature: function(feature, layer) {
                            const provinceName = feature.properties.NAME_1;
                            const reports = provinceReports[provinceName] || 0;
                            feature.properties.reports = reports;
                            layer.bindTooltip(`<b>${provinceName}</b><br>${reports} laporan`, {
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

                    // City choropleth layer using gadm41_IDN_2.json
                    const cityChoroplethLayer = L.geoJSON(cityGeoJson, {
                        style: styleCity,
                        onEachFeature: function(feature, layer) {
                            const cityName = feature.properties.NAME_2;
                            const reports = cityReports[cityName] || 0;
                            feature.properties.reports = reports;
                            layer.bindTooltip(`<b>${cityName}</b><br>${reports} laporan`, {
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

                    const legend = L.control({
                        position: 'bottomright'
                    });
                    legend.onAdd = function(map) {
                        const div = L.DomUtil.create('div', 'info legend'),
                            grades = [0, 10, 20, 50, 100],
                            labels = [];
                        labels.push('<i style="background:#32cd32"></i> 0 laporan');
                        labels.push('<i style="background:#fdcc8a"></i> 1–10 laporan');
                        labels.push('<i style="background:#fc8d59"></i> 11–20 laporan');
                        labels.push('<i style="background:#e34a33"></i> 21–50 laporan');
                        labels.push('<i style="background:#b30000"></i> 51–100 laporan');
                        labels.push('<i style="background:#800000"></i> > 100 laporan');
                        div.innerHTML = labels.join('<br>');
                        return div;
                    };

                    const baseMaps = {
                        "Peta": osmLayer,
                        "Satelit": satelliteLayer
                    };
                    const overlayMaps = {
                        "Marker Laporan Sampah": markers,
                        "Choropleth (Laporan per Provinsi)": provinceChoroplethLayer,
                        "Choropleth (Laporan per Kota)": cityChoroplethLayer,
                        "Lingkaran Laporan Provinsi": provinceCircleLayerGroup,
                        "Lingkaran Laporan Kota": cityCircleLayerGroup
                    };
                    const layerControl = L.control.layers(baseMaps, overlayMaps).addTo(map);

                    map.on('overlayadd', function(e) {
                        if (e.name === 'Choropleth (Laporan per Provinsi)' || e.name ===
                            'Choropleth (Laporan per Kota)') {
                            info.addTo(map);
                            legend.addTo(map);
                        }
                        if (e.name === 'Lingkaran Laporan Provinsi') {
                            updateMapFeatures();
                        }
                        if (e.name === 'Lingkaran Laporan Kota') {
                            updateMapFeatures();
                        }
                    });
                    map.on('overlayremove', function(e) {
                        if (e.name === 'Choropleth (Laporan per Provinsi)' || e.name ===
                            'Choropleth (Laporan per Kota)') {
                            map.removeControl(info);
                            map.removeControl(legend);
                        }
                        if (e.name === 'Lingkaran Laporan Provinsi') {
                            provinceCircleLayerGroup.clearLayers();
                        }
                        if (e.name === 'Lingkaran Laporan Kota') {
                            cityCircleLayerGroup.clearLayers();
                        }
                    });

                    map.on('baselayerchange', function(e) {
                        localStorage.setItem('mapLayer', e.name.toLowerCase());
                    });

                    provinceChoroplethLayer.addTo(map);
                    info.addTo(map);
                    legend.addTo(map);
                });
        }

        initializeMap();

        document.getElementById('searchButton').addEventListener('click', async () => {
            const locationInput = document.getElementById('location').value;
            const type = document.getElementById('type').value;
            const radius = parseInt(document.getElementById('radius').value);

            let userLatLon = null;
            if (locationInput) {
                try {
                    const geoResponse = await fetch(
                        `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(locationInput)}&format=json&limit=1`
                    );
                    const geoData = await geoResponse.json();
                    if (geoData && geoData.length > 0) {
                        userLatLon = [parseFloat(geoData[0].lat), parseFloat(geoData[0].lon)];
                        alert(`Lokasi ditemukan: ${geoData[0].display_name}`);
                    } else {
                        alert('Lokasi tidak ditemukan. Filter berdasarkan jenis dan radius saja.');
                    }
                } catch (geoError) {
                    console.error('Error geocoding location:', geoError);
                    alert('Gagal mencari lokasi. Filter berdasarkan jenis dan radius saja.');
                }
            }

            const {
                reports
            } = await fetchWastePoints();
            let filteredLocations = reports;

            if (type) {
                filteredLocations = filteredLocations.filter(loc => loc.type === type);
            }

            if (userLatLon && radius > 0) {
                filteredLocations = filteredLocations.filter(loc => {
                    if (loc.coords && loc.coords.length === 2 && !isNaN(loc.coords[0]) && !isNaN(loc
                            .coords[1])) {
                        const distance = calculateDistance(userLatLon[0], userLatLon[1], loc.coords[0],
                            loc.coords[1]);
                        return distance <= radius;
                    }
                    return false;
                });
            }

            addMarkers(filteredLocations, userLatLon);
            updateAreaStatistics(filteredLocations);
        });

        document.getElementById('resetMapButton').addEventListener('click', async () => {
            map.setView([-2.5489, 118.0149], 5);
            const {
                reports
            } = await fetchWastePoints();
            addMarkers(reports, null);
            updateAreaStatistics(reports);
            map.closePopup();
            document.getElementById('location').value = '';
            document.getElementById('type').value = '';
            document.getElementById('radius').value = '10';
        });
    </script>
@endsection
