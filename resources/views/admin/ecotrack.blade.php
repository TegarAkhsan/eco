@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-12 font-['Poppins']">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-8 tracking-tight text-center">
            Peta Interaktif Sampah
        </h1>

        <div class="bg-[#d9d9d9]/10 rounded-xl overflow-hidden h-[700px] shadow-[0px_6px_20px_rgba(0,0,0,0.3)] relative">
            <div id="map" class="w-full h-full"></div>

            {{-- Map Type Selector (Peta & Satelit buttons) --}}
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
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

    <style>
        .leaflet-container {
            background: #f5f6f5 !important;
            border-radius: 12px;
            overflow: hidden;
        }

        .leaflet-control-container .leaflet-control {
            background: #fff !important;
            border-radius: 8px !important;
            padding: 4px !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .1) !important;
            border: none !important;
            transition: all 0.3s ease-in-out;
        }

        .leaflet-control-container .leaflet-control:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, .15) !important;
            transform: translateY(-2px);
        }

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

        .leaflet-control-layers {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            padding: 8px !important;
            min-width: 180px;
        }

        .leaflet-control-layers-base,
        .leaflet-control-layers-overlays {
            margin: 0;
            padding: 0;
        }

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

        .leaflet-control-layers-selector {
            margin-right: 8px;
            accent-color: #22d3ee;
            width: 16px;
            height: 16px;
        }

        .custom-distance-control-separator {
            border-top: 1px solid #e0e0e0;
            margin: 8px 0;
            padding-top: 0;
        }

        .custom-layers-toggle-button {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 800;
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

        .map-type-selector-container {
            position: absolute;
            bottom: 15px;
            left: 15px;
            z-index: 800;
            display: flex;
            gap: 8px;
            background: #fff;
            padding: 8px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .1);
            transition: all 0.3s ease-in-out;
        }

        .map-type-button {
            background: #f0f0f0;
            color: #4a5568;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            min-width: 60px;
            font-size: 12px;
            font-weight: 500;
        }

        .map-type-button:hover {
            background: #e5e7eb;
            border-color: #9ca3af;
        }

        .map-type-button.active {
            background: #38bdf8;
            color: #fff;
            border-color: #38bdf8;
            box-shadow: 0 2px 8px rgba(56, 189, 248, 0.4);
        }

        .map-type-button.active:hover {
            background: #0ea5e9;
            border-color: #0ea5e9;
        }

        .map-type-button svg {
            width: 28px;
            height: 28px;
            margin-bottom: 4px;
            fill: currentColor;
        }

        .map-type-label {
            text-align: center;
        }
    </style>

    <script>
        const API_REPORTS_URL = '/api/reports';
        const DEFAULT_MAP_CENTER = [-2.5489, 118.0149];
        const DEFAULT_MAP_ZOOM = 5;
        const MIN_ZOOM = 3;
        const MAX_ZOOM = 18;
        const MARKER_ICON_URL = 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png';
        const MARKER_SHADOW_URL = 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png';
        const PROVINCE_GEOJSON_PATH = '{{ asset('storage/gadm41_IDN_1.json') }}';
        const CITY_GEOJSON_PATH = '{{ asset('storage/gadm41_IDN_2.json') }}';

        let map;
        let markers;
        let osmLayer, satelliteLayer, provinceChoroplethLayer, cityChoroplethLayer, provinceCircleLayerGroup,
            cityCircleLayerGroup;
        let infoControl, cityInfoControl, legendControl;
        let layerControlInstance;
        let allFetchedReports = [];

        const mapPetaButton = document.getElementById('mapPetaButton');
        const mapSatelitButton = document.getElementById('mapSatelitButton');

        function getMarkerIcon() {
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

        async function fetchWastePoints() {
            try {
                const response = await fetch(API_REPORTS_URL);
                if (!response.ok) {
                    throw new Error(`Gagal mengambil data laporan dari API: ${response.status} ${response.statusText}`);
                }
                const data = await response.json();
                const rawReports = data && Array.isArray(data.reports) ? data.reports : (Array.isArray(data) ? data :
                []);
                if (!Array.isArray(rawReports)) {
                    console.error('Format data.reports dari API tidak sesuai (bukan array):', rawReports);
                    return [];
                }
                const validReports = rawReports.map(report => {
                    let lat = null,
                        lon = null;
                    if (report.coords && Array.isArray(report.coords) && report.coords.length === 2) {
                        lat = parseFloat(report.coords[0]);
                        lon = parseFloat(report.coords[1]);
                    } else if (typeof report.latitude !== 'undefined' && typeof report.longitude !==
                        'undefined') {
                        lat = parseFloat(report.latitude);
                        lon = parseFloat(report.longitude);
                    }
                    if (isNaN(lat) || isNaN(lon)) {
                        console.warn(
                            `Laporan ID ${report.id || '(tanpa ID)'} ("${report.name || 'Tanpa Nama'}") dilewati karena koordinat tidak valid.`
                            );
                        return null;
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
                            .photos] : []),
                        province: report.province || 'Provinsi Tidak Diketahui',
                        city: report.city || 'Kota/Kab Tidak Diketahui'
                    };
                }).filter(report => report !== null);
                allFetchedReports = validReports;
                return validReports;
            } catch (error) {
                console.error('Error dalam fetchWastePoints:', error);
                return [];
            }
        }

        async function addMarkers(reportsToDisplay) {
            if (!markers) {
                console.error("Marker cluster group (markers) belum diinisialisasi.");
                return;
            }
            markers.clearLayers();
            if (reportsToDisplay.length === 0) {
                return;
            }
            reportsToDisplay.forEach((loc) => {
                if (!loc.coords || loc.coords.length !== 2 || isNaN(loc.coords[0]) || isNaN(loc.coords[1])) {
                    console.warn(
                        `addMarkers: Melewati laporan "${loc.name || 'Tanpa Nama'}" karena koordinat tidak valid.`
                        );
                    return;
                }
                const [lat, lon] = loc.coords;
                const popupContent = `
                    <div class="p-3 max-w-xs">
                        <h4 class="font-bold text-gray-900 text-base mb-2">${loc.name}</h4>
                        ${loc.email && loc.email !== 'Tidak diketahui' ? `<p class="text-gray-700 text-sm mb-1"><strong>Email:</strong> ${loc.email}</p>` : ''}
                        <p class="text-gray-700 text-sm mb-1"><strong>Alamat:</strong> ${loc.address}</p>
                        <p class="text-gray-700 text-sm mb-1"><strong>Jenis:</strong> ${loc.type ? loc.type.charAt(0).toUpperCase() + loc.type.slice(1) : 'Tidak Diketahui'}</p>
                        <p class="text-gray-700 text-sm mb-1"><strong>Ukuran:</strong> ${loc.capacity}</p>
                        <p class="text-gray-700 text-sm mb-1"><strong>Urgensi:</strong> ${loc.urgency}</p>
                        ${loc.province && loc.province !== 'Provinsi Tidak Diketahui' ? `<p class="text-gray-700 text-sm mb-1"><strong>Provinsi:</strong> ${loc.province}</p>` : ''}
                        ${loc.city && loc.city !== 'Kota/Kab Tidak Diketahui' ? `<p class="text-gray-700 text-sm mb-1"><strong>Kota/Kab:</strong> ${loc.city}</p>` : ''}
                        <p class="text-gray-700 text-sm mb-2"><strong>Deskripsi:</strong> ${loc.description || 'Tidak ada'}</p>
                        ${loc.photos && loc.photos.length > 0 ? `
                                <p class="text-gray-700 text-sm mb-1"><strong>Foto:</strong></p>
                                <div style="max-height: 150px; overflow-y: auto;">
                                    ${loc.photos.map(photo => `<img src="/${photo.startsWith('storage/') ? photo : 'storage/' + photo}" alt="Foto Sampah" class="w-full mt-1 rounded-md shadow-sm mb-1">`).join('')}
                                </div>
                            ` : '<p class="text-gray-700 text-sm mb-1"><strong>Foto:</strong> Tidak ada</p>'}
                    </div>`;
                const marker = L.marker([lat, lon], {
                    icon: getMarkerIcon()
                }).bindPopup(popupContent, {
                    className: 'popup-content',
                    autoPanPadding: [50, 50]
                });
                markers.addLayer(marker);
            });
            if (markers.getLayers().length > 0 && map) {
                map.fitBounds(markers.getBounds(), {
                    padding: [50, 50],
                    maxZoom: 14
                });
            }
        }

        async function initializeMap() {
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
                attribution: '© OpenStreetMap',
                maxZoom: MAX_ZOOM
            });
            satelliteLayer = L.tileLayer(
                'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                    attribution: 'Tiles © Esri',
                    maxZoom: MAX_ZOOM
                });

            let initialLayerName = localStorage.getItem('mapLayer') || 'osm';
            let initialLayer;
            if (initialLayerName === 'satellite') {
                initialLayer = satelliteLayer;
            } else {
                initialLayer = osmLayer;
                initialLayerName = 'osm';
            }
            initialLayer.addTo(map);

            if (initialLayer === osmLayer) {
                mapPetaButton.classList.add('active');
            } else if (initialLayer === satelliteLayer) {
                mapSatelitButton.classList.add('active');
            }

            markers = L.markerClusterGroup({
                maxClusterRadius: 60,
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
                zoomToBoundsOnClick: true,
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
                    });
                }
            });
            map.addLayer(markers);

            const reports = await fetchWastePoints();
            await addMarkers(reports);

            const provinceReports = {};
            const cityReports = {};
            allFetchedReports.forEach(report => {
                if (report.province && report.province !== 'Provinsi Tidak Diketahui') {
                    const normalizedReportProvince = report.province.replace(/\s/g, '');
                    provinceReports[normalizedReportProvince] = (provinceReports[normalizedReportProvince] ||
                        0) + 1;
                }
                if (report.city && report.city !== 'Kota/Kab Tidak Diketahui') {
                    const normalizedReportCity = report.city.replace(/\s/g, '');
                    cityReports[normalizedReportCity] = (cityReports[normalizedReportCity] || 0) + 1;
                }
            });

            const provinceGeoJsonPromise = fetch(PROVINCE_GEOJSON_PATH).then(res => res.ok ? res.json() : Promise
                .reject('Gagal memuat GeoJSON Provinsi')).catch(err => {
                console.error(err);
                return null;
            });
            const cityGeoJsonPromise = fetch(CITY_GEOJSON_PATH).then(res => res.ok ? res.json() : Promise.reject(
                'Gagal memuat GeoJSON Kota/Kab')).catch(err => {
                console.error(err);
                return null;
            });

            Promise.all([provinceGeoJsonPromise, cityGeoJsonPromise]).then(([provinceGeoJson, cityGeoJson]) => {
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
                            '')] = bounds.getCenter();
                    });
                    if (provinceChoroplethLayer) provinceChoroplethLayer.addData(provinceGeoJson);
                }
                if (cityGeoJson && cityGeoJson.features) {
                    cityGeoJson.features.forEach(feature => {
                        const bounds = L.geoJSON(feature).getBounds();
                        if (bounds.isValid()) cityCentroids[feature.properties.NAME_2.replace(/\s/g,
                            '')] = bounds.getCenter();
                    });
                    if (cityChoroplethLayer) cityChoroplethLayer.addData(cityGeoJson);
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
                    };
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
                                    interactive: false
                                });
                                circle.bindTooltip(
                                    `<b>${feature.properties.NAME_1}</b><br>${reportCount} laporan`, {
                                        sticky: true
                                    });
                                provinceCircleLayerGroup.addLayer(circle).addLayer(numberMarker);
                            }
                        });
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
                                    interactive: false
                                });
                                circle.bindTooltip(
                                    `<b>${feature.properties.NAME_2}</b> (${feature.properties.NAME_1})<br>${reportCount} laporan`, {
                                        sticky: true
                                    });
                                cityCircleLayerGroup.addLayer(circle).addLayer(numberMarker);
                            }
                        });
                    }
                }

                map.on('zoomend', updateCircleFeaturesLayers);

                function getChoroplethColor(d) {
                    return d > 100 ? '#800000' : d > 50 ? '#b30000' : d > 20 ? '#e34a33' : d > 10 ? '#fc8d59' :
                        d > 0 ? '#fdcc8a' : '#f7f7f7';
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
                    };
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
                    };
                }

                infoControl = L.control({
                    position: 'topright'
                });
                infoControl.onAdd = function(map) {
                    this._div = L.DomUtil.create('div', 'info province-info');
                    this.update();
                    return this._div;
                };
                infoControl.update = function(props) {
                    const count = props ? (provinceReports[props.NAME_1.replace(/\s/g, '')] || 0) : 0;
                    this._div.innerHTML = '<h4>Laporan per Provinsi</h4>' + (props ?
                        `<b>${props.NAME_1}</b><br />${count} laporan` : 'Arahkan kursor ke provinsi');
                };

                cityInfoControl = L.control({
                    position: 'topright'
                });
                cityInfoControl.onAdd = function(map) {
                    this._div = L.DomUtil.create('div', 'info city-info');
                    this.update();
                    return this._div;
                };
                cityInfoControl.update = function(props) {
                    let content = '<h4>Laporan per Kota/Kab.</h4>';
                    if (props && props.NAME_2) {
                        const count = cityReports[props.NAME_2.replace(/\s/g, '')] || 0;
                        content += `<b>${props.NAME_2}</b> (${props.NAME_1})<br />${count} laporan`;
                    } else {
                        content += 'Arahkan kursor ke kota/kabupaten';
                    }
                    this._div.innerHTML = content;
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
                    else cityInfoControl.update(layer.feature.properties);
                }

                function resetHighlightProvince(e) {
                    if (provinceChoroplethLayer) provinceChoroplethLayer.resetStyle(e.target);
                    infoControl.update();
                }

                function resetHighlightCity(e) {
                    if (cityChoroplethLayer) cityChoroplethLayer.resetStyle(e.target);
                    cityInfoControl.update();
                }

                function zoomToFeature(e) {
                    map.fitBounds(e.target.getBounds());
                }

                if (provinceChoroplethLayer && provinceGeoJson && provinceGeoJson.features) {
                    provinceChoroplethLayer.options.onEachFeature = (feature, layer) => {
                        const reportCount = provinceReports[feature.properties.NAME_1.replace(/\s/g, '')] ||
                            0;
                        layer.bindTooltip(`<b>${feature.properties.NAME_1}</b><br>${reportCount} laporan`, {
                            sticky: true
                        });
                        layer.on({
                            mouseover: e => highlightFeature(e, true),
                            mouseout: resetHighlightProvince,
                            click: zoomToFeature
                        });
                    };
                    if (provinceChoroplethLayer.getLayers().length > 0) provinceChoroplethLayer.eachLayer(
                        layer => {
                            if (layer.feature && layer.feature.properties) {
                                provinceChoroplethLayer.options.onEachFeature(layer.feature, layer);
                            }
                        });
                }

                if (cityChoroplethLayer && cityGeoJson && cityGeoJson.features) {
                    cityChoroplethLayer.options.onEachFeature = (feature, layer) => {
                        const reportCount = cityReports[feature.properties.NAME_2.replace(/\s/g, '')] || 0;
                        layer.bindTooltip(
                            `<b>${feature.properties.NAME_2}</b> (${feature.properties.NAME_1})<br>${reportCount} laporan`, {
                                sticky: true
                            });
                        layer.on({
                            mouseover: e => highlightFeature(e, false),
                            mouseout: resetHighlightCity,
                            click: zoomToFeature
                        });
                    };
                    if (cityChoroplethLayer.getLayers().length > 0) cityChoroplethLayer.eachLayer(layer => {
                        if (layer.feature && layer.feature.properties) {
                            cityChoroplethLayer.options.onEachFeature(layer.feature, layer);
                        }
                    });
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
                    return div;
                };

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

                map.on('overlayadd', function(e) {
                    if (e.layer === provinceChoroplethLayer && infoControl && !infoControl._map) {
                        infoControl.addTo(map);
                    } else if (e.layer === cityChoroplethLayer && cityInfoControl && !cityInfoControl
                        ._map) {
                        cityInfoControl.addTo(map);
                    } else if (e.layer === provinceCircleLayerGroup || e.layer ===
                        cityCircleLayerGroup) {
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

                if (map.hasLayer(provinceChoroplethLayer) && infoControl && !infoControl._map) infoControl
                    .addTo(map);
                if (map.hasLayer(cityChoroplethLayer) && cityInfoControl && !cityInfoControl._map)
                    cityInfoControl.addTo(map);
                if ((map.hasLayer(provinceChoroplethLayer) || map.hasLayer(cityChoroplethLayer)) &&
                    legendControl && !legendControl._map) legendControl.addTo(map);
                if (map.hasLayer(provinceCircleLayerGroup) || map.hasLayer(cityCircleLayerGroup))
                    updateCircleFeaturesLayers();
            });
        }

        function setActiveBaseMapButton(buttonId) {
            mapPetaButton.classList.remove('active');
            mapSatelitButton.classList.remove('active');
            document.getElementById(buttonId).classList.add('active');
        }

        mapPetaButton.addEventListener('click', () => {
            if (!map.hasLayer(osmLayer)) {
                map.removeLayer(satelliteLayer);
                osmLayer.addTo(map);
                localStorage.setItem('mapLayer', 'osm');
                setActiveBaseMapButton('mapPetaButton');
            }
        });

        mapSatelitButton.addEventListener('click', () => {
            if (!map.hasLayer(satelliteLayer)) {
                map.removeLayer(osmLayer);
                satelliteLayer.addTo(map);
                localStorage.setItem('mapLayer', 'satellite');
                setActiveBaseMapButton('mapSatelitButton');
            }
        });

        document.getElementById('resetMapButton').addEventListener('click', async () => {
            if (map) {
                map.setView(DEFAULT_MAP_CENTER, DEFAULT_MAP_ZOOM);
                if (map.closePopup) map.closePopup();
            }
            if (map.hasLayer(satelliteLayer)) {
                map.removeLayer(satelliteLayer);
            }
            if (!map.hasLayer(osmLayer)) {
                osmLayer.addTo(map);
            }
            localStorage.setItem('mapLayer', 'osm');
            setActiveBaseMapButton('mapPetaButton');
            await fetchWastePoints();
            await addMarkers(allFetchedReports);
            if (typeof updateCircleFeaturesLayers === 'function') updateCircleFeaturesLayers();
        });

        document.addEventListener('DOMContentLoaded', () => {
            initializeMap();
            const toggleLayersButton = document.getElementById('toggleLayersControl');
            if (toggleLayersButton) {
                toggleLayersButton.addEventListener('click', () => {
                    if (layerControlInstance) {
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
