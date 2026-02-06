@extends('admin.template-admin')
@section('title', 'Daftar Kajian')
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                <div class="mb-4 lg:mb-0">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Daftar Kajian</h2>
                    <p class="text-gray-600">Kelola semua kajian yang tersedia</p>
                </div>
                <div class="text-center lg:text-right">
                    <div class="text-4xl font-bold text-blue-600">{{ $kajians->count() }}</div>
                    <div class="text-sm text-gray-500 mt-1">Total Kajian</div>
                </div>
            </div>
        </div>

        <!-- Filter dan Search -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <i data-lucide="search"
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
                        <input type="text" id="searchInput" placeholder="Cari kajian..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.masjid.kajian.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow transition">
                        <i data-lucide="plus" class="w-4 h-4 me-2"></i>
                        <span>Tambah Kajian</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- List Container -->
        <div id="kajiansContainer" class="space-y-4">
            @forelse($kajians as $kajian)
                <div class="kajian-card bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-300"
                    data-judul="{{ strtolower($kajian->judul) }}" data-hari="{{ strtolower($kajian->hari) }}">
                    <div class="flex flex-col md:flex-row">
                        <!-- Poster Area - Diperbaiki -->
                        <div class="md:w-1/6 lg:w-1/7 relative">
                            @if($kajian->poster)
                                <div class="w-full h-full min-h-[200px] md:min-h-[240px]">
                                    <img src="{{ asset('storage/' . $kajian->poster) }}" alt="{{ $kajian->judul }}"
                                        class="w-full h-full object-cover">
                                </div>
                            @else
                                <div
                                    class="w-full h-full min-h-[200px] md:min-h-[240px] bg-gray-100 flex flex-col items-center justify-center gap-2 py-12 px-12">
                                    <i data-lucide="book-open" class="w-12 h-12 text-gray-400"></i>
                                    <span class="text-sm text-gray-400">No image</span>
                                </div>
                            @endif

                            <!-- Hari & Jenis Badge -->
                            <div class="absolute top-3 right-3 flex flex-col sm:flex-row gap-1 sm:gap-2">
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium
                                           bg-blue-100 text-blue-800 border border-blue-200 whitespace-nowrap">
                                    <i data-lucide="calendar" class="w-3 h-3 text-blue-600"></i>
                                    {{ ucfirst($kajian->hari) }}
                                </span>

                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium
                                           bg-green-100 text-green-800 border border-green-200 whitespace-nowrap">
                                    <i data-lucide="hash" class="w-3 h-3 text-green-600"></i>
                                    {{ ucfirst($kajian->jenis_kajian) }}
                                </span>
                            </div>
                        </div>

                        <!-- Content - Diperbaiki -->
                        <div class="md:w-5/6 lg:w-6/7 p-6 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-gray-800 text-xl mb-4 line-clamp-2">{{ $kajian->judul }}</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4">
                                    <div class="flex items-start text-gray-600">
                                        <i data-lucide="user" class="w-4 h-4 mr-2 mt-0.5 text-blue-500 flex-shrink-0"></i>
                                        <div>
                                            <span class="font-medium">Pemateri:</span>
                                            <span class="ml-1">{{ $kajian->pembicara }}</span>
                                        </div>
                                    </div>

                                    @if($kajian->jenis_kajian === 'bulanan' && $kajian->waktu_mulai && $kajian->waktu_selesai)
                                        <div class="flex items-start text-gray-600">
                                            <i data-lucide="clock" class="w-4 h-4 mr-2 mt-0.5 text-blue-500 flex-shrink-0"></i>
                                            <div>
                                                <span class="font-medium">Waktu:</span>
                                                <span class="ml-1">
                                                    {{ \Carbon\Carbon::parse($kajian->waktu_mulai)->format('H:i') }} -
                                                    {{ \Carbon\Carbon::parse($kajian->waktu_selesai)->format('H:i') }} WIB
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <div></div> <!-- Placeholder untuk menjaga grid -->
                                    @endif

                                    @if($kajian->lokasi)
                                        <div class="flex items-start text-gray-600 md:col-span-2">
                                            <i data-lucide="map-pin" class="w-4 h-4 mr-2 mt-0.5 text-blue-500 flex-shrink-0"></i>
                                            <div>
                                                <span class="font-medium">Lokasi:</span>
                                                <span class="ml-1">{{ $kajian->lokasi }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Actions - Diperbaiki -->
                            <div
                                class="flex flex-col sm:flex-row items-start sm:items-center justify-between pt-4 border-t border-gray-100 gap-3 sm:gap-0">
                                <div class="text-sm text-gray-500">
                                    Dibuat: {{ \Carbon\Carbon::parse($kajian->created_at)->format('d M Y') }}
                                </div>
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.masjid.kajian.edit', $kajian->id) }}"
                                        class="inline-flex items-center px-4 py-2 bg-yellow-50 hover:bg-yellow-100 text-yellow-600 rounded-lg transition-colors duration-200 group"
                                        title="Edit Kajian">
                                        <i data-lucide="pencil" class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform"></i>
                                        <span>Edit</span>
                                    </a>

                                    <form action="{{ route('admin.masjid.kajian.destroy', $kajian->id) }}" method="POST"
                                        id="deleteKajianForm-{{ $kajian->id }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('deleteKajianForm-{{ $kajian->id }}').submit(), {
                                                                        title: 'Hapus Kajian',
                                                                        message: 'Apakah Anda yakin ingin menghapus kajian ini?',
                                                                        confirmText: 'Ya, Hapus',
                                                                        confirmColor: 'bg-red-600 hover:bg-red-700',
                                                                        confirmIcon: 'trash'
                                                                    })"
                                        class="inline-flex items-center px-4 py-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors duration-200 group"
                                        title="Hapus Kajian">
                                        <i data-lucide="trash" class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform"></i>
                                        <span>Hapus</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-full">
                    <div class="text-center py-12">
                        <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <i data-lucide="book-open" class="w-12 h-12 text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada kajian</h3>
                        <p class="text-gray-500 mb-6">Mulai dengan membuat kajian pertama Anda</p>
                        <a href="{{ route('admin.masjid.kajian.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow transition">
                            <i data-lucide="plus" class="w-4 h-4 me-2"></i>
                            <span>Tambah Kajian Pertama</span>
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- No Results State -->
        <div id="noResults" class="hidden text-center py-12">
            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <i data-lucide="search" class="w-12 h-12 text-gray-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada hasil</h3>
            <p class="text-gray-500">Coba ubah kata kunci pencarian</p>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const kajianCards = document.querySelectorAll('.kajian-card');
            const noResults = document.getElementById('noResults');
            const kajiansContainer = document.getElementById('kajiansContainer');

            function filterKajians() {
                const searchTerm = searchInput.value.toLowerCase();
                let visibleCount = 0;

                kajianCards.forEach(card => {
                    const judul = card.getAttribute('data-judul');
                    const matchesSearch = judul.includes(searchTerm);

                    if (matchesSearch) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (visibleCount === 0) {
                    noResults.classList.remove('hidden');
                    kajiansContainer.classList.add('hidden');
                } else {
                    noResults.classList.add('hidden');
                    kajiansContainer.classList.remove('hidden');
                }
            }

            // Search real-time
            searchInput.addEventListener('input', filterKajians);

            kajianCards.forEach(card => card.style.display = 'block');
        });
    </script>
@endsection