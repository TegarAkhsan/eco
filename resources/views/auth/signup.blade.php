@extends('layouts.app')
@section('hideNavbar', true)
@section('content')
    <div class="w-full h-screen relative bg-[#111827] overflow-hidden">
        <!-- Back Button SVG -->
        <a href="{{ route('home') }}"
            class="absolute left-4 top-4 flex items-center gap-2 px-4 py-2 rounded-full bg-gray-800 hover:bg-gray-700 text-white transition duration-300 shadow">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M15.707 17.707C16.098 17.316 16.098 16.684 15.707 16.293L11.414 12L15.707 7.707C16.098 7.316 16.098 6.684 15.707 6.293C15.316 5.902 14.684 5.902 14.293 6.293L9.293 11.293C8.902 11.684 8.902 12.316 9.293 12.707L14.293 17.707C14.684 18.098 15.316 18.098 15.707 17.707Z"
                    fill="currentColor" />
            </svg>
            <span class="text-sm font-medium">Back</span>
        </a>

        <!-- Decorative Ellipses -->
        <div
            class="absolute w-[292px] h-[292px] left-[-145px] top-[-89px] bg-gradient-to-b from-[#3fa8df] to-[#a30c74] rounded-full blur-[100px]">
        </div>
        <div
            class="absolute w-[292px] h-[292px] left-[1220px] top-[874px] bg-gradient-to-b from-[#3fa8df] to-[#a30c74] rounded-full blur-[100px]">
        </div>

        <!-- Earth Image -->
        <img class="absolute left-0 opacity-20" style="transform: scaleX(1); top: -300px;"
            src="{{ asset('images/Earth Side.png') }}" alt="Side Earth">

        <!-- Title and Description Section -->
        <div class="absolute w-[512px] h-[320px] left-[73px] top-[200px]">
            <div class="absolute left-0 top-0 text-emerald-400 text-base font-semibold leading-none tracking-wide">JOIN ECO
                TRACK FOR FREE</div>
            <div class="absolute left-0 top-[56px] w-96 text-white text-5xl font-bold leading-[48px]">Help Shape a Cleaner
                Future</div>
            <div class="absolute left-0 top-[221px] w-96 text-gray-200 text-lg font-normal leading-none">
                Join thousands of environmental champions making a real difference. Track, reduce, and optimize your carbon
                footprint with our innovative platform.
            </div>
        </div>

        <!-- Signup Form Container -->
        <div
            class="absolute right-[250px] top-1/2 -translate-y-1/2 w-[360px] bg-[#1e2538] rounded-2xl shadow-[0px_20px_25px_0px_rgba(0,0,0,0.10),0px_8px_10px_0px_rgba(0,0,0,0.10)] px-6 py-8">

            <!-- Form Title -->
            <h2 class="text-center text-white text-xl font-bold font-poppins mb-4">Create new account</h2>

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

            <!-- Form -->
            <form action="{{ route('signup') }}" method="POST">
                @csrf

                <!-- Username -->
                <div class="relative mb-4">
                    <input type="text" id="username" name="username" required placeholder="Username"
                        value="{{ old('username') }}"
                        class="w-full h-11 pl-10 pr-4 py-2 bg-[#1A1F2E] rounded-xl outline outline-1 outline-[#2E3A59] placeholder:text-gray-500 text-gray-300 text-sm focus:ring-2 focus:ring-[#367AEC] transition duration-150">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 14 14">
                            <circle cx="7" cy="7" r="7" fill="#9CA3AF" />
                        </svg>
                    </div>
                </div>

                <!-- First and Last Name -->
                <div class="flex gap-3 mb-4">
                    <input type="text" id="first_name" name="first_name" required placeholder="First Name"
                        value="{{ old('first_name') }}"
                        class="w-1/2 h-11 px-4 bg-[#1A1F2E] rounded-xl outline outline-1 outline-[#2E3A59] placeholder:text-gray-500 text-gray-300 text-sm focus:ring-2 focus:ring-[#367AEC] transition duration-150">
                    <input type="text" id="last_name" name="last_name" required placeholder="Last Name"
                        value="{{ old('last_name') }}"
                        class="w-1/2 h-11 px-4 bg-[#1A1F2E] rounded-xl outline outline-1 outline-[#2E3A59] placeholder:text-gray-500 text-gray-300 text-sm focus:ring-2 focus:ring-[#367AEC] transition duration-150">
                </div>

                <!-- Email -->
                <div class="relative mb-4">
                    <input type="email" id="email" name="email" required placeholder="Email"
                        value="{{ old('email') }}"
                        class="w-full h-11 pl-10 pr-4 bg-[#1A1F2E] rounded-xl outline outline-1 outline-[#2E3A59] placeholder:text-gray-500 text-gray-300 text-sm focus:ring-2 focus:ring-[#367AEC] transition duration-150">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M0 4l8 5 8-5v8H0V4z" />
                        </svg>
                    </div>
                </div>

                <!-- Password -->
                <div class="relative mb-4">
                    <input type="password" id="password" name="password" required placeholder="Password"
                        class="w-full h-11 pl-10 pr-4 bg-[#1A1F2E] rounded-xl outline outline-1 outline-[#2E3A59] placeholder:text-gray-500 text-gray-300 text-sm focus:ring-2 focus:ring-[#367AEC] transition duration-150">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 17a2 2 0 100-4 2 2 0 000 4zM6 9V7a6 6 0 0112 0v2a2 2 0 012 2v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5a2 2 0 012-2z" />
                        </svg>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="relative mb-4">
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        placeholder="Confirm Password"
                        class="w-full h-11 pl-10 pr-4 bg-[#1A1F2E] rounded-xl outline outline-1 outline-[#2E3A59] placeholder:text-gray-500 text-gray-300 text-sm focus:ring-2 focus:ring-[#367AEC] transition duration-150">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 17a2 2 0 100-4 2 2 0 000 4zM6 9V7a6 6 0 0112 0v2a2 2 0 012 2v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5a2 2 0 012-2z" />
                        </svg>
                    </div>
                </div>

                <!-- Role Selection -->
                <div class="relative mb-4">
                    <select id="role" name="role" required
                        class="w-full h-11 px-4 bg-[#1A1F2E] rounded-xl outline outline-1 outline-[#2E3A59] text-gray-300 text-sm focus:ring-2 focus:ring-[#367AEC] transition duration-150">
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full h-11 bg-[#367AEC] rounded-xl text-white text-sm font-semibold hover:bg-[#2a5ccd] transition duration-200">
                    Sign Up
                </button>

                <!-- Sign In Link -->
                <p class="text-center text-gray-400 text-sm mt-3">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-[#367AEC] hover:underline">Sign in</a>
                </p>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-2 bg-[#1e2538] text-[#adaebc] text-sm">Or continue with</span>
                    </div>
                </div>

                <!-- Social Buttons -->
                <div class="flex justify-center gap-4">
                    <!-- Google -->
                    <button
                        class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-gray-100 transition">
                        <svg class="w-5 h-5" viewBox="0 0 533.5 544.3">
                            <path fill="#4285F4"
                                d="M533.5 278.4c0-17.4-1.6-34-4.7-50.1H272v95.1h146.9c-6.3 34-25 62.7-53.4 82l86.1 66.8c50.1-46.1 81.9-114 81.9-193.8z" />
                            <path fill="#34A853"
                                d="M272 544.3c72.3 0 132.9-23.9 177.2-64.9 \n                    74.8 477 167.5 544.3 272 544.3z" />
                            <path fill="#FBBC04"
                                d="M121.5 327.7c-10.5-30.9-10.5-64 0-94.9V163.4H30c-30.7 61.3-30.7 134.3 0 195.6l91.5-31.3z" />
                            <path fill="#EA4335"
                                d="M272 107.3c39.3 0 74.6 13.5 102.5 40.1l76.9-76.9C404.9 24.6 344.3 0 272 0 167.5 0 74.8 67.3 30 163.4l91.5 69.4C142.7 154.5 202 107.3 272 107.3z" />
                        </svg>
                    </button>

                    <!-- Apple -->
                    <button
                        class="w-10 h-10 bg-black rounded-full flex items-center justify-center hover:bg-gray-800 transition">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 384 512">
                            <path
                                d="M318.7 268.6c-.3-49.2 40.1-72.8 41.9-74.1-23.2-33.8-59.3-38.5-72.1-39-30.7-3.1-59.8 18.1-75.3 18.1-15.4 0-39.1-17.7-64.3-17.2-33.1.5-63.6 19.2-80.5 48.8-34.3 59.5-8.8 147.3 24.6 195.6 16.3 23.6 35.7 50 61.1 48.9 24.1-1 33.3-15.8 62.3-15.8 29.1 0 37.1 15.8 62.5 15.4 25.9-.4 42.3-24.1 58.3-47.9 18-_R5m 18.3-26.6 25.9-52.3 26.2-53.6-.6-.3-50.2-19.2-50.5-76.2zM254.3 81.6c13.7-16.6 22.9-39.8 20.4-63.1-19.7.8-43.6 13.1-57.6 29.7-12.7 14.7-24 38.2-21 60.5 22 .8 44.5-11.2 58.2-27.1z" />
                        </svg>
                    </button>

                    <!-- Facebook -->
                    <button
                        class="w-10 h-10 bg-[#1877f2] rounded-full flex items-center justify-center hover:bg-[#1567d2] transition">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 320 512">
                            <path
                                d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S270.43 0 241.35 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H89.09V288h31.18v224h92.4V288z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('hideFooter', true)
</DOCUMENT>
