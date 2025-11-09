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
                    <div class="flex items-center gap-2">
                        <input type="date" id="filterDate"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            title="Filter berdasarkan tanggal">
                        <button type="button" id="applyFilter"
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow transition inline-flex items-center gap-2">
                            <i data-lucide="filter" class="w-4 h-4"></i>
                            <span>Terapkan Filter</span>
                        </button>
                        <button type="button" id="resetFilter"
                            class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg shadow transition inline-flex items-center gap-2">
                            <i data-lucide="x" class="w-4 h-4"></i>
                            <span>Reset</span>
                        </button>
                    </div>
                    <a href="{{ route('admin.masjid.kajian.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow transition">
                        <i data-lucide="plus" class="w-4 h-4 me-2"></i>
                        <span>Tambah Kajian</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Cards Container -->
        <div id="kajiansContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($kajians as $kajian)
                <div class="kajian-card bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-300"
                    data-judul="{{ strtolower($kajian->judul) }}" data-tanggal="{{ $kajian->tanggal?->format('Y-m-d') }}">

                    <!-- Poster Area -->
                    <div class="relative">
                        @if($kajian->poster)
                            <div class="aspect-w-3 aspect-h-4">
                                <img src="{{ asset('storage/' . $kajian->poster) }}" alt="{{ $kajian->judul }}"
                                    class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="aspect-w-3 aspect-h-4 bg-gray-100 flex items-center justify-center">
                                <i data-lucide="book-open" class="w-12 h-12 text-gray-400"></i>
                            </div>
                        @endif

                        <!-- Hari Badge -->
                        <div class="absolute top-4 right-4">
                            <span
                                class="px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                {{ $kajian->tanggal?->locale('id')->translatedFormat('l, d M Y') ?? 'Belum ada tanggal' }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $kajian->judul }}</h3>

                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                                <span>{{ $kajian->pembicara }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i data-lucide="clock" class="w-4 h-4 mr-2"></i>
                                <span>
                                    {{ \Carbon\Carbon::parse($kajian->waktu_mulai)->format('H:i') }} WIB -
                                    {{ \Carbon\Carbon::parse($kajian->waktu_selesai)->format('H:i') }} WIB
                                </span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i data-lucide="map-pin" class="w-4 h-4 mr-2"></i>
                                <span>{{ $kajian->lokasi }}</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.masjid.kajian.show', $kajian->id) }}"
                                    class="inline-flex items-center p-2 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition-colors duration-200 group"
                                    title="Lihat Detail">
                                    <i data-lucide="eye" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                </a>

                                <a href="{{ route('admin.masjid.kajian.edit', $kajian->id) }}"
                                    class="inline-flex items-center p-2 bg-yellow-50 hover:bg-yellow-100 text-yellow-600 rounded-lg transition-colors duration-200 group"
                                    title="Edit Kajian">
                                    <i data-lucide="pencil" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
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
                                    class="inline-flex items-center p-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors duration-200 group"
                                    title="Hapus Kajian">
                                    <i data-lucide="trash" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                </button>
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
            <p class="text-gray-500">Coba ubah kata kunci pencarian atau filter</p>
        </div>
    </main>

    <style>
        /* Add these styles */
        .aspect-w-3 {
            position: relative;
            padding-bottom: 133.333333%;
            /* 4:3 aspect ratio */
        }

        .aspect-w-3>* {
            position: absolute;
            height: 100%;
            width: 100%;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const filterDate = document.getElementById('filterDate');
            const applyFilter = document.getElementById('applyFilter');
            const resetFilter = document.getElementById('resetFilter');
            const kajianCards = document.querySelectorAll('.kajian-card');
            const noResults = document.getElementById('noResults');
            const kajiansContainer = document.getElementById('kajiansContainer');

            function filterKajians() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedDate = filterDate.value ? new Date(filterDate.value) : null;
                let visibleCount = 0;

                kajianCards.forEach(card => {
                    const judul = card.getAttribute('data-judul');
                    const tanggal = card.getAttribute('data-tanggal') ? new Date(card.getAttribute('data-tanggal')) : null;

                    const matchesSearch = judul.includes(searchTerm);
                    let matchesDate = true;

                    if (selectedDate && tanggal) {
                        matchesDate = tanggal.toDateString() === selectedDate.toDateString();
                    }

                    if (matchesSearch && matchesDate) {
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

            // Search input handler (real-time)
            searchInput.addEventListener('input', filterKajians);

            // Apply filter button handler
            applyFilter.addEventListener('click', filterKajians);

            // Reset filter button handler
            resetFilter.addEventListener('click', function() {
                searchInput.value = '';
                filterDate.value = '';
                kajianCards.forEach(card => {
                    card.style.display = 'block';
                });
                noResults.classList.add('hidden');
                kajiansContainer.classList.remove('hidden');
            });

            // Initialize - show all cards
            kajianCards.forEach(card => {
                card.style.display = 'block';
            });
        });
    </script>
@endsection