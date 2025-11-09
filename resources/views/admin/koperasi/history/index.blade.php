@extends('admin.template-admin')
@section('title', 'Kelola Sejarah Koperasi')
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
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Sejarah Koperasi</h2>
                        <p class="text-gray-600">Kelola konten sejarah koperasi Anda</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Sejarah Koperasi</h1>

                    @if(!$history)
                        <a href="{{ route('admin.koperasi.history.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow transition">
                            <i data-lucide="plus" class="w-4 h-4 me-2"></i>
                            <span>Tambah Sejarah</span>
                        </a>
                    @else
                        <a href="{{ route('admin.koperasi.history.edit', $history->id) }}"
                            class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow transition">
                            <i data-lucide="edit" class="w-4 h-4 me-2"></i>
                            <span>Edit Sejarah</span>
                        </a>
                    @endif
                </div>

                <!-- Konten Sejarah -->
                @if($history)
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                        <!-- Header Card -->
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-green-100">
                            <div class="flex flex-col md:flex-row md:items-center justify-between">
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800">{{ $history->title }}</h2>
                                    @if($history->subtitle)
                                        <p class="text-green-600 font-medium mt-1">{{ $history->subtitle }}</p>
                                    @endif
                                </div>
                                <div class="mt-2 md:mt-0">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i data-lucide="clock" class="w-3 h-3 mr-1"></i>
                                        Diperbarui: {{ $history->updated_at->format('d M Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Body Card -->
                        <div class="p-6">
                            <div class="flex flex-col lg:flex-row gap-6">
                                <!-- Gambar -->
                                <div class="lg:w-1/3">
                                    @if($history->image)
                                        <div class="rounded-lg overflow-hidden shadow-md">
                                            <img src="{{ asset('storage/' . $history->image) }}" alt="{{ $history->title }}"
                                                class="w-full h-64 object-cover transition-transform duration-300 hover:scale-105">
                                        </div>
                                    @else
                                        <div class="rounded-lg border-2 border-dashed border-gray-300 h-64 flex flex-col items-center justify-center bg-gray-50">
                                            <i data-lucide="image" class="w-12 h-12 text-gray-400 mb-3"></i>
                                            <p class="text-gray-500 text-sm">Tidak ada gambar</p>
                                        </div>
                                    @endif
                                    
                                    <!-- Informasi Metadata -->
                                    <div class="mt-4 space-y-3">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Dibuat:</span>
                                            <span class="font-medium">{{ $history->created_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Konten -->
                                <div class="lg:w-2/3">
                                    <div class="content-paragraphs text-gray-700 space-y-4">
                                        @php
                                            // Memisahkan konten menjadi paragraf berdasarkan newline
                                            $paragraphs = preg_split('/\n|\r\n?/', $history->content);
                                        @endphp
                                        
                                        @foreach($paragraphs as $paragraph)
                                            @if(trim($paragraph) !== '')
                                                <p class="leading-relaxed text-justify">{{ $paragraph }}</p>
                                            @endif
                                        @endforeach
                                    </div>
                                    
                                    <!-- Tombol Aksi -->
                                    <div class="mt-6 pt-6 border-t border-gray-100 flex flex-wrap gap-3">
                                        <!-- Edit -->
                                        <a href="{{ route('admin.koperasi.history.edit', $history->id) }}"
                                            class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow transition"
                                            title="Edit Sejarah">
                                            <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                                            Edit Sejarah
                                        </a>

                                        <!-- Delete -->
                                        <form action="{{ route('admin.koperasi.history.destroy', $history->id) }}" method="POST"
                                            id="deleteForm-{{ $history->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('deleteForm-{{ $history->id }}').submit(), {
                                                        title: 'Hapus Sejarah',
                                                        message: 'Apakah Anda yakin ingin menghapus sejarah ini? Tindakan ini tidak dapat dibatalkan.',
                                                        confirmText: 'Ya, Hapus',
                                                        confirmColor: 'bg-red-600 hover:bg-red-700',
                                                        confirmIcon: 'trash'
                                                    })"
                                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg shadow transition"
                                            title="Hapus Sejarah">
                                            <i data-lucide="trash" class="w-4 h-4 mr-2"></i>
                                            Hapus Sejarah
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
                            <div class="w-24 h-24 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center">
                                <i data-lucide="history" class="w-12 h-12 text-green-500"></i>
                            </div>
                            <h3 class="text-xl font-medium text-gray-500 mb-2">Belum ada sejarah</h3>
                            <p class="text-gray-400 mb-6">Mulai dengan menambahkan sejarah Koperasi Anda</p>
                            <a href="{{ route('admin.koperasi.history.create') }}"
                                class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow transition">
                                <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
                                Tambah Sejarah Pertama
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <style>
        .content-paragraphs {
            line-height: 1.7;
        }
        
        .content-paragraphs p {
            margin-bottom: 1em;
            text-align: justify;
        }
        
        /* Style untuk paragraf pertama */
        .content-paragraphs p:first-child {
            font-size: 1.05em;
            color: #1f2937;
        }
        
        /* Style untuk paragraf penting (jika ada) */
        .content-paragraphs p.important {
            background-color: #f0fdf4;
            padding: 1em;
            border-left: 4px solid #10b981;
            border-radius: 0.375rem;
        }
    </style>

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

        // Optional: Tambahkan styling untuk paragraf yang mengandung kata kunci penting
        document.addEventListener('DOMContentLoaded', function() {
            const paragraphs = document.querySelectorAll('.content-paragraphs p');
            const importantKeywords = ['penting', 'utama', 'visi', 'misi', 'tujuan', 'nilai'];
            
            paragraphs.forEach(p => {
                const text = p.textContent.toLowerCase();
                if (importantKeywords.some(keyword => text.includes(keyword))) {
                    p.classList.add('important');
                }
            });
        });
    </script>
@endsection