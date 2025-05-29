@extends('layouts.app')
@section('hideNavbar', true)
@section('content')
    <div class="w-full h-screen relative bg-[#111827] overflow-hidden">
        <!-- Back Button SVG -->
        <a href="{{ route('home') }}"
            class="absolute left-4 top-4 flex items-center gap-2 px-4 py-2 rounded-full bg-gray-800 hover:bg-gray-700 text-white transition duration-300 shadow">
            <!-- Ikon panah kiri -->
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M15.707 17.707C16.098 17.316 16.098 16.684 15.707 16.293L11.414 12L15.707 7.707C16.098 7.316 16.098 6.684 15.707 6.293C15.316 5.902 14.684 5.902 14.293 6.293L9.293 11.293C8.902 11.684 8.902 12.316 9.293 12.707L14.293 17.707C14.684 18.098 15.316 18.098 15.707 17.707Z"
                    fill="currentColor" />
            </svg>
            <!-- Teks Back -->
            <span class="text-sm font-medium">Back</span>
        </a>

        <!-- Decorative Ellipses -->
        <div
            class="absolute w-[292px] h-[292px] left-[-145px] top-[-89px] bg-gradient-to-b from-[#3fa8df] to-[#a30c74] rounded-full blur-[100px]">
        </div>
        <div
            class="absolute w-[292px] h-[292px] left-[1220px] top-[874px] bg-gradient-to-b from-[#3fa8df] to-[#a30c74] rounded-full blur-[100px]">
        </div>

        <!-- Side Earth Image -->
        <img class="absolute right-0 opacity-20" style="transform: scaleX(-1); top: -300px;"
            src="{{ asset('images/Earth Side.png') }}" alt="Side Earth">

        <!-- Title and Description Section -->
        <div class="absolute right-0 top-1/2 transform -translate-y-1/2 flex flex-col items-end pr-10 w-[512px]">
            <div class="text-emerald-400 text-base font-semibold leading-none tracking-wide">JOIN ECO TRACK FOR FREE</div>
            <div class="mt-6 text-white text-6xl font-bold leading-[48px] text-right">Help Shape a Cleaner Future</div>
            <div class="mt-6 w-[403px] text-gray-200 text-xl font-normal leading-[18px] text-right">
                Join thousands of environmental champions making a real difference. Track, reduce, and optimize your carbon
                footprint with our innovative platform.
            </div>
        </div>

        <!-- Login Form -->
        <div
            class="absolute w-[360px] h-[630px] left-[300px] top-[60px] bg-[#1e2538] rounded-2xl shadow-[0px_20px_25px_0px_rgba(0,0,0,0.10),0px_8px_10px_0px_rgba(0,0,0,0.10)]">
            <h2 class="absolute left-[24px] top-[24px] text-white text-xl font-bold font-poppins">Sign In to Your Account
            </h2>

            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="text-center text-green-500 text-sm mt-3">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="text-center text-red-500 text-sm mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="absolute w-[304px] left-[24px] top-[72px]">
                @csrf
                <!-- Email Field -->
                <div class="mb-[20px]">
                    <label for="email" class="block text-white text-sm font-normal mb-[6px]">Email Address</label>
                    <div class="relative">
                        <input type="email" id="email" name="email" required placeholder="Enter your email"
                            value="{{ old('email') }}"
                            class="w-full h-[44px] pl-[14px] pr-4 py-2 bg-[#1e2538] rounded-[8px] outline outline-1 outline-[#2e3a59] text-[#adaebc] text-sm font-normal leading-normal focus:outline-none focus:ring-2 focus:ring-[#2553a1]">
                    </div>
                </div>

                <!-- Password Field -->
                <div class="mb-[20px]">
                    <label for="password" class="block text-white text-sm font-normal mb-[6px]">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required placeholder="Enter your password"
                            class="w-full h-[44px] pl-[40px] pr-4 py-2 bg-[#1e2538] rounded-[8px] outline outline-1 outline-[#2e3a59] text-[#adaebc] text-sm font-normal leading-normal focus:outline-none focus:ring-2 focus:ring-[#2553a1]">
                        <!-- Eye Icon for Password Visibility -->
                        <button type="button" id="togglePassword" onclick="togglePassword()"
                            class="absolute right-[12px] top-[13px] w-4 h-4 text-gray-400 focus:outline-none">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Forgot Password Link -->
                <div class="text-right mb-[16px]">
                    <a href="#" class="text-[#2553a1] text-sm font-normal leading-[14px] hover:underline">Forgot
                        Password?</a>
                </div>

                <!-- Log In Button -->
                <button type="submit"
                    class="w-full h-11 bg-[#2553a1] text-white text-sm font-normal rounded-[8px] hover:bg-[#1e4687] transition duration-300">Log
                    In
                </button>

                <!-- Or Continue With Divider -->
                <div class="relative my-[20px]">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-2 bg-[#1e2538] text-[#adaebc] text-sm">Or continue with</span>
                    </div>
                </div>

                <!-- Social Login Buttons -->
                <div class="space-y-[10px] mb-[60px]">
                    <!-- Google Button -->
                    <button
                        class="w-full h-11 bg-white text-gray-800 text-sm font-normal rounded-[8px] flex items-center justify-center space-x-2 hover:bg-gray-100 transition duration-300">
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.8281 8.18125C15.8281 12.6031 12.8 15.75 8.32812 15.75C4.04063 15.75 0.578125 12.2875 0.578125 8C0.578125 3.7125 4.04063 0.25 8.32812 0.25C10.4156 0.25 12.1719 1.01562 13.525 2.27813L11.4156 4.30625C8.65625 1.64375 3.525 3.64375 3.525 8C3.525 10.7031 5.68437 12.8938 8.32812 12.8938C11.3969 12.8938 12.5469 10.6938 12.7281 9.55313H8.32812V6.8875H15.7063C15.7781 7.28437 15.8281 7.66562 15.8281 8.18125Z"
                                fill="#1F2937" />
                        </svg>
                        <span>Continue with Google</span>
                    </button>

                    <!-- Apple Button -->
                    <button
                        class="w-full h-11 bg-black text-white text-sm font-normal rounded-[8px] flex items-center justify-center space-x-2 hover:bg-gray-900 transition duration-300">
                        <svg width="12" height="14" viewBox="0 0 13 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.5531 8.39688C10.5469 7.25 11.0656 6.38437 12.1156 5.74687C11.5281 4.90625 10.6406 4.44375 9.46875 4.35313C8.35938 4.26562 7.14687 5 6.70312 5C6.23438 5 5.15938 4.38438 4.31562 4.38438C2.57187 4.4125 0.71875 5.775 0.71875 8.54688C0.71875 9.36563 0.86875 10.2115 1.16875 11.0844C1.56875 12.2313 3.0125 15.0437 4.51875 14.9969C5.30625 14.9781 5.8625 14.4375 6.8875 14.4375C7.88125 14.4375 8.39687 14.9969 9.275 14.9969C10.7937 14.975 12.1 12.4187 12.4812 11.2688C10.4438 10.3094 10.5531 8.45625 10.5531 8.39688ZM8.78438 3.26562C9.6375 2.25312 9.55937 1.33125 9.53438 1C8.78125 1.04375 7.90937 1.5125 7.4125 2.09063C6.86562 2.70938 6.54375 3.475 6.6125 4.3375C7.42813 4.4 8.17188 3.98125 8.78438 3.26562Z"
                                fill="white" />
                        </svg>
                        <span>Continue with Apple</span>
                    </button>

                    <!-- Facebook Button -->
                    <button
                        class="w-full h-11 bg-[#1877f2] text-white text-sm font-normal rounded-[8px] flex items-center justify-center space-x-2 hover:bg-[#1567d2] transition duration-300">
                        <svg width="15" height="14" viewBox="0 0 17 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.4688 8C16.4688 3.71875 13 0.25 8.71875 0.25C4.4375 0.25 0.96875 3.71875 0.96875 8C0.96875 11.8681 3.80281 15.0744 7.50781 15.6562V10.2403H5.53906V8H7.50781V6.2925C7.50781 4.35031 8.66406 3.2775 10.435 3.2775C11.2831 3.2775 12.17 3.42875 12.17 3.42875V5.335H11.1925C10.23 5.335 9.92969 5.9325 9.92969 6.54531V8H12.0791L11.7353 10.2403H9.92969V15.6562C13.6347 15.0744 16.4688 11.8681 16.4688 8Z"
                                fill="white" />
                        </svg>
                        <span>Continue with Facebook</span>
                    </button>
                </div>

                <!-- Sign Up Prompt -->
                <div class="absolute bottom-[16px] w-full text-center">
                    <span class="text-gray-400 text-sm font-normal leading-none font-poppins">Don't have an account?</span>
                    <a href="{{ route('signup') }}" class="text-[#2553a1] text-sm font-normal leading-none hover:underline">
                        Sign Up</a>
                </div>
            </form>

            <script>
                function togglePassword() {
                    const passwordInput = document.getElementById('password');
                    const eyeIcon = document.getElementById('eyeIcon');
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        eyeIcon.setAttribute('stroke', '#4ade80');
                    } else {
                        passwordInput.type = 'password';
                        eyeIcon.setAttribute('stroke', 'currentColor');
                    }
                }
            </script>
        </div>

    </div>
@endsection
@section('hideFooter', true)
