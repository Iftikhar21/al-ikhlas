<?php
$meta_title = "Pengajar TPA Al-Ikhlas | Masjid Al-Ikhlas Dalang";
$meta_description = "Kenali pengajar TPA Al-Ikhlas Dalang, pendidik generasi Qur'ani berakhlak mulia. Temukan profil dan pengalaman mereka.";
$meta_keywords = "TPA Al-Ikhlas, pengajar TPA, guru TPA, pendidikan islam, masjid al ikhlas, masjid dalang";
?>

@extends('template')

@section('title', $meta_title)

@section('meta')
    <meta name="description" content="{{ $meta_description }}">
    <meta name="keywords" content="{{ $meta_keywords }}">
    <meta property="og:title" content="{{ $meta_title }}">
    <meta property="og:description" content="{{ $meta_description }}">
    <meta property="og:image" content="{{ asset('img/al_ikhlas_logo.jpg') }}">
    <meta property="og:type" content="website">
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[40vh] min-h-[400px] bg-gradient-to-br from-emerald-700 via-emerald-800 to-emerald-900 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.1\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="relative z-10 container mx-auto px-4 h-full flex flex-col items-center justify-center text-center">
            <!-- Logo Masjid -->
            <div class="mb-6 p-3 bg-white/10 rounded-full backdrop-blur-sm">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center">
                    <img src="{{ asset('img/al_ikhlas_logo.jpg') }}" class="rounded-full" alt="Logo Masjid Al-Ikhlas">
                </div>
            </div>

            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 font-serif">Pengajar TPA Al-Ikhlas</h1>
            <div class="w-20 h-1 bg-amber-400 mb-4"></div>
            <p class="text-lg text-white/90 max-w-2xl">
                Pendidik Generasi Qur'ani yang Berdedikasi dalam Membentuk Akhlak Mulia
            </p>
        </div>
    </section>

    <!-- Daftar Pengajar Section -->
    <section class="py-16 px-4 bg-gradient-to-b from-emerald-50 to-white">
        <div class="container mx-auto max-w-7xl">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-emerald-900 mb-4 font-serif">Tim Pengajar Kami</h2>
                <p class="text-lg text-emerald-700 max-w-2xl mx-auto">
                    Bertemu dengan para asatidzah yang berkompeten dan berpengalaman dalam mendidik generasi penerus ummat
                </p>
            </div>

            <!-- Stats Overview -->
            <div class="mb-12 bg-white rounded-2xl shadow-lg p-6 border border-emerald-100">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6 text-center">
                    <div class="p-4">
                        <div class="text-3xl font-bold text-emerald-600 mb-2">{{ count($pengajars) }}</div>
                        <div class="text-sm text-emerald-700">Total Pengajar</div>
                    </div>
                    <div class="p-4">
                        <div class="text-3xl font-bold text-amber-600 mb-2">
                            {{ $pengajars->where('gender', 'Laki-laki')->count() }}
                        </div>
                        <div class="text-sm text-amber-700">Ustadz</div>
                    </div>
                    <div class="p-4">
                        <div class="text-3xl font-bold text-rose-600 mb-2">
                            {{ $pengajars->where('gender', 'Perempuan')->count() }}
                        </div>
                        <div class="text-sm text-rose-700">Ustadzah</div>
                    </div>
                </div>
            </div>

            <!-- Pengajar Grid - Mobile Scroll Horizontal -->
            <div class="block md:hidden">
                <div class="relative">
                    <!-- Scroll Container -->
                    <div class="flex overflow-x-auto pb-6 -mx-4 px-4 scrollbar-hide snap-x snap-mandatory scroll-smooth">
                        <div class="flex gap-4">
                            @forelse($pengajars as $pengajar)
                                <div class="w-80 flex-shrink-0 snap-start">
                                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden group border border-emerald-100 h-full">
                                        <!-- Header dengan Foto Profil Bulat -->
                                        <div class="relative pt-6 px-4 pb-3 bg-gradient-to-br from-emerald-50 to-amber-50">
                                            <!-- Foto Profil Bulat -->
                                            <div class="flex justify-center mb-3">
                                                <div class="relative">
                                                    @if($pengajar->foto)
                                                        <img src="{{ asset('storage/' . $pengajar->foto) }}" alt="{{ $pengajar->name }}"
                                                            class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg group-hover:scale-110 transition duration-500">
                                                    @else
                                                        <div class="w-24 h-24 rounded-full bg-emerald-100 border-4 border-white shadow-lg flex items-center justify-center group-hover:scale-110 transition duration-500">
                                                            <i data-lucide="user" class="w-10 h-10 text-emerald-400"></i>
                                                        </div>
                                                    @endif

                                                    <!-- Gender Badge -->
                                                    <div class="absolute -bottom-1 -right-1">
                                                        @if($pengajar->gender == 'Laki-laki')
                                                            <span class="px-2 py-1 bg-blue-500 text-white text-xs font-bold rounded-full shadow-md flex items-center gap-1">
                                                                <i data-lucide="user" class="w-2 h-2"></i>
                                                                Ustadz
                                                            </span>
                                                        @else
                                                            <span class="px-2 py-1 bg-rose-500 text-white text-xs font-bold rounded-full shadow-md flex items-center gap-1">
                                                                <i data-lucide="user" class="w-2 h-2"></i>
                                                                Ustadzah
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Nama dan Posisi -->
                                            <div class="text-center">
                                                <h3 class="text-lg font-bold text-emerald-900 mb-1 font-serif group-hover:text-emerald-700 transition-colors line-clamp-1">
                                                    {{ $pengajar->name }}
                                                </h3>
                                                <p class="text-emerald-600 font-semibold text-sm">{{ $pengajar->position }}</p>
                                            </div>
                                        </div>

                                        <!-- Informasi Pengajar -->
                                        <div class="p-4">
                                            <!-- Informasi Detail -->
                                            <div class="space-y-2 mb-3">
                                                <!-- Pendidikan Terakhir -->
                                                <div class="flex items-center gap-2">
                                                    <div class="p-1 bg-emerald-100 rounded-lg flex-shrink-0">
                                                        <i data-lucide="book-open" class="w-3 h-3 text-emerald-600"></i>
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <div class="text-xs font-medium text-emerald-900">Pendidikan</div>
                                                        <div class="text-emerald-700 text-xs truncate">{{ $pengajar->last_education ?? '-' }}</div>
                                                    </div>
                                                </div>

                                                <!-- Nomor Telepon -->
                                                @if($pengajar->phone_number)
                                                <div class="flex items-center gap-2">
                                                    <div class="p-1 bg-blue-100 rounded-lg flex-shrink-0">
                                                        <i data-lucide="phone" class="w-3 h-3 text-blue-600"></i>
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <div class="text-xs font-medium text-blue-900">Telepon</div>
                                                        <div class="text-blue-700 text-xs">{{ $pengajar->phone_number }}</div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>

                                            <!-- Alamat -->
                                            @if($pengajar->address)
                                            <div class="mb-3 p-2 bg-gray-50 rounded-lg border border-gray-100">
                                                <div class="flex items-start gap-1">
                                                    <i data-lucide="map-pin" class="w-3 h-3 text-gray-500 mt-0.5 flex-shrink-0"></i>
                                                    <div class="min-w-0 flex-1">
                                                        <div class="text-xs font-medium text-gray-900 mb-1">Alamat</div>
                                                        <div class="text-xs text-gray-600 leading-relaxed line-clamp-2">{{ $pengajar->address }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <!-- Empty State untuk Mobile -->
                                <div class="w-full flex-shrink-0">
                                    <div class="p-6 bg-white rounded-2xl shadow-lg border border-emerald-100 text-center">
                                        <i data-lucide="user-x" class="w-16 h-16 mx-auto text-emerald-400 mb-4"></i>
                                        <h3 class="text-lg font-bold text-emerald-900 mb-2 font-serif">Belum Ada Pengajar</h3>
                                        <p class="text-emerald-700 text-sm mb-4">
                                            Silakan hubungi pengurus TPA untuk informasi lebih lanjut.
                                        </p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Scroll Indicators -->
                    @if(count($pengajars) > 1)
                    <div class="flex justify-center mt-4 space-x-2">
                        @foreach($pengajars as $index => $pengajar)
                            <button class="scroll-indicator w-2 h-2 rounded-full bg-emerald-300 transition-all"
                                    data-index="{{ $index }}"></button>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <!-- Pengajar Grid - Desktop Normal -->
            <div class="hidden md:grid md:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
                @forelse($pengajars as $pengajar)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden group border border-emerald-100">
                        <!-- Header dengan Foto Profil Bulat -->
                        <div class="relative pt-8 px-6 pb-4 bg-gradient-to-br from-emerald-50 to-amber-50">
                            <!-- Foto Profil Bulat -->
                            <div class="flex justify-center mb-4">
                                <div class="relative">
                                    @if($pengajar->foto)
                                        <img src="{{ asset('storage/' . $pengajar->foto) }}" alt="{{ $pengajar->name }}"
                                            class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg group-hover:scale-110 transition duration-500">
                                    @else
                                        <div class="w-32 h-32 rounded-full bg-emerald-100 border-4 border-white shadow-lg flex items-center justify-center group-hover:scale-110 transition duration-500">
                                            <i data-lucide="user" class="w-12 h-12 text-emerald-400"></i>
                                        </div>
                                    @endif

                                    <!-- Gender Badge -->
                                    <div class="absolute -bottom-2 -right-2">
                                        @if($pengajar->gender == 'Laki-laki')
                                            <span class="px-3 py-1 bg-blue-500 text-white text-xs font-bold rounded-full shadow-md flex items-center gap-1">
                                                <i data-lucide="user" class="w-3 h-3"></i>
                                                Ustadz
                                            </span>
                                        @else
                                            <span class="px-3 py-1 bg-rose-500 text-white text-xs font-bold rounded-full shadow-md flex items-center gap-1">
                                                <i data-lucide="user" class="w-3 h-3"></i>
                                                Ustadzah
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Nama dan Posisi -->
                            <div class="text-center">
                                <h3 class="text-xl font-bold text-emerald-900 mb-1 font-serif group-hover:text-emerald-700 transition-colors">
                                    {{ $pengajar->name }}
                                </h3>
                                <p class="text-emerald-600 font-semibold">{{ $pengajar->position }}</p>
                            </div>
                        </div>

                        <!-- Informasi Pengajar -->
                        <div class="p-6">
                            <!-- Informasi Detail -->
                            <div class="space-y-3 mb-4">
                                <!-- Pendidikan Terakhir -->
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-emerald-100 rounded-lg flex-shrink-0">
                                        <i data-lucide="book-open" class="w-4 h-4 text-emerald-600"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="text-sm font-medium text-emerald-900">Pendidikan Terakhir</div>
                                        <div class="text-emerald-700 truncate">{{ $pengajar->last_education ?? '-' }}</div>
                                    </div>
                                </div>

                                <!-- Jenis Kelamin -->
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-amber-100 rounded-lg flex-shrink-0">
                                        <i data-lucide="users" class="w-4 h-4 text-amber-600"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="text-sm font-medium text-amber-900">Jenis Kelamin</div>
                                        <div class="text-amber-700">{{ $pengajar->gender ?? '-' }}</div>
                                    </div>
                                </div>

                                <!-- Nomor Telepon -->
                                @if($pengajar->phone_number)
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-blue-100 rounded-lg flex-shrink-0">
                                        <i data-lucide="phone" class="w-4 h-4 text-blue-600"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="text-sm font-medium text-blue-900">Telepon</div>
                                        <div class="text-blue-700">{{ $pengajar->phone_number }}</div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- Alamat -->
                            @if($pengajar->address)
                            <div class="mb-4 p-3 bg-gray-50 rounded-lg border border-gray-100">
                                <div class="flex items-start gap-2">
                                    <i data-lucide="map-pin" class="w-4 h-4 text-gray-500 mt-0.5 flex-shrink-0"></i>
                                    <div class="min-w-0 flex-1">
                                        <div class="text-sm font-medium text-gray-900 mb-1">Alamat</div>
                                        <div class="text-sm text-gray-600 leading-relaxed line-clamp-2">{{ $pengajar->address }}</div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <!-- Empty State untuk Desktop -->
                    <div class="col-span-full text-center py-16">
                        <div class="max-w-md mx-auto">
                            <div class="p-8 bg-white rounded-2xl shadow-lg border border-emerald-100">
                                <i data-lucide="user-x" class="w-20 h-20 mx-auto text-emerald-400 mb-6"></i>
                                <h3 class="text-2xl font-bold text-emerald-900 mb-3 font-serif">Belum Ada Pengajar</h3>
                                <p class="text-emerald-700 mb-6 leading-relaxed">
                                    Saat ini belum ada data pengajar yang tersedia. Silakan hubungi pengurus TPA untuk informasi lebih lanjut.
                                </p>
                                <button class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-full transition-all flex items-center gap-2 mx-auto font-medium">
                                    <i data-lucide="phone" class="w-4 h-4"></i>
                                    <span>Hubungi Pengurus</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #059669;
        }

        /* Hide scrollbar for mobile horizontal scroll */
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        /* Snap scrolling */
        .snap-x {
            scroll-snap-type: x mandatory;
        }

        .snap-start {
            scroll-snap-align: start;
        }

        /* Hover effects */
        .group:hover {
            transform: translateY(-5px);
        }

        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Active scroll indicator */
        .scroll-indicator.active {
            background-color: #10b981;
            transform: scale(1.2);
        }
    </style>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Mobile horizontal scroll functionality
        document.addEventListener('DOMContentLoaded', function() {
            const scrollContainer = document.querySelector('.flex.overflow-x-auto');
            const indicators = document.querySelectorAll('.scroll-indicator');
            
            if (scrollContainer && indicators.length > 0) {
                // Update indicators on scroll
                scrollContainer.addEventListener('scroll', function() {
                    const scrollLeft = this.scrollLeft;
                    const cardWidth = this.querySelector('.w-80').offsetWidth + 16; // width + gap
                    const activeIndex = Math.round(scrollLeft / cardWidth);
                    
                    indicators.forEach((indicator, index) => {
                        if (index === activeIndex) {
                            indicator.classList.add('active', 'bg-emerald-600');
                            indicator.classList.remove('bg-emerald-300');
                        } else {
                            indicator.classList.remove('active', 'bg-emerald-600');
                            indicator.classList.add('bg-emerald-300');
                        }
                    });
                });

                // Click indicators to scroll
                indicators.forEach((indicator, index) => {
                    indicator.addEventListener('click', function() {
                        const cardWidth = scrollContainer.querySelector('.w-80').offsetWidth + 16;
                        scrollContainer.scrollTo({
                            left: index * cardWidth,
                            behavior: 'smooth'
                        });
                    });
                });

                // Set first indicator as active initially
                if (indicators.length > 0) {
                    indicators[0].classList.add('active', 'bg-emerald-600');
                    indicators[0].classList.remove('bg-emerald-300');
                }
            }

            // Add interactive effects for desktop cards
            const desktopCards = document.querySelectorAll('.hidden.md\\:block .group');
            desktopCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
@endsection