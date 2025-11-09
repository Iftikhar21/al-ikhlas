@extends('admin.template-admin')
@section('title', 'Kelola Visi & Misi Masjid')
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
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Visi & Misi Masjid</h2>
                        <p class="text-gray-600">Kelola visi dan misi masjid Anda</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Daftar Visi & Misi</h1>

                    @if($visions->isEmpty())
                        <a href="{{ route('admin.masjid.visions.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow transition">
                            <i data-lucide="plus" class="w-4 h-4 me-2"></i>
                            <span>Tambah Visi & Misi</span>
                        </a>
                    @else
                        <div class="flex items-center gap-2 text-amber-600 bg-amber-50 px-3 py-2 rounded-lg">
                            <i data-lucide="info" class="w-4 h-4"></i>
                            <span class="text-sm">Data sudah ada. Silakan edit jika ingin mengubah.</span>
                        </div>
                    @endif
                </div>

                <!-- Konten Visi & Misi -->
                @if($visions->isNotEmpty())
                    <div class="space-y-6">
                        @foreach($visions as $index => $item)
                            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                                <!-- Header Card -->
                                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-4 border-b border-purple-100">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                                        <div>
                                            <h2 class="text-xl font-bold text-gray-800">Visi & Misi #{{ $index + 1 }}</h2>
                                            <p class="text-purple-600 font-medium mt-1">Dokumen Visi & Misi Masjid</p>
                                        </div>
                                        <div class="mt-2 md:mt-0">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                <i data-lucide="clock" class="w-3 h-3 mr-1"></i>
                                                Diperbarui: {{ $item->updated_at->format('d M Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Body Card -->
                                <div class="p-6">
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <!-- Visi -->
                                        <div>
                                            <div class="flex items-center mb-3">
                                                <div
                                                    class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                                    <i data-lucide="eye" class="w-4 h-4 text-purple-600"></i>
                                                </div>
                                                <h3 class="text-lg font-semibold text-gray-800">Visi</h3>
                                            </div>
                                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                                <p class="text-gray-700 leading-relaxed">{{ $item->vision }}</p>
                                            </div>
                                        </div>

                                        <!-- Misi -->
                                        <div>
                                            <div class="flex items-center mb-3">
                                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                    <i data-lucide="target" class="w-4 h-4 text-blue-600"></i>
                                                </div>
                                                <h3 class="text-lg font-semibold text-gray-800">Misi</h3>
                                            </div>
                                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                                <ul class="space-y-2">
                                                    @foreach($item->missions as $missionIndex => $mission)
                                                        <li class="flex items-start">
                                                            <span
                                                                class="inline-flex items-center justify-center w-6 h-6 bg-blue-100 text-blue-600 rounded-full text-xs font-medium mr-3 mt-0.5 flex-shrink-0">
                                                                {{ $missionIndex + 1 }}
                                                            </span>
                                                            <span class="text-gray-700 leading-relaxed">{{ $mission }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tombol Aksi -->
                                    <div class="mt-6 pt-6 border-t border-gray-100 flex flex-wrap gap-3">
                                        <!-- Edit -->
                                        <a href="{{ route('admin.masjid.visions.edit', $item->id) }}"
                                            class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow transition"
                                            title="Edit Visi & Misi">
                                            <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                                            Edit
                                        </a>

                                        <!-- Delete -->
                                        <form action="{{ route('admin.masjid.visions.destroy', $item->id) }}" method="POST"
                                            id="deleteForm-{{ $item->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('deleteForm-{{ $item->id }}').submit(), {
                                                                                title: 'Hapus Visi & Misi',
                                                                                message: 'Apakah Anda yakin ingin menghapus visi & misi ini? Tindakan ini tidak dapat dibatalkan.',
                                                                                confirmText: 'Ya, Hapus',
                                                                                confirmColor: 'bg-red-600 hover:bg-red-700',
                                                                                confirmIcon: 'trash'
                                                                            })"
                                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg shadow transition"
                                            title="Hapus Visi & Misi">
                                            <i data-lucide="trash" class="w-4 h-4 mr-2"></i>
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- State Kosong -->
                    <div class="text-center py-16">
                        <div class="max-w-md mx-auto">
                            <div class="w-24 h-24 mx-auto mb-6 bg-purple-100 rounded-full flex items-center justify-center">
                                <i data-lucide="target" class="w-12 h-12 text-purple-500"></i>
                            </div>
                            <h3 class="text-xl font-medium text-gray-500 mb-2">Belum ada visi & misi</h3>
                            <p class="text-gray-400 mb-6">Mulai dengan menambahkan visi dan misi masjid Anda</p>
                            <a href="{{ route('admin.masjid.visions.create') }}"
                                class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg shadow transition">
                                <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
                                Tambah Visi & Misi Pertama
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

    <style>
        .content-paragraphs {
            line-height: 1.7;
        }

        .content-paragraphs p {
            margin-bottom: 1em;
            text-align: justify;
        }
    </style>
@endsection