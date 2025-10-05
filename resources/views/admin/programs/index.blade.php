@extends('admin.template-admin')
@section('title', 'Daftar Program')
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                <div class="mb-4 lg:mb-0">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Daftar Program</h2>
                    <p class="text-gray-600">Kelola semua program yang tersedia</p>
                </div>
                <div class="text-center lg:text-right">
                    <div class="text-4xl font-bold text-blue-600">{{ $programs->count() }}</div>
                    <div class="text-sm text-gray-500 mt-1">Total Program</div>
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
                        <input type="text" id="searchInput" placeholder="Cari program..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <select id="statusFilter"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="all">Semua Status</option>
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                    </select>
                    <a href="{{ route('admin-programs.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow transition">
                        <i data-lucide="plus" class="w-4 h-4 me-2"></i>
                        <span>Tambah Program</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Cards Container -->
        <div id="programsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($programs as $program)
                                <div class="program-card bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-300"
                                    data-title="{{ strtolower($program->title) }}" data-status="{{ $program->status }}">

                                    <!-- Icon Area 1:1 -->
                                    <div class="relative flex items-center justify-center">
                                        @if($program->thumbnail)
                                            <div class="w-36 h-36 flex items-center justify-center"> <!-- diperkecil -->
                                                <img src="{{ asset('storage/' . $program->thumbnail) }}" alt="{{ $program->title }}"
                                                    class="object-cover w-full h-full rounded-lg">
                                            </div>
                                        @else
                                            <div class="w-16 h-16 rounded-full bg-white p-2 shadow-sm flex items-center justify-center">
                                                <i data-lucide="book-open" class="w-8 h-8 text-blue-600"></i>
                                            </div>
                                        @endif

                                        <!-- Status Badge -->
                                        <div class="absolute top-4 right-4 text-xs">
                                            <span class="px-2 py-1 rounded-full font-medium shadow-sm
                                                                    {{ $program->status == 'published'
                ? 'bg-green-100 text-green-700 border border-green-200'
                : 'bg-gray-100 text-gray-700 border border-gray-200' }}">
                                                {{ ucfirst($program->status) }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="p-4">
                                        <h3 class="font-bold text-gray-800 text-base mb-1 text-center leading-tight">
                                            {{ $program->title }}
                                        </h3>

                                        <p class="text-gray-600 text-sm mb-3 text-center leading-relaxed line-clamp-1">
                                            {{ Str::limit(strip_tags($program->description), 80) }}
                                        </p>

                                        <!-- Metadata -->
                                        <div class="flex items-center justify-center text-xs text-gray-500 mb-3 space-x-3">
                                            <div class="flex items-center">
                                                <i data-lucide="calendar" class="w-3 h-3 mr-1"></i>
                                                <span>{{ $program->created_at->format('d M Y') }}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i data-lucide="clock" class="w-3 h-3 mr-1"></i>
                                                <span>{{ $program->created_at->format('H:i') }}</span>
                                            </div>
                                        </div>

                                        <!-- Actions -->
                                        <div class="flex items-center justify-center space-x-2 pt-2 border-t border-gray-100">
                                            <!-- View -->
                                            <a href="{{ route('admin-programs.show', $program->id) }}"
                                                class="inline-flex items-center p-2 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition-colors duration-200 group"
                                                title="Lihat Detail">
                                                <i data-lucide="eye" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                            </a>

                                            <!-- Edit -->
                                            <a href="{{ route('admin-programs.edit', $program->id) }}"
                                                class="inline-flex items-center p-2 bg-yellow-50 hover:bg-yellow-100 text-yellow-600 rounded-lg transition-colors duration-200 group"
                                                title="Edit Program">
                                                <i data-lucide="pencil" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                            </a>

                                            <!-- Delete -->
                                            <form action="{{ route('admin-programs.destroy', $program->id) }}" method="POST" id="deleteForm-{{ $program->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                            </form>
                                            <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('deleteForm-{{ $program->id }}').submit(), {
                                                    title: 'Hapus Program',
                                                    message: 'Apakah Anda yakin ingin menghapus program ini?',
                                                    confirmText: 'Ya, Hapus',
                                                    confirmColor: 'bg-red-600 hover:bg-red-700',
                                                    confirmIcon: 'trash'
                                                })"
                                                class="inline-flex items-center p-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors duration-200 group"
                                                title="Hapus Program">
                                                <i data-lucide="trash" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-full">
                    <div class="text-center py-12">
                        <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <i data-lucide="folder-open" class="w-12 h-12 text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada program</h3>
                        <p class="text-gray-500 mb-6">Mulai dengan membuat program pertama Anda</p>
                        <a href="{{ route('admin-programs.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow transition">
                            <i data-lucide="plus" class="w-4 h-4 me-2"></i>
                            <span>Tambah Program Pertama</span>
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- No Results State (Hidden by default) -->
        <div id="noResults" class="hidden text-center py-12">
            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <i data-lucide="search" class="w-12 h-12 text-gray-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada hasil</h3>
            <p class="text-gray-500">Coba ubah kata kunci pencarian atau filter</p>
        </div>
    </main>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl max-w-md w-full">
            <div class="flex items-center p-4 border-b border-gray-200">
                <div class="flex items-center justify-center w-10 h-10 bg-red-100 rounded-lg mr-3">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-red-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Hapus Program</h3>
            </div>
            <div class="p-4">
                <p class="text-gray-700" id="deleteMessage">Apakah Anda yakin ingin menghapus program ini?</p>
                <p class="text-sm text-gray-500 mt-2">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="flex justify-end gap-3 p-4 border-t border-gray-200">
                <button type="button" onclick="closeDeleteModal()"
                    class="px-4 py-2 text-gray-600 hover:text-gray-800 transition font-medium">
                    Batal
                </button>
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium flex items-center">
                        <i data-lucide="trash" class="w-4 h-4 mr-2"></i>
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .program-card {
            transition: all 0.3s ease;
        }

        .program-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.15);
        }

        /* Icon container dengan aspect ratio 1:1 */
        .program-card>div:first-child {
            display: flex;
            justify-content: center;
            align-items: center;
            /* Tambahkan ini supaya vertikal juga center */
            aspect-ratio: 1 / 1;
            overflow: hidden;
            /* Supaya gambar tidak keluar container */
        }
    </style>

    <script>
        // Filter and Search Functionality
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const programCards = document.querySelectorAll('.program-card');
            const noResults = document.getElementById('noResults');
            const programsContainer = document.getElementById('programsContainer');

            function filterPrograms() {
                const searchTerm = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value;
                let visibleCount = 0;

                programCards.forEach(card => {
                    const title = card.getAttribute('data-title');
                    const status = card.getAttribute('data-status');

                    const matchesSearch = title.includes(searchTerm);
                    const matchesStatus = statusValue === 'all' || status === statusValue;

                    if (matchesSearch && matchesStatus) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Show/hide no results message
                if (visibleCount === 0) {
                    noResults.classList.remove('hidden');
                    programsContainer.classList.add('hidden');
                } else {
                    noResults.classList.add('hidden');
                    programsContainer.classList.remove('hidden');
                }
            }

            searchInput.addEventListener('input', filterPrograms);
            statusFilter.addEventListener('change', filterPrograms);

            // Initial filter
            filterPrograms();
        });

        // Delete Confirmation Modal
        function confirmDelete(programTitle, button) {
            const form = button.closest('form');
            const modal = document.getElementById('deleteModal');
            const deleteMessage = document.getElementById('deleteMessage');
            const deleteForm = document.getElementById('deleteForm');

            deleteMessage.textContent = `Apakah Anda yakin ingin menghapus program "${programTitle}"?`;
            deleteForm.action = form.action;

            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
@endsection