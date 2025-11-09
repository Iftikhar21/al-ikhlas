@extends('admin.template-admin')
@section('title', 'Daftar Kegiatan Koperasi')
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <div class="bg-white rounded-lg shadow-sm p-6 mb-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Daftar Kegiatan Koperasi</h2>
                    <p class="text-gray-600">Kelola kegiatan koperasi masjid</p>
                </div>
                <div class="text-right">
                    <div class="text-4xl font-bold text-blue-600">{{ $activities->count() }}</div>
                    <div class="text-sm text-gray-500 mt-1">Total Kegiatan</div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Daftar Kegiatan</h1>
                <a href="{{ route('admin.koperasi.activity.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow transition">
                    <i data-lucide="plus" class="w-4 h-4 me-2"></i>
                    <span>Tambah Kegiatan</span>
                </a>
            </div>

            <!-- Grid Kegiatan -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($activities as $activity)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                        <!-- Thumbnail -->
                        <div class="relative h-48 overflow-hidden">
                            @if($activity->thumbnail)
                                <img src="{{ asset('storage/' . $activity->thumbnail) }}" alt="{{ $activity->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <i data-lucide="image" class="w-12 h-12 text-gray-400"></i>
                                </div>
                            @endif

                            <!-- Baris Atas: Tanggal + Tombol -->
                            <div class="absolute top-3 left-3 right-3 flex justify-between items-center">
                                <!-- Tanggal -->
                                <div class="bg-blue-600 text-white text-xs font-medium px-2 py-1 rounded">
                                    {{ $activity->created_at->format('d M Y') }}
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="flex space-x-2">
                                    <!-- Detail -->
                                    <a href="{{ route('admin.koperasi.activity.show', $activity->id) }}"
                                        class="flex items-center justify-center w-8 h-8 bg-blue-500 hover:bg-blue-600 text-white rounded shadow transition"
                                        title="Lihat Detail">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('admin.koperasi.activity.edit', $activity->id) }}"
                                        class="flex items-center justify-center w-8 h-8 bg-yellow-500 hover:bg-yellow-600 text-white rounded shadow transition"
                                        title="Edit Kegiatan">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.koperasi.activity.destroy', $activity->id) }}" 
                                          method="POST" 
                                          id="deleteForm-{{ $activity->id }}"
                                          class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" 
                                        onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('deleteForm-{{ $activity->id }}').submit(), {
                                            title: 'Hapus Kegiatan',
                                            message: 'Apakah Anda yakin ingin menghapus kegiatan ini?',
                                            confirmText: 'Ya, Hapus',
                                            confirmColor: 'bg-red-600 hover:bg-red-700',
                                            confirmIcon: 'trash'
                                        })"
                                        class="flex items-center justify-center w-8 h-8 bg-red-600 hover:bg-red-700 text-white rounded shadow transition"
                                        title="Hapus Kegiatan">
                                        <i data-lucide="trash" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Konten Card -->
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-800 mb-2 line-clamp-2">{{ $activity->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($activity->content), 120) }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <i data-lucide="clipboard-list" class="w-16 h-16 mx-auto text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-medium text-gray-500 mb-2">Belum ada kegiatan</h3>
                        <p class="text-gray-400 mb-6">Mulai dengan menambahkan kegiatan pertama</p>
                        <a href="{{ route('admin.koperasi.activity.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow transition">
                            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                            Tambah Kegiatan Pertama
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($activities->hasPages())
                <div class="mt-6">
                    {{ $activities->links() }}
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

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection