@php
    $menus = [
        [
            'route' => 'admin.dashboard',
            'label' => 'Dashboard',
            'icon' => 'home',
        ],
        [
            'route' => 'admin.news.index',
            'label' => 'Berita',
            'icon' => 'newspaper',
        ],
        [
            'route' => 'admin.programs.index',
            'label' => 'Program',
            'icon' => 'list',
        ],
        [
            'route' => [
                'admin.schedules.*',
                'admin.weekly.*',
                'admin.events.*',
                'admin.quotes.*'
            ],
            'label' => 'Jadwal',
            'icon' => 'calendar',
            'main' => 'admin.schedules.index',
        ],
        [
            'route' => 'admin.admin-register-online.index',
            'label' => 'Pendaftaran',
            'icon' => 'book-text',
        ],
        [
            'route' => 'admin.footer.index',
            'label' => 'Contact',
            'icon' => 'phone',
        ],
        // Tambahan: Menu Dropdown PROFILE
        [
            'label' => 'Profile',
            'icon' => 'user',
            'children' => [
                [
                    'route' => 'admin.history.index',
                    'label' => 'Sejarah',
                ],
                [
                    'route' => 'admin.structure.index',
                    'label' => 'Struktur Organisasi',
                ],
                [
                    'route' => 'admin.visions.index',
                    'label' => 'Visi & Misi',
                ],
            ],
        ],
    ];
@endphp

<aside
    class="fixed top-0 left-0 h-screen w-80 bg-slate-900 text-white z-40 transform -translate-x-full lg:translate-x-0 transition-transform">
    <!-- Logo -->
    <div class="p-6 border-b border-slate-800 flex justify-center">
        <div class="w-48 h-48 flex items-center justify-center">
            <img src="{{ asset('img/al_ikhlas_logo_white.png') }}" alt="Logo"
                class="max-w-full max-h-full object-contain">
        </div>
    </div>

    <!-- Navigation -->
    <nav class="p-4">
        <ul class="space-y-2">
            @foreach($menus as $menu)
                @if(isset($menu['children']))
                    {{-- Dropdown --}}
                    @php
                        $isActiveParent = false;
                        foreach ($menu['children'] as $child) {
                            if (request()->routeIs($child['route'])) {
                                $isActiveParent = true;
                                break;
                            }
                        }
                    @endphp

                    <li x-data="{ open: {{ $isActiveParent ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full px-4 py-3 rounded-lg
                                    {{ $isActiveParent ? 'bg-gray-600 text-white' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <i data-lucide="{{ $menu['icon'] }}"></i>
                                <span class="font-medium">{{ $menu['label'] }}</span>
                            </div>
                            <i data-lucide="chevron-down" class="transition-transform" :class="{ 'rotate-180': open }"></i>
                        </button>

                        <ul x-show="open" x-collapse class="ml-8 mt-1 space-y-1">
                            @foreach($menu['children'] as $child)
                                <li>
                                    <a href="{{ route($child['route']) }}"
                                        class="block px-4 py-2 rounded-lg text-sm
                                                    {{ request()->routeIs($child['route']) ? 'bg-gray-600 text-white' : 'text-gray-400 hover:bg-slate-800 hover:text-white' }}">
                                        {{ $child['label'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    {{-- Single Menu --}}
                    @php
                        $routes = is_array($menu['route']) ? $menu['route'] : [$menu['route']];
                        $isActive = false;
                        foreach ($routes as $r) {
                            if (request()->routeIs($r)) {
                                $isActive = true;
                                break;
                            }
                        }
                        $href = $menu['main'] ?? (is_array($menu['route']) ? $menu['route'][0] : $menu['route']);
                    @endphp

                    <li>
                        <a href="{{ route($href) }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg
                                    {{ $isActive ? 'bg-gray-600 text-white border-r-4 border-gray-200 translate-x-2' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }}">
                            <i data-lucide="{{ $menu['icon'] }}"></i>
                            <span class="font-medium">{{ $menu['label'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </nav>
</aside>

<div id="overlay" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden"></div>

<script src="https://unpkg.com/alpinejs" defer></script>