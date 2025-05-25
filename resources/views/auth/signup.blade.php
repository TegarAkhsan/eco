@extends('layouts.app')
@section('hideNavbar', true)
@section('content')
    <div class="h-[1024px] relative bg-[#111827] overflow-hidden font-['Poppins']">
        <!-- Decorative Ellipses -->
        <div
            class="absolute w-72 h-72 left-[-47px] top-[900px] bg-gradient-to-b from-sky-400 to-pink-700 rounded-full blur-[100px]">
        </div>
        <div
            class="absolute w-72 h-72 left-[calc(100%-192px)] top-[-89px] bg-gradient-to-b from-sky-400 to-pink-700 rounded-full blur-[100px]">
        </div>

        <!-- Earth Image -->
        <img class="absolute left-0 opacity-20" style="transform: scaleX(1); top: -300px;"
            src="{{ asset('images/Earth Side.png') }}" alt="Side Earth">

        <!-- Title and Description Section -->
        <div class="absolute w-[512px] h-[320px] left-[73px] top-[356px]">
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
            class="absolute w-[448px] h-[700px] right-[400px] top-[100px] bg-[#1e2538] rounded-2xl shadow-[0px_20px_25px_0px_rgba(0,0,0,0.10),0px_8px_10px_0px_rgba(0,0,0,0.10)]">
            <!-- Form Title -->
            <h2 class="text-center text-white text-2xl font-bold font-poppins mt-6">Create new account</h2>

            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="text-center text-green-500 text-sm mt-4">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="text-center text-red-500 text-sm mt-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('signup') }}" method="POST" class="absolute w-96 left-[32px] top-[94.29px]">
                @csrf

                <!-- Username -->
                <div class="relative w-96 h-12 mb-6">
                    <input type="text" id="username" name="username" required placeholder="Username"
                        value="{{ old('username') }}"
                        class="w-full h-full pl-12 pr-4 py-2 bg-[#1A1F2E] rounded-xl outline outline-1 outline-[#2E3A59] placeholder:text-gray-500 text-gray-300 text-base focus:outline-none focus:ring-2 focus:ring-[#367AEC] transition duration-150">
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 14 16">
                            <rect width="14" height="14" rx="7" fill="#9CA3AF" />
                        </svg>
                    </div>
                </div>

                <!-- First Name and Last Name -->
                <div class="flex gap-6 mb-6">
                    <div class="relative w-[184px] h-12">
                        <input type="text" id="first_name" name="first_name" required placeholder="First Name"
                            value="{{ old('first_name') }}"
                            class="w-full h-full pl-4 pr-4 py-2 bg-[#1A1F2E] rounded-xl outline outline-1 outline-[#2E3A59] placeholder:text-gray-500 text-gray-300 text-base focus:outline-none focus:ring-2 focus:ring-[#367AEC] transition duration-150">
                    </div>
                    <div class="relative w-[184px] h-12">
                        <input type="text" id="last_name" name="last_name" required placeholder="Last Name"
                            value="{{ old('last_name') }}"
                            class="w-full h-full pl-4 pr-4 py-2 bg-[#1A1F2E] rounded-xl outline outline-1 outline-[#2E3A59] placeholder:text-gray-500 text-gray-300 text-base focus:outline-none focus:ring-2 focus:ring-[#367AEC] transition duration-150">
                    </div>
                </div>

                <!-- Email -->
                <div class="relative w-96 h-12 mb-6">
                    <input type="email" id="email" name="email" required placeholder="Email"
                        value="{{ old('email') }}"
                        class="w-full h-full pl-12 pr-4 py-2 bg-[#1A1F2E] rounded-xl outline outline-1 outline-[#2E3A59] placeholder:text-gray-500 text-gray-300 text-base focus:outline-none focus:ring-2 focus:ring-[#367AEC] transition duration-150">
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M0 4l8 5 8-5v8H0V4z" />
                        </svg>
                    </div>
                </div>

                <!-- Password -->
                <div class="relative w-96 h-12 mb-6">
                    <input type="password" id="password" name="password" required placeholder="Password"
                        class="w-full h-full pl-12 pr-4 py-2 bg-[#1A1F2E] rounded-xl outline outline-1 outline-[#2E3A59] placeholder:text-gray-500 text-gray-300 text-base focus:outline-none focus:ring-2 focus:ring-[#367AEC] transition duration-150">
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 17a2 2 0 100-4 2 2 0 000 4zM6 9V7a6 6 0 0112 0v2a2 2 0 012 2v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5a2 2 0 012-2z" />
                        </svg>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="relative w-96 h-12 mb-6">
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        placeholder="Confirm Password"
                        class="w-full h-full pl-12 pr-4 py-2 bg-[#1A1F2E] rounded-xl outline outline-1 outline-[#2E3A59] placeholder:text-gray-500 text-gray-300 text-base focus:outline-none focus:ring-2 focus:ring-[#367AEC] transition duration-150">
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 17a2 2 0 100-4 2 2 0 000 4zM6 9V7a6 6 0 0112 0v2a2 2 0 012 2v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5a2 2 0 012-2z" />
                        </svg>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full h-12 bg-[#367AEC] rounded-xl text-white text-lg font-semibold hover:bg-[#2a5ccd] transition duration-200">
                    Sign Up
                </button>

                <!-- Link to Login -->
                <p class="text-center text-gray-400 text-sm mt-4">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-[#367AEC] hover:underline">Sign in</a>
                </p>

                <!-- Or Continue With Divider -->
                <div class="relative my-[24px]">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-2 bg-[#1e2538] text-[#adaebc] text-sm">Or continue with</span>
                    </div>
                </div>

                <!-- Social Login Buttons (Smaller & Inline) -->
                <div class="flex justify-center items-center space-x-4 mb-[24px]">
                    <!-- Google Button -->
                    <button
                        class="w-12 h-12 bg-white rounded-full flex items-center justify-center hover:bg-gray-100 transition duration-300">
                        <svg width="20" height="20" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.8281 8.18125C15.8281 12.6031 12.8 15.75 8.32812 15.75C4.04063 15.75 0.578125 12.2875 0.578125 8C0.578125 3.7125 4.04063 0.25 8.32812 0.25C10.4156 0.25 12.1719 1.01562 13.525 2.27813L11.4156 4.30625C8.65625 1.64375 3.525 3.64375 3.525 8C3.525 10.7031 5.68437 12.8938 8.32812 12.8938C11.3969 12.8938 12.5469 10.6938 12.7281 9.55313H8.32812V6.8875H15.7063C15.7781 7.28437 15.8281 7.66562 15.8281 8.18125Z"
                                fill="#1F2937" />
                        </svg>
                    </button>

                    <!-- Apple Button -->
                    <button
                        class="w-12 h-12 bg-black rounded-full flex items-center justify-center hover:bg-gray-900 transition duration-300">
                        <svg width="16" height="20" viewBox="0 0 13 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.5531 8.39688C10.5469 7.25 11.0656 6.38437 12.1156 5.74687C11.5281 4.90625 10.6406 4.44375 9.46875 4.35313C8.35938 4.26562 7.14687 5 6.70312 5C6.23438 5 5.15938 4.38438 4.31562 4.38438C2.57187 4.4125 0.71875 5.775 0.71875 8.54688C0.71875 9.36563 0.86875 10.2115 1.16875 11.0844C1.56875 12.2313 3.0125 15.0437 4.51875 14.9969C5.30625 14.9781 5.8625 14.4375 6.8875 14.4375C7.88125 14.4375 8.39687 14.9969 9.275 14.9969C10.7937 14.975 12.1 12.4187 12.4812 11.2688C10.4438 10.3094 10.5531 8.45625 10.5531 8.39688ZM8.78438 3.26562C9.6375 2.25312 9.55937 1.33125 9.53438 1C8.78125 1.04375 7.90937 1.5125 7.4125 2.09063C6.86562 2.70938 6.54375 3.475 6.6125 4.3375C7.42813 4.4 8.17188 3.98125 8.78438 3.26562Z"
                                fill="white" />
                        </svg>
                    </button>

                    <!-- Facebook Button -->
                    <button
                        class="w-12 h-12 bg-[#1877f2] rounded-full flex items-center justify-center hover:bg-[#1567d2] transition duration-300">
                        <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.4688 8C16.4688 3.71875 13 0.25 8.71875 0.25C4.4375 0.25 0.96875 3.71875 0.96875 8C0.96875 11.8681 3.80281 15.0744 7.50781 15.6562V10.2403H5.53906V8H7.50781V6.2925C7.50781 4.35031 8.66406 3.2775 10.435 3.2775C11.2831 3.2775 12.17 3.42875 12.17 3.42875V5.335H11.1925C10.23 5.335 9.92969 5.9325 9.92969 6.54531V8H12.0791L11.7353 10.2403H9.92969V15.6562C13.6347 15.0744 16.4688 11.8681 16.4688 8Z"
                                fill="white" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('hideFooter', true)
