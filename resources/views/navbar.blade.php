<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <div class="w-12 h-12">
                    <img src="{{ asset('img/al_ikhlas_logo.jpg') }}" alt="Logo TPA">
                </div>
            </div>

            @php
                $menus = [
                    ['route' => 'home', 'label' => 'Beranda'],
                    [
                        'dropdown' => true,
                        'label' => 'Profil',
                        'items' => [
                            ['route' => 'history', 'label' => 'Sejarah'],
                            ['route' => 'structure', 'label' => 'Struktur Organisasi'],
                            ['route' => 'visionAndMission', 'label' => 'Visi & Misi'],
                        ]
                    ],
                    ['route' => 'news', 'label' => 'Berita'],
                    ['route' => 'program', 'label' => 'Program'],
                    ['route' => 'schedule', 'label' => 'Jadwal'],
                    ['route' => 'register-online', 'label' => 'Pendaftaran'],
                    ['route' => 'contact', 'label' => 'Kontak'],
                    ['route' => 'login', 'label' => 'Login'],
                ];
            @endphp

            <!-- Desktop Menu -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    @foreach ($menus as $menu)
                        @if (isset($menu['dropdown']) && $menu['dropdown'])
                            @php
                                $profileRoutes = collect($menu['items'])->pluck('route')->toArray();
                                $isActive = request()->routeIs($profileRoutes);
                            @endphp

                            <!-- Dropdown Profil -->
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <div class="absolute pt-2 top-full left-0 hidden group-hover:block bg-transparent z-50">
                                    <div class="bg-white shadow-lg rounded-lg w-48 border border-gray-100">
                                        @foreach ($menu['items'] as $submenu)
                                                            <a href="{{ route($submenu['route']) }}" class="block px-4 py-2 text-sm 
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
                </div>
            </div>

            <div class="hidden md:block">
                <a href="{{ route('register-online') }}" class="bg-accent text-gray-800 font-medium px-4 py-2 rounded-lg 
                    transition-all duration-300 transform 
                    hover:bg-yellow-900 hover:scale-105 hover:shadow-lg hover:text-white">
                    Daftar Sekarang
                </a>
            </div>

            <!-- Mobile menu button -->
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
                            $profileRoutes = collect($menu['items'])->pluck('route')->toArray();
                            $isActive = request()->routeIs($profileRoutes);
                        @endphp

                        <!-- Dropdown Profil (Mobile) -->
                        <div>
                            <button onclick="toggleSubmenu(this)"
                                class="flex justify-between items-center w-full px-3 py-2 text-sm font-medium rounded-lg
                                            {{ $isActive ? 'bg-green-50 text-green-700 border-l-4 border-green-700' : 'text-gray-600 hover:bg-gray-100 hover:text-green-700' }}">
                                {{ $menu['label'] }}
                                <svg class="submenu-arrow w-4 h-4 transform transition-transform duration-200 {{ $isActive ? 'rotate-180 text-green-700' : '' }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div class="submenu {{ $isActive ? '' : 'hidden' }} flex flex-col pl-4 space-y-1 mt-1">
                                @foreach ($menu['items'] as $submenu)
                                            <a href="{{ route($submenu['route']) }}" class="px-3 py-2 text-sm 
                                                                {{ request()->routeIs($submenu['route'])
                                    ? 'bg-green-50 text-green-700 font-medium'
                                    : 'text-gray-600 hover:bg-green-50 hover:text-green-700' }}
                                                                rounded-lg">
                                                {{ $submenu['label'] }}
                                            </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                            <a href="{{ route($menu['route']) }}" class="px-3 py-2 text-sm font-medium transition-colors rounded-lg
                                        {{ request()->routeIs($menu['route'])
                        ? 'bg-green-50 text-green-700 border-l-4 border-green-700'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-green-700' }}">
                                {{ $menu['label'] }}
                            </a>
                    @endif
                @endforeach

                <a href="{{ route('register-online') }}" class="bg-accent text-gray-800 font-medium px-4 py-2 rounded-lg 
                    transition-all duration-300 text-center
                    hover:bg-yellow-900 hover:shadow-lg hover:text-white mt-2">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    }

    function toggleSubmenu(btn) {
        const submenu = btn.nextElementSibling;
        const arrow = btn.querySelector('.submenu-arrow');
        submenu.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    }
</script>