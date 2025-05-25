@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/about-ecotrack.css') }}">
    <!-- Hero Section -->
    <div class="relative bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('images/Hero-Section-AboutUs[1].png') }}');">
        <!-- Overlay gelap agar teks tetap terbaca -->
        <div class="absolute inset-0 bg-gradient-to-b from-[#0f172a]/80 via-[#0f172a]/80 to-[#3b0764]/80"></div>

        <!-- Konten -->
        <div class="container mx-auto px-8 py-40 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">About Us</h1>
            <p class="text-white text-lg mb-8 max-w-3xl mx-auto">
                "Bersama EcoTrack, wujudkan pengelolaan sampah berkelanjutan di Indonesia."
            </p>
        </div>
    </div>
    <!-- End Hero Section -->


    <!-- Visi dan Misi Kami -->
    <section class="bg-transparent py-20">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-white text-[36px] font-poppins font-bold leading-[36px] mb-4">Visi & Misi Kami</h2>
            <p class="text-[#9CA3AF] text-[16px] font-poppins font-normal leading-[24px] max-w-2xl mx-auto mb-12">
                EcoTrack hadir untuk membangun masa depan pengelolaan sampah yang berkelanjutan melalui teknologi dan
                kolaborasi lintas sektor.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl mx-auto">
                <!-- Misi -->
                <div
                    class="bg-[rgba(15,23,42,0.50)] p-8 rounded-xl border border-[#1E293B] hover:bg-[rgba(15,23,42,0.70)] transition-colors duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center">
                            <!-- Inline SVG Misi -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" viewBox="0 0 24 24" fill="none"
                                stroke="#22b07d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <circle cx="12" cy="12" r="6" />
                                <circle cx="12" cy="12" r="2" fill="#22b07d" />
                                <line x1="12" y1="2" x2="12" y2="6" />
                                <line x1="12" y1="18" x2="12" y2="22" />
                                <line x1="2" y1="12" x2="6" y2="12" />
                                <line x1="18" y1="12" x2="22" y2="12" />
                            </svg>
                        </div>
                        <div class="text-left">
                            <h3 class="text-white text-[20px] font-poppins font-semibold leading-[24px] mb-2">Misi Kami
                            </h3>
                            <p class="text-[#9CA3AF] text-[16px] font-poppins font-normal leading-[24px]">
                                Menghubungkan komunitas, pemerintah, dan sektor swasta melalui platform digital untuk
                                menciptakan solusi pengelolaan sampah yang efektif dan berkelanjutan.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Visi -->
                <div
                    class="bg-[rgba(15,23,42,0.50)] p-8 rounded-xl border border-[#1E293B] hover:bg-[rgba(15,23,42,0.70)] transition-colors duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center">
                            <!-- Inline SVG Visi -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" viewBox="0 0 24 24" fill="none"
                                stroke="#22b07d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" fill="#22b07d" />
                            </svg>
                        </div>
                        <div class="text-left">
                            <h3 class="text-white text-[20px] font-poppins font-semibold leading-[24px] mb-2">Visi Kami
                            </h3>
                            <p class="text-[#9CA3AF] text-[16px] font-poppins font-normal leading-[24px]">
                                Mewujudkan Indonesia bebas sampah liar dengan sistem pengelolaan sampah yang efisien,
                                berkelanjutan, dan mendukung ekonomi sirkular.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Tim Kami -->
    <section class="bg-transparent py-20">
        <div class="px-4 md:px-0 text-center">
            <h2 class="text-white text-[36px] font-poppins font-bold leading-[36px] mb-4">Tim Kami</h2>
            <p class="text-[#9CA3AF] text-[16px] font-poppins font-normal leading-[24px] max-w-2xl mx-auto mb-12">
                Di balik EcoTrack, terdapat tim berdedikasi yang menggabungkan keahlian di bidang teknologi, lingkungan,
                dan kolaborasi sosial.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
                @foreach ([['name' => 'Arfian Putra Pratama', 'title' => 'Founder & CEO', 'desc' => 'Budi memiliki pengalaman lebih dari 10 tahun dalam bidang teknologi dan lingkungan.'], ['name' => 'Tegar Eka Pambudi El Akhsan', 'title' => 'CTO', 'desc' => 'Siti adalah ahli teknologi dengan fokus pada pengembangan platform berbasis data.'], ['name' => 'Ferdynata Rafi Hardiyanto', 'title' => 'Head of Partnerships', 'desc' => 'Ahmad membangun hubungan dengan pemerintah dan mitra industri untuk memperluas jangkauan EcoTrack.']] as $member)
                    <div
                        class="bg-[rgba(15,23,42,0.5)] hover:bg-[rgba(15,23,42,0.7)] transition-colors duration-300 border border-[#1E293B] p-8 rounded-xl text-center">
                        <div
                            class="w-28 h-28 rounded-full overflow-hidden mx-auto mb-4 border-4 border-purple-500 flex items-center justify-center bg-[#0f172a]">
                            <!-- Inline SVG profil simple -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-28 h-28 text-purple-500" viewBox="0 0 64 64"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="32" cy="20" r="12" />
                                <path d="M12 52c0-11 20-11 20-11s20 0 20 11" />
                            </svg>
                        </div>
                        <h3 class="text-white text-[20px] font-semibold mb-1">{{ $member['name'] }}</h3>
                        <p class="text-[#22b07d] font-medium mb-3">{{ $member['title'] }}</p>
                        <p class="text-[#9CA3AF] text-sm mb-4">{{ $member['desc'] }}</p>
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="text-[#9CA3AF] hover:text-white transition">
                                <i class="fab fa-linkedin text-xl"></i>
                            </a>
                            <a href="#" class="text-[#9CA3AF] hover:text-white transition">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <a href="#" class="text-[#9CA3AF] hover:text-white transition">
                                <i class="fab fa-github text-xl"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why Choose EcoTrack Section -->
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
                            <img src="{{ asset('images/div-2.png') }}" alt="Secure icon"
                                style="width:60px; height:60px;">
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
        </div>
    </section>

    <div class="">
        <h2 class="text-3xl font-bold mb-2 text-center text-white">Hubungi Kami</h2>
        <p class="text-center text-indigo-200 mb-8">Kami senang mendengar dari Anda! Jangan ragu mengirimkan pesan atau
            pertanyaan.</p>

        <form action="" method="POST"
            style="position: relative;
           background-color: rgba(203, 213, 225, 0.1);
           border: 3px solid rgba(255, 255, 255, 0.5);
           border-radius: 15px 40px 40px 15px;
           backdrop-filter: blur(17.5px);
           -webkit-backdrop-filter: blur(17.5px);
           transition: background-color 0.3s ease;"
            onmouseover="this.style.backgroundColor='rgba(203, 213, 225, 0.2)';"
            onmouseout="this.style.backgroundColor='rgba(203, 213, 225, 0.1)';" class="p-8 space-y-6 shadow-lg">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-white">Nama Awal</label>
                    <input type="text" id="first_name" name="first_name" required
                        class="mt-1 block w-full rounded-lg border border-white/40 bg-white/10 text-white placeholder-white/70 shadow-sm focus:ring-indigo-400 focus:border-indigo-400">
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-medium text-white">Nama Akhir</label>
                    <input type="text" id="last_name" name="last_name" required
                        class="mt-1 block w-full rounded-lg border border-white/40 bg-white/10 text-white placeholder-white/70 shadow-sm focus:ring-indigo-400 focus:border-indigo-400">
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-white">Email</label>
                <input type="email" id="email" name="email" required
                    class="mt-1 block w-full rounded-lg border border-white/40 bg-white/10 text-white placeholder-white/70 shadow-sm focus:ring-indigo-400 focus:border-indigo-400">
            </div>

            <div>
                <label for="subject" class="block text-sm font-medium text-white">Tujuan</label>
                <input type="text" id="subject" name="subject" placeholder="Misalnya: Kritik, Saran, Kolaborasi"
                    class="mt-1 block w-full rounded-lg border border-white/40 bg-white/10 text-white placeholder-white/70 shadow-sm focus:ring-indigo-400 focus:border-indigo-400">
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-white">Deskripsi</label>
                <textarea id="message" name="message" rows="5" required
                    class="mt-1 block w-full rounded-lg border border-white/40 bg-white/10 text-white placeholder-white/70 shadow-sm focus:ring-indigo-400 focus:border-indigo-400"
                    placeholder="Tulis pesan Anda di sini..."></textarea>
            </div>

            <div class="text-center">
                <button type="submit"
                    class="bg-indigo-700 bg-opacity-90 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-600 transition">
                    Kirim Pesan
                </button>
            </div>
        </form>
    </div>
@endsection
