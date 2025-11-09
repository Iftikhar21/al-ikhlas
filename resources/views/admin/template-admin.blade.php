<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    @vite('resources/css/app.css')
    <link rel="icon" type="image/png" href="{{ asset('img/al_ikhlas_logo.jpg') }}">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        /* Umum */
        .mobile-fix {
            overflow-x: hidden;
        }

        .content-container {
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        * {
            max-width: 100%;
        }

        .table-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* ✅ Fix tampilan dropdown profil */
        #profileDropdown {
            position: absolute;
            right: 0;
            top: 110%;
            width: 180px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            z-index: 50;
            transition: all 0.2s ease-in-out;
        }

        #profileDropdown button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            width: 100%;
            text-align: left;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            color: #374151;
            transition: background 0.2s ease, color 0.2s ease;
        }

        #profileDropdown button:hover {
            background-color: #f3f4f6;
            color: #111827;
        }

        #profileDropdown i {
            width: 1rem;
            height: 1rem;
            color: #6b7280;
        }

        /* ✨ Fix posisi & tampilan di mobile */
        @media (max-width: 768px) {
            #profileDropdown {
                position: fixed !important;
                right: 1rem;
                top: 4.25rem;
                width: 160px;
                z-index: 9999;
            }

            #profileDropdown button {
                padding: 0.75rem;
                font-size: 0.85rem;
            }
        }
    </style>

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

<body class="mobile-fix">
    <div class="mobile-fix">
        @include('admin/navbar-admin')

        <div class="min-h-screen bg-gray-100 mobile-fix">
            <header class="fixed top-0 right-0 left-0 lg:left-80 bg-white border-b border-gray-200 z-30">
                <div class="flex items-center justify-between px-4 lg:px-8 py-4 content-container">
                    <!-- Kiri -->
                    <div class="flex items-center gap-3">
                        <button id="mobileMenuBtn" class="lg:hidden text-slate-900">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <h1 class="text-lg font-semibold text-gray-800 truncate max-w-[150px] lg:max-w-none">
                            @yield('title', 'Dashboard')
                        </h1>
                    </div>

                    <!-- Kanan -->
                    <div class="relative">
                        <button id="profileBtn" class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 lg:w-10 lg:h-10 bg-gray-200 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 lg:w-6 lg:h-6 text-gray-600" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="hidden lg:inline text-sm font-medium text-gray-700 truncate max-w-[100px]">
                                {{ Auth::user()->name ?? 'Unknown' }}
                            </span>
                            <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- ✅ Dropdown rapi -->
                        <div id="profileDropdown" class="hidden">
                            <form method="POST" action="{{ route('action-logout') }}">
                                @csrf
                                <button type="submit">
                                    <i data-lucide="log-out"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="content-container">
                <div>@yield('content')</div>
                <x-confirm-modal id="globalConfirmModal" title="Hapus Data"
                    message="Apakah Anda yakin ingin menghapus data ini?" confirmText="Ya, Hapus" cancelText="Batal" />
            </main>
        </div>

        @include('admin/footer-admin')
    </div>

    <script>
        const profileBtn = document.getElementById("profileBtn");
        const profileDropdown = document.getElementById("profileDropdown");

        profileBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            profileDropdown.classList.toggle("hidden");
        });

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
            document.body.classList.toggle('overflow-hidden');
        }

        mobileMenuBtn.addEventListener("click", toggleSidebar);
        if (overlay) overlay.addEventListener("click", toggleSidebar);
    </script>

    <script>
        lucide.createIcons();

        document.addEventListener('DOMContentLoaded', function () {
            document.body.style.overflowX = 'hidden';
            function setVH() {
                let vh = window.innerHeight * 0.01;
                document.documentElement.style.setProperty('--vh', `${vh}px`);
            }
            setVH();
            window.addEventListener('resize', setVH);
        });
    </script>

    <!-- template-admin.blade.php -->
    <script>
        // Global Modal Functions - Available in all admin pages
        function openConfirmModal(modalId, confirmCallback, options = {}) {
            const modal = document.getElementById(modalId);
            if (!modal) {
                console.error('Modal not found:', modalId);
                return;
            }

            // Set modal content based on options
            if (options.title) {
                const titleElement = modal.querySelector('h2');
                if (titleElement) titleElement.textContent = options.title;
            }

            if (options.message) {
                const messageElement = modal.querySelector('p');
                if (messageElement) messageElement.textContent = options.message;
            }

            if (options.confirmText) {
                const confirmBtn = modal.querySelector(`#${modalId}-confirm`);
                if (confirmBtn) {
                    const icon = confirmBtn.querySelector('i');
                    const textSpan = confirmBtn.querySelector('span:last-child') || document.createElement('span');

                    if (!textSpan.parentNode) {
                        confirmBtn.innerHTML = '';
                        if (icon) confirmBtn.appendChild(icon);
                        confirmBtn.appendChild(textSpan);
                    }

                    textSpan.textContent = options.confirmText;
                }
            }

            if (options.confirmColor) {
                const confirmBtn = modal.querySelector(`#${modalId}-confirm`);
                if (confirmBtn) {
                    // Remove existing color classes
                    confirmBtn.className = confirmBtn.className.replace(/bg-\w+-\d+ hover:bg-\w+-\d+/g, '');
                    // Add new color classes
                    confirmBtn.classList.add(...options.confirmColor.split(' '));
                }
            }

            if (options.confirmIcon) {
                const confirmBtn = modal.querySelector(`#${modalId}-confirm`);
                if (confirmBtn) {
                    // 🧹 Hapus SVG hasil render sebelumnya (biar gak dobel)
                    confirmBtn.querySelectorAll('svg').forEach(svg => svg.remove());

                    // 🔄 Cek kalau belum ada <i data-lucide>
                    let icon = confirmBtn.querySelector('i[data-lucide]');
                    if (!icon) {
                        icon = document.createElement('i');
                        confirmBtn.prepend(icon);
                    }

                    // 🔁 Set ikon baru
                    icon.setAttribute('data-lucide', options.confirmIcon);

                    // 🎯 Render ulang hanya dalam tombol ini
                    lucide.createIcons({
                        icons: lucide.icons, // pakai semua ikon default
                        attrs: {},
                        nameAttr: 'data-lucide',
                    });

                    // Pastikan ikon tampil di depan teks
                    confirmBtn.prepend(icon);
                }
            }

            // Set confirm action
            const confirmBtn = modal.querySelector(`#${modalId}-confirm`);
            if (confirmBtn) {
                confirmBtn.onclick = function () {
                    if (typeof confirmCallback === 'function') {
                        confirmCallback();
                    }
                    closeConfirmModal(modalId);
                };
            }

            // Show modal
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeConfirmModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }

        // Close modal when clicking outside
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('backdrop-blur-sm') ||
                e.target.classList.contains('bg-opacity-30')) {
                const modals = document.querySelectorAll('[id$="ConfirmModal"]');
                modals.forEach(modal => {
                    if (!modal.classList.contains('hidden')) {
                        const modalId = modal.id;
                        closeConfirmModal(modalId);
                    }
                });
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                const modals = document.querySelectorAll('[id$="ConfirmModal"]');
                modals.forEach(modal => {
                    if (!modal.classList.contains('hidden')) {
                        const modalId = modal.id;
                        closeConfirmModal(modalId);
                    }
                });
            }
        });
    </script>
</body>

</html>