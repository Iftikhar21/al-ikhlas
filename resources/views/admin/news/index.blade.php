@extends('admin.template-admin')
@section('title', 'Daftar Berita')
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <div class="bg-white rounded-lg shadow-sm p-6 mb-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Daftar Berita</h2>
                    <p class="text-gray-600">Pilih berita yang ingin anda lihat</p>
                </div>
                <div class="text-right">
                    <div class="text-4xl font-bold text-blue-600">{{ $news->count() }}</div>
                    <div class="text-sm text-gray-500 mt-1">Total Berita</div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Daftar Berita</h1>
                <a href="{{ route('admin.news.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow transition">
                    <i data-lucide="plus" class="w-4 h-4 me-2"></i>
                    <span>Tambah Berita</span>
                </a>
            </div>

            <!-- Filter dan Pencarian -->
            <div class="flex flex-col md:flex-row gap-4 mb-6">
                <div class="relative flex-grow">
                    <input type="text" placeholder="Cari berita..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                </div>
            </div>

            <!-- Grid Berita -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($news as $item)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                        <!-- Thumbnail -->
                        <div class="relative h-48 overflow-hidden">
                            @if($item->thumbnail)
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-4xl"></i>
                                </div>
                            @endif

                            <!-- Baris Atas: Tanggal + Tombol -->
                            <div class="absolute top-3 left-3 right-3 flex justify-between items-center">
                                <!-- Tanggal -->
                                <div class="bg-blue-600 text-white text-xs font-medium px-2 py-1 rounded">
                                    {{ $item->created_at->format('d M Y') }}
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="flex space-x-2">
                                    <!-- Detail -->
                                    <a href="{{ route('admin.news.show', $item->id) }}"
                                        class="flex items-center justify-center w-8 h-8 bg-blue-500 hover:bg-blue-600 text-white rounded shadow transition"
                                        title="Lihat Detail">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('admin.news.edit', $item->id) }}"
                                        class="flex items-center justify-center w-8 h-8 bg-yellow-500 hover:bg-yellow-600 text-white rounded shadow transition"
                                        title="Edit Berita">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" id="deleteForm-{{ $item->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('deleteForm-{{ $item->id }}').submit(), {
                                            title: 'Hapus Berita',
                                            message: 'Apakah Anda yakin ingin menghapus berita ini?',
                                            confirmText: 'Ya, Hapus',
                                            confirmColor: 'bg-red-600 hover:bg-red-700',
                                            confirmIcon: 'trash'
                                        })"
                                        class="flex items-center justify-center w-8 h-8 bg-red-600 hover:bg-red-700 text-white rounded shadow transition"
                                        title="Hapus Berita">
                                        <i data-lucide="trash" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Konten Card -->
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-800 mb-2 line-clamp-2">{{ $item->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($item->content), 120) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pesan jika tidak ada berita -->
            @if($news->count() == 0)
                <div class="text-center py-12">
                    <i class="fas fa-newspaper text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-xl font-medium text-gray-500 mb-2">Belum ada berita</h3>
                    <p class="text-gray-400 mb-6">Mulai dengan menambahkan berita pertama Anda</p>
                    <a href="{{ route('admin.news.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow transition">
                        <i class="fas fa-plus mr-2"></i> Tambah Berita Pertama
                    </a>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($news->count() > 0)
            <div class="mt-4">
                {{ $news->links('pagination::tailwind') }}
            </div>
        @endif
    </main>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection