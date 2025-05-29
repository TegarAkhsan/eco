<aside id="sidebar"
    class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-700 rounded-tr-[60px] p-4 flex flex-col justify-between
    transform -translate-x-full transition-transform duration-300 ease-in-out
    sm:translate-x-0 sm:static sm:flex-shrink-0">

    <nav class="mt-10 space-y-5">
        <a
            href="{{ route('admin.dashboard') }}"class="flex items-center gap-3 bg-white text-green-700 rounded-lg px-4 py-3 font-semibold">
            <svg class="w-4 h-4" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 16.5H0V0.5H16V16.5Z" stroke="#E5E7EB" />
                <path
                    d="M14.7063 5.20625C15.0969 4.81563 15.0969 4.18125 14.7063 3.79063C14.3156 3.4 13.6812 3.4 13.2906 3.79063L10 7.08437L8.20625 5.29063C7.81563 4.9 7.18125 4.9 6.79063 5.29063L3.29063 8.79062C2.9 9.18125 2.9 9.81563 3.29063 10.2063C3.68125 10.5969 4.31563 10.5969 4.70625 10.2063L7.5 7.41563L9.29375 9.20938C9.68437 9.6 10.3188 9.6 10.7094 9.20938L14.7094 5.20937L14.7063 5.20625Z"
                    fill="#1E7F55" />
            </svg>
            Dashboard
        </a>

        <a
            href="{{ route('admin.reports') }}"class="flex items-center gap-3 text-white px-4 py-2 hover:text-green-300 transition">
            <svg class="w-3 h-4" viewBox="0 0 12 17" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M2 0.5C0.896875 0.5 0 1.39688 0 2.5V14.5C0 15.6031 0.896875 16.5 2 16.5H10C11.1031 16.5 12 15.6031 12 14.5V5.5H8C7.44688 5.5 7 5.05312 7 4.5V0.5H2Z" />
            </svg>
            Data Laporan
        </a>

        <a
            href="{{ route('admin.dashboard') }}"class="flex items-center gap-3 text-white px-4 py-2 hover:text-green-300 transition">
            <svg class="w-4 h-4" viewBox="0 0 18 16" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 16H0V0H18V16Z" stroke="#E5E7EB" />
                <path d="M12 14.878L6 13.1624V1.12175L12 2.83738V14.878Z" fill="white" />
            </svg>
            EcoTrack Map
        </a>

        <a
            href="{{ route('admin.mitra') }}"class="flex items-center gap-3 text-white px-4 py-2 hover:text-green-300 transition">
            <svg class="w-4 h-4" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M5.459 1.41C6.006 0.53 6.969 0 8 0C9.031 0 9.994 0.531 10.541 1.41L11.747 3.337L12.591 2.85C12.853 2.697 13.181 2.719 13.422 2.903C13.663 3.088 13.769 3.4 13.691 3.694L12.959 6.425C12.853 6.825 12.441 7.063 12.041 6.956L9.309 6.225C9.016 6.147 8.8 5.9 8.759 5.6C8.719 5.3 8.866 5.003 9.128 4.853L10.016 4.341L8.844 2.469C8.662 2.178 8.344 2 8 2C7.656 2 7.338 2.178 7.156 2.469L6.609 3.344C6.322 3.806 5.716 3.953 5.247 3.672C4.769 3.384 4.616 2.759 4.912 2.284L5.459 1.41Z" />
            </svg>
            Mitra Bank Sampah
        </a>

        <a href="{{ route('admin.setting') }}"
            class="flex items-center gap-3 text-white px-4 py-2 rounded-lg hover:text-green-300 transition">
            <svg class="w-4 h-4" fill="white" viewBox="0 0 24 24">
                <path
                    d="M12 14.25A2.25 2.25 0 1 0 12 9.75a2.25 2.25 0 0 0 0 4.5ZM21 12c0-.63-.06-1.24-.17-1.83l2.05-1.6a1 1 0 0 0 .24-1.32l-2-3.46a1 1 0 0 0-1.26-.45l-2.42 1a7.97 7.97 0 0 0-1.96-1.13l-.37-2.6A1 1 0 0 0 14 0h-4a1 1 0 0 0-.99.86l-.37 2.6a8.015 8.015 0 0 0-1.96 1.13l-2.42-1a1 1 0 0 0-1.26.45l-2 3.46a1 1 0 0 0 .24 1.32l2.05 1.6c-.11.59-.17 1.22-.17 1.83s.06 1.24.17 1.83l-2.05 1.6a1 1 0 0 0-.24 1.32l2 3.46a1 1 0 0 0 1.26.45l2.42-1c.57.45 1.21.84 1.96 1.13l.37 2.6A1 1 0 0 0 10 24h4a1 1 0 0 0 .99-.86l.37-2.6a7.97 7.97 0 0 0 1.96-1.13l2.42 1a1 1 0 0 0 1.26-.45l2-3.46a1 1 0 0 0-.24-1.32l-2.05-1.6c.11-.59.17-1.22.17-1.83Z" />
            </svg>
            Setting Akun
        </a>

        <button class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition font-medium">
            Download Data
        </button>
    </nav>
</aside>
