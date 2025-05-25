@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-cover bg-center px-4 py-12 font-['Poppins']"
        style="background-image: url('{{ asset('images/earth.png') }}')">
        <div class="bg-[#0b1121]/90 rounded-xl max-w-6xl mx-auto p-10 shadow-xl">
            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="text-center text-green-500 text-sm mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="text-center text-red-500 text-sm mb-4">
                    <ul>
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
                <!-- Contact Info -->
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
                                d="M12 2C8.13 2 5 5.13 5 9c0 4.25 5.4 11.74 6.17 12.74.39.5 1.28.5 1.67 0C13.6 20.74 19 13.25 19 9c0-3.87-3.13-7-7-7z" />
                        </svg>
                        <span>Indonesia, Surabaya</span>
                    </div>
                </div>

                <!-- Report Form -->
                <form action="{{ route('report.submit') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-5 text-white relative" id="reportForm">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nama</label>
                        <input type="text" name="name" id="name" placeholder="Nama" required
                            value="{{ old('name') }}"
                            class="w-full px-4 py-3 pr-10 rounded-xl bg-[#1e293b] border border-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                            aria-label="Nama">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email" required
                            value="{{ old('email') }}"
                            class="w-full px-4 py-3 pr-10 rounded-xl bg-[#1e293b] border border-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                            aria-label="Email">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-300 mb-1">Lokasi Titik
                            Sampah</label>
                        <input type="text" name="location" id="location"
                            placeholder="Masukkan alamat atau gunakan lokasi saat ini" required
                            value="{{ old('location') }}"
                            class="w-full px-4 py-3 pr-10 rounded-xl bg-[#1e293b] border border-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('location') border-red-500 @enderror"
                            aria-label="Lokasi Titik Sampah">
                        <button type="button" id="getLocation"
                            class="mt-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-full transition duration-300">
                            Gunakan Lokasi Saat Ini
                        </button>
                        @error('location')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Hidden fields for coordinates -->
                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">

                    <div class="relative">
                        <label for="type" class="block text-sm font-medium text-gray-300 mb-1">Jenis Sampah</label>
                        <select name="type" id="type" required
                            class="w-full px-4 py-3 pr-10 rounded-xl bg-[#1e293b] border border-gray-700 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 @error('type') border-red-500 @enderror"
                            aria-label="Pilih Jenis Sampah">
                            <option value="">Pilih Jenis Sampah</option>
                            <option value="organik" {{ old('type') == 'organik' ? 'selected' : '' }}>Organik</option>
                            <option value="anorganik" {{ old('type') == 'anorganik' ? 'selected' : '' }}>Anorganik</option>
                            <option value="b3" {{ old('type') == 'b3' ? 'selected' : '' }}>Berbahaya (B3)</option>
                            <option value="campuran" {{ old('type') == 'campuran' ? 'selected' : '' }}>Campuran</option>
                        </select>
                        <div class="absolute inset-y-0 right-4 top-6 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        @error('type')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative">
                        <label for="size" class="block text-sm font-medium text-gray-300 mb-1">Estimasi Ukuran</label>
                        <select name="size" id="size" required
                            class="w-full px-4 py-3 pr-10 rounded-xl bg-[#1e293b] border border-gray-700 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 @error('size') border-red-500 @enderror"
                            aria-label="Pilih Estimasi Ukuran">
                            <option value="">Pilih Estimasi Ukuran</option>
                            <option value="kecil" {{ old('size') == 'kecil' ? 'selected' : '' }}>Kecil (<1m³)< /option>
                            <option value="sedang" {{ old('size') == 'sedang' ? 'selected' : '' }}>Sedang (1–5m³)</option>
                            <option value="besar" {{ old('size') == 'besar' ? 'selected' : '' }}>Besar (>5m³)</option>
                        </select>
                        <div class="absolute inset-y-0 right-4 top-6 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
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
                            <option value="kritis" {{ old('urgency') == 'kritis' ? 'selected' : '' }}>Butuh Penanganan
                                Cepat</option>
                        </select>
                        <div class="absolute inset-y-0 right-4 top-6 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        @error('urgency')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Deskripsi
                            (Opsional)</label>
                        <textarea name="description" id="description" rows="4" placeholder="Deskripsi (opsional)"
                            class="w-full px-4 py-3 rounded-xl bg-[#1e293b] border border-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                            aria-label="Deskripsi">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="photos" class="block text-sm font-medium text-gray-300 mb-1">Foto Sampah
                            (Opsional)</label>
                        <input type="file" name="photos[]" id="photos" multiple accept="image/*"
                            class="w-full px-4 py-3 rounded-xl bg-[#1e293b] border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('photos.*') border-red-500 @enderror"
                            aria-label="Upload Foto Sampah">
                        @error('photos.*')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="terms" id="terms" required
                            class="w-5 h-5 text-blue-500 bg-gray-900 border-gray-700 rounded focus:ring-blue-500 @error('terms') border-red-500 @enderror"
                            {{ old('terms') ? 'checked' : '' }} aria-label="Setuju dengan syarat">
                        <label for="terms" class="ml-3 text-sm text-gray-300">Data yang saya berikan valid *</label>
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

    <script>
        // Prompt for geolocation when the page loads or when a photo is selected
        document.getElementById('photos').addEventListener('change', requestGeolocation);
        window.addEventListener('load', requestGeolocation);

        // Handle "Gunakan Lokasi Saat Ini" button click
        document.getElementById('getLocation').addEventListener('click', requestGeolocation);

        function requestGeolocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    async function(position) {
                            const latitude = position.coords.latitude;
                            const longitude = position.coords.longitude;
                            document.getElementById('latitude').value = latitude;
                            document.getElementById('longitude').value = longitude;

                            // Reverse geocode to get a human-readable address
                            try {
                                const response = await fetch(
                                    `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`
                                    );
                                const data = await response.json();
                                const address = data.display_name || `Lat: ${latitude}, Lon: ${longitude}`;
                                document.getElementById('location').value = address;
                                alert('Lokasi berhasil didapatkan: ' + address);
                            } catch (error) {
                                document.getElementById('location').value = `Lat: ${latitude}, Lon: ${longitude}`;
                                alert(
                                    'Lokasi berhasil didapatkan, tetapi alamat tidak dapat diambil. Menggunakan koordinat.');
                            }
                        },
                        function(error) {
                            alert('Gagal mendapatkan lokasi: ' + error.message +
                                '. Silakan masukkan alamat secara manual.');
                        }
                );
            } else {
                alert('Geolocation tidak didukung oleh browser Anda. Silakan masukkan alamat secara manual.');
            }
        }

        // Disable submit button during form submission
        document.getElementById('reportForm').addEventListener('submit', function(event) {
            const submitButton = document.getElementById('submitButton');
            submitButton.disabled = true;
            submitButton.textContent = 'Mengirim...';
        });
    </script>
@endsection

@section('hideFooter', true)
