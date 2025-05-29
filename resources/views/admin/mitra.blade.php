@extends('admin.layouts.app') {{-- Ini memberitahu Blade untuk menggunakan app.blade.php sebagai layout --}}

@section('content')
    {{-- Konten di dalam section ini akan dimasukkan ke dalam @yield('content') di app.blade.php --}}
    <section class="p-6">
        <h1 class="text-2xl font-bold text-black mb-6">Daftar Mitra</h1>

        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $mitras = [
                    [
                        'nama' => 'Mitra A',
                        'bidang' => 'Daur Ulang',
                        'logo' => 'logo-mitra1.png',
                        'deskripsi' =>
                            'Mengelola dan mendaur ulang sampah organik & anorganik di wilayah Surabaya Timur.',
                        'proyek' => 5,
                        'wilayah' => 'Surabaya Timur',
                        'status' => 'Aktif',
                        'dokumen' => '#',
                        'id' => 1,
                    ],
                    [
                        'nama' => 'Mitra B',
                        'bidang' => 'Bank Sampah',
                        'logo' => 'logo-mitra2.png',
                        'deskripsi' => 'Mengelola bank sampah digital dan sistem insentif untuk masyarakat.',
                        'proyek' => 3,
                        'wilayah' => 'Gresik & Lamongan',
                        'status' => 'Nonaktif',
                        'dokumen' => '#',
                        'id' => 2,
                    ],
                    [
                        'nama' => 'Mitra C',
                        'bidang' => 'Edukasi Lingkungan',
                        'logo' => 'logo-mitra3.png',
                        'deskripsi' => 'Memberikan edukasi pengelolaan sampah ke sekolah-sekolah dan komunitas lokal.',
                        'proyek' => 2,
                        'wilayah' => 'Sidoarjo',
                        'status' => 'Aktif',
                        'dokumen' => '#',
                        'id' => 3,
                    ],
                ];
            @endphp

            @foreach ($mitras as $mitra)
                <section class="bg-green-700 rounded-xl p-5 shadow hover:shadow-lg transition flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-4 mb-4">
                            <img src="{{ asset('images/' . $mitra['logo']) }}" alt="Logo Mitra"
                                class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h2 class="text-white font-semibold text-lg">{{ $mitra['nama'] }}</h2>
                                <p class="text-sm text-green-100">Bidang: {{ $mitra['bidang'] }}</p>
                            </div>
                        </div>

                        <p class="text-green-100 text-sm mb-4">{{ $mitra['deskripsi'] }}</p>

                        <div class="text-sm text-green-100 space-y-1 mb-4">
                            <div><span class="font-semibold text-white">Proyek:</span> {{ $mitra['proyek'] }} program</div>
                            <div><span class="font-semibold text-white">Wilayah Aktif:</span> {{ $mitra['wilayah'] }}</div>
                            <div>
                                <span class="font-semibold text-white">Status:</span>
                                @if ($mitra['status'] == 'Aktif')
                                    <span
                                        class="inline-block px-2 py-1 bg-green-600 text-white text-xs rounded-full">Aktif</span>
                                @else
                                    <span
                                        class="inline-block px-2 py-1 bg-red-600 text-white text-xs rounded-full">Nonaktif</span>
                                @endif
                            </div>
                            <div>
                                <a href="{{ $mitra['dokumen'] }}" target="_blank"
                                    class="text-green-200 underline text-xs">Lihat Dokumen Kerja Sama</a>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-2">
                        <a href="{{ url('/admin/mitra/' . $mitra['id']) }}"
                            class="px-3 py-1 bg-emerald-800 text-white text-xs rounded hover:bg-emerald-900">Detail</a>
                        <div class="space-x-2">
                            <a href="{{ url('/admin/mitra/' . $mitra['id'] . '/edit') }}"
                                class="px-3 py-1 bg-yellow-500 text-white text-xs rounded hover:bg-yellow-600">Edit</a>
                            <form action="{{ url('/admin/mitra/' . $mitra['id']) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Yakin ingin menghapus mitra ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700">Delete</button>
                            </form>
                        </div>
                    </div>
                </section>
            @endforeach
        </section>
    </section>

    <section class="mt-10 p-6 bg-white rounded-xl shadow-lg">
        <h2 class="text-xl font-bold text-green-900 mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11 17a4 4 0 01-4-4V7a4 4 0 118 0v6a4 4 0 01-4 4zm0 0v4m4-4h3m-14 0h3" />
            </svg>
            Statistik Mitra
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-gradient-to-r from-green-100 to-green-200 p-5 rounded-xl shadow-sm flex items-center space-x-4">
                <div class="bg-green-500 text-white p-3 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 01.88 7.9M12 8v4l3 3M12 19a7 7 0 100-14 7 7 0 000 14z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-green-700">Total Mitra</p>
                    <p class="text-2xl font-bold text-green-900">3</p>
                </div>
            </div>

            <div class="bg-gradient-to-r from-green-100 to-green-200 p-5 rounded-xl shadow-sm flex items-center space-x-4">
                <div class="bg-green-500 text-white p-3 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6h13M3 13l4-4m0 0l4 4m-4-4v12" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-green-700">Proyek Aktif</p>
                    <p class="text-2xl font-bold text-green-900">7</p>
                </div>
            </div>

            <div class="bg-gradient-to-r from-green-100 to-green-200 p-5 rounded-xl shadow-sm flex items-center space-x-4">
                <div class="bg-green-500 text-white p-3 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h12M9 3v2m0 4v10m-4 0h8" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-green-700">Wilayah Terjangkau</p>
                    <p class="text-2xl font-bold text-green-900">3</p>
                </div>
            </div>

            <div class="bg-gradient-to-r from-green-100 to-green-200 p-5 rounded-xl shadow-sm flex items-center space-x-4">
                <div class="bg-green-500 text-white p-3 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 16h8M8 12h8m-8-4h8m-4 12a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-green-700">Dokumen Kerja Sama</p>
                    <p class="text-2xl font-bold text-green-900">3</p>
                </div>
            </div>
        </div>
    </section>


    <section class="mt-10 p-6 bg-green-50 rounded-xl shadow-lg">
        <h2 class="text-xl font-bold text-green-900 mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M7 8h10M7 12h8m-5 8h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
            </svg>
            Feedback Pengguna
        </h2>

        <div class="space-y-4">
            <div class="bg-white border border-green-200 rounded-lg p-4 flex items-start gap-4 shadow-sm">
                <img src="{{ asset('images/user1.png') }}" alt="User" class="w-10 h-10 rounded-full object-cover">
                <div>
                    <p class="text-gray-700 italic">"Mitra A sangat membantu dalam edukasi masyarakat!"</p>
                    <span class="text-xs text-gray-500 block mt-1">— Warga Surabaya</span>
                </div>
            </div>

            <div class="bg-white border border-green-200 rounded-lg p-4 flex items-start gap-4 shadow-sm">
                <img src="{{ asset('images/user2.png') }}" alt="User" class="w-10 h-10 rounded-full object-cover">
                <div>
                    <p class="text-gray-700 italic">"Inovasi bank sampah dari Mitra B membuat lingkungan kami lebih
                        bersih."</p>
                    <span class="text-xs text-gray-500 block mt-1">— Ibu RT Gresik</span>
                </div>
            </div>

            <div class="bg-white border border-green-200 rounded-lg p-4 flex items-start gap-4 shadow-sm">
                <img src="{{ asset('images/user3.png') }}" alt="User" class="w-10 h-10 rounded-full object-cover">
                <div>
                    <p class="text-gray-700 italic">"Senang bisa melihat langsung dampaknya, apalagi ada aplikasi ini!"</p>
                    <span class="text-xs text-gray-500 block mt-1">— Pelajar Sidoarjo</span>
                </div>
            </div>
        </div>
    </section>
@endsection
