<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client; // Pastikan Guzzle terinstal: composer require guzzlehttp/guzzle

class ReportController extends Controller
{
    /**
     * Display the report form for web.
     */
    public function create()
    {
        return view('report');
    }

    /**
     * Store a new report. This method handles both web form submission
     * and API requests.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'location' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'type' => 'required|in:organik,anorganik,b3,campuran',
            'size' => 'required|in:kecil,sedang,besar',
            'urgency' => 'required|in:rendah,sedang,tinggi,kritis',
            'description' => 'nullable|string|max:1000',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'terms' => 'required|accepted',
        ]);

        $report = new Report();
        $report->name = $validatedData['name'];
        $report->email = $validatedData['email'];
        $report->location = $validatedData['location'];
        $report->latitude = $validatedData['latitude'];
        $report->longitude = $validatedData['longitude'];
        $report->type = $validatedData['type'];
        $report->size = $validatedData['size'];
        $report->urgency = $validatedData['urgency'];
        $report->description = $validatedData['description'];
        $report->user_id = auth()->check() ? auth()->id() : null; // Tambahkan user_id jika ada user login

        // Extract province and city from location using reverse geocoding
        $locationData = $this->getLocationDetailsFromCoordinates($validatedData['latitude'], $validatedData['longitude']);
        $report->province = $locationData['province'] ?? 'UnknownProvince'; // Default menjadi 'UnknownProvince'
        $report->city = $locationData['city'] ?? 'UnknownCity'; // Default menjadi 'UnknownCity'

        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('reports', 'public'); // Simpan di storage/app/public/reports
                $photoPaths[] = 'storage/' . $path; // URL relatif dari root public
            }
        }
        $report->photos = json_encode($photoPaths); // Simpan sebagai JSON string

        $report->save();

        // Check if the request expects a JSON response (typical for API calls)
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'message' => 'Laporan berhasil dikirim!',
                'report' => [
                    'id' => $report->id,
                    'name' => $report->name,
                    'latitude' => (float) $report->latitude,
                    'longitude' => (float) $report->longitude,
                    'location' => $report->location,
                    'type' => $report->type,
                    'size' => $report->size,
                    'urgency' => $report->urgency,
                    'description' => $report->description,
                    'photos' => json_decode($report->photos) ?? [], // Pastikan dekode berhasil
                    'province' => $report->province,
                    'city' => $report->city,
                ]
            ], 201); // 201 Created
        }

        // Otherwise, redirect for web requests
        return redirect()->route('report')->with('success', 'Laporan berhasil dikirim! Terima kasih atas kontribusi Anda.');
    }

    /**
     * Get all reports for API or map display.
     */
    public function getReports(Request $request)
    {
        $reports = Report::all()->map(function ($report) {
            $photos = null;
            if (is_string($report->photos)) {
                $photos = json_decode($report->photos);
            }
            if (!is_array($photos)) { // Pastikan hasil akhirnya array
                $photos = [];
            }

            return [
                'id' => $report->id,
                'name' => $report->name,
                'coords' => [(float) $report->latitude, (float) $report->longitude], // Pastikan float untuk JS
                'location' => $report->location, // Address
                'type' => $report->type,
                'size' => $report->size, // Capacity
                'urgency' => $report->urgency,
                'description' => $report->description,
                'photos' => $photos,
                'province' => $report->province ?? 'UnknownProvince',
                'city' => $report->city ?? 'UnknownCity',
            ];
        });

        // Aggregate reports by province
        $provinceReports = [];
        $cityReports = [];

        foreach ($reports as $report) {
            $province = $report['province'] ?? 'UnknownProvince';
            $city = $report['city'] ?? 'UnknownCity';

            // Aggregate by province
            if (!isset($provinceReports[$province])) {
                $provinceReports[$province] = 0;
            }
            $provinceReports[$province]++;

            // Aggregate by city
            if (!isset($cityReports[$city])) {
                $cityReports[$city] = 0;
            }
            $cityReports[$city]++;
        }

        return response()->json([
            'reports' => $reports,
            'provinceReports' => $provinceReports,
            'cityReports' => $cityReports,
        ]);
    }

    /**
     * Helper function to get province and city name from coordinates using Nominatim API.
     */
    private function getLocationDetailsFromCoordinates($latitude, $longitude)
    {
        $client = new Client();
        try {
            $response = $client->get("https://nominatim.openstreetmap.org/reverse", [
                'query' => [
                    'format' => 'json',
                    'lat' => $latitude,
                    'lon' => $longitude,
                    'zoom' => 10, // Menyesuaikan zoom untuk mendapatkan detail provinsi dan kota
                    'addressdetails' => 1,
                ],
                'headers' => [
                    'User-Agent' => 'EcoTrackApp/1.0 (your-email@example.com)', // GANTI DENGAN EMAIL ASLI ANDA
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            $detectedProvince = null;
            $detectedCity = null;

            // Extract province
            if (isset($data['address']['state'])) {
                $detectedProvince = $data['address']['state'];
            } elseif (isset($data['address']['province'])) {
                $detectedProvince = $data['address']['province'];
            } elseif (isset($data['address']['region'])) {
                $detectedProvince = $data['address']['region'];
            }

            // Extract city (NAME_2 in GeoJSON corresponds to city/district)
            if (isset($data['address']['city'])) {
                $detectedCity = $data['address']['city'];
            } elseif (isset($data['address']['county'])) {
                $detectedCity = $data['address']['county'];
            } elseif (isset($data['address']['district'])) {
                $detectedCity = $data['address']['district'];
            }

            // Mapping untuk konsistensi nama provinsi dengan GeoJSON Anda (tanpa spasi)
            $provinceMapping = [
                'aceh' => 'Aceh',
                'sumaterautara' => 'SumateraUtara',
                'sumatera utara' => 'SumateraUtara',
                'northsumatra' => 'SumateraUtara',
                'north sumatra' => 'SumateraUtara',
                'sumaterabarat' => 'SumateraBarat',
                'sumatera barat' => 'SumateraBarat',
                'westsumatra' => 'SumateraBarat',
                'west sumatra' => 'SumateraBarat',
                'riau' => 'Riau',
                'kepulauanriau' => 'KepulauanRiau',
                'kepulauan riau' => 'KepulauanRiau',
                'jambi' => 'Jambi',
                'sumateraselatan' => 'SumateraSelatan',
                'sumatera selatan' => 'SumateraSelatan',
                'southsumatra' => 'SumateraSelatan',
                'south sumatra' => 'SumateraSelatan',
                'bengkulu' => 'Bengkulu',
                'lampung' => 'Lampung',
                'kepulauanbangbabelitung' => 'KepulauanBangkaBelitung',
                'kepulauan bangka belitung' => 'KepulauanBangkaBelitung',
                'bangka belitung islands' => 'KepulauanBangkaBelitung',
                'dkijakarta' => 'Jakarta',
                'dki jakarta' => 'Jakarta',
                'jakarta' => 'Jakarta',
                'jawabarat' => 'JawaBarat',
                'jawa barat' => 'JawaBarat',
                'westjava' => 'JawaBarat',
                'west java' => 'JawaBarat',
                'jawatengah' => 'JawaTengah',
                'jawa tengah' => 'JawaTengah',
                'centraljava' => 'JawaTengah',
                'central java' => 'JawaTengah',
                'daerahistimewayogyakarta' => 'DaerahIstimewaYogyakarta',
                'daerah istimewa yogyakarta' => 'DaerahIstimewaYogyakarta',
                'yogyakarta' => 'DaerahIstimewaYogyakarta',
                'jawatimur' => 'JawaTimur',
                'jawa timur' => 'JawaTimur',
                'eastjava' => 'JawaTimur',
                'east java' => 'JawaTimur',
                'banten' => 'Banten',
                'bali' => 'Bali',
                'nusatenggarabarat' => 'NusaTenggaraBarat',
                'nusa tenggara barat' => 'NusaTenggaraBarat',
                'westnusatenggara' => 'NusaTenggaraBarat',
                'west nusa tenggara' => 'NusaTenggaraBarat',
                'nusatenggaratimur' => 'NusaTenggaraTimur',
                'nusa tenggara timur' => 'NusaTenggaraTimur',
                'eastnusatenggara' => 'NusaTenggaraTimur',
                'east nusa tenggara' => 'NusaTenggaraTimur',
                'kalimantanbarat' => 'KalimantanBarat',
                'kalimantan barat' => 'KalimantanBarat',
                'westkalimantan' => 'KalimantanBarat',
                'west kalimantan' => 'KalimantanBarat',
                'kalimantantengah' => 'KalimantanTengah',
                'kalimantan tengah' => 'KalimantanTengah',
                'centralkalimantan' => 'KalimantanTengah',
                'central kalimantan' => 'KalimantanTengah',
                'kalimantanselatan' => 'KalimantanSelatan',
                'kalimantan selatan' => 'KalimantanSelatan',
                'southkalimantan' => 'KalimantanSelatan',
                'south kalimantan' => 'KalimantanSelatan',
                'kalimantantimur' => 'KalimantanTimur',
                'kalimantan timur' => 'KalimantanTimur',
                'eastkalimantan' => 'KalimantanTimur',
                'east kalimantan' => 'KalimantanTimur',
                'kalimantanutaara' => 'KalimantanUtara',
                'kalimantan utara' => 'KalimantanUtara',
                'northkalimantan' => 'KalimantanUtara',
                'north kalimantan' => 'KalimantanUtara',
                'sulawesiutara' => 'SulawesiUtara',
                'sulawesi utara' => 'SulawesiUtara',
                'northsulawesi' => 'SulawesiUtara',
                'north sulawesi' => 'SulawesiUtara',
                'gorontalo' => 'Gorontalo',
                'sulawesitengah' => 'SulawesiTengah',
                'sulawesi tengah' => 'SulawesiTengah',
                'centralsulawesi' => 'SulawesiTengah',
                'central sulawesi' => 'SulawesiTengah',
                'sulawesitenggara' => 'SulawesiTenggara',
                'sulawesi tenggara' => 'SulawesiTenggara',
                'southeastsulawesi' => 'SulawesiTenggara',
                'southeast sulawesi' => 'SulawesiTenggara',
                'sulawesiselatan' => 'SulawesiSelatan',
                'sulawesi selatan' => 'SulawesiSelatan',
                'southsulawesi' => 'SulawesiSelatan',
                'south sulawesi' => 'SulawesiSelatan',
                'sulawesibarat' => 'SulawesiBarat',
                'sulawesi barat' => 'SulawesiBarat',
                'westsulawesi' => 'SulawesiBarat',
                'west sulawesi' => 'SulawesiBarat',
                'maluku' => 'Maluku',
                'malukuutara' => 'MalukuUtara',
                'maluku utara' => 'MalukuUtara',
                'northmaluku' => 'MalukuUtara',
                'north maluku' => 'MalukuUtara',
                'papua' => 'Papua',
                'westpapua' => 'PapuaBarat',
                'west papua' => 'PapuaBarat',
                'papuabarat' => 'PapuaBarat',
                'papua barat' => 'PapuaBarat',
                'papuapegunungan' => 'PapuaPegunungan',
                'papua pegunungan' => 'PapuaPegunungan',
                'papuaselatan' => 'PapuaSelatan',
                'papua selatan' => 'PapuaSelatan',
                'papuatengah' => 'PapuaTengah',
                'papua tengah' => 'PapuaTengah',
                'papuabaratdaya' => 'PapuaBaratDaya',
                'papua barat daya' => 'PapuaBaratDaya',
            ];

            $normalizedDetectedProvince = '';
            if ($detectedProvince) {
                $normalizedDetectedProvince = strtolower(str_replace(' ', '', $detectedProvince));
            }

            $normalizedProvince = 'UnknownProvince';
            if ($normalizedDetectedProvince && isset($provinceMapping[$normalizedDetectedProvince])) {
                $normalizedProvince = $provinceMapping[$normalizedDetectedProvince];
            } else {
                $normalizedProvince = str_replace(' ', '', ucwords(strtolower($detectedProvince ?? 'UnknownProvince')));
            }

            // Normalize city name (remove spaces for consistency with GeoJSON)
            $normalizedCity = 'UnknownCity';
            if ($detectedCity) {
                $normalizedCity = str_replace(' ', '', ucwords(strtolower($detectedCity)));
            }

            return [
                'province' => $normalizedProvince,
                'city' => $normalizedCity,
            ];
        } catch (\Exception $e) {
            Log::error('Error fetching location details from Nominatim: ' . $e->getMessage() . " for coords: $latitude, $longitude");
            return [
                'province' => 'UnknownProvince',
                'city' => 'UnknownCity',
            ];
        }
    }
}
