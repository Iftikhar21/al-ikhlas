@extends('template')
@section('title', 'Kegiatan Koperasi - Masjid Al-Ikhlas')

@section('meta')
    <meta name="description" content="Kegiatan dan aktivitas Koperasi Masjid Al-Ikhlas">
    <meta name="keywords" content="koperasi masjid, kegiatan koperasi, aktivitas koperasi, al-ikhlas">
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[40vh] min-h-[400px] bg-gradient-to-br from-emerald-700 via-emerald-800 to-emerald-900 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.1\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
            </div>
        </div>

        <div class="relative z-10 container mx-auto px-4 h-full flex flex-col items-center justify-center text-center">
            <div class="mb-6 p-3 bg-white/10 rounded-full backdrop-blur-sm">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center">
                    <img src="{{ asset('img/al_ikhlas_logo.jpg') }}" class="rounded-full" alt="Logo Masjid Al-Ikhlas">
                </div>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 font-serif">Kegiatan Koperasi</h1>
            <div class="w-20 h-1 bg-amber-400 mb-4"></div>
            <p class="text-lg text-white/90 max-w-2xl">
                Dokumentasi kegiatan dan aktivitas Koperasi Masjid Al-Ikhlas
            </p>
        </div>
    </section>

    <!-- Activities Grid Section -->
    <section class="py-16 px-4 bg-gradient-to-b from-emerald-50 to-white">
        <div class="container mx-auto max-w-7xl">
            @if($activities->count() > 0)
                <!-- Grid Container -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($activities as $activity)
                        <!-- Activity Card -->
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden group border border-emerald-100">
                            <!-- Thumbnail -->
                            <div class="aspect-video overflow-hidden bg-emerald-100">
                                @if($activity->thumbnail)
                                    <img src="{{ asset('storage/' . $activity->thumbnail) }}" 
                                         alt="{{ $activity->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i data-lucide="image" class="w-12 h-12 text-emerald-300"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-emerald-900 mb-2 line-clamp-2 group-hover:text-emerald-600 transition-colors">
                                    {{ $activity->title }}
                                </h3>
                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ Str::limit(strip_tags($activity->content), 150) }}
                                </p>

                                <!-- Photos Count & Read More -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2 text-sm text-emerald-600">
                                        <i data-lucide="image" class="w-4 h-4"></i>
                                        <span>{{ $activity->koperasi_activity_photos->count() }} Foto</span>
                                    </div>
                                    <a href="{{ route('koperasi.activity.detail', $activity->slug) }}" 
                                       class="inline-flex items-center gap-2 text-sm font-medium text-emerald-600 hover:text-emerald-700 transition-colors">
                                        Selengkapnya
                                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($activities->hasPages())
                    <div class="mt-12">
                        {{ $activities->links() }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="max-w-md mx-auto">
                        <div class="bg-white rounded-xl shadow-sm border border-emerald-100 p-6">
                            <i data-lucide="calendar-x" class="w-16 h-16 mx-auto text-emerald-400 mb-4"></i>
                            <h3 class="text-xl font-bold text-emerald-900 mb-2">Belum Ada Kegiatan</h3>
                            <p class="text-emerald-600">
                                Saat ini belum ada kegiatan yang ditambahkan. Silakan cek kembali nanti.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Initialize Lucide icons
    lucide.createIcons();
</script>
@endpush