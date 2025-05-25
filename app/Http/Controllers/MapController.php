<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Report;
use Illuminate\Support\Facades\Http;

class MapController extends Controller
{
    public function map()
    {
        return view('map');
    }

    public function report()
    {
        return view('report');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'location' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'type' => 'required|in:organik,anorganik,b3,campuran',
            'size' => 'required|in:kecil,sedang,besar',
            'urgency' => 'required|in:rendah,sedang,tinggi,kritis',
            'description' => 'nullable|string',
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'terms' => 'accepted',
        ]);

        $latitude = $request->latitude;
        $longitude = $request->longitude;

        // If coordinates are not provided, geocode the address
        if (!$latitude || !$longitude) {
            $address = $request->location;
            $response = Http::withHeaders(['User-Agent' => 'EcoTrack/1.0'])->get('https://nominatim.openstreetmap.org/search', [
                'q' => $address,
                'format' => 'json',
                'limit' => 1,
            ]);

            if ($response->successful() && !empty($response->json())) {
                $result = $response->json()[0];
                $latitude = $result['lat'];
                $longitude = $result['lon'];
            } else {
                return back()->withErrors(['location' => 'Tidak dapat menemukan koordinat untuk alamat ini. Silakan masukkan alamat yang valid atau gunakan lokasi saat ini.']);
            }
        }

        // Handle file uploads
        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'public');
                $photoPaths[] = $path;
            }
        }

        // Store the report in the database
        auth()->user()->reports()->create([
            'name' => $request->name,
            'email' => $request->email,
            'location' => $request->location,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'type' => $request->type,
            'size' => $request->size,
            'urgency' => $request->urgency,
            'description' => $request->description,
            'photos' => !empty($photoPaths) ? json_encode($photoPaths) : null,
        ]);

        return redirect()->route('map')->with('success', 'Laporan titik sampah berhasil dikirim!');
    }
}
