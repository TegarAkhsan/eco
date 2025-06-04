<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::orderBy('created_at', 'desc')->paginate(10);
        $activities = Activity::with('user')
            ->whereHas('user', function ($query) {
                $query->whereIn('role', ['admin', 'super_admin']);
            })
            ->where('status', 'login')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $totalReports = Report::count();
        $trashPoints = 85;
        $activeWasteBanks = 32;
        $registeredTPAs = 14;

        $activeUsers = User::whereIn('role', ['admin', 'super_admin'])
            ->whereNotNull('last_login_at')
            ->where('last_login_at', '>=', now()->subMinutes(15))
            ->get();

        return view('admin.index', compact('reports', 'activities', 'totalReports', 'trashPoints', 'activeWasteBanks', 'registeredTPAs', 'activeUsers'));
    }

    public function create()
    {
        return view('report');
    }

    public function store(Request $request)
    {
        try {
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
                'terms' => 'required_if:expectsJson,0|accepted',
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
            $report->user_id = auth()->check() ? auth()->id() : null;

            $locationData = $this->getLocationDetailsFromCoordinates($validatedData['latitude'], $validatedData['longitude']);
            $report->province = $locationData['province'] ?? 'Unknown Province';
            $report->city = $locationData['city'] ?? 'Unknown City';

            $photoPaths = [];
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('reports', 'public');
                    $photoPaths[] = $path;
                }
            }
            $report->photos = json_encode($photoPaths);

            $report->save();

            $apiPhotoPaths = [];
            if ($report->photos) {
                $decodedPhotos = json_decode($report->photos, true);
                if (is_array($decodedPhotos)) {
                    foreach ($decodedPhotos as $p) {
                        $apiPhotoPaths[] = str_starts_with($p, 'storage/') ? $p : 'storage/' . $p;
                    }
                }
            }

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
                        'photos' => $apiPhotoPaths,
                        'province' => $report->province,
                        'city' => $report->city,
                        'created_at' => $report->created_at->toIso8601String(),
                    ]
                ], 201);
            }

            return redirect()->route('report')->with('success', 'Laporan berhasil dikirim! Terima kasih atas kontribusi Anda.');
        } catch (\Exception $e) {
            Log::error('Error storing report: ' . $e->getMessage());
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'Gagal menyimpan laporan. Silakan coba lagi.',
                    'error' => $e->getMessage(),
                ], 500);
            }
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan laporan. Silakan coba lagi.']);
        }
    }

    public function getReports()
    {
        try {
            $allReports = Report::orderBy('created_at', 'desc')->get();
            Log::info('Total reports retrieved for chart data:', ['count' => $allReports->count()]);

            $reports = Report::orderBy('created_at', 'desc')->paginate(10);
            Log::info('Reports retrieved for table:', ['count' => $reports->total()]);

            $formattedReports = $reports->map(function ($report) {
                $photoPathsForApi = [];
                if ($report->photos) {
                    $decodedPhotos = json_decode($report->photos, true);
                    if (is_array($decodedPhotos)) {
                        foreach ($decodedPhotos as $p) {
                            $photoPathsForApi[] = str_starts_with($p, 'storage/') ? $p : 'storage/' . $p;
                        }
                    }
                }

                return [
                    'id' => $report->id,
                    'name' => $report->name,
                    'email' => $report->email,
                    'location' => $report->location,
                    'latitude' => (float) $report->latitude,
                    'longitude' => (float) $report->longitude,
                    'type' => $report->type,
                    'size' => $report->size,
                    'urgency' => $report->urgency,
                    'description' => $report->description,
                    'photos' => $photoPathsForApi,
                    'province' => $report->province ?? 'Unknown Province',
                    'city' => $report->city ?? 'Unknown City',
                    'created_at' => $report->created_at->timezone('Asia/Jakarta')->toIso8601String(),
                ];
            });

            $dayCounts = ['Sen' => 0, 'Sel' => 0, 'Rab' => 0, 'Kam' => 0, 'Jum' => 0, 'Sab' => 0, 'Min' => 0];
            $now = now()->timezone('Asia/Jakarta');
            $startOfWeek = $now->copy()->startOfWeek();
            $endOfWeek = $now->copy()->endOfWeek();

            Log::info('Date range for week:', [
                'start' => $startOfWeek->toDateTimeString(),
                'end' => $endOfWeek->toDateTimeString(),
                'now' => $now->toDateTimeString(),
            ]);

            foreach ($allReports as $report) {
                $reportDate = $report->created_at->timezone('Asia/Jakarta')->startOfDay();
                $dayOfWeek = $reportDate->dayOfWeek;
                $dayName = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'][$dayOfWeek];

                Log::info('Processing report:', [
                    'id' => $report->id,
                    'created_at' => $report->created_at->toDateTimeString(),
                    'reportDate' => $reportDate->toDateTimeString(),
                    'dayOfWeek' => $dayOfWeek,
                    'dayName' => $dayName,
                    'isWithinRange' => ($reportDate >= $startOfWeek && $reportDate <= $endOfWeek),
                ]);

                if ($reportDate >= $startOfWeek && $reportDate <= $endOfWeek) {
                    if (array_key_exists($dayName, $dayCounts)) {
                        $dayCounts[$dayName]++;
                        Log::info('Incrementing day:', ['day' => $dayName, 'new_count' => $dayCounts[$dayName]]);
                    }
                }
            }

            Log::info('Chart data calculated:', $dayCounts);

            return response()->json([
                'reports' => $formattedReports,
                'pagination' => [
                    'current_page' => $reports->currentPage(),
                    'last_page' => $reports->lastPage(),
                    'per_page' => $reports->perPage(),
                    'total' => $reports->total(),
                ],
                'chart_data' => $dayCounts,
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching reports: ' . $e->getMessage());
            return response()->json([
                'message' => 'Gagal memuat laporan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    private function getLocationDetailsFromCoordinates($latitude, $longitude)
    {
        $cacheKey = "location_{$latitude}_{$longitude}";
        $cachedData = Cache::get($cacheKey);

        if ($cachedData) {
            return $cachedData;
        }

        $client = new Client();
        try {
            $response = $client->get("https://nominatim.openstreetmap.org/reverse", [
                'query' => [
                    'format' => 'json',
                    'lat' => $latitude,
                    'lon' => $longitude,
                    'zoom' => 10,
                    'addressdetails' => 1,
                ],
                'headers' => [
                    'User-Agent' => 'EcoTrackApp/1.0 (contact@yourapp.com)',
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            $detectedProvince = null;
            $detectedCity = null;

            if (isset($data['address']['state']))
                $detectedProvince = $data['address']['state'];
            elseif (isset($data['address']['province']))
                $detectedProvince = $data['address']['province'];
            elseif (isset($data['address']['region']))
                $detectedProvince = $data['address']['region'];

            if (isset($data['address']['city']))
                $detectedCity = $data['address']['city'];
            elseif (isset($data['address']['county']))
                $detectedCity = $data['address']['county'];
            elseif (isset($data['address']['town']))
                $detectedCity = $data['address']['town'];
            elseif (isset($data['address']['village']))
                $detectedCity = $data['address']['village'];
            elseif (isset($data['address']['city_district']))
                $detectedCity = $data['address']['city_district'];

            $provinceMapping = [
                'aceh' => 'Aceh',
                'sumatera utara' => 'Sumatera Utara',
                'sumatera barat' => 'Sumatera Barat',
                'riau' => 'Riau',
                'kepulauan riau' => 'Kepulauan Riau',
                'jambi' => 'Jambi',
                'sumatera selatan' => 'Sumatera Selatan',
                'bengkulu' => 'Bengkulu',
                'lampung' => 'Lampung',
                'kepulauan bangka belitung' => 'Kepulauan Bangka Belitung',
                'dki jakarta' => 'DKI Jakarta',
                'jakarta' => 'DKI Jakarta',
                'jawa barat' => 'Jawa Barat',
                'jawa tengah' => 'Jawa Tengah',
                'yogyakarta' => 'DI Yogyakarta',
                'daerah istimewa yogyakarta' => 'DI Yogyakarta',
                'jawa timur' => 'Jawa Timur',
                'banten' => 'Banten',
                'bali' => 'Bali',
                'nusa tenggara barat' => 'Nusa Tenggara Barat',
                'nusa tenggara timur' => 'Nusa Tenggara Timur',
                'kalimantan barat' => 'Kalimantan Barat',
                'kalimantan tengah' => 'Kalimantan Tengah',
                'kalimantan selatan' => 'Kalimantan Selatan',
                'kalimantan timur' => 'Kalimantan Timur',
                'kalimantan utara' => 'Kalimantan Utara',
                'sulawesi utara' => 'Sulawesi Utara',
                'gorontalo' => 'Gorontalo',
                'sulawesi tengah' => 'Sulawesi Tengah',
                'sulawesi tenggara' => 'Sulawesi Tenggara',
                'sulawesi selatan' => 'Sulawesi Selatan',
                'sulawesi barat' => 'Sulawesi Barat',
                'maluku' => 'Maluku',
                'maluku utara' => 'Maluku Utara',
                'papua' => 'Papua',
                'papua barat' => 'Papua Barat',
                'papua pegunungan' => 'Papua Pegunungan',
                'papua selatan' => 'Papua Selatan',
                'papua tengah' => 'Papua Tengah',
                'papua barat daya' => 'Papua Barat Daya',
            ];

            $normalizedProvince = 'Unknown Province';
            if ($detectedProvince) {
                $lowerDetectedProvince = strtolower(str_replace([' ', '-'], '', $detectedProvince));
                $bestMatch = null;
                foreach ($provinceMapping as $key => $value) {
                    $lowerKey = strtolower(str_replace([' ', '-'], '', $key));
                    if ($lowerDetectedProvince === $lowerKey) {
                        $bestMatch = $value;
                        break;
                    }
                }
                $normalizedProvince = $bestMatch ?? ucwords(strtolower($detectedProvince));
            }

            $normalizedCity = 'Unknown City';
            if ($detectedCity) {
                $normalizedCity = ucwords(strtolower($detectedCity));
            }

            $locationData = [
                'province' => $normalizedProvince,
                'city' => $normalizedCity,
            ];

            Cache::put($cacheKey, $locationData, now()->addHours(24));

            return $locationData;
        } catch (\Exception $e) {
            Log::error('Error fetching location details from Nominatim: ' . $e->getMessage() . " for coords: $latitude, $longitude");
            return [
                'province' => 'Unknown Province',
                'city' => 'Unknown City',
            ];
        }
    }
}
