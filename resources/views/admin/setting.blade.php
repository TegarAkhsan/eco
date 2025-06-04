@extends('admin.layouts.app') {{-- Ini memberitahu Blade untuk menggunakan app.blade.php sebagai layout --}}

@section('content')
    {{-- Konten di dalam section ini akan dimasukkan ke dalam @yield('content') di app.blade.php --}}
    <div class="mb-10">
        <h1 class="text-4xl font-extrabold text-black">Account Settings</h1>
        <p class="text-black mt-2">Manage your personal information and account security</p>
    </div>

    <div class="mb-6">
        <label class="block text-sm text-black mb-2">Username</label>
        <div class="flex items-center bg-[#1a2e21] rounded-xl border border-green-700 p-3">
            <svg class="w-5 h-5 mr-2 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 0114 0H3z" />
            </svg>
            <span class="text-white font-medium">YourUsername</span>
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-6 mb-6">
        <div class="w-full md:w-1/2">
            <label class="block text-sm text-black mb-2">First Name</label>
            <input type="text"
                class="w-full bg-[#1a2e21] rounded-xl border border-green-700 p-3 text-white placeholder:text-gray-400"
                placeholder="First Name">
        </div>
        <div class="w-full md:w-1/2">
            <label class="block text-sm text-black mb-2">Last Name</label>
            <input type="text"
                class="w-full bg-[#1a2e21] rounded-xl border border-green-700 p-3 text-white placeholder:text-gray-400"
                placeholder="Last Name">
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-6 mb-6">
        <div class="w-full md:w-1/2">
            <label class="block text-sm text-black mb-2">Email</label>
            <input type="email"
                class="w-full bg-[#1a2e21] rounded-xl border border-green-700 p-3 text-white placeholder:text-gray-400"
                placeholder="email@example.com">
        </div>
        <div class="w-full md:w-1/2">
            <label class="block text-sm text-black mb-2">Phone Number</label>
            <input type="text"
                class="w-full bg-[#1a2e21] rounded-xl border border-green-700 p-3 text-white placeholder:text-gray-400"
                placeholder="+62 812 3456 7890">
        </div>
    </div>
@endsection
