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
        <footer class="container mx-auto px-4 py-8 mt-12 border-t border-gray-800">
            <div class="flex flex-col md:flex-row justify-between">
                <div class="mb-6 md:mb-0">
                    <h3 class="text-xl font-bold mb-4">EcoTrack</h3>
                    <p class="text-gray-400 max-w-md">Wujudkan pengelolaan sampah berkelanjutan di Indonesia bersama
                        EcoTrack.</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                    <div>
                        <h4 class="font-semibold mb-3">Fitur</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('map') }}" class="text-gray-400 hover:text-white">Peta
                                    Interaktif</a>
                            </li>
                            <li><a href="{{ route('report') }}" class="text-gray-400 hover:text-white">Pelaporan Titik
                                    Sampah</a></li>
                            <li><a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white">Dashboard
                                    Data</a></li>
                            <li><a href="{{ route('collaboration') }}"
                                    class="text-gray-400 hover:text-white">Kolaborasi
                                    Ekosistem</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-3">Tentang</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white">Tim Kami</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Misi</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Karir</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Kontak</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-3">Legal</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white">Kebijakan Privasi</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Syarat & Ketentuan</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-6 border-t border-gray-800 text-center text-gray-400">
                <p>© {{ date('Y') }} EcoTrack. All rights reserved.</p>
            </div>
        </footer>
    @endif
</body>

</html>
