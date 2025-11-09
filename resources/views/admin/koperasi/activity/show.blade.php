@extends('admin.template-admin')
@section('title', $activity->title)
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <!-- Tombol Aksi -->
        <div class="mb-3 flex flex-wrap gap-2">
            <a href="{{ route('admin.koperasi.activity.edit', $activity) }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow transition">
                <i data-lucide="pencil" class="w-4 h-4"></i>
                <span>Edit</span>
            </a>

            <form id="deleteForm-{{ $activity->id }}" 
                  action="{{ route('admin.koperasi.activity.destroy', $activity->id) }}" 
                  method="POST">
                @csrf
                @method('DELETE')
                <button type="button"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg shadow transition"
                    onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('deleteForm-{{ $activity->id }}').submit(), {
                        title: 'Hapus Kegiatan',
                        message: 'Apakah Anda yakin ingin menghapus kegiatan ini?',
                        confirmText: 'Ya, Hapus',
                        confirmColor: 'bg-red-600 hover:bg-red-700',
                        confirmIcon: 'trash-2'
                    })">
                    <i data-lucide="trash" class="w-4 h-4"></i>
                    <span>Hapus</span>
                </button>
            </form>

            <a href="{{ route('admin.koperasi.activity.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg shadow transition">
                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                <span>Kembali</span>
            </a>
        </div>

        <!-- Card Detail Kegiatan -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden max-w-full mx-auto">
            <!-- Header Kegiatan -->
            <div class="p-8 border-b border-gray-200">
                <!-- Judul -->
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                    {{ $activity->title }}
                </h1>

                <!-- Meta Info -->
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-2">
                    <div class="flex items-center">
                        <i data-lucide="calendar" class="w-4 h-4 mr-2 text-blue-600"></i>
                        <span>{{ $activity->created_at->translatedFormat('d F Y') }}</span>
                    </div>
                    <span>|</span>
                    <div class="flex items-center">
                        <i data-lucide="clock" class="w-4 h-4 mr-2 text-blue-600"></i>
                        <span>{{ $activity->created_at->format('H:i') }} WIB</span>
                    </div>
                </div>
            </div>

            <!-- Thumbnail Utama -->
            <div class="relative">
                @if($activity->thumbnail)
                    <img src="{{ asset('storage/' . $activity->thumbnail) }}" 
                         alt="{{ $activity->title }}"
                         class="w-full h-64 lg:h-96 object-cover">
                @else
                    <div class="w-full h-64 lg:h-96 bg-gray-200 flex items-center justify-center">
                        <i data-lucide="image" class="w-24 h-24 text-gray-400"></i>
                    </div>
                @endif

                <!-- Deskripsi Gambar -->
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                    <p class="text-white text-sm text-center">
                        Dokumentasi kegiatan {{ $activity->title }}
                    </p>
                </div>
            </div>

            <!-- Konten Kegiatan -->
            <div class="p-8">
                <!-- Ringkasan -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8 rounded-r-lg">
                    <p class="text-gray-700 font-medium flex items-start gap-2">
                        <i data-lucide="info" class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5"></i>
                        <span>
                            <strong>Ringkasan:</strong> 
                            {{ Str::limit(strip_tags($activity->content), 200) }}
                        </span>
                    </p>
                </div>

                <!-- Konten Utama -->
                <article class="prose max-w-none text-gray-700 leading-relaxed">
                    @foreach(explode("\n\n", $activity->content) as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </article>
            </div>

            <!-- Galeri Foto -->
            @if($activity->koperasi_activity_photos->count() > 0)
                <div class="p-8 border-t border-gray-200 bg-gray-50">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <i data-lucide="images" class="w-6 h-6 mr-2 text-blue-500"></i>
                        Dokumentasi Kegiatan
                    </h2>
                    <p class="text-gray-600 mb-6">Foto-foto dokumentasi kegiatan koperasi</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($activity->koperasi_activity_photos as $photo)
                            <div class="group relative overflow-hidden rounded-lg shadow-md cursor-pointer"
                                 onclick="openModal('{{ asset('storage/' . $photo->path) }}')">
                                <img src="{{ asset('storage/' . $photo->path) }}" 
                                     alt="Dokumentasi {{ $activity->title }}"
                                     class="w-full h-48 object-cover transition duration-300 group-hover:scale-105">
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <i data-lucide="zoom-in" class="w-8 h-8 text-white"></i>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </main>

    <!-- Modal Image Preview -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black/75 flex items-center justify-center p-4">
        <div class="relative max-w-4xl w-full">
            <img id="modalImage" src="" alt="Preview" class="w-full h-auto rounded-lg shadow-xl">
            <button onclick="closeModal()" class="absolute -top-4 -right-4 bg-white rounded-full p-2 shadow-lg hover:bg-gray-100 transition">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>
    </div>

    <style>
        .prose {
            max-width: none;
        }
        .prose p {
            margin-bottom: 1.5em;
            line-height: 1.8;
        }
    </style>

    <script>
        // Image Modal Functions
        function openModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });

        // Close modal when clicking outside image
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    </script>
@endsection