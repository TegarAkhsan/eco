@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-16">
        <h1 class="text-4xl font-bold mb-10 text-white">Kolaborasi Ekosistem Lingkungan</h1>

        {{-- Hero Section --}}
        <section class="bg-[#0b1121]/60 p-10 rounded-2xl shadow-lg mb-16">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="md:w-2/3">
                    <h2 class="text-3xl font-bold text-white mb-5">Bergabunglah dengan Gerakan Perubahan</h2>
                    <p class="text-gray-300 mb-8 leading-relaxed">
                        EcoTrack menghubungkan berbagai pemangku kepentingan dalam ekosistem pengelolaan sampah, termasuk
                        komunitas lokal, pemerintah daerah, dan UMKM daur ulang.
                        Bersama-sama, kita dapat menciptakan solusi berkelanjutan untuk masalah sampah di Indonesia.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#komunitas"
                            class="bg-[#22b07d] hover:bg-[#1c9d6e] text-white px-6 py-3 rounded-xl font-semibold shadow transition">Komunitas</a>
                        <a href="#pemerintah"
                            class="text-white border border-white px-6 py-3 rounded-xl hover:bg-white hover:text-[#0b1121] transition">Pemerintah</a>
                        <a href="#umkm"
                            class="text-white border border-white px-6 py-3 rounded-xl hover:bg-white hover:text-[#0b1121] transition">UMKM
                            Daur Ulang</a>
                    </div>
                </div>
                <div class="md:w-1/3">
                    <img src="{{ asset('images/collaboration-main.jpg') }}" alt="Collaboration"
                        class="rounded-xl object-cover w-full h-full shadow-lg">
                </div>
            </div>
        </section>

        {{-- Komunitas --}}
        <section id="komunitas" class="mb-20">
            <h2 class="text-3xl font-bold text-white mb-12 text-center">Untuk Komunitas</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ([['title' => 'Organisasi Kegiatan', 'desc' => 'Gunakan platform EcoTrack untuk mengorganisir kegiatan pembersihan lingkungan dan kampanye kesadaran masyarakat.', 'icon' => 'user-group'], ['title' => 'Pelaporan Kolektif', 'desc' => 'Laporkan titik sampah secara kolektif dan pantau progres penanganannya bersama komunitas Anda.', 'icon' => 'check-circle'], ['title' => 'Program Edukasi', 'desc' => 'Akses materi edukasi dan kurikulum untuk program pendidikan lingkungan di sekolah dan komunitas.', 'icon' => 'academic-cap']] as $item)
                    <div
                        class="bg-[#0b1121]/60 p-8 rounded-2xl shadow-md hover:shadow-2xl hover:scale-[1.03] transition-all duration-300 ease-in-out border border-[#1a233a] hover:border-[#22b07d]">
                        <div class="bg-[#22b07d] w-14 h-14 flex items-center justify-center rounded-full mb-5">
                            @if ($item['icon'] === 'user-group')
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M15 7a3 3 0 11-6 0 3 3 0 016 0zM17 11a3 3 0 100-6 3 3 0 000 6zM7 11a3 3 0 100-6 3 3 0 000 6z" />
                                </svg>
                            @elseif($item['icon'] === 'check-circle')
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12l2 2 4-4M12 22C6.48 22 2 17.52 2 12S6.48 2 12 2s10 4.48 10 10-4.48 10-10 10z" />
                                </svg>
                            @elseif($item['icon'] === 'academic-cap')
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 14l9-5-9-5-9 5 9 5zM12 14v7m0-7L3 9m9 5l9-5" />
                                </svg>
                            @endif
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-3">{{ $item['title'] }}</h3>
                        <p class="text-gray-300 mb-5 leading-relaxed">{{ $item['desc'] }}</p>
                        <a href="#"
                            class="text-[#22b07d] hover:underline font-medium transition duration-200">Pelajari Lebih
                            Lanjut</a>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-12">
                <a href="#"
                    class="bg-[#22b07d] hover:bg-[#1c9d6e] text-white px-8 py-3 rounded-xl font-semibold shadow transition duration-300">Daftar
                    Sebagai Komunitas</a>
            </div>
        </section>


        {{-- Pemerintah --}}
        <section id="pemerintah" class="mb-20">
            <h2 class="text-3xl font-bold text-white mb-12 text-center">Untuk Pemerintah Daerah</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ([['title' => 'Dashboard Analitik', 'desc' => 'Akses dashboard analitik yang komprehensif untuk memantau persebaran titik sampah, tren, dan efektivitas program.', 'image' => 'gov-dashboard.jpg'], ['title' => 'Sistem Respons Cepat', 'desc' => 'Implementasikan sistem respons cepat untuk menangani laporan titik sampah kritis dan darurat lingkungan.', 'image' => 'rapid-response.jpg']] as $item)
                    <div
                        class="bg-[#0b1121]/60 p-6 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 ease-in-out">
                        <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['title'] }}"
                            class="w-full h-48 object-cover rounded-lg mb-5 shadow-md">
                        <h3 class="text-xl font-semibold text-white mb-3">{{ $item['title'] }}</h3>
                        <p class="text-gray-300 mb-5">{{ $item['desc'] }}</p>
                        <a href="#" class="text-[#22b07d] hover:underline font-medium">Pelajari Lebih Lanjut</a>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-10">
                <a href="#"
                    class="bg-[#22b07d] hover:bg-[#1c9d6e] text-white px-8 py-3 rounded-xl font-semibold shadow-md hover:shadow-lg transition duration-300">Hubungi
                    Tim Pemerintahan</a>
            </div>
        </section>


        {{-- UMKM --}}
        <section id="umkm" class="mb-20">
            <h2 class="text-3xl font-bold text-white mb-8">Untuk UMKM Daur Ulang</h2>
            <div class="bg-[#0b1121]/60 p-8 rounded-xl shadow flex flex-col md:flex-row gap-10 items-center">
                <div class="md:w-1/2">
                    <h3 class="text-xl font-semibold text-white mb-4">Marketplace Bahan Daur Ulang</h3>
                    <p class="text-gray-300 mb-6">Akses marketplace bahan daur ulang yang menghubungkan UMKM dengan sumber
                        sampah yang dapat didaur ulang.</p>
                    <ul class="space-y-3 text-gray-300 mb-6">
                        @foreach (['Akses ke jaringan bank sampah dan pengumpul sampah', 'Sistem lelang dan penawaran untuk bahan daur ulang', 'Analitik pasar dan prediksi ketersediaan bahan'] as $point)
                            <li class="flex items-start">
                                <svg class="text-[#22b07d] w-5 h-5 mr-2 mt-1" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12l2 2 4-4M12 22C6.48 22 2 17.52 2 12S6.48 2 12 2s10 4.48 10 10-4.48 10-10 10z" />
                                </svg>
                                {{ $point }}
                            </li>
                        @endforeach
                    </ul>
                    <a href="#"
                        class="bg-[#22b07d] hover:bg-[#1c9d6e] text-white px-6 py-3 rounded-xl font-semibold shadow transition">Bergabung
                        Sebagai UMKM</a>
                </div>
                <div class="md:w-1/2">
                    <img src="{{ asset('images/recycling-business.jpg') }}" alt="Recycling Business"
                        class="w-full h-full object-cover rounded-xl shadow-lg">
                </div>
            </div>
        </section>

        {{-- Mitra --}}
        <section class="bg-[#0b1121]/60 p-10 rounded-xl shadow-lg">
            <h2 class="text-3xl font-bold text-white mb-8 text-center">Mitra Kami</h2>

            <!-- Swiper Container -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ([1, 2, 3, 4, 5, 1, 2, 3, 4, 5] as $num)
                        <div class="swiper-slide flex items-center justify-center bg-white rounded-lg p-4 h-24 shadow">
                            <img src="{{ asset("images/partner-$num.png") }}" alt="Partner Logo {{ $num }}"
                                class="max-h-full max-w-full">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


    </div>
@endsection
