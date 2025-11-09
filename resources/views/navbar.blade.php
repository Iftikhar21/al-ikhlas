<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-12 h-12">
                    <img src="{{ asset('img/al_ikhlas_logo.jpg') }}" alt="Logo Masjid Al-Ikhlas"
                        class="w-full h-full object-contain">
                </div>
                <div>
                    <span class="font-semibold text-emerald-900 text-sm md:text-base">Masjid Al-Ikhlas Dalang</span>
                </div>
            </div>

            @php
                $menus = [
                    ['route' => 'home', 'label' => 'Beranda'],

                    // 🕌 MASJID
                    [
                        'dropdown' => true,
                        'label' => 'Masjid',
                        'items' => [
                            ['route' => 'masjid.sejarah', 'label' => 'Sejarah'],
                            ['route' => 'masjid.struktur', 'label' => 'Struktur Kepengurusan'],
                            ['route' => 'masjid.visimisi', 'label' => 'Visi & Misi'],
                            ['route' => 'masjid.kajian', 'label' => 'Kajian'],
                        ]
                    ],

                    // 🏫 TPA
                    [
                        'dropdown' => true,
                        'label' => 'TPA',
                        'items' => [
                            ['route' => 'tpa.history', 'label' => 'Sejarah'],
                            ['route' => 'tpa.structure', 'label' => 'Struktur Kepengurusan'],
                            ['route' => 'tpa.visimisi', 'label' => 'Visi & Misi'],
                            ['route' => 'tpa.teachers', 'label' => 'Profil Pengajar'],
                            ['route' => 'tpa.schedule', 'label' => 'Jadwal'],
                            ['route' => 'tpa.register', 'label' => 'Pendaftaran'],
                        ]
                    ],

                    // 💼 KOPERASI
                    [
                        'dropdown' => true,
                        'label' => 'Koperasi',
                        'items' => [
                            ['route' => 'koperasi.sejarah', 'label' => 'Sejarah'],
                            ['route' => 'koperasi.struktur', 'label' => 'Struktur Kepengurusan'],
                            ['route' => 'koperasi.visimisi', 'label' => 'Visi & Misi'],
                            ['route' => 'koperasi.kegiatan', 'label' => 'Kegiatan'],
                        ]
                    ],

                    // 🌐 Global
                    ['route' => 'news', 'label' => 'Berita'],
                    ['route' => 'contact', 'label' => 'Kontak'],
                ];

                // Function to check if any submenu is active
                function isSubmenuActive($items)
                {
                    foreach ($items as $submenu) {
                        if (request()->routeIs($submenu['route'])) {
                            return true;
                        }
                    }
                    return false;
                }
            @endphp

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-4">
                @foreach ($menus as $menu)
                    @if (isset($menu['dropdown']) && $menu['dropdown'])
                        @php
                            $routes = collect($menu['items'])->pluck('route')->toArray();
                            $isActive = request()->routeIs($routes);
                        @endphp

                        <div class="relative group">
                            <button class="flex items-center gap-1 relative px-3 py-2 text-sm font-medium transition-colors
                                                {{ $isActive ? 'text-green-700 after:scale-x-100' : 'text-gray-600 hover:text-primary hover:after:scale-x-100' }}
                                                after:content-[''] after:absolute after:left-0 after:bottom-0 
                                                after:w-full after:h-[2px] after:bg-green-700
                                                after:origin-center after:scale-x-0 
                                                after:transition-transform after:duration-300">
                                {{ $menu['label'] }}
                                <svg class="w-4 h-4 {{ $isActive ? 'text-green-700 rotate-180' : 'text-gray-500 group-hover:text-primary' }} transition-transform duration-200"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div class="absolute pt-2 top-full left-0 hidden group-hover:block bg-transparent z-50">
                                <div class="bg-white shadow-lg rounded-lg w-56 border border-gray-100">
                                    @foreach ($menu['items'] as $submenu)
                                                    <a href="{{ route($submenu['route']) }}"
                                                        class="block px-4 py-2 text-sm 
                                                                                            {{ request()->routeIs($submenu['route'])
                                        ? 'bg-green-50 text-green-700 font-medium'
                                        : 'text-gray-700 hover:bg-green-50 hover:text-green-700' }}
                                                                                            transition-colors first:rounded-t-lg last:rounded-b-lg">
                                                        {{ $submenu['label'] }}
                                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                            <a href="{{ route($menu['route']) }}" class="relative px-3 py-2 text-sm font-medium transition-colors
                                                    {{ request()->routeIs($menu['route'])
                        ? 'text-primary after:scale-x-100'
                        : 'text-gray-600 hover:text-primary hover:after:scale-x-100' }}
                                                    after:content-[''] after:absolute after:left-0 after:bottom-0 
                                                    after:w-full after:h-[2px] after:bg-green-700
                                                    after:origin-center after:scale-x-0 
                                                    after:transition-transform after:duration-300">
                                {{ $menu['label'] }}
                            </a>
                    @endif
                @endforeach

                <!-- 🔐 Login / Dashboard Button -->
                @guest
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm font-medium bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        Login
                    </a>
                @else
                    <a href="{{ route('admin.dashboard') }}"
                        class="px-4 py-2 text-sm font-medium bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        Dashboard
                    </a>
                @endguest
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button class="text-gray-600 hover:text-primary p-2" onclick="toggleMobileMenu()">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden pb-4">
            <div class="flex flex-col space-y-2">
                @foreach ($menus as $menu)
                    @if (isset($menu['dropdown']) && $menu['dropdown'])
                            @php
                                $isParentActive = isSubmenuActive($menu['items']);
                                $hasActiveChild = false;
                            @endphp
                            <div>
                                <button onclick="toggleSubmenu(this)" class="flex justify-between items-center w-full px-3 py-2 text-sm font-medium rounded-lg transition-colors
                                                    {{ $isParentActive
                        ? 'bg-green-50 text-green-700 border border-green-200'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-green-700' }}">
                                    <span class="flex items-center gap-2">
                                        {{ $menu['label'] }}
                                        @if($isParentActive)
                                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                        @endif
                                    </span>
                                    <svg class="submenu-arrow w-4 h-4 transform transition-transform duration-200 
                                                        {{ $isParentActive ? 'text-green-700 rotate-180' : 'text-gray-500' }}"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="submenu flex flex-col pl-4 space-y-1 mt-1 
                                                    {{ $isParentActive ? 'block' : 'hidden' }}">
                                    @foreach ($menu['items'] as $submenu)
                                                <a href="{{ route($submenu['route']) }}" class="px-3 py-2 text-sm rounded-lg transition-colors
                                                                       {{ request()->routeIs($submenu['route'])
                                        ? 'bg-green-100 text-green-700 font-medium border border-green-200'
                                        : 'text-gray-600 hover:bg-green-50 hover:text-green-700' }}">
                                                    <span class="flex items-center gap-2">
                                                        {{ $submenu['label'] }}
                                                        @if(request()->routeIs($submenu['route']))
                                                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                                        @endif
                                                    </span>
                                                </a>
                                    @endforeach
                                </div>
                            </div>
                    @else
                            <a href="{{ route($menu['route']) }}" class="flex items-center gap-2 px-3 py-2 text-sm font-medium transition-colors rounded-lg
                                                {{ request()->routeIs($menu['route'])
                        ? 'bg-green-50 text-green-700 border border-green-200'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-green-700' }}">
                                {{ $menu['label'] }}
                                @if(request()->routeIs($menu['route']))
                                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                @endif
                            </a>
                    @endif
                @endforeach

                <!-- 🔐 Login / Dashboard Button (Mobile) -->
                @guest
                    <a href="{{ route('login') }}"
                        class="px-3 py-2 text-sm font-medium bg-green-600 text-white rounded-lg text-center hover:bg-green-700 transition-colors">
                        Login
                    </a>
                @else
                    <a href="{{ route('admin.dashboard') }}"
                        class="px-3 py-2 text-sm font-medium bg-green-600 text-white rounded-lg text-center hover:bg-green-700 transition-colors">
                        Dashboard
                    </a>
                @endguest
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');

        // Close all submenus when closing mobile menu
        if (mobileMenu.classList.contains('hidden')) {
            const submenus = mobileMenu.querySelectorAll('.submenu');
            const arrows = mobileMenu.querySelectorAll('.submenu-arrow');

            submenus.forEach(submenu => {
                if (!submenu.classList.contains('block')) { // Don't close active submenus
                    submenu.classList.add('hidden');
                }
            });

            arrows.forEach(arrow => {
                if (!arrow.classList.contains('rotate-180')) { // Don't reset active arrows
                    arrow.classList.remove('rotate-180');
                }
            });
        }
    }

    function toggleSubmenu(btn) {
        const submenu = btn.nextElementSibling;
        const arrow = btn.querySelector('.submenu-arrow');

        submenu.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');

        // Close other submenus when opening a new one
        if (!submenu.classList.contains('hidden')) {
            const allSubmenus = document.querySelectorAll('.submenu');
            const allArrows = document.querySelectorAll('.submenu-arrow');

            allSubmenus.forEach(otherSubmenu => {
                if (otherSubmenu !== submenu && !otherSubmenu.classList.contains('block')) {
                    otherSubmenu.classList.add('hidden');
                }
            });

            allArrows.forEach(otherArrow => {
                if (otherArrow !== arrow && !otherArrow.classList.contains('rotate-180')) {
                    otherArrow.classList.remove('rotate-180');
                }
            });
        }
    }

    // Auto-open submenu if current page is in it
    document.addEventListener('DOMContentLoaded', function () {
        const activeSubmenuItems = document.querySelectorAll('#mobile-menu a.bg-green-100');
        activeSubmenuItems.forEach(item => {
            const submenu = item.closest('.submenu');
            if (submenu) {
                submenu.classList.remove('hidden');
                submenu.classList.add('block');

                const parentButton = submenu.previousElementSibling;
                if (parentButton) {
                    const arrow = parentButton.querySelector('.submenu-arrow');
                    if (arrow) {
                        arrow.classList.add('rotate-180');
                    }
                }
            }
        });
    });
</script>

<style>
    /* Smooth transitions for mobile menu */
    #mobile-menu {
        transition: all 0.3s ease-in-out;
    }

    .submenu {
        transition: all 0.3s ease-in-out;
        max-height: 0;
        overflow: hidden;
    }

    .submenu:not(.hidden) {
        max-height: 500px;
    }

    /* Active state indicators */
    .bg-green-50 {
        background-color: rgba(16, 185, 129, 0.1);
    }

    .bg-green-100 {
        background-color: rgba(16, 185, 129, 0.2);
    }
</style>