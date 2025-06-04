{{-- map.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-12 font-['Poppins']">
        <h1 class="text-4xl font-extrabold text-white mb-8 tracking-tight text-center">
            Peta Interaktif Sampah
        </h1>

        <div id="notification-area" class="fixed top-24 right-4 z-[2000] w-80 space-y-2"></div>

        {{-- Filter Section --}}
        <div class="bg-[#0b1121]/70 backdrop-blur-md p-6 rounded-2xl mb-8 shadow-[0px_6px_20px_rgba(0,0,0,0.4)]">
            <div class="grid md:grid-cols-4 gap-x-6 gap-y-4 mb-6">
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
                <div>
                    <label for="targetLocationInput" class="block text-sm font-medium text-gray-300 mb-2">Lokasi Tujuan
                        Pencarian</label>
                    <input type="text" id="targetLocationInput"
                        class="w-full px-4 py-3 rounded-xl bg-[#1e293b]/80 border border-gray-600 text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 transition duration-300 h-[46px]"
                        placeholder="Ketik nama tempat atau alamat">
                </div>
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

            {{-- NEW: Map Type Selector (Peta & Satelit buttons) --}}
            <div id="mapTypeSelector" class="map-type-selector-container">
                <button id="mapPetaButton" class="map-type-button" title="Peta">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M11.54 22.351l.07.04.028.016a.76.76 0 00.082-.015 10.5 10.5 0 00.32-1.608V16.637c0-2.282-.574-4.225-1.11-5.696-.69-1.928-1.927-3.134-3.52-3.134-1.606 0-2.836 1.205-3.52 3.134-.536 1.471-1.11 3.414-1.11 5.696v4.677a10.5 10.5 0 00.32 1.608.76.76 0 00.082.015l.028-.016.07-.04c1.47-1.017 2.94-1.984 4.372-2.913a1.5 1.5 0 01.996 0c1.432.929 2.903 1.896 4.372 2.913zM14.25 5.76a.75.75 0 01.75-.75h1.125a.75.75 0 01.75.75v1.125a.75.75 0 01-.75.75H15a.75.75 0 01-.75-.75V5.76zM14.25 9.76a.75.75 0 01.75-.75h1.125a.75.75 0 01.75.75v1.125a.75.75 0 01-.75.75H15a.75.75 0 01-.75-.75V9.76zM14.25 13.76a.75.75 0 01.75-.75h1.125a.75.75 0 01.75.75v1.125a.75.75 0 01-.75.75H15a.75.75 0 01-.75-.75V13.76zM2.25 5.76a.75.75 0 01.75-.75H4.125a.75.75 0 01.75.75v1.125a.75.75 0 01-.75.75H3A.75.75 0 012.25 6.885V5.76zM2.25 9.76a.75.75 0 01.75-.75H4.125a.75.75 0 01.75.75v1.125a.75.75 0 01-.75.75H3A.75.75 0 012.25 10.885V9.76zM2.25 13.76a.75.75 0 01.75-.75H4.125a.75.75 0 01.75.75v1.125a.75.75 0 01-.75.75H3A.75.75 0 012.25 14.885V13.76z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="map-type-label">Peta</span>
                </button>
                <button id="mapSatelitButton" class="map-type-button" title="Satelit">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M1.373 3.693c-.469 1.448-.713 2.991-.713 4.547 0 4.614 3.55 8.472 8.653 9.767l.004.001a49.497 49.497 0 001.206 1.427c.484.482.997.928 1.542 1.332.062.046.13.09.202.131.513.298 1.074.544 1.66.726.39.12.799.213 1.221.272.763.107 1.573.147 2.404.124a8.9 8.9 0 00.74-.035 15.683 15.683 0 005.163-1.455c.74-.29 1.4-.645 1.996-1.074a.75.75 0 00.183-.349l.05-.164c.045-.148.08-.29.109-.427.005-.02.01-.04.015-.062l.024-.092c.005-.018.008-.036.013-.054s.005-.035.008-.053c.01-.037.016-.075.021-.113.003-.018.005-.036.008-.055.006-.038.009-.077.012-.115h.002a.75.75 0 00-.001-.019l.001-.002.002-.006a.75.75 0 00-.006-.08c.002-.026.002-.053 0-.079a.75.75 0 00-.012-.092l-.004-.008a.75.75 0 00-.019-.08l-.007-.009a.75.75 0 00-.025-.078l-.008-.009c-.009-.011-.019-.02-.029-.031a.75.75 0 00-.036-.03l-.009-.007a.75.75 0 00-.045-.025c-.01-.005-.02-.01-.03-.014a.75.75 0 00-.05-.017L21.5 7.027v-.006a.75.75 0 00-.01-.018l-.002-.004a.75.75 0 00-.014-.012l-.004-.004a.75.75 0 00-.01-.008l-.004-.005a.75.75 0 00-.007-.003l-.005-.003c-1.396-.79-2.735-1.463-4.004-1.956a6.837 6.837 0 00-1.636-.53c-.09-.022-.18-.041-.271-.06-.184-.036-.37-.066-.559-.09a15.75 15.75 0 01-3.002 0c-.396.006-.793.023-1.185.053-.45.034-.896.083-1.331.149Q8.945 5.56 7.6 6.06c-1.433.535-2.79 1.258-4.006 2.148a.75.75 0 00-.215.154l-.044.053a.75.75 0 00-.083.115c-.012.016-.023.033-.034.05L2.2 8.354l-.031.056c-.006.012-.01.025-.016.037l-.007.014a.75.75 0 00-.022.05L2.115 8.5a.75.75 0 00-.024.062l-.01.025a.75.75 0 00-.009.027l-.007.02c-.004.009-.007.018-.01.027L2.008 8.68A.75.75 0 002 8.706v.004L1.992 8.73a.75.75 0 00-.004.025l-.002.011a.75.75 0 00-.003.018L1.974 8.79a.75.75 0 00-.006.037L1.96 8.85a.75.75 0 00-.005.04L1.95 8.91a.75.75 0 00-.003.036L1.942 8.97a.75.75 0 00-.001.042l-.001.047a.75.75 0 000 .098v.001l-.001.052a.75.75 0 00-.004.072l-.002.05a.75.75 0 00-.008.064L1.91 9.3c-.002.01-.003.02-.005.03-.004.02-.007.04-.01.06-.003.02-.006.04-.009.059-.003.02-.005.04-.008.06A.75.75 0 001.85 9.54l-.014.027a.75.75 0 00-.019.034l-.009.018a.75.75 0 00-.016.027l-.008.012a.75.75 0 00-.011.018l-.006.009a.75.75 0 00-.008.01l-.003.003c-.003.003-.005.006-.008.008l-.002.002a.75.75 0 00-.005.006l-.002.002L1.737 9.87a.75.75 0 00-.003.003c-.002.003-.003.005-.005.008a.75.75 0 00-.003.004l-.002.003a.75.75 0 00-.002.002L1.71 9.92l-.003.004a.75.75 0 00-.002.002l-.002.003-.002.002a.75.75 0 00-.001.001L1.69 9.96c-.001.001-.002.002-.003.003a.75.75 0 00-.002.002L1.678 10a.75.75 0 00-.002.002l-.001.001a.75.75 0 00-.001.001L1.666 10a.75.75 0 00-.001.001L1.657 10.01l-.001.001a.75.75 0 000 0c-.394.301-.735.632-1.012.985a.75.75 0 00-.174.267.75.75 0 00-.115.312A3.25 3.25 0 00.75 12c0 2.213.918 4.28 2.378 5.671a1.5 1.5 0 00.996 0C5.378 16.28 6.25 14.373 6.25 12a.75.75 0 00-1.5 0c0 1.25-.397 2.457-1.077 3.492C3.125 14.526 2.25 13.313 2.25 12c0-1.711.29-3.376.832-4.887.697-1.988 1.944-3.235 3.535-3.235 1.606 0 2.836 1.205 3.52 3.134.536 1.471 1.11 3.414 1.11 5.696v4.677A10.5 10.5 0 0012 21.05c.895 0 1.769-.074 2.625-.224a.75.75 0 00.592-.708V3.654a.75.75 0 00-.592-.709A49.359 49.359 0 0112 3c-2.41 0-4.817.178-7.208.545a.75.75 0 00-.592.709z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="map-type-label">Satelit</span>
                </button>
            </div>

            {{-- Icon Toggle Kontrol Lapisan (for Overlays) --}}
            <button id="toggleLayersControl" class="custom-layers-toggle-button"
                title="Tampilkan/Sembunyikan Lapisan Overlay">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                        d="M3.792 2.945A49.359 49.359 0 0112 3c2.41 0 4.817.178 7.208.545a.75.75 0 01.592.709V19.05a.75.75 0 01-.592.708A49.359 49.359 0 0112 21c-2.41 0-4.817-.178-7.208-.545a.75.75 0 01-.592-.708V3.654a.75.75 0 01.592-.709zM12 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <button id="resetMapButton" class="custom-reset-button">
                Reset Peta
            </button>
        </div>

        {{-- Konten Lainnya --}}
        <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-[#0b1121]/80 backdrop-blur-lg p-6 rounded-2xl shadow-xl">
                <h3 class="text-2xl font-semibold text-white mb-5 flex items-center gap-2">
                    <svg class="w-6 h-6 text-[#22d3ee]" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M17.657 16.657L13.414 12l4.243-4.243M6.343 7.343L10.586 12l-4.243 4.243" />
                    </svg>
                    Lokasi Terdekat
                </h3>
                <ul id="nearest-locations" class="space-y-5 text-gray-300 text-sm max-h-[400px] overflow-y-auto"></ul>
            </div>
            <div class="bg-[#0b1121]/80 backdrop-blur-lg p-6 rounded-2xl shadow-xl">
                <h3 class="text-2xl font-semibold text-white mb-5 flex items-center gap-2">
                    <svg class="w-6 h-6 text-[#22d3ee]" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M11 3v18m-4-4l4 4 4-4" />
                    </svg>
                    Statistik Area
                </h3>
                <div id="area-statistics" class="space-y-5"></div>
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

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

    <style>
        .app-notification {
            padding: 12px 16px;
            border-radius: 8px;
            color: #fff;
            font-size: .875rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
            opacity: 0;
            transform: translateX(100%);
            animation: slideInNotification .5s forwards, fadeOutNotification .5s 4.5s forwards
        }

        .app-notification.success {
            background-color: #28a745
        }

        .app-notification.error {
            background-color: #dc3545
        }

        .app-notification.warning {
            background-color: #ffc107;
            color: #333
        }

        .app-notification.info {
            background-color: #17a2b8
        }

        @keyframes slideInNotification {
            to {
                opacity: 1;
                transform: translateX(0)
            }
        }

        @keyframes fadeOutNotification {
            to {
                opacity: 0;
                transform: translateX(100%)
            }
        }

        #fetchCurrentLocationButton svg.animate-spin {
            animation: spin 1s linear infinite
        }

        @keyframes spin {
            0% {
                transform: rotate(0)
            }

            to {
                transform: rotate(360deg)
            }
        }

        /* Perbaikan untuk estetika dan minimalis */
        .leaflet-container {
            background: #f5f6f5 !important;
            border-radius: 12px;
            overflow: hidden;
        }

        /* General Leaflet Control Styling (Lebih minimalis) */
        .leaflet-control-container .leaflet-control {
            background: #fff !important;
            border-radius: 8px !important;
            padding: 4px !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .1) !important;
            border: none !important;
            transition: all 0.3s ease-in-out;
        }

        /* Hover effect untuk kontrol */
        .leaflet-control-container .leaflet-control:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, .15) !important;
            transform: translateY(-2px);
        }

        /* Leaflet Zoom Control Styling */
        .leaflet-control-zoom a {
            background: #fff !important;
            color: #333 !important;
            border-radius: 6px !important;
            width: 28px !important;
            height: 28px !important;
            line-height: 28px !important;
            font-size: 16px !important;
            transition: all .2s ease !important;
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
            left: 10px !important
        }

        /* Leaflet Attribution */
        .leaflet-control-attribution {
            background: #fff !important;
            color: #4b5563 !important;
            border-radius: 6px !important;
            font-size: 11px !important;
            padding: 2px 6px !important;
            bottom: 10px !important;
            right: 10px !important;
            opacity: .8
        }

        /* Leaflet Popup */
        .leaflet-popup-content-wrapper {
            background: #fff !important;
            border-radius: 8px !important;
            box-shadow: 0 3px 12px rgba(0, 0, 0, .2) !important;
            padding: 0 !important
        }

        .leaflet-popup-content {
            margin: 12px !important;
            font-family: 'Poppins', sans-serif !important;
            font-size: 12px !important;
            max-width: 280px !important;
            line-height: 1.6 !important;
            color: #333
        }

        .leaflet-popup-content h4 {
            font-weight: 700;
            color: #1a202c;
            font-size: 1rem;
            margin-bottom: .5rem
        }

        .leaflet-popup-content p {
            margin-bottom: .15rem;
            color: #4a5568
        }

        .leaflet-popup-content strong {
            color: #2d3748
        }

        .leaflet-popup-content img {
            width: 100%;
            margin-top: .25rem;
            border-radius: .375rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .05);
            margin-bottom: .25rem
        }

        .leaflet-popup-tip {
            background: #fff !important
        }

        /* Custom Reset Button Styling */
        .custom-reset-button {
            position: absolute;
            bottom: 15px;
            right: 15px;
            z-index: 800;
            background: #fff !important;
            color: #1e40af !important;
            padding: 10px 18px;
            border-radius: 10px;
            border: none;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .1);
            transition: all .3s ease;
        }

        .custom-reset-button:hover {
            background: #e5e7eb !important;
            color: #1e3a8a !important;
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 6px 20px rgba(0, 0, 0, .15);
        }

        /* Marker Cluster Styling */
        .marker-cluster-small,
        .marker-cluster-medium,
        .marker-cluster-large {
            background-color: rgba(245, 158, 11, .9) !important;
            border-radius: 50% !important
        }

        .marker-cluster div {
            background-color: rgba(255, 255, 255, .9) !important;
            color: #1f2937 !important;
            font-weight: 600 !important;
            border-radius: 50% !important;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .2);
            font-size: 12px;
            width: 30px;
            height: 30px;
            line-height: 30px
        }

        .marker-cluster-small div {
            width: 30px;
            height: 30px;
            line-height: 30px
        }

        .marker-cluster-medium div {
            width: 36px;
            height: 36px;
            line-height: 36px
        }

        .marker-cluster-large div {
            width: 40px;
            height: 40px;
            line-height: 40px
        }

        /* Waste Circle Styling */
        .waste-circle {
            border-radius: 50%;
            opacity: .7;
            text-align: center;
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .waste-circle-label {
            position: absolute;
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            text-align: center;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none
        }

        /* Info Control for Choropleth Layers (Lebih minimalis) */
        .info {
            padding: 10px 14px;
            font: 13px/16px Poppins, Arial, Helvetica, sans-serif;
            background: rgba(255, 255, 255, .95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, .1);
            border-radius: 6px;
            z-index: 800;
            color: #333 !important;
        }

        .info h4 {
            margin: 0 0 8px;
            color: #1a202c !important;
            font-weight: 700;
            font-size: 1rem;
        }

        /* Legend Control (Lebih minimalis) */
        .legend {
            line-height: 20px;
            background: rgba(255, 255, 255, .95);
            padding: 10px 14px;
            border-radius: 6px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .1);
            z-index: 800;
            color: #333;
            font-size: 13px;
        }

        .legend strong {
            color: #1a202c !important;
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }

        .legend i {
            width: 16px;
            height: 16px;
            float: left;
            margin-right: 6px;
            opacity: .7;
            border: 1px solid #e0e0e0;
        }

        /* Leaflet Tooltip (Lebih minimalis) */
        .leaflet-tooltip {
            font-family: 'Poppins', sans-serif;
            font-size: 11px;
            background: rgba(255, 255, 255, .9);
            border: 1px solid #ccc;
            border-radius: 3px;
            padding: 3px 7px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .15);
        }

        .leaflet-tooltip-permanent {
            background-color: rgba(0, 0, 0, .7) !important;
            color: #fff !important;
            border: none !important;
            padding: 2px 6px !important;
            white-space: nowrap !important;
            border-radius: 3px !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .3) !important;
            font-size: 10px !important;
        }

        /* Scrollbar styling for nearest-locations */
        #nearest-locations {
            max-height: 400px;
            overflow-y: auto
        }

        #nearest-locations::-webkit-scrollbar {
            width: 8px
        }

        #nearest-locations::-webkit-scrollbar-track {
            background: #1e293b;
            border-radius: 10px
        }

        #nearest-locations::-webkit-scrollbar-thumb {
            background: #38bdf8;
            border-radius: 10px
        }

        #nearest-locations::-webkit-scrollbar-thumb:hover {
            background: #0ea5e9
        }

        /* Styling for Leaflet Layers Control itself (Penting untuk minimalis) */
        .leaflet-control-layers {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            padding: 8px !important;
            min-width: 180px;
        }

        /* Header "Base maps" dan "Overlays" di kontrol lapisan */
        .leaflet-control-layers-base,
        .leaflet-control-layers-overlays {
            margin: 0;
            padding: 0;
        }

        /* Label untuk setiap opsi lapisan di kontrol lapisan */
        .leaflet-control-layers label {
            display: flex;
            align-items: center;
            padding: 5px 0;
            cursor: pointer;
            color: #4a5568;
            transition: color 0.2s ease;
        }

        .leaflet-control-layers label:hover {
            color: #1e40af;
        }

        /* Checkbox/radio button di kontrol lapisan */
        .leaflet-control-layers-selector {
            margin-right: 8px;
            accent-color: #22d3ee;
            width: 16px;
            height: 16px;
        }

        /* Separator kustom di kontrol lapisan */
        .custom-distance-control-separator {
            border-top: 1px solid #e0e0e0;
            margin: 8px 0;
            padding-top: 0;
        }

        /* Custom Layers Toggle Button (for Overlays) */
        .custom-layers-toggle-button {
            position: absolute;
            top: 15px;
            /* Sesuaikan agar tidak terlalu dekat dengan tepi */
            right: 15px;
            /* Posisikan di kanan atas */
            z-index: 800;
            /* Pastikan di atas peta tapi di bawah kontrol Leaflet itu sendiri */
            background: #fff;
            color: #1e40af;
            padding: 8px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .1);
            transition: all .3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }

        .custom-layers-toggle-button:hover {
            background: #e5e7eb;
            color: #1e3a8a;
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 6px 20px rgba(0, 0, 0, .15);
        }

        .custom-layers-toggle-button svg {
            width: 24px;
            height: 24px;
            fill: currentColor;
        }

        /* NEW: Styles for the Map Type Selector (Peta/Satelit buttons) */
        .map-type-selector-container {
            position: absolute;
            bottom: 15px;
            left: 15px;
            z-index: 800;
            display: flex;
            gap: 8px;
            /* Space between buttons */
            background: #fff;
            padding: 8px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .1);
            transition: all 0.3s ease-in-out;
        }

        .map-type-button {
            background: #f0f0f0;
            /* Light gray background for inactive buttons */
            color: #4a5568;
            /* Darker gray text/icon color for inactive */
            border: 1px solid #d1d5db;
            /* Light border */
            border-radius: 8px;
            /* Rounded corners for individual buttons */
            padding: 8px;
            /* Padding for the button content */
            display: flex;
            flex-direction: column;
            /* Stack icon and text vertically */
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            min-width: 60px;
            /* Minimum width to accommodate text/icon */
            font-size: 12px;
            /* Smaller font for labels */
            font-weight: 500;
        }

        .map-type-button:hover {
            background: #e5e7eb;
            /* Slightly darker on hover */
            border-color: #9ca3af;
            /* Darker border on hover */
        }

        .map-type-button.active {
            background: #38bdf8;
            /* Blue background for active button (cyan-500 equivalent) */
            color: #fff;
            /* White text/icon for active button */
            border-color: #38bdf8;
            /* Blue border for active button */
            box-shadow: 0 2px 8px rgba(56, 189, 248, 0.4);
            /* Blue shadow for active button */
        }

        .map-type-button.active:hover {
            background: #0ea5e9;
            /* Darker blue on hover for active button */
            border-color: #0ea5e9;
        }

        .map-type-button svg {
            width: 28px;
            /* Icon size */
            height: 28px;
            margin-bottom: 4px;
            /* Space between icon and label */
            fill: currentColor;
            /* Use button's color for SVG fill */
        }

        .map-type-label {
            text-align: center;
        }
    </style>

    <script>
        // --- Konstanta Aplikasi & Variabel Global & Elemen UI ---
        const API_REPORTS_URL = '/api/reports';
        const DEFAULT_MAP_CENTER = [-2.5489, 118.0149];
        const DEFAULT_MAP_ZOOM = 5; // Adjusted default zoom
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
            cityCircleLayerGroup;
        let infoControl, cityInfoControl, legendControl;
        let currentLocationMapMarker = null;
        let targetLocationMapMarker = null;
        let allFetchedReports = [];

        let straightLineLayer = null;
        let showStraightLine = false;
        let layerControlInstance = null; // This will now only manage overlays
        let distanceUpdateTimeout = null;

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

        // NEW: Elements for Map Type Buttons
        const mapPetaButton = document.getElementById('mapPetaButton');
        const mapSatelitButton = document.getElementById('mapSatelitButton');

        function showAppNotification(message, type = 'info', duration = 5000) {
            if (!notificationAreaEl) return;
            const notifElement = document.createElement('div');
            notifElement.className = `app-notification ${type}`;
            notifElement.textContent = message;
            notificationAreaEl.appendChild(notifElement);
            setTimeout(() => {
                notifElement.style.animationName = 'fadeOutNotification';
                setTimeout(() => notifElement.remove(), 490)
            }, duration - 500);
        }

        function updateInputLocationMarker(locationObj, existingMarker, isCurrentLocationMarker, mapInstance) {
            if (!mapInstance) {
                console.warn("[DEBUG] updateInputLocationMarker: mapInstance belum siap.");
                return existingMarker
            }
            if (existingMarker && mapInstance.hasLayer(existingMarker)) {
                mapInstance.removeLayer(existingMarker)
            }
            if (locationObj && locationObj.lat !== null && locationObj.lon !== null) {
                const icon = L.icon({
                    iconUrl: MARKER_ICON_URL,
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
                    }).openTooltip()
                } else {
                    newMarker.bindPopup(`<b>Tujuan:</b> ${labelText}`)
                }
                return newMarker
            }
            return null
        }

        async function geocodeLocation(query, inputElement, locationStorageObject, isForCurrentLocationMarker) {
            console.log(
                `[DEBUG] geocodeLocation dipanggil untuk: "${query}", isCurrent: ${isForCurrentLocationMarker}`);
            if (!query) {
                locationStorageObject.lat = null;
                locationStorageObject.lon = null;
                locationStorageObject.displayName = '';
                if (inputElement) inputElement.value = '';
                if (map) {
                    if (isForCurrentLocationMarker && currentLocationMapMarker && map.hasLayer(
                            currentLocationMapMarker)) {
                        map.removeLayer(currentLocationMapMarker);
                        currentLocationMapMarker = null
                    } else if (!isForCurrentLocationMarker && targetLocationMapMarker && map.hasLayer(
                            targetLocationMapMarker)) {
                        map.removeLayer(targetLocationMapMarker);
                        targetLocationMapMarker = null
                    }
                }
                tryAutoCalculateRadius();
                updateDistanceVisualizations();
                return !1
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
                    if (inputElement) inputElement.value = locationStorageObject.displayName;
                    showAppNotification(`Menggunakan koordinat langsung: ${locationStorageObject.displayName}`,
                        'success');
                    if (map) {
                        if (isForCurrentLocationMarker) {
                            currentLocationMapMarker = updateInputLocationMarker(locationStorageObject,
                                currentLocationMapMarker, true, map);
                            if (currentLocationMapMarker) map.setView([locationStorageObject.lat, locationStorageObject
                                .lon
                            ], 13)
                        } else {
                            targetLocationMapMarker = updateInputLocationMarker(locationStorageObject,
                                targetLocationMapMarker, false, map);
                            if (targetLocationMapMarker) map.setView([locationStorageObject.lat, locationStorageObject
                                .lon
                            ], 13)
                        }
                    }
                    tryAutoCalculateRadius();
                    updateDistanceVisualizations();
                    return !0
                } else {
                    showAppNotification(`Format koordinat "${query}" tidak valid.`, 'warning')
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
                    if (inputElement) inputElement.value = data[0].display_name;
                    showAppNotification(`Lokasi "${data[0].display_name}" ditemukan.`, 'success');
                    if (map) {
                        if (isForCurrentLocationMarker) {
                            currentLocationMapMarker = updateInputLocationMarker(locationStorageObject,
                                currentLocationMapMarker, true, map);
                            if (currentLocationMapMarker) map.setView([locationStorageObject.lat, locationStorageObject
                                .lon
                            ], 13)
                        } else {
                            targetLocationMapMarker = updateInputLocationMarker(locationStorageObject,
                                targetLocationMapMarker, false, map);
                            if (targetLocationMapMarker) map.setView([locationStorageObject.lat, locationStorageObject
                                .lon
                            ], 13)
                        }
                    }
                    tryAutoCalculateRadius();
                    updateDistanceVisualizations();
                    return !0
                } else {
                    showAppNotification(
                        `Alamat "${query}" tidak ditemukan. Coba sederhanakan atau gunakan format "lat,lon".`,
                        'warning', 6000);
                    locationStorageObject.lat = null;
                    locationStorageObject.lon = null;
                    locationStorageObject.displayName = query;
                    if (map) {
                        if (isForCurrentLocationMarker && currentLocationMapMarker && map.hasLayer(
                                currentLocationMapMarker)) {
                            map.removeLayer(currentLocationMapMarker);
                            currentLocationMapMarker = null
                        } else if (!isForCurrentLocationMarker && targetLocationMapMarker && map.hasLayer(
                                targetLocationMapMarker)) {
                            map.removeLayer(targetLocationMapMarker);
                            targetLocationMapMarker = null
                        }
                    }
                    tryAutoCalculateRadius();
                    updateDistanceVisualizations();
                    return !1
                }
            } catch (error) {
                console.error('Error geocoding:', error);
                showAppNotification(`Gagal mencari alamat "${query}". Periksa koneksi atau coba lagi.`, 'error');
                locationStorageObject.lat = null;
                locationStorageObject.lon = null;
                locationStorageObject.displayName = query;
                if (map) {
                    if (isForCurrentLocationMarker && currentLocationMapMarker && map.hasLayer(
                            currentLocationMapMarker)) {
                        map.removeLayer(currentLocationMapMarker);
                        currentLocationMapMarker = null
                    } else if (!isForCurrentLocationMarker && targetLocationMapMarker && map.hasLayer(
                            targetLocationMapMarker)) {
                        map.removeLayer(targetLocationMapMarker);
                        targetLocationMapMarker = null
                    }
                }
                tryAutoCalculateRadius();
                updateDistanceVisualizations();
                return !1
            }
        }

        function tryAutoCalculateRadius() {
            if (currentLocationCoords.lat !== null && currentLocationCoords.lon !== null && targetLocationCoords.lat !==
                null && targetLocationCoords.lon !== null) {
                const distance = calculateDistance(currentLocationCoords.lat, currentLocationCoords.lon,
                    targetLocationCoords.lat, targetLocationCoords.lon);
                const roundedDistance = Math.max(0.1, parseFloat(distance.toFixed(1)));
                radiusInputEl.value = roundedDistance;
                showAppNotification(`Radius otomatis dihitung: ${roundedDistance} km.`, 'info')
            }
        }

        function getMarkerIcon() {
            return L.icon({
                iconUrl: MARKER_ICON_URL,
                shadowUrl: MARKER_SHADOW_URL,
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [0, -41],
                shadowSize: [41, 41],
                shadowAnchor: [12, 41]
            })
        }

        function updateAreaStatistics(wastePoints) {
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
                return
            }
            reportCounts.forEach(({
                label,
                count,
                unit
            }) => {
                const statDiv = document.createElement('div');
                statDiv.innerHTML =
                    ` <p class="text-sm text-gray-300 mb-2">${label}</p> <div class="w-full bg-gray-800 rounded-full h-3"> <div class="bg-gradient-to-r from-[#22d3ee] to-[#06b6d4] h-3 rounded-full transition-all duration-500" style="width: ${totalReports>0?(count/totalReports)*100:0}%"></div> </div> <p class="text-right text-xs text-gray-400 mt-1">${count} ${unit}</p>`;
                statsContainerEl.appendChild(statDiv)
            })
        }

        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371;
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI /
                180) * Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c
        }
        async function fetchWastePoints() {
            try {
                const response = await fetch(API_REPORTS_URL);
                if (!response.ok) {
                    const errorText = await response.text();
                    throw new Error(
                        `Gagal mengambil data laporan dari API: ${response.status} ${response.statusText} - ${errorText}`
                    )
                }
                const data = await response.json();
                const rawReports = data && Array.isArray(data.reports) ? data.reports : (Array.isArray(data) ? data :
                []);
                if (!Array.isArray(rawReports)) {
                    console.error('Format data.reports dari API tidak sesuai (bukan array):', rawReports);
                    showAppNotification('Format data laporan dari API tidak sesuai atau API tidak dapat diakses.',
                        'error');
                    return []
                }
                console.log(`API Call: Diterima ${rawReports.length} laporan mentah.`);
                const validReports = rawReports.map(report => {
                    let lat = null,
                        lon = null;
                    if (report.coords && Array.isArray(report.coords) && report.coords.length === 2) {
                        lat = parseFloat(report.coords[0]);
                        lon = parseFloat(report.coords[1])
                    } else if (typeof report.latitude !== 'undefined' && typeof report.longitude !==
                        'undefined') {
                        lat = parseFloat(report.latitude);
                        lon = parseFloat(report.longitude)
                    }
                    if (isNaN(lat) || isNaN(lon)) {
                        console.warn(
                            `Laporan ID ${report.id||'(tanpa ID)'} ("${report.name||'Tanpa Nama'}") dilewati karena koordinat tidak valid: lat=${report.latitude}, lon=${report.longitude}, data asli:`,
                            report);
                        return null
                    }
                    return {
                        id: report.id || Date.now() + Math.random(),
                        name: report.name || 'Laporan Tanpa Nama',
                        email: report.email || 'Tidak diketahui',
                        coords: [lat, lon],
                        type: report.type || 'Tidak Diketahui',
                        address: report.location || 'Alamat Tidak Diketahui',
                        capacity: report.size || 'Ukuran Tidak Diketahui',
                        urgency: report.urgency || 'Urgensi Tidak Diketahui',
                        description: report.description || 'Tidak ada deskripsi',
                        photos: Array.isArray(report.photos) ? report.photos : (report.photos ? [report
                            .photos
                        ] : []),
                        province: report.province || 'Provinsi Tidak Diketahui',
                        city: report.city || 'Kota/Kab Tidak Diketahui'
                    }
                }).filter(report => report !== null);
                console.log(`Pemrosesan Selesai: ${validReports.length} laporan valid akan digunakan.`);
                allFetchedReports = validReports;
                if (validReports.length === 0 && rawReports.length > 0) {
                    showAppNotification(
                        'Semua laporan yang diterima dari API memiliki data lokasi yang tidak lengkap/valid.',
                        'warning')
                } else if (validReports.length === 0 && rawReports.length === 0) {
                    showAppNotification('Tidak ada data laporan yang diterima dari API.', 'info')
                }
                return validReports
            } catch (error) {
                console.error('Error dalam fetchWastePoints:', error);
                showAppNotification('Gagal memuat data laporan: ' + error.message, 'error');
                allFetchedReports = [];
                return []
            }
        }
        async function addMarkers(reportsToDisplay, referenceLatLon) {
            if (!markers) {
                console.error("Marker cluster group (markers) belum diinisialisasi.");
                return
            }
            markers.clearLayers();
            nearestLocationsListEl.innerHTML = '';
            if (reportsToDisplay.length === 0) {
                if (referenceLatLon) {
                    nearestLocationsListEl.innerHTML =
                        `<li class="text-gray-400 text-center py-4">Tidak ada laporan ditemukan dalam radius yang ditentukan.</li>`
                } else {
                    nearestLocationsListEl.innerHTML =
                        `<li class="text-gray-400 text-center py-4">Tidak ada laporan untuk ditampilkan.</li>`
                }
                return
            }
            let displayedInListCount = 0;
            reportsToDisplay.forEach((loc, index) => {
                if (!loc.coords || loc.coords.length !== 2 || isNaN(loc.coords[0]) || isNaN(loc.coords[1])) {
                    console.warn(
                        `addMarkers: Melewati laporan "${loc.name||'Tanpa Nama'}" karena koordinat tidak valid.`
                    );
                    return
                }
                const [lat, lon] = loc.coords;
                const distance = referenceLatLon ? calculateDistance(referenceLatLon[0], referenceLatLon[1],
                    lat, lon) : null;
                const popupContent =
                    ` <div class="p-3 max-w-xs"> <h4 class="font-bold text-gray-900 text-base mb-2">${loc.name}</h4> ${loc.email&&loc.email!=='Tidak diketahui'?`<p class="text-gray-700 text-sm mb-1"><strong>Email:</strong> ${loc.email}</p>`:''} <p class="text-gray-700 text-sm mb-1"><strong>Alamat:</strong> ${loc.address}</p> <p class="text-gray-700 text-sm mb-1"><strong>Jenis:</strong> ${loc.type?loc.type.charAt(0).toUpperCase()+loc.type.slice(1):'Tidak Diketahui'}</p> <p class="text-gray-700 text-sm mb-1"><strong>Ukuran:</strong> ${loc.capacity}</p> <p class="text-gray-700 text-sm mb-1"><strong>Urgensi:</strong> ${loc.urgency}</p> ${loc.province&&loc.province!=='Provinsi Tidak Diketahui'?`<p class="text-gray-700 text-sm mb-1"><strong>Provinsi:</strong> ${loc.province}</p>`:''} ${loc.city&&loc.city!=='Kota/Kab Tidak Diketahui'?`<p class="text-gray-700 text-sm mb-1"><strong>Kota/Kab:</strong> ${loc.city}</p>`:''} <p class="text-gray-700 text-sm mb-2"><strong>Deskripsi:</strong> ${loc.description||'Tidak ada'}</p> ${loc.photos&&loc.photos.length>0?` <p class="text-gray-700 text-sm mb-1"><strong>Foto:</strong></p> <div style="max-height: 150px; overflow-y: auto;"> ${loc.photos.map(photo=>`<img src="/${photo.startsWith('storage/')?photo:'storage/'+photo}" alt="Foto Sampah" class="w-full mt-1 rounded-md shadow-sm mb-1">`).join('')} </div>`:'<p class="text-gray-700 text-sm mb-1"><strong>Foto:</strong> Tidak ada</p>'} </div>`;
                const marker = L.marker([lat, lon], {
                    icon: getMarkerIcon()
                }).bindPopup(popupContent, {
                    className: 'popup-content',
                    autoPanPadding: [50, 50]
                });
                markers.addLayer(marker);
                const radiusToFilterList = parseFloat(radiusInputEl.value);
                if (referenceLatLon && distance !== null && distance <= radiusToFilterList) {
                    const li = document.createElement('li');
                    li.className =
                        'border-b border-gray-700 pb-3 transition hover:bg-gray-800/50 rounded-md px-2 py-2 cursor-pointer text-gray-300 hover:text-white';
                    li.innerHTML =
                        ` <h4 class="font-semibold text-base">${loc.name}</h4> <p class="text-xs">${loc.address}</p> <p class="text-xs">Jenis: ${loc.type?loc.type.charAt(0).toUpperCase()+loc.type.slice(1):'N/A'}</p> <p class="text-xs text-cyan-400 font-medium">${distance.toFixed(1)} km dari lokasi Anda</p> ${loc.city&&loc.city!=='Kota/Kab Tidak Diketahui'?`<p class="text-gray-500 text-xs">Kota/Kab: ${loc.city.replace(/([A-Z])/g,' $1').trim()}</p>`:''} ${loc.province&&loc.province!=='Provinsi Tidak Diketahui'?`<p class="text-gray-500 text-xs">Provinsi: ${loc.province.replace(/([A-Z])/g,' $1').trim()}</p>`:''}`;
                    li.addEventListener('click', () => {
                        if (map) map.setView([lat, lon], 14);
                        marker.openPopup()
                    });
                    nearestLocationsListEl.appendChild(li);
                    displayedInListCount++
                }
            });
            if (referenceLatLon && displayedInListCount === 0 && reportsToDisplay.length > 0) {
                nearestLocationsListEl.innerHTML =
                    `<li class="text-gray-400 text-center py-4">Tidak ada laporan dalam radius yang ditentukan dari lokasi acuan.</li>`
            } else if (!referenceLatLon && reportsToDisplay.length > 0 && nearestLocationsListEl.children.length ===
                0) {
                nearestLocationsListEl.innerHTML =
                    `<li class="text-gray-400 text-center py-4">Gunakan GPS atau cari lokasi untuk melihat laporan terdekat.</li>`
            }
            if (markers.getLayers().length > 0 && map) {
                if (referenceLatLon && !showStraightLine) {
                    map.fitBounds(markers.getBounds(), {
                        padding: [50, 50],
                        maxZoom: 14
                    })
                } else if (markers.getLayers().length === 1 && !referenceLatLon) {
                    map.setView(markers.getLayers()[0].getLatLng(), 13)
                }
            }
        }
        async function refreshNearbyLocations() {
            if (!allFetchedReports || allFetchedReports.length === 0) {
                console.log("refreshNearbyLocations: Data laporan global kosong, mengambil ulang...");
                await fetchWastePoints();
                if (!allFetchedReports || allFetchedReports.length === 0) {
                    addMarkers([], null);
                    updateAreaStatistics([]);
                    nearestLocationsListEl.innerHTML =
                        `<li class="text-gray-400 text-center py-4">Data laporan belum tersedia.</li>`;
                    return
                }
            }
            if (currentLocationCoords.lat === null || currentLocationCoords.lon === null) {
                console.log(
                    "refreshNearbyLocations: Lokasi pengguna tidak ada. Menampilkan semua laporan (dengan filter jenis)."
                );
                const typeFilterValue = typeInputEl.value;
                let reportsToDisplay = allFetchedReports;
                if (typeFilterValue) {
                    reportsToDisplay = reportsToDisplay.filter(loc => loc.type === typeFilterValue)
                }
                addMarkers(reportsToDisplay, null);
                updateAreaStatistics(reportsToDisplay);
                return
            }
            showAppNotification('Memperbarui laporan terdekat...', 'info', 2500);
            const currentRadius = parseFloat(radiusInputEl.value) || 10;
            const typeFilterValue = typeInputEl.value;
            let reportsToFilter = allFetchedReports;
            if (typeFilterValue) {
                reportsToFilter = reportsToFilter.filter(loc => loc.type === typeFilterValue)
            }
            const nearbyFilteredReports = reportsToFilter.filter(loc => {
                if (loc.coords) {
                    const distance = calculateDistance(currentLocationCoords.lat, currentLocationCoords.lon, loc
                        .coords[0], loc.coords[1]);
                    return distance <= currentRadius
                }
                return !1
            });
            addMarkers(nearbyFilteredReports, [currentLocationCoords.lat, currentLocationCoords.lon]);
            updateAreaStatistics(nearbyFilteredReports);
            if (nearbyFilteredReports.length === 0) {
                showAppNotification(`Tidak ada laporan ditemukan dalam radius ${currentRadius}km.`, 'info')
            } else {
                showAppNotification(`${nearbyFilteredReports.length} laporan terdekat ditemukan.`, 'success')
            }
        }
        async function handleFetchCurrentLocation() {
            if (!navigator.geolocation) {
                showAppNotification('Geolocation tidak didukung browser Anda.', 'error');
                return
            }
            showAppNotification('Mendapatkan lokasi GPS Anda...', 'info', 4000);
            fetchCurrentLocationButtonEl.disabled = !0;
            const originalButtonContent = fetchCurrentLocationButtonEl.innerHTML;
            fetchCurrentLocationButtonEl.innerHTML =
                `<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>`;
            try {
                const position = await new Promise((resolve, reject) => {
                    navigator.geolocation.getCurrentPosition(resolve, reject, {
                        timeout: 10000,
                        enableHighAccuracy: !0
                    })
                });
                currentLocationCoords.lat = position.coords.latitude;
                currentLocationCoords.lon = position.coords.longitude;
                const response = await fetch(
                    `${NOMINATIM_REVERSE_URL}?format=json&lat=${currentLocationCoords.lat}&lon=${currentLocationCoords.lon}&accept-language=id&addressdetails=1`
                );
                if (!response.ok) throw new Error('Gagal reverse geocoding');
                const data = await response.json();
                currentLocationCoords.displayName = data && data.display_name ? data.display_name :
                    `Koordinat: ${currentLocationCoords.lat.toFixed(5)}, ${currentLocationCoords.lon.toFixed(5)}`;
                currentLocationInputEl.value = currentLocationCoords.displayName;
                showAppNotification(data && data.display_name ? 'Lokasi GPS ditemukan & diisi.' :
                    'Lokasi GPS (koordinat) ditemukan.', 'success');
                if (map) {
                    currentLocationMapMarker = updateInputLocationMarker(currentLocationCoords,
                        currentLocationMapMarker, !0, map);
                    if (currentLocationMapMarker) map.setView([currentLocationCoords.lat, currentLocationCoords.lon],
                        13)
                }
                tryAutoCalculateRadius();
                await refreshNearbyLocations();
                updateDistanceVisualizations()
            } catch (error) {
                console.error('Error pada proses GPS/reverse geocoding:', error);
                let message = 'Gagal mendapatkan lokasi GPS: ';
                if (error.code) {
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            message += 'Anda menolak izin.';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            message += 'Informasi lokasi tidak tersedia.';
                            break;
                        case error.TIMEOUT:
                            message += 'Permintaan lokasi timed out.';
                            break;
                        default:
                            message += 'Kesalahan tidak diketahui.'
                    }
                } else {
                    message = 'Gagal mendapatkan detail alamat dari GPS. Cek koneksi Anda.'
                }
                showAppNotification(message, 'error');
                if (currentLocationCoords.lat && currentLocationCoords.lon && !currentLocationCoords.displayName) {
                    currentLocationCoords.displayName =
                        `Koordinat: ${currentLocationCoords.lat.toFixed(5)}, ${currentLocationCoords.lon.toFixed(5)}`;
                    currentLocationInputEl.value = currentLocationCoords.displayName;
                    if (map) {
                        currentLocationMapMarker = updateInputLocationMarker(currentLocationCoords,
                            currentLocationMapMarker, !0, map);
                        if (currentLocationMapMarker) map.setView([currentLocationCoords.lat, currentLocationCoords
                            .lon
                        ], 13)
                    }
                    await refreshNearbyLocations()
                } else if (!currentLocationCoords.lat || !currentLocationCoords.lon) {
                    currentLocationCoords = {
                        lat: null,
                        lon: null,
                        displayName: ''
                    };
                    currentLocationInputEl.value = '';
                    if (map && currentLocationMapMarker && map.hasLayer(currentLocationMapMarker)) {
                        map.removeLayer(currentLocationMapMarker);
                        currentLocationMapMarker = null
                    }
                }
                tryAutoCalculateRadius();
                updateDistanceVisualizations()
            } finally {
                fetchCurrentLocationButtonEl.disabled = !1;
                fetchCurrentLocationButtonEl.innerHTML = originalButtonContent
            }
        }

        function updateDistanceVisualizations() {
            console.log("[DEBUG] updateDistanceVisualizations diminta. showStraightLine:", showStraightLine, "currentLoc:",
                currentLocationCoords, "targetLoc:", targetLocationCoords);

            if (distanceUpdateTimeout) {
                clearTimeout(distanceUpdateTimeout);
                console.log("[DEBUG] Timeout pembaruan jarak sebelumnya dibatalkan.");
            }

            distanceUpdateTimeout = setTimeout(() => {
                console.log("[DEBUG] Timeout pembaruan jarak dieksekusi.");
                if (!map) {
                    console.warn("[DEBUG] Peta belum siap untuk updateDistanceVisualizations (dalam timeout).");
                    distanceUpdateTimeout = null;
                    return;
                }

                if (straightLineLayer && map.hasLayer(straightLineLayer)) {
                    map.removeLayer(straightLineLayer);
                    straightLineLayer = null;
                    console.log("[DEBUG] Straight line layer lama dihapus (dalam timeout).");
                }

                const startPoint = (currentLocationCoords.lat !== null && currentLocationCoords.lon !== null) ? [
                    currentLocationCoords.lat, currentLocationCoords.lon
                ] : null;
                const endPoint = (targetLocationCoords.lat !== null && targetLocationCoords.lon !== null) ? [
                    targetLocationCoords.lat, targetLocationCoords.lon
                ] : null;

                if (!startPoint || !endPoint) {
                    console.log(
                        "[DEBUG] Titik awal atau akhir belum ada (dalam timeout). Tidak ada visualisasi jarak."
                    );
                    distanceUpdateTimeout = null;
                    return;
                }

                if (showStraightLine) {
                    console.log("[DEBUG] Menampilkan jarak lurus (dalam timeout).");
                    straightLineLayer = L.polyline([startPoint, endPoint], {
                        color: 'blue',
                        weight: 3,
                        opacity: 0.7,
                        dashArray: '5, 10'
                    }).addTo(map);
                    const distance = calculateDistance(startPoint[0], startPoint[1], endPoint[0], endPoint[1]);
                    straightLineLayer.bindTooltip(`Jarak Lurus: ${distance.toFixed(2)} km`, {
                        permanent: false,
                        direction: 'center',
                        className: 'custom-tooltip-distance'
                    });
                    map.fitBounds(L.latLngBounds(startPoint, endPoint), {
                        padding: [50, 50],
                        maxZoom: 16
                    });
                }

                distanceUpdateTimeout = null;
            }, 150);
        }


        async function initializeMap() {
            console.log("[DEBUG] initializeMap mulai.");
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
            console.log("[DEBUG] Objek peta dibuat.");

            osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap',
                maxZoom: MAX_ZOOM
            });
            satelliteLayer = L.tileLayer(
                'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                    attribution: 'Tiles © Esri',
                    maxZoom: MAX_ZOOM
                });

            // Determine initial layer from localStorage or default to OSM
            let initialLayerName = localStorage.getItem('mapLayer') || 'osm';
            let initialLayer;

            if (initialLayerName === 'satellite') {
                initialLayer = satelliteLayer;
            } else {
                initialLayer = osmLayer;
                initialLayerName = 'osm'; // Ensure consistency if default
            }
            initialLayer.addTo(map);

            // Set initial active state for the new map type buttons
            if (initialLayer === osmLayer) {
                mapPetaButton.classList.add('active');
            } else if (initialLayer === satelliteLayer) {
                mapSatelitButton.classList.add('active');
            }


            markers = L.markerClusterGroup({
                maxClusterRadius: 60,
                spiderfyOnMaxZoom: !0,
                showCoverageOnHover: !0,
                zoomToBoundsOnClick: !0,
                disableClusteringAtZoom: 15,
                iconCreateFunction: function(cluster) {
                    const count = cluster.getChildCount();
                    let sc = 'small';
                    if (count >= 10 && count < 100) sc = 'medium';
                    else if (count >= 100) sc = 'large';
                    return L.divIcon({
                        html: `<div><span>${count}</span></div>`,
                        className: `marker-cluster marker-cluster-${sc}`,
                        iconSize: L.point(40, 40)
                    })
                }
            });
            map.addLayer(markers);
            console.log("[DEBUG] Marker cluster group ditambahkan.");

            showAppNotification('Memuat data peta awal...', 'info', 2000);
            await fetchWastePoints();
            await refreshNearbyLocations();

            const provinceReports = {};
            const cityReports = {};
            allFetchedReports.forEach(report => {
                if (report.province && report.province !== 'Provinsi Tidak Diketahui') {
                    const normalizedReportProvince = report.province.replace(/\s/g, '');
                    provinceReports[normalizedReportProvince] = (provinceReports[normalizedReportProvince] ||
                        0) + 1
                }
                if (report.city && report.city !== 'Kota/Kab Tidak Diketahui') {
                    const normalizedReportCity = report.city.replace(/\s/g, '');
                    cityReports[normalizedReportCity] = (cityReports[normalizedReportCity] || 0) + 1
                }
            });
            const provinceGeoJsonPromise = fetch(PROVINCE_GEOJSON_PATH).then(res => res.ok ? res.json() : Promise
                .reject('Gagal memuat GeoJSON Provinsi')).catch(err => {
                console.error(err);
                showAppNotification(String(err), 'error');
                return null
            });
            const cityGeoJsonPromise = fetch(CITY_GEOJSON_PATH).then(res => res.ok ? res.json() : Promise.reject(
                'Gagal memuat GeoJSON Kota/Kab')).catch(err => {
                console.error(err);
                showAppNotification(String(err), 'error');
                return null
            });
            Promise.all([provinceGeoJsonPromise, cityGeoJsonPromise]).then(([provinceGeoJson, cityGeoJson]) => {
                console.log("[DEBUG] Data GeoJSON diterima (atau null jika gagal).");
                provinceChoroplethLayer = L.geoJson(null, {
                    style: styleProvince
                });
                cityChoroplethLayer = L.geoJson(null, {
                    style: styleCityRegency
                });
                provinceCircleLayerGroup = L.layerGroup();
                cityCircleLayerGroup = L.layerGroup();
                let provinceCentroids = {},
                    cityCentroids = {};
                if (provinceGeoJson && provinceGeoJson.features) {
                    provinceGeoJson.features.forEach(feature => {
                        const bounds = L.geoJSON(feature).getBounds();
                        if (bounds.isValid()) provinceCentroids[feature.properties.NAME_1.replace(/\s/g,
                            '')] = bounds.getCenter()
                    });
                    if (provinceChoroplethLayer) provinceChoroplethLayer.addData(provinceGeoJson)
                }
                if (cityGeoJson && cityGeoJson.features) {
                    cityGeoJson.features.forEach(feature => {
                        const bounds = L.geoJSON(feature).getBounds();
                        if (bounds.isValid()) cityCentroids[feature.properties.NAME_2.replace(/\s/g,
                            '')] = bounds.getCenter()
                    });
                    if (cityChoroplethLayer) cityChoroplethLayer.addData(cityGeoJson)
                }

                function getCircleOptions(count) {
                    if (count >= 16) return {
                        color: '#b30000',
                        fillColor: '#b30000',
                        radius: 3e4
                    };
                    if (count >= 8) return {
                        color: '#ff4500',
                        fillColor: '#ff4500',
                        radius: 25e3
                    };
                    if (count >= 4) return {
                        color: '#ff8c00',
                        fillColor: '#ff8c00',
                        radius: 2e4
                    };
                    if (count > 0) return {
                        color: '#ffd700',
                        fillColor: '#ffd700',
                        radius: 15e3
                    };
                    return {
                        color: '#32cd32',
                        fillColor: '#32cd32',
                        radius: 1e4
                    }
                }

                function updateCircleFeaturesLayers() {
                    provinceCircleLayerGroup.clearLayers();
                    cityCircleLayerGroup.clearLayers();
                    if (map.getZoom() < 8 && map.hasLayer(provinceCircleLayerGroup) && provinceGeoJson &&
                        provinceGeoJson.features) {
                        provinceGeoJson.features.forEach(feature => {
                            const normalizedGeoJsonProvince = feature.properties.NAME_1.replace(/\s/g,
                                '');
                            const reportCount = provinceReports[normalizedGeoJsonProvince] || 0;
                            const centroid = provinceCentroids[normalizedGeoJsonProvince];
                            if (centroid && reportCount > 0) {
                                const circle = L.circle(centroid, {
                                    ...getCircleOptions(reportCount),
                                    fillOpacity: .5,
                                    className: 'waste-circle'
                                });
                                const numberIcon = L.divIcon({
                                    className: 'waste-circle-label',
                                    html: `<span>${reportCount}</span>`,
                                    iconSize: [30, 30],
                                    iconAnchor: [15, 15]
                                });
                                const numberMarker = L.marker(centroid, {
                                    icon: numberIcon,
                                    interactive: !1
                                });
                                circle.bindTooltip(
                                    `<b>${feature.properties.NAME_1}</b><br>${reportCount} laporan`, {
                                        sticky: !0
                                    });
                                provinceCircleLayerGroup.addLayer(circle).addLayer(numberMarker)
                            }
                        })
                    }
                    if (map.getZoom() >= 8 && map.hasLayer(cityCircleLayerGroup) && cityGeoJson && cityGeoJson
                        .features) {
                        cityGeoJson.features.forEach(feature => {
                            const normalizedGeoJsonCity = feature.properties.NAME_2.replace(/\s/g, '');
                            const reportCount = cityReports[normalizedGeoJsonCity] || 0;
                            const centroid = cityCentroids[normalizedGeoJsonCity];
                            if (centroid && reportCount > 0) {
                                const circle = L.circle(centroid, {
                                    ...getCircleOptions(reportCount),
                                    radius: getCircleOptions(reportCount).radius / 2,
                                    fillOpacity: .5,
                                    className: 'waste-circle'
                                });
                                const numberIcon = L.divIcon({
                                    className: 'waste-circle-label',
                                    html: `<span>${reportCount}</span>`,
                                    iconSize: [20, 20],
                                    iconAnchor: [10, 10]
                                });
                                const numberMarker = L.marker(centroid, {
                                    icon: numberIcon,
                                    interactive: !1
                                });
                                circle.bindTooltip(
                                    `<b>${feature.properties.NAME_2}</b> (${feature.properties.NAME_1})<br>${reportCount} laporan`, {
                                        sticky: !0
                                    });
                                cityCircleLayerGroup.addLayer(circle).addLayer(numberMarker)
                            }
                        })
                    }
                }
                map.on('zoomend', updateCircleFeaturesLayers);

                function getChoroplethColor(d) {
                    return d > 100 ? '#800000' : d > 50 ? '#b30000' : d > 20 ? '#e34a33' : d > 10 ? '#fc8d59' :
                        d > 0 ? '#fdcc8a' : '#f7f7f7'
                }

                function styleProvince(feature) {
                    const normalizedGeoJsonProvince = feature.properties.NAME_1.replace(/\s/g, '');
                    const reportCount = provinceReports[normalizedGeoJsonProvince] || 0;
                    return {
                        fillColor: getChoroplethColor(reportCount),
                        weight: 2,
                        opacity: 1,
                        color: 'white',
                        dashArray: '3',
                        fillOpacity: .7
                    }
                }

                function styleCityRegency(feature) {
                    const normalizedGeoJsonCity = feature.properties.NAME_2.replace(/\s/g, '');
                    const reportCount = cityReports[normalizedGeoJsonCity] || 0;
                    return {
                        fillColor: getChoroplethColor(reportCount),
                        weight: 1,
                        opacity: 1,
                        color: '#ccc',
                        dashArray: '1',
                        fillOpacity: .65
                    }
                }
                infoControl = L.control({
                    position: 'topright'
                });
                infoControl.onAdd = function(map) {
                    this._div = L.DomUtil.create('div', 'info province-info');
                    this.update();
                    return this._div
                };
                infoControl.update = function(props) {
                    const count = props ? (provinceReports[props.NAME_1.replace(/\s/g, '')] || 0) : 0;
                    this._div.innerHTML = '<h4>Laporan per Provinsi</h4>' + (props ?
                        `<b>${props.NAME_1}</b><br />${count} laporan` : 'Arahkan kursor ke provinsi')
                };
                cityInfoControl = L.control({
                    position: 'topright'
                });
                cityInfoControl.onAdd = function(map) {
                    this._div = L.DomUtil.create('div', 'info city-info');
                    this.update();
                    return this._div
                };
                cityInfoControl.update = function(props) {
                    let content = '<h4>Laporan per Kota/Kab.</h4>';
                    if (props && props.NAME_2) {
                        const count = cityReports[props.NAME_2.replace(/\s/g, '')] || 0;
                        content += `<b>${props.NAME_2}</b> (${props.NAME_1})<br />${count} laporan`
                    } else {
                        content += 'Arahkan kursor ke kota/kabupaten'
                    }
                    this._div.innerHTML = content
                };

                function highlightFeature(e, isProvince) {
                    const layer = e.target;
                    layer.setStyle({
                        weight: 5,
                        color: '#22d3ee',
                        dashArray: '',
                        fillOpacity: .7
                    });
                    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) layer.bringToFront();
                    if (isProvince) infoControl.update(layer.feature.properties);
                    else cityInfoControl.update(layer.feature.properties)
                }

                function resetHighlightProvince(e) {
                    if (provinceChoroplethLayer) provinceChoroplethLayer.resetStyle(e.target);
                    infoControl.update()
                }

                function resetHighlightCity(e) {
                    if (cityChoroplethLayer) cityChoroplethLayer.resetStyle(e.target);
                    cityInfoControl.update()
                }

                function zoomToFeature(e) {
                    map.fitBounds(e.target.getBounds())
                }
                if (provinceChoroplethLayer && provinceGeoJson && provinceGeoJson.features) {
                    provinceChoroplethLayer.options.onEachFeature = (feature, layer) => {
                        const reportCount = provinceReports[feature.properties.NAME_1.replace(/\s/g, '')] ||
                            0;
                        layer.bindTooltip(`<b>${feature.properties.NAME_1}</b><br>${reportCount} laporan`, {
                            sticky: !0
                        });
                        layer.on({
                            mouseover: e => highlightFeature(e, !0),
                            mouseout: resetHighlightProvince,
                            click: zoomToFeature
                        })
                    };
                    if (provinceChoroplethLayer.getLayers().length > 0) provinceChoroplethLayer.eachLayer(
                        layer => {
                            if (layer.feature && layer.feature.properties) {
                                provinceChoroplethLayer.options.onEachFeature(layer.feature, layer)
                            }
                        })
                }
                if (cityChoroplethLayer && cityGeoJson && cityGeoJson.features) {
                    cityChoroplethLayer.options.onEachFeature = (feature, layer) => {
                        const reportCount = cityReports[feature.properties.NAME_2.replace(/\s/g, '')] || 0;
                        layer.bindTooltip(
                            `<b>${feature.properties.NAME_2}</b> (${feature.properties.NAME_1})<br>${reportCount} laporan`, {
                                sticky: !0
                            });
                        layer.on({
                            mouseover: e => highlightFeature(e, !1),
                            mouseout: resetHighlightCity,
                            click: zoomToFeature
                        })
                    };
                    if (cityChoroplethLayer.getLayers().length > 0) cityChoroplethLayer.eachLayer(layer => {
                        if (layer.feature && layer.feature.properties) {
                            cityChoroplethLayer.options.onEachFeature(layer.feature, layer)
                        }
                    })
                }
                legendControl = L.control({
                    position: 'bottomright'
                });
                legendControl.onAdd = function(map) {
                    const div = L.DomUtil.create('div', 'info legend');
                    let labels = ['<strong>Legenda Jumlah Laporan</strong>'];
                    labels.push('<i style="background:#f7f7f7"></i> 0');
                    labels.push(`<i style="background:${getChoroplethColor(1)}"></i> 1 &ndash; 10`);
                    labels.push(`<i style="background:${getChoroplethColor(11)}"></i> 11 &ndash; 20`);
                    labels.push(`<i style="background:${getChoroplethColor(21)}"></i> 21 &ndash; 50`);
                    labels.push(`<i style="background:${getChoroplethColor(51)}"></i> 51 &ndash; 100`);
                    labels.push(`<i style="background:${getChoroplethColor(101)}"></i> > 100`);
                    div.innerHTML = labels.join('<br>');
                    return div
                };

                // MODIFIED: baseMaps are now empty, handled by custom buttons
                const baseMaps = {};
                const overlayMaps = {
                    "Marker Laporan Sampah": markers,
                    "Choropleth Provinsi": provinceChoroplethLayer,
                    "Choropleth Kota/Kab.": cityChoroplethLayer,
                    "Lingkaran Laporan (Provinsi)": provinceCircleLayerGroup,
                    "Lingkaran Laporan (Kota/Kab.)": cityCircleLayerGroup
                };
                layerControlInstance = L.control.layers(baseMaps, overlayMaps, {
                    collapsed: true
                }).addTo(map);
                console.log("[DEBUG] Layer control dasar ditambahkan.");

                const overlaysListContainer = layerControlInstance.getContainer().querySelector(
                    '.leaflet-control-layers-overlays');
                if (overlaysListContainer) {
                    console.log("[DEBUG] Container untuk overlay kustom ditemukan.");
                    const separatorDiv = document.createElement('div');
                    separatorDiv.className = 'custom-distance-control-separator';
                    overlaysListContainer.appendChild(separatorDiv);

                    const straightLineDiv = document.createElement('div');
                    straightLineDiv.innerHTML =
                        `<label><input type="checkbox" class="leaflet-control-layers-selector" id="cbShowStraightLine"><span> Tampilkan Jarak Lurus</span></label>`;
                    overlaysListContainer.appendChild(straightLineDiv);
                    const cbStraightElement = document.getElementById('cbShowStraightLine');
                    if (cbStraightElement) {
                        cbStraightElement.checked = showStraightLine;
                        cbStraightElement.addEventListener('change', function(e) {
                            showStraightLine = e.target.checked;
                            console.log("[DEBUG] Status Tampilkan Jarak Lurus diubah menjadi:",
                                showStraightLine);
                            updateDistanceVisualizations();
                        });
                    } else {
                        console.error("[DEBUG] Checkbox 'cbShowStraightLine' tidak ditemukan!");
                    }

                } else {
                    console.error("[DEBUG] Container '.leaflet-control-layers-overlays' tidak ditemukan!");
                }

                map.on('overlayadd', function(e) {
                    if (e.layer === provinceChoroplethLayer && infoControl && !infoControl._map) {
                        infoControl.addTo(map);
                    } else if (e.layer === cityChoroplethLayer && cityInfoControl && !cityInfoControl
                        ._map) {
                        cityInfoControl.addTo(map);
                    } else if (e.layer === provinceCircleLayerGroup) {
                        updateCircleFeaturesLayers();
                    } else if (e.layer === cityCircleLayerGroup) {
                        updateCircleFeaturesLayers();
                    }
                    if ((e.layer === provinceChoroplethLayer || e.layer === cityChoroplethLayer) &&
                        legendControl && !legendControl._map) {
                        legendControl.addTo(map);
                    }
                });
                map.on('overlayremove', function(e) {
                    if (e.layer === provinceChoroplethLayer && infoControl && infoControl._map) {
                        map.removeControl(infoControl);
                    } else if (e.layer === cityChoroplethLayer && cityInfoControl && cityInfoControl
                        ._map) {
                        map.removeControl(cityInfoControl);
                    } else if (e.layer === provinceCircleLayerGroup) {
                        provinceCircleLayerGroup.clearLayers();
                    } else if (e.layer === cityCircleLayerGroup) {
                        cityCircleLayerGroup.clearLayers();
                    }
                    if ((e.layer === provinceChoroplethLayer || e.layer === cityChoroplethLayer) &&
                        legendControl && legendControl._map) {
                        if (!map.hasLayer(provinceChoroplethLayer) && !map.hasLayer(
                                cityChoroplethLayer)) {
                            map.removeControl(legendControl);
                        }
                    }
                });
                // REMOVED: map.on('baselayerchange', ...) - now handled by custom buttons.

                // Initial addition of controls if they are supposed to be active by default,
                // but this will be overridden by the toggle button logic.
                if (map.hasLayer(provinceChoroplethLayer) && infoControl && !infoControl._map) infoControl
                    .addTo(map);
                if (map.hasLayer(cityChoroplethLayer) && cityInfoControl && !cityInfoControl._map)
                    cityInfoControl.addTo(map);
                if ((map.hasLayer(provinceChoroplethLayer) || map.hasLayer(cityChoroplethLayer)) &&
                    legendControl && !legendControl._map) legendControl.addTo(map);
                if (map.hasLayer(provinceCircleLayerGroup) || map.hasLayer(cityCircleLayerGroup))
                    updateCircleFeaturesLayers();

                console.log("[DEBUG] Event listener peta dan kontrol awal diatur.");
                updateDistanceVisualizations();
            }).catch(error => {
                console.error("[DEBUG] Error memuat data GeoJSON:", error);
                showAppNotification("Gagal memuat sebagian data peta.", "error");
            });
            console.log("[DEBUG] initializeMap selesai.");
        }

        // NEW: Function to set active state for base map buttons
        function setActiveBaseMapButton(buttonId) {
            mapPetaButton.classList.remove('active');
            mapSatelitButton.classList.remove('active');
            document.getElementById(buttonId).classList.add('active');
        }

        // NEW: Event listeners for Peta and Satelit buttons
        mapPetaButton.addEventListener('click', () => {
            if (!map.hasLayer(osmLayer)) {
                map.removeLayer(satelliteLayer);
                osmLayer.addTo(map);
                localStorage.setItem('mapLayer', 'osm');
                setActiveBaseMapButton('mapPetaButton');
                showAppNotification('Peta dasar diganti ke OpenStreetMap.', 'info', 2000);
            }
        });

        mapSatelitButton.addEventListener('click', () => {
            if (!map.hasLayer(satelliteLayer)) {
                map.removeLayer(osmLayer);
                satelliteLayer.addTo(map);
                localStorage.setItem('mapLayer', 'satellite');
                setActiveBaseMapButton('mapSatelitButton');
                showAppNotification('Peta dasar diganti ke Citra Satelit.', 'info', 2000);
            }
        });


        fetchCurrentLocationButtonEl.addEventListener('click', handleFetchCurrentLocation);
        currentLocationInputEl.addEventListener('change', (event) => {
            geocodeLocation(event.target.value, currentLocationInputEl, currentLocationCoords, true)
                .then(success => {
                    if (success) refreshNearbyLocations();
                });
        });
        targetLocationInputEl.addEventListener('change', (event) => {
            geocodeLocation(event.target.value, targetLocationInputEl, targetLocationCoords, false);
        });

        searchButtonEl.addEventListener('click', async () => {
            console.log("[DEBUG] Tombol Cari diklik.");
            searchButtonIconEl.textContent = '⏳';
            searchButtonTextEl.textContent = 'Mencari...';
            searchButtonEl.disabled = !0;
            let searchCenterLatLon = null;
            let searchDisplayName = "data umum";
            const manualTargetQuery = targetLocationInputEl.value.trim();
            const currentLocQuery = currentLocationInputEl.value.trim();
            if (targetLocationCoords.lat !== null && targetLocationCoords.lon !== null) {
                searchCenterLatLon = [targetLocationCoords.lat, targetLocationCoords.lon];
                searchDisplayName = targetLocationCoords.displayName || manualTargetQuery
            } else if (manualTargetQuery !== "") {
                const geocodeSuccess = await geocodeLocation(manualTargetQuery, targetLocationInputEl,
                    targetLocationCoords, !1);
                if (geocodeSuccess && targetLocationCoords.lat !== null) {
                    searchCenterLatLon = [targetLocationCoords.lat, targetLocationCoords.lon];
                    searchDisplayName = targetLocationCoords.displayName || manualTargetQuery
                } else {
                    showAppNotification(
                        `Lokasi Tujuan "${manualTargetQuery}" tidak dapat ditemukan. Filter jenis tetap diterapkan.`,
                        'warning')
                }
            }
            if (!searchCenterLatLon) {
                if (currentLocationCoords.lat !== null && currentLocationCoords.lon !== null) {
                    searchCenterLatLon = [currentLocationCoords.lat, currentLocationCoords.lon];
                    searchDisplayName = currentLocationCoords.displayName || currentLocQuery
                } else if (currentLocQuery !== "") {
                    const geocodeSuccess = await geocodeLocation(currentLocQuery, currentLocationInputEl,
                        currentLocationCoords, !0);
                    if (geocodeSuccess && currentLocationCoords.lat !== null) {
                        searchCenterLatLon = [currentLocationCoords.lat, currentLocationCoords.lon];
                        searchDisplayName = currentLocationCoords.displayName || currentLocQuery
                    }
                }
            }
            if (searchCenterLatLon && map) {
                map.setView(searchCenterLatLon, map.getZoom() < 10 ? 10 : map.getZoom())
            }
            showAppNotification(searchCenterLatLon ? `Mencari di sekitar "${searchDisplayName}"...` :
                'Menerapkan filter jenis...', 'info');
            const typeFilter = typeInputEl.value;
            const radiusToSearch = parseFloat(radiusInputEl.value);
            let filteredReports = allFetchedReports;
            if (typeFilter) {
                filteredReports = filteredReports.filter(loc => loc.type === typeFilter)
            }
            if (searchCenterLatLon && radiusToSearch > 0 && !isNaN(radiusToSearch)) {
                filteredReports = filteredReports.filter(loc => {
                    if (loc.coords) {
                        const distance = calculateDistance(searchCenterLatLon[0], searchCenterLatLon[1],
                            loc.coords[0], loc.coords[1]);
                        return distance <= radiusToSearch
                    }
                    return !1
                })
            } else if (searchCenterLatLon && (isNaN(radiusToSearch) || radiusToSearch <= 0)) {
                showAppNotification('Radius tidak valid, filter radius diabaikan.', 'warning')
            }
            addMarkers(filteredReports, searchCenterLatLon);
            updateAreaStatistics(filteredReports);
            updateDistanceVisualizations();
            if (filteredReports.length === 0 && (searchCenterLatLon || typeFilter)) {
                showAppNotification('Tidak ada laporan ditemukan untuk kriteria ini.', 'info')
            } else if (filteredReports.length > 0) {
                showAppNotification(`${filteredReports.length} laporan ditemukan.`, 'success')
            }
            searchButtonIconEl.textContent = '🔍';
            searchButtonTextEl.textContent = 'Cari';
            searchButtonEl.disabled = !1
        });

        document.getElementById('resetMapButton').addEventListener('click', async () => {
            console.log("[DEBUG] Tombol Reset Peta diklik.");
            showAppNotification('Mereset peta & filter...', 'info', 2000);
            if (map) {
                map.setView(DEFAULT_MAP_CENTER, DEFAULT_MAP_ZOOM);
                if (map.closePopup) map.closePopup();
            }
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

            if (map) {
                if (currentLocationMapMarker && map.hasLayer(currentLocationMapMarker)) {
                    map.removeLayer(currentLocationMapMarker);
                    currentLocationMapMarker = null;
                }
                if (targetLocationMapMarker && map.hasLayer(targetLocationMapMarker)) {
                    map.removeLayer(targetLocationMapMarker);
                    targetLocationMapMarker = null;
                }
            }

            const cbStraight = document.getElementById('cbShowStraightLine');
            if (cbStraight) cbStraight.checked = false;

            showStraightLine = false;
            updateDistanceVisualizations();

            // Reset base map to OSM and update button active state
            if (map.hasLayer(satelliteLayer)) {
                map.removeLayer(satelliteLayer);
            }
            if (!map.hasLayer(osmLayer)) {
                osmLayer.addTo(map);
            }
            localStorage.setItem('mapLayer', 'osm');
            setActiveBaseMapButton('mapPetaButton');


            await fetchWastePoints();
            addMarkers(allFetchedReports, null);
            updateAreaStatistics(allFetchedReports);
            nearestLocationsListEl.innerHTML =
                `<li class="text-gray-400 text-center py-4">Gunakan GPS atau cari lokasi untuk melihat laporan terdekat.</li>`;

            if (typeof updateCircleFeaturesLayers === 'function') updateCircleFeaturesLayers();
            console.log("[DEBUG] Reset selesai.");
        });

        // Event listener untuk tombol toggle kontrol lapisan (overlay)
        document.addEventListener('DOMContentLoaded', () => {
            initializeMap(); // Pastikan initializeMap dipanggil terlebih dahulu

            const toggleLayersButton = document.getElementById('toggleLayersControl');
            if (toggleLayersButton) {
                toggleLayersButton.addEventListener('click', () => {
                    if (layerControlInstance) {
                        // Leaflet Layers Control secara internal menggunakan style display 'none' saat collapsed
                        // dan menambahkan/menghapus class 'leaflet-control-layers-expanded'
                        if (layerControlInstance._form.style.display === 'none') {
                            layerControlInstance.expand();
                        } else {
                            layerControlInstance.collapse();
                        }
                    }
                });
            }
        });
    </script>
@endsection
