@extends('template')

@section('title', 'Sejarah')

@section('content')
    <style>
        .islamic-pattern {
            background-color: #f0f9f4;
            background-image:
                repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(16, 185, 129, 0.03) 35px, rgba(16, 185, 129, 0.03) 70px),
                repeating-linear-gradient(-45deg, transparent, transparent 35px, rgba(16, 185, 129, 0.03) 35px, rgba(16, 185, 129, 0.03) 70px);
        }
    </style>

    <div class="islamic-pattern">
        <!-- Hero Section -->
        <!-- Hero Section -->
        <section class="relative h-screen min-h-[600px] flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-green-600 to-yellow-500 opacity-90"></div>

            <!-- Ubah bagian background gambar -->
            <div class="absolute inset-0 bg-center bg-cover opacity-30 flex items-center justify-center z-0">
                @if($history && $history->image)
                    <img src="{{ asset('storage/' . $history->image) }}" alt="Background Sejarah"
                        class="w-full h-full object-cover">
                @else
                    <img src="{{ asset('img/masjid.png') }}" alt="Background Masjid" class="w-full h-full object-cover">
                @endif
            </div>

            <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
                <div class="mb-6">
                    <div class="inline-block p-4 bg-white bg-opacity-20 rounded-full backdrop-blur-sm mb-4 w-64 h-64">
                        <img src="{{ asset('img/al_ikhlas_logo.jpg') }}" class="rounded-full" alt="Logo TPA">
                    </div>
                </div>

                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 drop-shadow-lg">
                    {{ $history?->title ?? 'Sejarah TPA Al-Ikhlas' }}
                </h1>
                <p class="text-lg md:text-xl text-white text-opacity-95 max-w-2xl mx-auto leading-relaxed drop-shadow">
                    {{ $history?->subtitle ?? 'Perjalanan kami dalam mendidik generasi Qur\'ani yang berakhlak mulia.' }}
                </p>
            </div>

            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </div>
        </section>

        <!-- Main History Content -->
        <section class="py-16 md:py-24 px-4">
            <div class="max-w-5xl mx-auto">
                <div
                    class="bg-white rounded-3xl shadow-xl p-8 md:p-12 transform hover:shadow-2xl transition-shadow duration-300">

                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-1 h-12 bg-gradient-to-b from-green-500 to-yellow-500 rounded-full"></div>
                            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">
                                {{ $history?->title ?? 'Awal Mula Berdirinya' }}
                            </h2>
                        </div>

                        @if($history && $history->subtitle)
                            <p class="text-lg text-green-600 font-semibold ml-4">
                                {{ $history->subtitle }}
                            </p>
                        @endif
                    </div>

                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed whitespace-pre-line">
                        {!! nl2br(e($history?->content ?? 'Belum ada sejarah yang ditambahkan.')) !!}
                    </div>
                </div>
            </div>
        </section>

        <!-- Vision & Mission Section -->
        <section class="py-16 md:py-24 px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Visi & Misi</h2>
                    <p class="text-lg text-gray-600">Panduan kami dalam membentuk generasi Qur'ani yang berakhlak mulia</p>
                </div>

                @if($visions->isNotEmpty())
                    @foreach($visions as $vision)
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Vision -->
                            <div
                                class="bg-gradient-to-br from-green-500 to-green-600 rounded-3xl p-8 md:p-10 text-white shadow-xl transform hover:scale-105 transition-transform duration-300">
                                <div class="flex items-center gap-4 mb-6">
                                    <div class="p-3 bg-white bg-opacity-20 rounded-full">
                                        <i data-lucide="eye" class="w-10 h-10 text-slate-500"></i>
                                    </div>
                                    <h3 class="text-2xl md:text-3xl font-bold">Visi</h3>
                                </div>
                                <p class="text-lg leading-relaxed">
                                    {{ $vision->vision }}
                                </p>
                            </div>

                            <!-- Mission -->
                            <div
                                class="bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-3xl p-8 md:p-10 text-white shadow-xl transform hover:scale-105 transition-transform duration-300">
                                <div class="flex items-center gap-4 mb-6">
                                    <div class="p-3 bg-white bg-opacity-20 rounded-full">
                                        <i data-lucide="target" class="w-10 h-10 text-slate-500"></i>
                                    </div>
                                    <h3 class="text-2xl md:text-3xl font-bold">Misi</h3>
                                </div>
                                <ul class="space-y-3 text-lg">
                                    @foreach($vision->missions as $mission)
                                        <li class="flex items-start gap-3">
                                            <i data-lucide="check-circle" class="w-6 h-6 flex-shrink-0 mt-1"></i>
                                            <span>{{ $mission }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center text-gray-500 italic">
                        Belum ada data visi & misi yang ditambahkan.
                    </div>
                @endif
            </div>
        </section>
    </div>
    <script>
        lucide.createIcons();
    </script>
@endsection