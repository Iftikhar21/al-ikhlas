@extends('template')
@section('title', $activity->title . ' - Koperasi Masjid Al-Ikhlas')

@section('meta')
    <meta name="description" content="{{ Str::limit(strip_tags($activity->content), 160) }}">
    <meta name="keywords" content="koperasi masjid, kegiatan koperasi, {{ $activity->title }}, al-ikhlas">
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[50vh] min-h-[400px] overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 bg-emerald-900">
            @if($activity->thumbnail !== null)
                <img src="{{ asset('storage/' . $activity->thumbnail) }}" alt="{{ $activity->title }}"
                    class="w-full h-full object-cover opacity-50">
            @endif
        </div>

        <!-- Content -->
        <div class="relative z-10 container mx-auto px-4 h-full flex flex-col justify-end pb-12">
            <div class="max-w-4xl">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 font-serif">
                    {{ $activity->title }}
                </h1>
                <div class="flex items-center gap-4 text-white/90">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span>{{ $activity->created_at->locale('id')->translatedFormat('l, d F Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="image" class="w-4 h-4"></i>
                        <span>{{ $activity->koperasi_activity_photos->count() }} Foto</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-12 px-4">
        <div class="container mx-auto max-w-4xl">
            <!-- Back Button -->
            <div class="mb-8">
                <a href="{{ route('koperasi.kegiatan') }}"
                    class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    <span>Kembali ke Daftar Kegiatan</span>
                </a>
            </div>

            <!-- Main Content -->
            <div class="bg-white rounded-xl shadow-sm border border-emerald-100 overflow-hidden">
                <!-- Content -->
                <div class="p-6 md:p-8">
                    <div class="prose prose-emerald max-w-none">
                        {!! nl2br(e($activity->content)) !!}
                    </div>
                </div>

                <!-- Photo Gallery -->
                @if($activity->koperasi_activity_photos->count() > 0)
                    <div class="border-t border-emerald-100">
                        <div class="p-6 md:p-8">
                            <h2 class="text-2xl font-bold text-emerald-900 mb-6 font-serif">Galeri Foto</h2>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach($activity->koperasi_activity_photos as $photo)
                                    <a href="{{ asset('storage/' . $photo->path) }}"
                                        class="block aspect-square rounded-lg overflow-hidden group" data-fslightbox="gallery">
                                        <img src="{{ asset('storage/' . $photo->path) }}" alt="Foto {{ $activity->title }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <link href="{{ asset('css/fslightbox.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/fslightbox.min.js') }}"></script>
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

    </script>
@endsection