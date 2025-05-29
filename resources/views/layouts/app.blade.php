<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EcoTrack') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-b from-[#0b1121] to-[#0f172a] text-white">
    @if (!View::hasSection('hideNavbar'))
        <!-- Navigation -->
        <nav class="bg-gradient-to-r from-blue-900 via-blue-800 to-purple-700 shadow-md">
            <div class="container mx-auto px-6 py-4 flex items-center justify-between">
                <!-- Logo Section -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}"
                        class="text-2xl font-bold text-white hover:text-[#22b07d] transition-colors duration-300">
                        EcoTrack
                    </a>
                </div>

                <!-- Menu Items (Desktop) -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}"
                        class="text-white hover:text-[#22b07d] transition-colors duration-300">
                        Home
                    </a>
                    <a href="{{ route('map') }}"
                        class="text-white hover:text-[#22b07d] transition-colors duration-300">
                        Explore EcoTrack
                    </a>
                    <a href="{{ route('report') }}"
                        class="text-white hover:text-[#22b07d] transition-colors duration-300">
                        Laporkan Titik
                    </a>
                    <a href="{{ route('about') }}"
                        class="text-white hover:text-[#22b07d] transition-colors duration-300">
                        About Us
                    </a>
                    <a href="{{ route('collaboration') }}"
                        class="text-white hover:text-[#22b07d] transition-colors duration-300">
                        collaboration
                    </a>
                </div>

                <!-- Mobile Menu Toggle (Hamburger) -->
                <div class="md:hidden flex items-center space-x-4">
                    <button class="text-white focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    @auth
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-white hover:text-[#22b07d] transition-colors duration-300">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-white hover:text-[#22b07d] transition-colors duration-300">
                            Login
                        </a>
                        <a href="{{ route('signup') }}"
                            class="bg-transparent border border-white text-white hover:bg-white hover:text-[#0b1121] px-6 py-2 rounded-full transition duration-300">
                            Sign Up
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
    @endif
    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    @if (!View::hasSection('hideFooter'))
        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-400 mt-20">
            <div class="max-w-7xl mx-auto px-6 py-12">
                <div class="grid md:grid-cols-4 gap-10">
                    <!-- Brand -->
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-4">EcoTrack</h3>
                        <p class="mb-4">Wujudkan pengelolaan sampah berkelanjutan di Indonesia bersama EcoTrack.</p>
                        <div class="flex gap-3 mt-4">
                            <a href="#" class="hover:text-white">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M22.675 0h-21.35C.599 0 0 .6 0 1.326v21.348C0 23.4.599 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.464.099 2.795.143v3.24h-1.918c-1.504 0-1.796.715-1.796 1.763v2.314h3.59l-.467 3.622h-3.123V24h6.116c.726 0 1.325-.6 1.325-1.326V1.326C24 .6 23.401 0 22.675 0z" />
                                </svg>
                            </a>
                            <a href="#" class="hover:text-white">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19.633 7.997c.014.199.014.398.014.598 0 6.09-4.637 13.112-13.112 13.112-2.61 0-5.036-.764-7.077-2.073.366.043.732.057 1.112.057 2.166 0 4.158-.732 5.75-1.966-2.022-.043-3.72-1.376-4.307-3.215.282.043.565.07.847.07.408 0 .816-.056 1.19-.155-2.12-.428-3.715-2.302-3.715-4.548v-.057c.621.346 1.328.553 2.08.58C2.39 8.675 1.37 7.06 1.37 5.21c0-.846.225-1.627.616-2.304 2.266 2.78 5.653 4.604 9.47 4.795-.08-.338-.122-.692-.122-1.06 0-2.55 2.07-4.62 4.62-4.62 1.328 0 2.53.56 3.373 1.455 1.05-.208 2.038-.59 2.932-1.12-.347 1.08-1.08 1.982-2.038 2.552.93-.106 1.816-.357 2.64-.71-.617.93-1.403 1.744-2.304 2.395z" />
                                </svg>
                            </a>
                            <a href="#" class="hover:text-white">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c-5.468 0-9.837 4.368-9.837 9.837 0 5.47 4.368 9.837 9.837 9.837 5.47 0 9.837-4.368 9.837-9.837 0-5.47-4.368-9.837-9.837-9.837zm0 18.256c-4.64 0-8.419-3.78-8.419-8.419s3.78-8.419 8.419-8.419 8.419 3.78 8.419 8.419-3.78 8.419-8.419 8.419zm4.378-12.839c-.356.158-.739.264-1.136.311.408-.244.72-.63.867-1.091-.382.227-.803.39-1.252.478a2.1 2.1 0 0 0-3.576 1.917 5.957 5.957 0 0 1-4.33-2.194 2.1 2.1 0 0 0 .65 2.802c-.32-.01-.62-.098-.884-.243v.025a2.104 2.104 0 0 0 1.687 2.06c-.27.074-.555.113-.85.113-.208 0-.41-.02-.607-.06a2.108 2.108 0 0 0 1.963 1.458 4.208 4.208 0 0 1-2.602.896c-.168 0-.334-.01-.498-.03a5.935 5.935 0 0 0 3.212.941c3.856 0 5.964-3.193 5.964-5.964 0-.09-.002-.18-.006-.27a4.254 4.254 0 0 0 1.046-1.084z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Fitur -->
                    <div>
                        <h4 class="text-white font-semibold mb-4">Fitur</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('map') }}" class="hover:text-white">Peta Interaktif</a></li>
                            <li><a href="{{ route('report') }}" class="hover:text-white">Pelaporan Titik Sampah</a>
                            </li>
                            <li><a href="{{ route('dashboard') }}" class="hover:text-white">Dashboard Data</a></li>
                            <li><a href="{{ route('collaboration') }}" class="hover:text-white">Kolaborasi
                                    Ekosistem</a></li>
                        </ul>
                    </div>

                    <!-- Tentang -->
                    <div>
                        <h4 class="text-white font-semibold mb-4">Tentang</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-white">Tim Kami</a></li>
                            <li><a href="#" class="hover:text-white">Misi</a></li>
                            <li><a href="#" class="hover:text-white">Karir</a></li>
                            <li><a href="#" class="hover:text-white">Kontak</a></li>
                        </ul>
                    </div>

                    <!-- Legal -->
                    <div>
                        <h4 class="text-white font-semibold mb-4">Legal</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-white">Kebijakan Privasi</a></li>
                            <li><a href="#" class="hover:text-white">Syarat & Ketentuan</a></li>
                        </ul>
                    </div>
                </div>

                <div class="mt-12 border-t border-gray-700 pt-6 text-center text-sm text-gray-500">
                    <p>© {{ date('Y') }} EcoTrack. All rights reserved.</p>
                </div>
            </div>
        </footer>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
</body>

</html>
