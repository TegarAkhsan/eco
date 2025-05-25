@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold mb-6">Kolaborasi Ekosistem Lingkungan</h1>

        <div class="bg-[#0b1121]/50 p-6 rounded-lg mb-8">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="md:w-2/3">
                    <h2 class="text-2xl font-bold mb-4">Bergabunglah dengan Gerakan Perubahan</h2>
                    <p class="text-gray-400 mb-6">
                        EcoTrack menghubungkan berbagai pemangku kepentingan dalam ekosistem pengelolaan sampah, termasuk
                        komunitas lokal, pemerintah daerah, dan UMKM daur ulang. Bersama-sama, kita dapat menciptakan solusi
                        berkelanjutan untuk masalah sampah di Indonesia.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#komunitas"
                            class="bg-[#22b07d] hover:bg-[#1c9d6e] text-white px-6 py-2 rounded-lg transition duration-300">Komunitas</a>
                        <a href="#pemerintah"
                            class="bg-transparent hover:bg-white hover:text-[#0b1121] border border-white px-6 py-2 rounded-lg transition duration-300">Pemerintah</a>
                        <a href="#umkm"
                            class="bg-transparent hover:bg-white hover:text-[#0b1121] border border-white px-6 py-2 rounded-lg transition duration-300">UMKM
                            Daur Ulang</a>
                    </div>
                </div>
                <div class="md:w-1/3">
                    <div class="bg-[#d9d9d9] rounded-lg overflow-hidden">
                        <img src="{{ asset('images/collaboration-main.jpg') }}" alt="Collaboration"
                            class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>

        <div id="komunitas" class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Untuk Komunitas</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-[#0b1121]/50 p-6 rounded-lg">
                    <div class="bg-[#22b07d] w-12 h-12 flex items-center justify-center rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Organisasi Kegiatan</h3>
                    <p class="text-gray-400 mb-4">
                        Gunakan platform EcoTrack untuk mengorganisir kegiatan pembersihan lingkungan dan kampanye kesadaran
                        masyarakat.
                    </p>
                    <a href="#" class="text-[#22b07d] hover:underline">Pelajari Lebih Lanjut</a>
                </div>

                <div class="bg-[#0b1121]/50 p-6 rounded-lg">
                    <div class="bg-[#22b07d] w-12 h-12 flex items-center justify-center rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Pelaporan Kolektif</h3>
                    <p class="text-gray-400 mb-4">
                        Laporkan titik sampah secara kolektif dan pantau progres penanganannya bersama komunitas Anda.
                    </p>
                    <a href="#" class="text-[#22b07d] hover:underline">Pelajari Lebih Lanjut</a>
                </div>

                <div class="bg-[#0b1121]/50 p-6 rounded-lg">
                    <div class="bg-[#22b07d] w-12 h-12 flex items-center justify-center rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Program Edukasi</h3>
                    <p class="text-gray-400 mb-4">
                        Akses materi edukasi dan kurikulum untuk program pendidikan lingkungan di sekolah dan komunitas.
                    </p>
                    <a href="#" class="text-[#22b07d] hover:underline">Pelajari Lebih Lanjut</a>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="#"
                    class="bg-[#22b07d] hover:bg-[#1c9d6e] text-white px-8 py-3 rounded-lg inline-block transition duration-300">Daftar
                    Sebagai Komunitas</a>
            </div>
        </div>

        <div id="pemerintah" class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Untuk Pemerintah Daerah</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-[#0b1121]/50 p-6 rounded-lg">
                    <h3 class="text-xl font-bold mb-4">Dashboard Analitik</h3>
                    <p class="text-gray-400 mb-4">
                        Akses dashboard analitik yang komprehensif untuk memantau persebaran titik sampah, tren, dan
                        efektivitas program pengelolaan sampah di wilayah Anda.
                    </p>
                    <div class="bg-[#d9d9d9] h-48 rounded-lg mb-4">
                        <img src="{{ asset('images/gov-dashboard.jpg') }}" alt="Government Dashboard"
                            class="w-full h-full object-cover rounded-lg">
                    </div>
                    <a href="#" class="text-[#22b07d] hover:underline">Pelajari Lebih Lanjut</a>
                </div>

                <div class="bg-[#0b1121]/50 p-6 rounded-lg">
                    <h3 class="text-xl font-bold mb-4">Sistem Respons Cepat</h3>
                    <p class="text-gray-400 mb-4">
                        Implementasikan sistem respons cepat untuk menangani laporan titik sampah kritis dan darurat
                        lingkungan lainnya.
                    </p>
                    <div class="bg-[#d9d9d9] h-48 rounded-lg mb-4">
                        <img src="{{ asset('images/rapid-response.jpg') }}" alt="Rapid Response System"
                            class="w-full h-full object-cover rounded-lg">
                    </div>
                    <a href="#" class="text-[#22b07d] hover:underline">Pelajari Lebih Lanjut</a>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="#"
                    class="bg-[#22b07d] hover:bg-[#1c9d6e] text-white px-8 py-3 rounded-lg inline-block transition duration-300">Hubungi
                    Tim Pemerintahan</a>
            </div>
        </div>

        <div id="umkm" class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Untuk UMKM Daur Ulang</h2>

            <div class="bg-[#0b1121]/50 p-6 rounded-lg">
                <div class="flex flex-col md:flex-row gap-8">
                    <div class="md:w-1/2">
                        <h3 class="text-xl font-bold mb-4">Marketplace Bahan Daur Ulang</h3>
                        <p class="text-gray-400 mb-6">
                            Akses marketplace bahan daur ulang yang menghubungkan UMKM dengan sumber sampah yang dapat
                            didaur ulang. Tingkatkan efisiensi rantai pasok dan skalakan bisnis Anda.
                        </p>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#22b07d] mr-2 mt-0.5"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Akses ke jaringan bank sampah dan pengumpul sampah</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#22b07d] mr-2 mt-0.5"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Sistem lelang dan penawaran untuk bahan daur ulang</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#22b07d] mr-2 mt-0.5"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Analitik pasar dan prediksi ketersediaan bahan</span>
                            </li>
                        </ul>
                        <a href="#"
                            class="bg-[#22b07d] hover:bg-[#1c9d6e] text-white px-6 py-2 rounded-lg inline-block transition duration-300">Bergabung
                            Sebagai UMKM</a>
                    </div>
                    <div class="md:w-1/2">
                        <div class="bg-[#d9d9d9] rounded-lg overflow-hidden h-full">
                            <img src="{{ asset('images/recycling-business.jpg') }}" alt="Recycling Business"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-[#0b1121]/50 p-6 rounded-lg">
            <h2 class="text-2xl font-bold mb-6">Mitra Kami</h2>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                <div class="bg-white p-4 rounded-lg flex items-center justify-center h-24">
                    <img src="{{ asset('images/partner-1.png') }}" alt="Partner Logo" class="max-h-full">
                </div>
                <div class="bg-white p-4 rounded-lg flex items-center justify-center h-24">
                    <img src="{{ asset('images/partner-2.png') }}" alt="Partner Logo" class="max-h-full">
                </div>
                <div class="bg-white p-4 rounded-lg flex items-center justify-center h-24">
                    <img src="{{ asset('images/partner-3.png') }}" alt="Partner Logo" class="max-h-full">
                </div>
                <div class="bg-white p-4 rounded-lg flex items-center justify-center h-24">
                    <img src="{{ asset('images/partner-4.png') }}" alt="Partner Logo" class="max-h-full">
                </div>
                <div class="bg-white p-4 rounded-lg flex items-center justify-center h-24">
                    <img src="{{ asset('images/partner-5.png') }}" alt="Partner Logo" class="max-h-full">
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="#" class="text-[#22b07d] hover:underline">Lihat Semua Mitra</a>
            </div>
        </div>
    </div>
@endsection
