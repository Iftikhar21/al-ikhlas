@extends('admin.template-admin')
@section('title', $news->title)
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <!-- Tombol Aksi -->
        <div class="mb-3 flex flex-wrap gap-2">
            <a href="{{ route('admin.news.edit', $news->id) }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow transition">
                <i data-lucide="pencil" class="w-4 h-4"></i>
                <span>Edit</span>
            </a>

            <form id="deleteForm-{{ $news->id }}" action="{{ route('admin.news.destroy', $news->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg shadow transition"
                    onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('deleteForm-{{ $news->id }}').submit(), {
                        title: 'Hapus Berita',
                        message: 'Apakah Anda yakin ingin menghapus berita ini?',
                        confirmText: 'Ya, Hapus',
                        confirmColor: 'bg-red-600 hover:bg-red-700',
                        confirmIcon: 'trash-2'
                    })">
                    <i data-lucide="trash" class="w-4 h-4"></i>
                    <span>Hapus</span>
                </button>
            </form>

            <a href="{{ route('admin.news.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg shadow transition">
                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                <span>Kembali</span>
            </a>
        </div>

        <!-- Card Artikel Utama -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden max-w-full mx-auto">
            <!-- Header Artikel -->
            <div class="p-8 border-b border-gray-200">

                <!-- Judul -->
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                    {{ $news->title }}
                </h1>

                <!-- Meta Info -->
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-2">
                    <div class="flex items-center">
                        <i class="far fa-calendar mr-2 text-blue-600"></i>
                        <span>{{ $news->created_at->translatedFormat('d F Y') }}</span>
                    </div>
                    <span>
                        |
                    </span>
                    <div class="flex items-center">
                        <i class="far fa-clock mr-2 text-blue-600"></i>
                        <span>{{ $news->created_at->format('H:i') }} WIB</span>
                    </div>
                </div>
            </div>

            <!-- Thumbnail Utama -->
            <div class="relative">
                @if($news->thumbnail)
                    <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}"
                        class="w-full h-64 lg:h-96 object-cover">
                @else
                    <div class="w-full h-64 lg:h-96 bg-gray-200 flex items-center justify-center">
                        <i data-lucide="image" class="text-6xl text-gray-500 mr-2"></i>
                    </div>
                @endif

                <!-- Deskripsi Gambar -->
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                    <p class="text-white text-sm text-center">
                        Ilustrasi berita {{ $news->title }}
                    </p>
                </div>
            </div>

            <!-- Konten Artikel -->
            <div class="p-8">
                <!-- Ringkasan -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8 rounded-r-lg">
                    <p class="text-gray-700 font-medium">
                        <i data-lucide="info" class="text-xs mb-2 text-blue-500"></i>
                        <strong>Ringkasan:</strong> {{ Str::limit(strip_tags($news->content), 200) }}
                    </p>
                </div>

                <!-- Konten Utama -->
                <article class="prose max-w-none text-gray-700 leading-relaxed text-xs lg:text-lg mb-8">
                    @foreach(explode("\n\n", $news->content) as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </article>
            </div>

            <!-- Galeri Foto (jika ada) -->
            @if($news->photos->count() > 0)
                <div class="p-8 border-t border-gray-200 bg-gray-50">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <i data-lucide="image" class="text-xs mr-2"></i>
                        Galeri Foto
                    </h2>
                    <p class="text-gray-600 mb-6">Dokumentasi foto pendukung berita ini</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($news->photos as $photo)
                            <div class="overflow-hidden rounded-lg shadow-md">
                                <img src="{{ asset('storage/' . $photo->path) }}" alt="Foto pendukung {{ $news->title }}"
                                    class="w-full h-auto object-cover">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </main>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .prose {
            max-width: none;
        }

        .prose p {
            margin-bottom: 1.5em;
            line-height: 1.8;
        }

        .prose img {
            border-radius: 0.5rem;
            margin: 2rem 0;
        }

        .prose h1,
        .prose h2,
        .prose h3,
        .prose h4 {
            color: #1f2937;
            margin-top: 1.5em;
            margin-bottom: 0.5em;
        }

        .prose ul,
        .prose ol {
            margin-bottom: 1.5em;
        }
    </style>

    <script>
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
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Close modal when clicking outside image
        document.getElementById('imageModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
@endsection