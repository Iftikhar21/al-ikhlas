<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#15803d',
                        'primary-dark': '#166534',
                        'accent': '#facc15',
                        'accent-dark': '#eab308',
                    }
                }
            }
        }
    </script>
</head>

<body>
    <div>
        @include('admin/navbar-admin')

        <div class="min-h-screen bg-gray-100">
            <header class="fixed top-0 right-0 left-0 lg:left-80 bg-white border-b border-gray-200 z-30">
                <div class="flex items-center justify-between px-4 lg:px-8 py-4">
                    <!-- Kiri: button + title -->
                    <div class="flex items-center gap-3">
                        <!-- Mobile Menu Button -->
                        <button id="mobileMenuBtn" class="lg:hidden text-slate-900">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <!-- Title -->
                        <h1 class="text-lg font-semibold text-gray-800">
                            @yield('title', 'Dashboard')
                        </h1>
                    </div>

                    <!-- Kanan: user -->
                    <div class="relative">
                        <button id="profileBtn" class="flex items-center gap-2">
                            <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="hidden lg:inline text-sm font-medium text-gray-700">admin (Admin)</span>
                            <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div id="profileDropdown"
                            class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-md hidden z-50">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Pengaturan</a>
                            <form method="POST" action="{{ route('action-logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            <main>
                @yield('content')

                <x-confirm-modal id="globalConfirmModal" title="Hapus Data"
                    message="Apakah Anda yakin ingin menghapus data ini?" confirmText="Ya, Hapus" cancelText="Batal" />

            </main>
        </div>

        @include('admin/footer-admin')
    </div>
    <script>
        const profileBtn = document.getElementById("profileBtn");
        const profileDropdown = document.getElementById("profileDropdown");

        profileBtn.addEventListener("click", () => {
            profileDropdown.classList.toggle("hidden");
        });

        // Klik di luar -> nutup dropdown
        document.addEventListener("click", (e) => {
            if (!profileBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.classList.add("hidden");
            }
        });
    </script>
    <script>
        const sidebar = document.querySelector("aside");
        const mobileMenuBtn = document.getElementById("mobileMenuBtn");
        const overlay = document.getElementById("overlay");

        function toggleSidebar() {
            sidebar.classList.toggle("-translate-x-full");
            overlay.classList.toggle("hidden");
        }

        mobileMenuBtn.addEventListener("click", toggleSidebar);
        overlay.addEventListener("click", toggleSidebar);
    </script>
    <script>
        let confirmCallback = null;

        function openConfirmModal(id, callback, options = {}) {
            const modal = document.getElementById(id);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            confirmCallback = callback;

            // ubah title/message jika ada
            if (options.title) modal.querySelector('h2').textContent = options.title;
            if (options.message) modal.querySelector('p').textContent = options.message;

            // ubah tombol confirm
            const confirmBtn = document.getElementById(id + '-confirm');

            if (options.confirmText) confirmBtn.lastChild.textContent = options.confirmText;

            if (options.confirmColor) {
                // hapus semua class warna default
                confirmBtn.className = confirmBtn.className
                    .replace(/\bbg-[^ ]+\b/g, '') // hapus bg-xxx
                    .replace(/\bhover:bg-[^ ]+\b/g, ''); // hapus hover:bg-xxx
                confirmBtn.classList.add(...options.confirmColor.split(' '));
            }

            if (options.confirmIcon) {
                confirmBtn.querySelector('i').setAttribute('data-lucide', options.confirmIcon);
                lucide.createIcons(); // update icon
            }

            confirmBtn.onclick = function () {
                if (confirmCallback) confirmCallback();
                closeConfirmModal(id);
            };
        }

        function closeConfirmModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.getElementById(id).classList.remove('flex');
        }
    </script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>