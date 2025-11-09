@extends('admin.template-admin')
@section('title', 'Kelola Struktur Organisasi TPA')
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <div class="max-w-full mx-auto">

            {{-- Alert --}}
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i data-lucide="check-circle" class="w-5 h-5 text-green-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i data-lucide="alert-circle" class="w-5 h-5 text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Header Stats -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Struktur Organisasi TPA</h2>
                        <p class="text-gray-600">Kelola struktur organisasi tpa Anda</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Struktur Organisasi TPA</h1>

                    @if(!$structure)
                        <a href="{{ route('admin.tpa.structure.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow transition">
                            <i data-lucide="plus" class="w-4 h-4 me-2"></i>
                            <span>Tambah Struktur</span>
                        </a>
                    @else
                        <a href="{{ route('admin.tpa.structure.edit', $structure->id) }}"
                            class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow transition">
                            <i data-lucide="edit" class="w-4 h-4 me-2"></i>
                            <span>Edit Struktur</span>
                        </a>
                    @endif
                </div>

                <!-- Konten Struktur Organisasi -->
                @if($structure)
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                        <!-- Header Card -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-blue-100">
                            <div class="flex flex-col md:flex-row md:items-center justify-between">
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800">{{ $structure->title }}</h2>
                                    @if($structure->description)
                                        <p class="text-blue-600 font-medium mt-1">{{ $structure->description }}</p>
                                    @endif
                                </div>
                                <div class="mt-2 md:mt-0">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i data-lucide="clock" class="w-3 h-3 mr-1"></i>
                                        Diperbarui: {{ $structure->updated_at->format('d M Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Body Card -->
                        <div class="p-6">
                            <div class="flex flex-col lg:flex-row gap-6">
                                <!-- Gambar Struktur Organisasi -->
                                <div class="lg:w-2/3">
                                    @if($structure->image)
                                        <div class="rounded-lg overflow-hidden shadow-md border border-gray-200">
                                            <img src="{{ asset('storage/' . $structure->image) }}" alt="{{ $structure->title }}"
                                                class="w-full h-auto object-contain transition-transform duration-300 hover:scale-105 max-w-3xl mx-auto">
                                        </div>
                                    @else
                                        <div class="rounded-lg border-2 border-dashed border-gray-300 h-64 flex flex-col items-center justify-center bg-gray-50">
                                            <i data-lucide="image" class="w-12 h-12 text-gray-400 mb-3"></i>
                                            <p class="text-gray-500 text-sm">Tidak ada gambar struktur organisasi</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Informasi dan Tombol Aksi -->
                                <div class="lg:w-1/3">
                                    <!-- Informasi Metadata -->
                                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                        <h3 class="font-medium text-gray-700 mb-3 flex items-center">
                                            <i data-lucide="info" class="w-4 h-4 mr-2"></i>
                                            Informasi Struktur
                                        </h3>
                                        <div class="space-y-3">
                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-500">Dibuat:</span>
                                                <span class="font-medium">{{ $structure->created_at->format('d M Y') }}</span>
                                            </div>
                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-500">Diperbarui:</span>
                                                <span class="font-medium">{{ $structure->updated_at->format('d M Y') }}</span>
                                            </div>
                                            @if($structure->description)
                                                <div class="pt-2 border-t border-gray-200">
                                                    <p class="text-sm text-gray-600">{{ $structure->description }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Tombol Aksi -->
                                    <div class="space-y-3">
                                        <!-- Edit -->
                                        <a href="{{ route('admin.tpa.structure.edit', $structure->id) }}"
                                            class="w-full inline-flex items-center justify-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow transition"
                                            title="Edit Struktur">
                                            <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                                            Edit Struktur
                                        </a>

                                        <!-- Delete -->
                                        <form action="{{ route('admin.tpa.structure.destroy', $structure->id) }}" method="POST"
                                            id="deleteForm-{{ $structure->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('deleteForm-{{ $structure->id }}').submit(), {
                                                        title: 'Hapus Struktur Organisasi',
                                                        message: 'Apakah Anda yakin ingin menghapus struktur organisasi ini? Tindakan ini tidak dapat dibatalkan.',
                                                        confirmText: 'Ya, Hapus',
                                                        confirmColor: 'bg-red-600 hover:bg-red-700',
                                                        confirmIcon: 'trash'
                                                    })"
                                            class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg shadow transition"
                                            title="Hapus Struktur">
                                            <i data-lucide="trash" class="w-4 h-4 mr-2"></i>
                                            Hapus Struktur
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- State Kosong -->
                    <div class="text-center py-16">
                        <div class="max-w-md mx-auto">
                            <div class="w-24 h-24 mx-auto mb-6 bg-blue-100 rounded-full flex items-center justify-center">
                                <i data-lucide="users" class="w-12 h-12 text-blue-500"></i>
                            </div>
                            <h3 class="text-xl font-medium text-gray-500 mb-2">Belum ada struktur organisasi</h3>
                            <p class="text-gray-400 mb-6">Mulai dengan menambahkan struktur organisasi tpa Anda</p>
                            <a href="{{ route('admin.tpa.structure.create') }}"
                                class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow transition">
                                <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
                                Tambah Struktur Organisasi
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <script>
        // Inisialisasi Lucide icons
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });

        // Fungsi untuk modal konfirmasi
        function openConfirmModal(modalId, confirmAction, options = {}) {
            // Implementasi modal konfirmasi sesuai dengan sistem yang sudah ada
            if (confirm(options.message || 'Apakah Anda yakin?')) {
                confirmAction();
            }
        }
    </script>
@endsection