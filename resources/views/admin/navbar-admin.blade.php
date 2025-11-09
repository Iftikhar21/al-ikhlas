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
            'route' => 'admin.register-online.index',
            'label' => 'Pendaftaran',
            'icon' => 'book-text',
        ],
        [
            'route' => 'admin.footer.index',
            'label' => 'Kontak',
            'icon' => 'phone',
        ],

        // 🕌 MASJID
        [
            'label' => 'Masjid',
            'icon' => 'building',
            'children' => [
                ['route' => 'admin.masjid.history', 'label' => 'Sejarah'],
                ['route' => 'admin.masjid.structure', 'label' => 'Struktur'],
                ['route' => 'admin.masjid.visions', 'label' => 'Visi & Misi'],
                ['route' => 'admin.masjid.kajian', 'label' => 'Kajian'],
            ],
        ],

        // 🏫 TPA
        [
            'label' => 'TPA',
            'icon' => 'book-open',
            'children' => [
                ['route' => 'admin.tpa.history', 'label' => 'Sejarah'],
                ['route' => 'admin.tpa.structure', 'label' => 'Struktur'],
                ['route' => 'admin.tpa.visions', 'label' => 'Visi & Misi'],
                ['route' => 'admin.tpa.teachers', 'label' => 'Pengajar'],
                ['route' => 'admin.tpa.schedule', 'label' => 'Jadwal'],
                ['route' => 'admin.tpa.programs', 'label' => 'Program'],
            ],
        ],

        // 💼 KOPERASI
        [
            'label' => 'Koperasi',
            'icon' => 'briefcase',
            'children' => [
                ['route' => 'admin.koperasi.history', 'label' => 'Sejarah'],
                ['route' => 'admin.koperasi.structure', 'label' => 'Struktur'],
                ['route' => 'admin.koperasi.visions', 'label' => 'Visi & Misi'],
                ['route' => 'admin.koperasi.activity', 'label' => 'Kegiatan'],
            ],
        ],
    ];
@endphp

<aside
    class="fixed top-0 left-0 h-screen w-80 bg-slate-900 text-white z-40 transform -translate-x-full lg:translate-x-0 transition-transform flex flex-col">

    <!-- Logo -->
    <div class="p-6 border-b border-slate-800 flex-shrink-0">
        <div class="w-40 h-40 mx-auto flex items-center justify-center">
            <img src="{{ asset('img/al_ikhlas_logo_white.png') }}" alt="Logo"
                class="max-w-full max-h-full object-contain">
        </div>
    </div>

    <!-- Navigation Container dengan Scroll -->
    <div class="flex-1 overflow-hidden flex flex-col">
        <nav class="p-4 flex-1 overflow-y-auto">
            <ul class="space-y-2">
                @foreach($menus as $menu)
                    @if(isset($menu['children']))
                        {{-- Dropdown Menu --}}
                        @php
                            $isActiveParent = false;
                            foreach ($menu['children'] as $child) {
                                $routes = is_array($child['route']) ? $child['route'] : [$child['route']];
                                foreach ($routes as $r) {
                                    if (request()->routeIs($r . '*')) {
                                        $isActiveParent = true;
                                        break 2;
                                    }
                                }
                            }
                        @endphp

                        <li x-data="{ open: {{ $isActiveParent ? 'true' : 'false' }} }" class="relative">
                            <button @click="open = !open"
                                class="flex items-center justify-between w-full px-4 py-3 rounded-lg transition-all duration-200
                                                    {{ $isActiveParent ? 'bg-slate-800 text-white shadow-sm' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }}">
                                <div class="flex items-center gap-3">
                                    <i data-lucide="{{ $menu['icon'] }}" class="w-5 h-5 flex-shrink-0"></i>
                                    <span class="font-medium text-sm">{{ $menu['label'] }}</span>
                                </div>
                                <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200 flex-shrink-0"
                                    :class="{ 'rotate-180': open }"></i>
                            </button>

                            {{-- Dropdown Content dengan Scroll --}}
                            <div x-show="open" x-collapse class="ml-4 mt-2 space-y-1 max-h-48 overflow-y-auto pr-2"
                                style="scrollbar-width: thin; scrollbar-color: #4b5563 #1f2937;">
                                @foreach($menu['children'] as $child)
                                    @php
                                        $childRoutes = is_array($child['route']) ? $child['route'] : [$child['route']];
                                        $isActiveChild = false;
                                        foreach ($childRoutes as $r) {
                                            if (request()->routeIs($r . '*')) {
                                                $isActiveChild = true;
                                                break;
                                            }
                                        }
                                    @endphp
                                    <div class="relative">
                                        <a href="{{ route($childRoutes[0] . '.index') }}"
                                            class="block px-4 py-2.5 rounded-lg text-sm transition-all duration-200
                                                                   {{ $isActiveChild ? 'bg-slate-700 text-white shadow-sm border-l-2 border-blue-400' : 'text-gray-400 hover:bg-slate-800 hover:text-white' }}">
                                            <div class="flex items-center">
                                                <div class="w-1.5 h-1.5 rounded-full bg-gray-500 mr-3 flex-shrink-0"></div>
                                                <span class="truncate">{{ $child['label'] }}</span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                    @else
                        {{-- Single Menu --}}
                        @php
                            $routes = is_array($menu['route']) ? $menu['route'] : [$menu['route']];
                            $isActive = false;
                            foreach ($routes as $r) {
                                if (request()->routeIs($r . '*')) {
                                    $isActive = true;
                                    break;
                                }
                            }
                            $href = $menu['main'] ?? (is_array($menu['route']) ? $menu['route'][0] : $menu['route']);
                        @endphp

                        <li>
                            <a href="{{ route($href) }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200
                                               {{ $isActive ? 'bg-slate-800 text-white shadow-sm border-r-2 border-blue-400' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }}">
                                <i data-lucide="{{ $menu['icon'] }}" class="w-5 h-5 flex-shrink-0"></i>
                                <span class="font-medium text-sm">{{ $menu['label'] }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>

        {{-- User Info atau Footer Sidebar --}}
        <div class="p-4 border-t border-slate-800 flex-shrink-0">
            <div class="flex items-center gap-3 px-2 py-2 text-gray-300">
                <div class="w-8 h-8 bg-slate-700 rounded-full flex items-center justify-center flex-shrink-0">
                    <i data-lucide="user" class="w-4 h-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-400 truncate">Administrator</p>
                </div>
            </div>
        </div>
    </div>
</aside>

<div id="overlay" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden"></div>

<style>
    /* Custom Scrollbar untuk Dropdown */
    .overflow-y-auto::-webkit-scrollbar {
        width: 4px;
    }

    .overflow-y-auto::-webkit-scrollbar-track {
        background: #1f2937;
        border-radius: 10px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #4b5563;
        border-radius: 10px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #6b7280;
    }

    /* Smooth transitions */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 200ms;
    }

    /* Hover effects */
    .hover-lift:hover {
        transform: translateY(-1px);
    }

    /* Active state enhancements */
    .bg-slate-800 {
        background-color: #1e293b;
    }

    .bg-slate-700 {
        background-color: #334155;
    }
</style>

<script src="https://unpkg.com/alpinejs" defer></script>