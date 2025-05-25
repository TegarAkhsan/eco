@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/about-ecotrack.css') }}">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-b from-dark-blue via-dark-blue to-purple-blue">
        <div class="container mx-auto px-8 py-40 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">EcoTrack untuk Masa Depan Bebas Sampah</h1>
            <p class="text-white text-lg mb-8 max-w-3xl mx-auto">
                "Bersama EcoTrack, wujudkan pengelolaan sampah berkelanjutan di Indonesia."
            </p>
            <a href="{{ route('map') }}"
                class="inline-block bg-transparent border-2 border-white text-white px-6 py-2 rounded-full hover:bg-white hover:text-blue-900 transition-colors duration-300">
                Lihat Peta
            </a>
        </div>

        <!-- Earth Image -->
        <div class="relative w-full h-[300px] md:h-[500px] overflow-hidden">
            <img src="{{ asset('images/Earth.png') }}" alt="Earth view from space" class="w-full h-full object-cover">
        </div>

        <!-- Image Gallery with Rotating Focus Animation -->
        <div class="relative z-10 container mx-auto px-4 pb-16 flex justify-center -mt-32 md:-mt-40">
            <div class="rotating-gallery">
                <div class="gallery-item left-item">
                    <img src="{{ asset('images/images 1.png') }}" alt="Beach cleanup" class="gallery-img">
                </div>
                <div class="gallery-item center-item">
                    <img src="{{ asset('images/images 2.png') }}" alt="Waste management truck" class="gallery-img">
                </div>
                <div class="gallery-item right-item">
                    <img src="{{ asset('images/images 3.png') }}" alt="Waste collection" class="gallery-img">
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Features Section -->

    <!-- Core Features -->
    <section class="container mx-auto px-4 py-16 text-center">
        <h2 class="text-3xl font-bold text-white mb-6">Core Features</h2>
        <p class="text-gray-400 max-w-2xl mx-auto">
            Empowering communities with innovative tools for waste management and environmental protection.
        </p>
    </section>

    <!-- Feature 1 -->
    <div class="container mx-auto px-2 md:px-32 lg:px-32 grid md:grid-cols-2 gap-4 items-center mb-2">
        <div class="text-left">
            <h3 class="text-xl md:text-2xl font-bold text-white mb-4">Peta Interaktif</h3>
            <p class="text-white mb-4">
                Eksplorasi lokasi bank sampah, tempat pembuangan akhir (TPA), dan laporan titik sampah liar di seluruh
                Indonesia dengan peta real-time yang mudah digunakan. Temukan solusi pengelolaan sampah terdekat hanya
                dalam satu klik.
            </p>
            <a href="{{ route('map') }}"
                class="inline-block bg-transparent border-2 border-white text-white px-6 py-2 rounded-full hover:bg-white hover:text-blue-900 transition-colors duration-300">
                EcoTrack Map
            </a>
        </div>
        <div>
            <img src="{{ asset('images/images 1.png') }}" alt="Interactive map feature" class="rounded-lg">
        </div>
    </div>

    <!-- Feature 2 -->
    <div class="container mx-auto px-2 md:px-32 lg:px-32 grid md:grid-cols-2 gap-4 items-center mb-2">
        <div class="md:order-2 text-left">
            <h3 class="text-xl md:text-2xl font-bold text-white mb-4">Pelaporan Titik Sampah Cepat</h3>
            <p class="text-white mb-4">
                Laporkan keberadaan sampah liar di lingkungan sekitar Anda secara langsung melalui form interaktif
                berbasis peta. Kontribusi Anda akan membantu pemerintah dan komunitas mengambil tindakan lebih cepat dan
                tepat.
            </p>
            <a href="{{ route('report') }}"
                class="inline-block bg-transparent border-2 border-white text-white px-6 py-2 rounded-full hover:bg-white hover:text-blue-900 transition-colors duration-300">
                EcoTrack Report
            </a>
        </div>
        <div class="md:order-1">
            <img src="{{ asset('images/images 1.png') }}" alt="Waste reporting feature" class="rounded-lg">
        </div>
    </div>

    <!-- Feature 3 -->
    <div class="container mx-auto px-2 md:px-32 lg:px-32 grid md:grid-cols-2 gap-4 items-center mb-2">
        <div class="text-left">
            <h3 class="text-xl md:text-2xl font-bold text-white mb-4">Dashboard Data untuk Pemerintah & Mitra</h3>
            <p class="text-white mb-4">
                Akses dashboard pintar berisi statistik laporan, heatmap wilayah kritis, dan kinerja penanganan sampah.
                EcoTrack mendukung dinas lingkungan dan mitra daur ulang dalam mengambil keputusan berbasis data yang
                akurat.
            </p>
            <a href="{{ route('dashboard') }}"
                class="inline-block bg-transparent border-2 border-white text-white px-6 py-2 rounded-full hover:bg-white hover:text-blue-900 transition-colors duration-300">
                EcoTrack Dashboard
            </a>
        </div>
        <div>
            <img src="{{ asset('images/images 1.png') }}" alt="Data dashboard feature" class="rounded-lg">
        </div>
    </div>

    <!-- Feature 4 -->
    <div class="container mx-auto px-2 md:px-32 lg:px-32 grid md:grid-cols-2 gap-4 items-center mb-2">
        <div class="md:order-2 text-left">
            <h3 class="text-xl md:text-2xl font-bold text-white mb-4">Kolaborasi Ekosistem Lingkungan</h3>
            <p class="text-white mb-4">
                EcoTrack menghubungkan masyarakat, pemerintah daerah, dan UMKM daur ulang dalam satu platform
                kolaboratif. Bersama, kita mempercepat terciptanya sistem pengelolaan sampah yang berkelanjutan dan
                memberdayakan ekonomi lokal.
            </p>
            <a href="{{ route('collaboration') }}"
                class="inline-block bg-transparent border-2 border-white text-white px-6 py-2 rounded-full hover:bg-white hover:text-blue-900 transition-colors duration-300">
                EcoTrack Collaboration
            </a>
        </div>
        <div class="md:order-1">
            <img src="{{ asset('images/images 1.png') }}" alt="Ecosystem collaboration feature" class="rounded-lg">
        </div>
    </div>

    <!-- Impact Section -->
    <section class="container mx-auto px-4 py-16 text-center">
        <h2 class="text-3xl font-bold text-white mb-12">Our Impact</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-[#0b1121]/50 p-6 rounded-lg hover:bg-[#0b1121]/70 transition-colors duration-300">
                <h3 class="text-3xl font-bold text-white mb-2">25,000+</h3>
                <p class="text-gray-400">Locations Mapped</p>
            </div>
            <div class="bg-[#0b1121]/50 p-6 rounded-lg hover:bg-[#0b1121]/70 transition-colors duration-300">
                <h3 class="text-3xl font-bold text-white mb-2">10,000+</h3>
                <p class="text-gray-400">Active Volunteers</p>
            </div>
            <div class="bg-[#0b1121]/50 p-6 rounded-lg hover:bg-[#0b1121]/70 transition-colors duration-300">
                <h3 class="text-3xl font-bold text-white mb-2">500,000+</h3>
                <p class="text-gray-400">KG Waste Reported</p>
            </div>
            <div class="bg-[#0b1121]/50 p-6 rounded-lg hover:bg-[#0b1121]/70 transition-colors duration-300">
                <h3 class="text-3xl font-bold text-white mb-2">15,000+</h3>
                <p class="text-gray-400">Actions Taken</p>
            </div>
        </div>
    </section>

    <!-- Why Choose EcoTrack? Section -->
    <section class="relative bg-gradient-to-b from-dark-blue to-purple-blue py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-white text-[36px] font-poppins font-bold leading-[36px] break-words mb-4">Why Choose
                EcoTrack?
            </h2>
            <p
                class="text-[#9CA3AF] text-[16px] font-poppins font-normal leading-[16px] break-words max-w-2xl mx-auto mb-12">
                Discover how EcoTrack is revolutionizing waste management and environmental protection
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl mx-auto">
                <div
                    class="bg-[rgba(15,23,42,0.50)] p-8 rounded-xl border border-[#1E293B] hover:bg-[rgba(15,23,42,0.70)] transition-colors duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/div-2.png') }}" alt="Secure icon" class="w-15 h-15">
                        </div>
                        <div class="text-left">
                            <h3 class="text-white text-[20px] font-poppins font-semibold leading-[20px] break-words mb-2">
                                Secure & Transparent</h3>
                            <p class="text-[#9CA3AF] text-[16px] font-poppins font-normal leading-[16px] break-words">
                                Blockchain technology ensures data integrity and transparency in waste tracking
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-[rgba(15,23,42,0.50)] p-8 rounded-xl border border-[#1E293B] hover:bg-[rgba(15,23,42,0.70)] transition-colors duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/div-1.png') }}" alt="Community icon" class="w-15 h-15">
                        </div>
                        <div class="text-left">
                            <h3 class="text-white text-[20px] font-poppins font-semibold leading-[20px] break-words mb-2">
                                Community Driven</h3>
                            <p class="text-[#9CA3AF] text-[16px] font-poppins font-normal leading-[16px] break-words">
                                Terbuka untuk semua masyarakat
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-[rgba(15,23,42,0.50)] p-8 rounded-xl border border-[#1E293B] hover:bg-[rgba(15,23,42,0.70)] transition-colors duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/div-1.png') }}" alt="Analytics icon" class="w-15 h-15">
                        </div>
                        <div class="text-left">
                            <h3 class="text-white text-[20px] font-poppins font-semibold leading-[20px] break-words mb-2">
                                Real-time Analytics</h3>
                            <p class="text-[#9CA3AF] text-[16px] font-poppins font-normal leading-[16px] break-words">
                                Data real-time & terverifikasi
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-[rgba(15,23,42,0.50)] p-8 rounded-xl border border-[#1E293B] hover:bg-[rgba(15,23,42,0.70)] transition-colors duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/div-1.png') }}" alt="Easy use icon" class="w-15 h-15">
                        </div>
                        <div class="text-left">
                            <h3 class="text-white text-[20px] font-poppins font-semibold leading-[20px] break-words mb-2">
                                Easy to Use</h3>
                            <p class="text-[#9CA3AF] text-[16px] font-poppins font-normal leading-[16px] break-words">
                                Intuitive website for quick waste reporting and tracking
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About EcoTrack Section -->
    <section class="about-ecotrack-section">
        <img src="{{ asset('images/Earth Side.png') }}" alt="Earth background" class="earth-background">
        <div class="content-container">
            <div class="section-title-container">
                <h2 class="section-title">About EcoTrack</h2>
                <p class="section-description">
                    Learn more about EcoTrack’s mission, data sources, and commitment to sustainability.
                </p>
            </div>
            <div class="card misi-kami">
                <div class="card-content">
                    <h3 class="subsection-title">Misi Kami</h3>
                    <p class="subsection-description">
                        Ikut menciptakan sistem pengelolaan sampah nasional yang partisipatif, transparan, dan
                        berkelanjutan
                        melalui kolaborasi teknologi dan masyarakat.
                    </p>
                </div>
            </div>
            <div class="card sdgs">
                <div class="card-content">
                    <h3 class="subsection-title">SDGs</h3>
                    <p class="subsection-description">
                        Kami mendukung pencapaian:<br>
                        SDG 11: Kota & Permukiman Berkelanjutan<br>
                        SDG 12: Konsumsi & Produksi Bertanggung Jawab<br>
                        SDG 13: Penanganan Perubahan Iklim
                    </p>
                </div>
            </div>
            <div class="card sumber-data">
                <div class="card-content">
                    <h3 class="subsection-title">Sumber Data</h3>
                    <p class="subsection-description">
                        BPS (Badan Pusat Statistik)<br>
                        KLHK<br>
                        Open Data Pemerintah
                    </p>
                </div>
            </div>
            <div class="decorative-ellipse"></div>
        </div>
    </section>

    <!-- Ayo Bergabung Bersama EcoTrack! Section -->
    <section class="relative bg-gradient-to-b from-dark-blue to-purple-blue py-16">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/pexels-pixabay-41949 1.png') }}" alt="Earth background"
                class="w-full h-full object-cover opacity-20">
        </div>
        <div class="relative z-10 container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Ayo Bergabung Bersama EcoTrack!</h2>
            <p class="text-white text-lg mb-8 max-w-3xl mx-auto">
                "Bersama EcoTrack, wujudkan pengelolaan sampah berkelanjutan di Indonesia."
            </p>
            <a href="{{ route('report') }}"
                class="inline-block bg-transparent border-2 border-white text-white px-6 py-2 rounded-full hover:bg-white hover:text-blue-900 transition-colors duration-300">
                Gabung Sekarang
            </a>
        </div>
    </section>
@endsection
