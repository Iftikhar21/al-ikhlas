@extends('template')
@section('title', 'Beranda')

@section('content')
    <style>
        .arabic-font {
            font-family: 'Amiri', serif;
        }

        /* Islamic Pattern Background */
        .islamic-pattern {
            background-image:
                repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(139, 195, 74, 0.06) 35px, rgba(139, 195, 74, 0.06) 70px),
                repeating-linear-gradient(-45deg, transparent, transparent 35px, rgba(76, 175, 80, 0.06) 35px, rgba(76, 175, 80, 0.06) 70px);
        }

        /* Slider Styles - TIDAK DIUBAH */
        .slider-container {
            position: relative;
            overflow: hidden;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .slider-wrapper {
            display: flex;
            transition: transform 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .slide {
            min-width: 100%;
            position: relative;
            opacity: 0;
            transform: scale(0.95);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .slide.active {
            opacity: 1;
            transform: scale(1);
        }

        .slide-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
            position: relative;
        }

        .slide-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.4) 60%, transparent 100%);
            padding: 3rem 2rem 2rem;
            color: white;
        }

        .nav-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.95);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 10;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .nav-button:hover {
            background: #8BC34A;
            color: white;
            transform: translateY(-50%) scale(1.1);
        }

        .nav-button.prev {
            left: 20px;
        }

        .nav-button.next {
            right: 20px;
        }

        .dots-container {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dot.active {
            background: #8BC34A;
            width: 30px;
            border-radius: 6px;
        }

        @media (max-width: 768px) {
            .slide-image {
                height: 350px;
            }

            .slide-overlay {
                padding: 2rem 1.5rem 1.5rem;
            }

            .nav-button {
                width: 40px;
                height: 40px;
            }
        }

        /* Custom Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Gradient Border Effect */
        .gradient-border {
            position: relative;
            background: white;
            border-radius: 1.5rem;
        }

        .gradient-border::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 1.5rem;
            padding: 2px;
            background: linear-gradient(135deg, #8BC34A, #689F38, #4CAF50);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gradient-border:hover::before {
            opacity: 1;
        }
    </style>

    <!-- Main Content -->
    <div class="islamic-pattern min-h-screen">
        <main class="container mx-auto px-4 py-8 lg:py-12">

            <!-- Hero Slider Section - TIDAK DIUBAH -->
            <section class="mb-20 relative">
                <div class="slider-container relative">
                    <div class="slider-wrapper" id="sliderWrapper">
                        @foreach($heroSlides as $index => $slide)
                            <div class="slide {{ $index === 0 ? 'active' : '' }} relative">
                                @if($slide->thumbnail)
                                    <img src="{{ asset('storage/' . $slide->thumbnail) }}" alt="{{ $slide->title }}"
                                        class="slide-image w-full h-full object-cover">
                                @else
                                    <div class="slide-image w-full h-full bg-gray-200 flex items-center justify-center">
                                        <i data-lucide="image" class="text-6xl text-gray-500"></i>
                                    </div>
                                @endif

                                <div class="slide-overlay absolute inset-0 bg-black/50 flex flex-col justify-center items-start text-left px-4 sm:px-8 md:px-16">
                                    <div class="m-10 md:m-20">
                                        <h2 class="text-lg sm:text-2xl md:text-4xl font-bold mb-2 sm:mb-3 text-white leading-snug">
                                            {{ $slide->title }}
                                        </h2>
                                        <p class="text-gray-200 text-xs sm:text-base md:text-lg mb-3 sm:mb-4 max-w-xl">
                                            {{ Str::limit($slide->content ?? $slide->content ?? 'Tidak ada deskripsi', 150) }}
                                        </p>
                                        <a href="{{ route('news-detail', $slide->slug) }}" class="bg-white text-green-600 text-xs sm:text-sm md:text-base px-3 sm:px-5 md:px-6 py-1.5 sm:py-2 rounded-full font-semibold hover:bg-green-50 transition">
                                            Baca Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button class="nav-button prev" onclick="moveSlide(-1)">
                        <i data-lucide="chevron-left"></i>
                    </button>
                    <button class="nav-button next" onclick="moveSlide(1)">
                        <i data-lucide="chevron-right"></i>
                    </button>

                    <div class="dots-container" id="dotsContainer"></div>
                </div>
            </section>

            <!-- Quick Links Section - Redesigned -->
            <section class="mb-24">
                <div class="text-center mb-16 animate-fade-in-up">
                    <div class="inline-block mb-4">
                        <span class="text-green-600 font-semibold text-sm uppercase tracking-wider bg-green-50 px-4 py-2 rounded-full">Layanan Kami</span>
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 pb-6 bg-clip-text text-transparent bg-gradient-to-r from-green-600 to-emerald-600">
                        Layanan Masjid/TPA
                    </h2>
                    <p class="text-gray-600 text-lg lg:text-xl max-w-3xl mx-auto leading-relaxed">
                        Berbagai Program dan layanan untuk pendidikan Al-Qur'an anak-anak dengan metode Ummi yang Mudah, menyenangkan
                        dan menyentuh hati.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <a href="{{ route('tpa.program') }}" class="group relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-gray-100 overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-100 to-emerald-50 rounded-bl-full -mr-16 -mt-16 opacity-50 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <i data-lucide="book-open" class="w-8 h-8 text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Program Belajar</h3>
                            <p class="text-gray-600 mb-4">Lihat program pendidikan unggulan kami</p>
                            <div class="flex items-center text-green-600 font-semibold group-hover:translate-x-2 transition-transform">
                                <span>Selengkapnya</span>
                                <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('tpa.schedule') }}" class="group relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-gray-100 overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-100 to-cyan-50 rounded-bl-full -mr-16 -mt-16 opacity-50 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <i data-lucide="calendar" class="w-8 h-8 text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Jadwal</h3>
                            <p class="text-gray-600 mb-4">Jadwal belajar & kegiatan lengkap</p>
                            <div class="flex items-center text-blue-600 font-semibold group-hover:translate-x-2 transition-transform">
                                <span>Selengkapnya</span>
                                <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('tpa.register') }}" class="group relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-gray-100 overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-100 to-orange-50 rounded-bl-full -mr-16 -mt-16 opacity-50 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <i data-lucide="user-plus" class="w-8 h-8 text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Pendaftaran</h3>
                            <p class="text-gray-600 mb-4">Daftar santri baru online</p>
                            <div class="flex items-center text-amber-600 font-semibold group-hover:translate-x-2 transition-transform">
                                <span>Selengkapnya</span>
                                <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('contact') }}" class="group relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-gray-100 overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-100 to-pink-50 rounded-bl-full -mr-16 -mt-16 opacity-50 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <i data-lucide="phone" class="w-8 h-8 text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Kontak</h3>
                            <p class="text-gray-600 mb-4">Hubungi kami untuk informasi</p>
                            <div class="flex items-center text-purple-600 font-semibold group-hover:translate-x-2 transition-transform">
                                <span>Selengkapnya</span>
                                <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </section>

            <!-- Programs Overview Section - Redesigned -->
            <section class="mb-24">
                <div class="text-center mb-16">
                    <div class="inline-block mb-4">
                        <span class="text-green-600 font-semibold text-sm uppercase tracking-wider bg-green-50 px-4 py-2 rounded-full">Program Kami</span>
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 pb-6 bg-clip-text text-transparent bg-gradient-to-r from-green-600 to-emerald-600">
                        Program Unggulan
                    </h2>
                    <p class="text-gray-600 text-lg lg:text-xl max-w-3xl mx-auto">
                        Program pendidikan Al-Quran untuk berbagai usia dengan kurikulum terstruktur
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($programs->take(3) as $program)
                        <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                            <div class="relative bg-gradient-to-br from-green-500 to-emerald-600 p-8 text-white">
                                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-bl-full -mr-8 -mt-8"></div>
                                <div class="relative z-10">
                                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-4">
                                        @if($program->thumbnail)
                                            <img src="{{ asset('storage/' . $program->thumbnail) }}" class="w-12 h-12 object-cover rounded-full"
                                                alt="{{ $program->title }}">
                                        @else
                                            <!-- Default icon -->
                                            <svg class="w-12 h-12 text-{{ $color }}-700" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 005.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <h3 class="text-2xl font-bold mb-2">{{ $program->title }}</h3>
                                </div>
                            </div>

                            <div class="p-8">
                                <p class="text-gray-600 leading-relaxed mb-6">{{ Str::limit($program->description, 100) }}</p>
                                <a href="{{ route('tpa.program-detail', $program->slug) }}" class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 group-hover:translate-x-2 transition-all">
                                    Lihat Detail Program
                                    <i data-lucide="arrow-right" class="ml-2 w-5 h-5"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('tpa.program') }}" class="inline-flex items-center bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-10 py-4 rounded-full font-semibold text-lg shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                        Lihat Semua Program
                        <i data-lucide="arrow-right" class="ml-3 w-5 h-5"></i>
                    </a>
                </div>
            </section>

            <!-- Schedule Overview Section - Redesigned -->
            <section class="mb-24">

                <!-- Upcoming Events List -->
                <div class="bg-white rounded-3xl p-8 lg:p-10 shadow-xl border border-amber-50">
                    <div class="flex items-center mb-8">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-amber-500 to-yellow-600 rounded-2xl flex items-center justify-center mr-5 shadow-lg">
                            <i data-lucide="star" class="w-8 h-8 text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-1">Kegiatan & Event Mendatang</h2>
                            <p class="text-gray-600">Acara spesial dan kegiatan luar biasa TPA</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        @foreach($eventSchedules->take(4) as $event)
                            <div
                                class="flex flex-col lg:flex-row items-start gap-6 p-6 bg-gradient-to-r from-amber-50 to-yellow-50 rounded-2xl border-l-4 border-amber-500 hover:shadow-lg transition-all duration-300">
                                <!-- Foto/Thumbnail -->
                                <div class="w-full lg:w-48 h-48 flex-shrink-0 rounded-xl overflow-hidden relative">
                                    @if($event->image)
                                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-amber-200 flex items-center justify-center">
                                            <i data-lucide="calendar" class="w-12 h-12 text-amber-600"></i>
                                        </div>
                                    @endif
                                    <!-- Date Badge Overlay -->
                                    <div class="absolute top-4 left-4 bg-amber-600 text-white px-3 py-2 rounded-lg font-bold text-sm">
                                        {{ \Carbon\Carbon::parse($event->event_date)->format('d M') }}
                                    </div>
                                </div>

                                <!-- Konten -->
                                <div class="flex-1">
                                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between mb-3">
                                        <div>
                                            <div class="text-amber-600 font-bold text-lg mb-2">
                                                {{ \Carbon\Carbon::parse($event->event_date)->format('l, d F Y') }}
                                            </div>
                                            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $event->title }}</h3>
                                        </div>
                                        <div class="bg-amber-600 text-white px-4 py-2 rounded-xl font-bold text-lg mb-3 lg:mb-0">
                                            {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}
                                        </div>
                                    </div>

                                    <p class="text-gray-700 leading-relaxed mb-4">
                                        {{ $event->description }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-8">
                        <a href="{{ route('tpa.schedule') }}"
                            class="inline-flex items-center bg-amber-600 hover:bg-amber-700 text-white px-8 py-3 rounded-xl font-semibold text-lg transition-colors group">
                            Lihat Semua Kegiatan
                            <i data-lucide="arrow-right" class="ml-2 w-5 h-5 group-hover:translate-x-2 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Latest News Section - Redesigned -->
            <section class="mb-24">
                <div class="text-center mb-16">
                    <div class="inline-block mb-4">
                        <span class="text-green-600 font-semibold text-sm uppercase tracking-wider bg-green-50 px-4 py-2 rounded-full">Berita Terkini</span>
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 pb-10 bg-clip-text text-transparent bg-gradient-to-r from-gray-800 to-gray-600">
                        Berita & Kegiatan Terbaru
                    </h2>
                    <p class="text-gray-600 text-lg lg:text-xl max-w-3xl mx-auto">
                        Update terbaru dari TPA kami seputar kegiatan dan prestasi santri
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($newsList as $news)
                        <article class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                            <div class="relative overflow-hidden h-56">
                                @if($news->thumbnail)
                                    <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                        <i data-lucide="image" class="text-5xl text-gray-400"></i>
                                    </div>
                                @endif
                                <div class="absolute top-4 left-4">
                                    <span class="bg-green-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                        {{ $news->category ?? 'Berita' }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-8">
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                                    <span>{{ $news->created_at->format('d F Y') }}</span>
                                </div>

                                <h3 class="text-xl font-bold text-gray-900 mb-4 leading-tight group-hover:text-green-600 transition-colors">
                                    <a href="{{ route('news-detail', $news->slug) }}">{{ $news->title }}</a>
                                </h3>

                                <p class="text-gray-600 leading-relaxed mb-6">{{ Str::limit($news->content ?? '', 100) }}</p>

                                <a href="{{ route('news-detail', $news->slug) }}" class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 group-hover:translate-x-2 transition-all">
                                    Baca Selengkapnya
                                    <i data-lucide="arrow-right" class="ml-2 w-5 h-5"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('news') }}" class="inline-flex items-center bg-gray-900 hover:bg-gray-800 text-white px-10 py-4 rounded-full font-semibold text-lg shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                        Lihat Semua Berita
                        <i data-lucide="arrow-right" class="ml-3 w-5 h-5"></i>
                    </a>
                </div>
            </section>

            <!-- Contact Overview Section - Redesigned -->
            <section class="mb-16">
                <div class="relative bg-gradient-to-br from-green-600 via-emerald-600 to-teal-600 rounded-3xl overflow-hidden shadow-2xl">
                    <!-- Decorative Elements -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
                    <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/5 rounded-full -ml-48 -mb-48"></div>

                    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center p-10 lg:p-16">
                        <div>
                            <div class="inline-block mb-4">
                                <span class="text-green-200 font-semibold text-sm uppercase tracking-wider bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">Hubungi Kami</span>
                            </div>
                            <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight">
                                Butuh Informasi Lebih Lanjut?
                            </h2>
                            <p class="text-green-50 text-lg lg:text-xl mb-8 leading-relaxed">
                                Hubungi kami untuk informasi pendaftaran, program, atau pertanyaan lainnya. Tim kami siap membantu Anda.
                            </p>

                            <div class="space-y-5">
                                @if($footer && $footer->telepon)
                                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-2xl p-5 hover:bg-white/20 transition-all">
                                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                            <i data-lucide="phone" class="w-6 h-6 text-white"></i>
                                        </div>
                                        @php
    $formattedPhone = preg_replace('/(\d{4})(?=\d)/', '$1-', $footer->telepon);
                                        @endphp

                                        <div>
                                            <p class="text-green-100 text-sm mb-1">Telepon</p>
                                            <span class="text-white font-semibold text-lg">{{ $formattedPhone }}</span>
                                        </div>
                                    </div>
                                @endif
                                @if($footer && $footer->email)
                                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-2xl p-5 hover:bg-white/20 transition-all">
                                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                            <i data-lucide="mail" class="w-6 h-6 text-white"></i>
                                        </div>
                                        <div>
                                            <p class="text-green-100 text-sm mb-1">Email</p>
                                            <span class="text-white font-semibold text-lg">{{ $footer->email }}</span>
                                        </div>
                                    </div>
                                @endif
                                @if($footer && $footer->alamat)
                                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-2xl p-5 hover:bg-white/20 transition-all">
                                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                            <i data-lucide="map-pin" class="w-6 h-6 text-white"></i>
                                        </div>
                                        <div>
                                            <p class="text-green-100 text-sm mb-1">Alamat</p>
                                            <span class="text-white font-semibold text-lg">{{ $footer->alamat }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="text-center lg:text-right">
                            <a href="{{ route('contact') }}" class="inline-flex items-center bg-white text-green-600 hover:bg-green-50 px-10 py-5 rounded-full font-bold text-lg shadow-2xl hover:shadow-xl transition-all duration-300 hover:scale-105">
                                <i data-lucide="message-circle" class="mr-3 w-6 h-6"></i>
                                Hubungi Kami Sekarang
                            </a>
                            <p class="text-green-100 text-sm mt-6">Kami siap melayani Anda 24/7</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Upcoming Kajian Section -->
            <section class="mb-24">
                <div class="text-center mb-16">
                    <div class="inline-block mb-4">
                        <span
                            class="text-green-600 font-semibold text-sm uppercase tracking-wider bg-green-50 px-4 py-2 rounded-full">Kajian</span>
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Kajian Mendatang</h2>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto">Jadwal kajian rutin masjid Al-Ikhlas Dalang</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($upcomingKajians as $kajian)
                        <div
                            class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                            <div class="flex items-center justify-between mb-4">
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ \Carbon\Carbon::parse($kajian->tanggal)->translatedFormat('l') }}
                                </span>
                                <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-sm font-bold">
                                    {{ \Carbon\Carbon::parse($kajian->tanggal)->translatedFormat('d M') }}
                                </span>
                            </div>

                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">{{ $kajian->judul }}</h3>

                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-gray-600">
                                    <i data-lucide="user" class="w-4 h-4 mr-2 text-green-600"></i>
                                    <span class="text-sm">{{ $kajian->pembicara }}</span>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i data-lucide="clock" class="w-4 h-4 mr-2 text-amber-600"></i>
                                    <span class="text-sm">
                                        {{ date('H:i', strtotime($kajian->waktu_mulai)) }} -
                                        {{ date('H:i', strtotime($kajian->waktu_selesai)) }}
                                    </span>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-blue-600"></i>
                                    <span class="text-sm">{{ $kajian->lokasi }}</span>
                                </div>
                            </div>

                            <p class="text-gray-600 text-sm line-clamp-2 mb-4">{{ $kajian->materi }}</p>

                            <a href="{{ route('masjid.kajian') }}"
                                class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 text-sm">
                                Lihat Detail
                                <i data-lucide="arrow-right" class="ml-1 w-4 h-4"></i>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-8">
                    <a href="{{ route('masjid.kajian') }}"
                        class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-full font-semibold transition-colors">
                        Lihat Semua Kajian
                        <i data-lucide="calendar" class="ml-2 w-5 h-5"></i>
                    </a>
                </div>
            </section>

            <!-- Latest Koperasi Activities -->
            <section class="mb-24">
                <div class="text-center mb-16">
                    <div class="inline-block mb-4">
                        <span
                            class="text-green-600 font-semibold text-sm uppercase tracking-wider bg-green-50 px-4 py-2 rounded-full">Koperasi</span>
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Kegiatan Koperasi</h2>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto">Aktivitas terbaru koperasi masjid Al-Ikhlas</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($latestActivities as $activity)
                        <article
                            class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                            <div class="relative overflow-hidden h-48">
                                @if($activity->thumbnail)
                                    <img src="{{ asset('storage/' . $activity->thumbnail) }}" alt="{{ $activity->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-200 to-cyan-300 flex items-center justify-center">
                                        <i data-lucide="store" class="text-5xl text-blue-600"></i>
                                    </div>
                                @endif
                                <div class="absolute top-4 left-4">
                                    <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                                        Koperasi
                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <div class="flex items-center text-sm text-gray-500 mb-3">
                                    <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                                    <span>{{ $activity->created_at->format('d F Y') }}</span>
                                </div>

                                <h3
                                    class="text-xl font-bold text-gray-900 mb-3 leading-tight group-hover:text-blue-600 transition-colors line-clamp-2">
                                    {{ $activity->title }}
                                </h3>

                                <p class="text-gray-600 leading-relaxed mb-4 line-clamp-3">
                                    {{ Str::limit(strip_tags($activity->content), 120) }}
                                </p>

                                <a href="{{ route('koperasi.activity.detail', $activity->slug) }}"
                                    class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 group-hover:translate-x-2 transition-all text-sm">
                                    Baca Selengkapnya
                                    <i data-lucide="arrow-right" class="ml-2 w-4 h-4"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="text-center mt-8">
                    <a href="{{ route('koperasi.kegiatan') }}"
                        class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-semibold transition-colors">
                        Lihat Semua Kegiatan
                        <i data-lucide="arrow-right" class="ml-2 w-5 h-5"></i>
                    </a>
                </div>
            </section>
        </main>
    </div>

    <script>
        // Slider functionality - TIDAK DIUBAH
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;
        let autoplayInterval;

        // Create dots
        const dotsContainer = document.getElementById('dotsContainer');
        for (let i = 0; i < totalSlides; i++) {
            const dot = document.createElement('div');
            dot.className = 'dot' + (i === 0 ? ' active' : '');
            dot.onclick = () => goToSlide(i);
            dotsContainer.appendChild(dot);
        }

        function updateSlider() {
            const sliderWrapper = document.getElementById('sliderWrapper');
            sliderWrapper.style.transform = `translateX(-${currentSlide * 100}%)`;

            slides.forEach((slide, index) => {
                slide.classList.toggle('active', index === currentSlide);
            });

            const dots = document.querySelectorAll('.dot');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }

        function moveSlide(direction) {
            currentSlide += direction;
            if (currentSlide < 0) {
                currentSlide = totalSlides - 1;
            } else if (currentSlide >= totalSlides) {
                currentSlide = 0;
            }
            updateSlider();
            resetAutoplay();
        }

        function goToSlide(index) {
            currentSlide = index;
            updateSlider();
            resetAutoplay();
        }

        function autoplay() {
            autoplayInterval = setInterval(() => {
                moveSlide(1);
            }, 5000);
        }

        function resetAutoplay() {
            clearInterval(autoplayInterval);
            autoplay();
        }

        // Start autoplay
        autoplay();

        // Pause autoplay when user hovers over slider
        const sliderContainer = document.querySelector('.slider-container');
        sliderContainer.addEventListener('mouseenter', () => {
            clearInterval(autoplayInterval);
        });

        sliderContainer.addEventListener('mouseleave', () => {
            autoplay();
        });

        // Initialize Lucide icons
        lucide.createIcons();
    </script>
@endsection