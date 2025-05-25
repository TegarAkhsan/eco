@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-12 font-['Poppins']">
        <!-- Header -->
        <h1 class="text-4xl font-extrabold text-white mb-8 tracking-tight text-center">
            Peta Interaktif Sampah
        </h1>

        <!-- Search and Filter Section -->
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

        <!-- Map Container -->
        <div class="bg-[#d9d9d9]/10 rounded-xl overflow-hidden h-[700px] shadow-[0px_6px_20px_rgba(0,0,0,0.3)] relative">
            <div id="map" class="w-full h-full"></div>
            <!-- Custom Reset Button -->
            <button id="resetMapButton" class="custom-reset-button">
                Reset Peta
            </button>
        </div>

        <!-- Information Section -->
        <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Nearest Locations -->
            <div class="bg-[#0b1121]/80 backdrop-blur-lg p-6 rounded-2xl shadow-xl">
                <h3 class="text-2xl font-semibold text-white mb-5 flex items-center gap-2">
                    <svg class="w-6 h-6 text-[#22d3ee]" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M17.657 16.657L13.414 12l4.243-4.243M6.343 7.343L10.586 12l-4.243 4.243" />
                    </svg>
                    Lokasi Terdekat
                </h3>
                <ul id="nearest-locations" class="space-y-5 text-gray-300 text-sm">
                    <!-- Diisi dinamis oleh JavaScript -->
                </ul>
            </div>

            <!-- Area Statistics -->
            <div class="bg-[#0b1121]/80 backdrop-blur-lg p-6 rounded-2xl shadow-xl">
                <h3 class="text-2xl font-semibold text-white mb-5 flex items-center gap-2">
                    <svg class="w-6 h-6 text-[#22d3ee]" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M11 3v18m-4-4l4 4 4-4" />
                    </svg>
                    Statistik Area
                </h3>
                <div class="space-y-5">
                    @php
                        $reportCounts = [
                            ['Organik', App\Models\Report::where('type', 'organik')->count(), 'lokasi'],
                            ['Anorganik', App\Models\Report::where('type', 'anorganik')->count(), 'lokasi'],
                            ['B3', App\Models\Report::where('type', 'b3')->count(), 'lokasi'],
                            ['Campuran', App\Models\Report::where('type', 'campuran')->count(), 'lokasi'],
                        ];
                        $totalReports = App\Models\Report::count();
                    @endphp
                    @foreach ($reportCounts as [$label, $count, $unit])
                        <div>
                            <p class="text-sm text-gray-300 mb-2">{{ $label }}</p>
                            <div class="w-full bg-gray-800 rounded-full h-3">
                                <div class="bg-gradient-to-r from-[#22d3ee] to-[#06b6d4] h-3 rounded-full transition-all duration-500"
                                    style="width: {{ $totalReports > 0 ? ($count / $totalReports) * 100 : 0 }}%"></div>
                            </div>
                            <p class="text-right text-xs text-gray-400 mt-1">{{ $count }} {{ $unit }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Report New Location -->
            <div class="bg-[#0b1121]/80 backdrop-blur-lg p-6 rounded-2xl shadow-xl flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl font-semibold text-white mb-5 flex items-center gap-2">
                        <svg class="w-6 h-6 text-[#22d3ee]" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M12 4v16m8-8H4" />
                        </svg>
                        Laporkan Titik Baru
                    </h3>
                    <p class="text-sm text-gray-300 mb-6 leading-relaxed">Temukan titik sampah liar yang belum terpetakan?
                        Laporkan sekarang untuk membantu lingkungan kita menjadi lebih bersih.</p>
                </div>
                <a href="{{ route('report') }}"
                    class="mt-auto bg-gradient-to-r from-[#22d3ee] to-[#06b6d4] hover:from-[#06b6d4] hover:to-[#0891b2] text-white px-6 py-3 rounded-lg inline-block transition duration-300 shadow-lg text-center font-medium">
                    Laporkan Titik Sampah
                </a>
            </div>
        </div>
    </div>

    <!-- OpenLayers CDN -->
    <script src="https://cdn.jsdelivr.net/npm/ol@v9.2.0/dist/ol.js"></script>
    <style>
        /* Custom Map Styles */
        .ol-control {
            background: linear-gradient(135deg, #4da8da, #1e90ff) !important;
            border-radius: 50px !important;
            padding: 5px !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3) !important;
            backdrop-filter: blur(5px) !important;
        }

        .ol-control button {
            background: rgba(255, 255, 255, 0.2) !important;
            color: #ffffff !important;
            border: none !important;
            border-radius: 50% !important;
            width: 30px !important;
            height: 30px !important;
            font-size: 16px !important;
            transition: all 0.3s ease !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 2px !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5) !important;
        }

        .ol-control button:hover {
            background: linear-gradient(135deg, #22d3ee, #06b6d4) !important;
            transform: scale(1.1) !important;
            color: #ffffff !important;
        }

        .ol-zoom {
            gap: 4px !important;
            position: absolute !important;
            bottom: 20px !important;
            left: 20px !important;
        }

        .ol-attribution {
            background: linear-gradient(135deg, #4da8da, #1e90ff) !important;
            color: #ffffff !important;
            border-radius: 12px !important;
            font-size: 12px !important;
            padding: 4px 8px !important;
            backdrop-filter: blur(5px) !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5) !important;
            position: absolute !important;
            bottom: 20px !important;
            left: 90px !important;
        }

        .popup-content {
            background: linear-gradient(135deg, #ffffff, #e0f7fa);
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            max-width: 300px;
            font-family: 'Poppins', sans-serif;
        }

        .custom-reset-button {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, #4da8da, #1e90ff);
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 20px;
            border: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
        }

        .custom-reset-button:hover {
            background: linear-gradient(135deg, #22d3ee, #06b6d4);
            transform: translateX(-50%) scale(1.05);
        }
    </style>
    <script>
        // Fetch user-submitted waste points from the database
        @php
            $reports = App\Models\Report::all();
            $wastePoints = $reports
                ->map(function ($report) {
                    return [
                        'name' => $report->name,
                        'coords' => [$report->longitude, $report->latitude],
                        'type' => $report->type,
                        'address' => $report->location,
                        'capacity' => $report->size,
                        'vol_masuk' => 'N/A',
                        'vol_dikelola' => 'N/A',
                        'volume_sampah_diolah' => 'N/A',
                        'vol_diangkut' => 'N/A',
                        'urgency' => $report->urgency,
                        'description' => $report->description,
                        'photos' => $report->photos ? json_decode($report->photos) : [],
                    ];
                })
                ->toArray();
        @endphp

        // Map initialization with OpenStreetMap
        const map = new ol.Map({
            target: 'map',
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM()
                })
            ],
            view: new ol.View({
                center: ol.proj.fromLonLat([113.9213, -0.7893]), // Pusat Indonesia
                zoom: 5,
                minZoom: 3,
                maxZoom: 18
            })
        });

        // Vector source for markers
        const vectorSource = new ol.source.Vector({});
        const vectorLayer = new ol.layer.Vector({
            source: vectorSource
        });
        map.addLayer(vectorLayer);

        // Popup overlay
        const popup = new ol.Overlay({
            element: document.createElement('div'),
            autoPan: true,
            autoPanAnimation: {
                duration: 250
            }
        });
        map.addOverlay(popup);
        popup.getElement().className = 'popup-content';

        // Custom marker styles based on type
        function getMarkerStyle(type) {
            let src, color;
            switch (type) {
                case 'organik':
                    src = 'https://img.icons8.com/color/48/organic-food.png';
                    color = '#22d3ee';
                    break;
                case 'anorganik':
                    src = 'https://img.icons8.com/color/48/recycle.png';
                    color = '#f97316';
                    break;
                case 'b3':
                    src = 'https://img.icons8.com/color/48/hazard.png';
                    color = '#ef4444';
                    break;
                case 'campuran':
                    src = 'https://img.icons8.com/color/48/waste.png';
                    color = '#d97706';
                    break;
                default:
                    src = 'https://img.icons8.com/color/48/marker.png';
                    color = '#22d3ee';
            }
            return new ol.style.Style({
                image: new ol.style.Icon({
                    anchor: [0.5, 1],
                    src: src,
                    scale: 0.5,
                    color: color
                })
            });
        }

        // Add markers and update nearest locations list
        function addMarkers(filteredLocations, userLonLat) {
            vectorSource.clear();
            const nearestLocationsList = document.getElementById('nearest-locations');
            nearestLocationsList.innerHTML = '';

            filteredLocations.forEach(loc => {
                // Skip locations with invalid coordinates
                if (!loc.coords || !loc.coords[0] || !loc.coords[1] || isNaN(loc.coords[0]) || isNaN(loc.coords[
                    1])) {
                    console.warn('Invalid coordinates for:', loc.name, loc.coords);
                    return;
                }

                const lonLat = loc.coords;
                const distance = userLonLat ? calculateDistance(userLonLat[0], userLonLat[1], lonLat[0], lonLat[
                    1]) : 0;

                const iconFeature = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.fromLonLat(lonLat)),
                    name: loc.name,
                    address: loc.address,
                    type: loc.type,
                    capacity: loc.capacity,
                    urgency: loc.urgency,
                    description: loc.description,
                    photos: loc.photos,
                    distance: distance.toFixed(1) + ' km'
                });

                iconFeature.setStyle(getMarkerStyle(loc.type));
                vectorSource.addFeature(iconFeature);

                const radius = parseInt(document.getElementById('radius').value);
                if (!userLonLat || distance <= radius) {
                    const li = document.createElement('li');
                    li.className = 'border-b border-gray-600 pb-4 transition hover:bg-[#1e293b]/50 rounded-lg px-2';
                    li.innerHTML = `
                        <h4 class="font-semibold text-white">${loc.name}</h4>
                        <p class="text-gray-300 text-sm">${loc.address}</p>
                        <p class="text-gray-300 text-sm">Jenis: ${loc.type}</p>
                        <p class="text-gray-300 text-sm">Ukuran: ${loc.capacity}</p>
                        <p class="text-gray-300 text-sm">Urgensi: ${loc.urgency}</p>
                        <p class="text-gray-300 text-sm">${distance.toFixed(1)} km dari lokasi Anda</p>
                    `;
                    nearestLocationsList.appendChild(li);
                }
            });

            const extent = vectorSource.getExtent();
            if (!vectorSource.isEmpty()) {
                map.getView().fit(extent, {
                    padding: [100, 100, 100, 100],
                    maxZoom: 10
                });
            } else {
                console.warn('No valid locations to display on the map.');
            }
        }

        // Utility Functions
        function calculateDistance(lon1, lat1, lon2, lat2) {
            const R = 6371;
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }

        // Initial marker load
        const wastePoints = @json($wastePoints);
        console.log('Waste Points:', wastePoints); // Debug: Check data
        addMarkers(wastePoints, null);

        // Popup on click
        map.on('click', function(evt) {
            const feature = map.forEachFeatureAtPixel(evt.pixel, function(feature) {
                return feature;
            });

            if (feature) {
                const coordinates = feature.getGeometry().getCoordinates();
                popup.setPosition(coordinates);
                popup.getElement().innerHTML = `
                    <h4 class="font-bold text-gray-800">${feature.get('name')}</h4>
                    <p class="text-gray-600">${feature.get('address')}</p>
                    <p class="text-gray-600">Jenis: ${feature.get('type')}</p>
                    <p class="text-gray-600">Ukuran: ${feature.get('capacity')}</p>
                    <p class="text-gray-600">Urgensi: ${feature.get('urgency')}</p>
                    <p class="text-gray-600">Deskripsi: ${feature.get('description')}</p>
                    <p class="text-gray-600">Jarak: ${feature.get('distance')}</p>
                    ${feature.get('photos').length > 0 ? '<p class="text-gray-600">Foto:</p>' + feature.get('photos').map(photo => `<img src="/storage/${photo}" alt="Waste Photo" class="w-full mt-2 rounded">`).join('') : ''}
                `;
            } else {
                popup.setPosition(undefined);
            }
        });

        // Search functionality
        document.getElementById('searchButton').addEventListener('click', () => {
            const locationInput = document.getElementById('location').value;
            const type = document.getElementById('type').value;
            const radius = parseInt(document.getElementById('radius').value);

            const userLonLat = locationInput ? [112.6290, -7.2330] : null; // Surabaya as default

            let filteredLocations = wastePoints;
            if (type) filteredLocations = wastePoints.filter(loc => loc.type === type);
            if (userLonLat) filteredLocations = filteredLocations.filter(loc => {
                const distance = calculateDistance(userLonLat[0], userLonLat[1], loc.coords[0], loc.coords[
                    1]);
                return distance <= radius;
            });

            addMarkers(filteredLocations, userLonLat);
        });

        // Reset Map Button Functionality
        document.getElementById('resetMapButton').addEventListener('click', () => {
            map.getView().setCenter(ol.proj.fromLonLat([113.9213, -0.7893]));
            map.getView().setZoom(5);
            addMarkers(wastePoints, null);
            popup.setPosition(undefined);
        });
    </script>
@endsection
