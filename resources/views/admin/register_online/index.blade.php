@extends('admin.template-admin')
@section('title', 'Daftar Pendaftar')
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Daftar Daftar Pendaftar Online</h2>
                        <p class="text-gray-600">Kelola pendaftaran siswa baru secara online</p>
                    </div>
                    <div class="text-right">
                        <div class="text-4xl font-bold text-blue-600">{{ $registrations->count() }}</div>
                        <div class="text-sm text-gray-500 mt-1">Total Pendaftar</div>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div id="success-alert"
                    class="mb-6 bg-green-50 border border-green-200 rounded-xl p-4 shadow-sm transition-opacity duration-500">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i data-lucide="circle-check" class="text-green-500 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-green-800 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>

                <script>
                    setTimeout(() => {
                        let alertBox = document.getElementById('success-alert');
                        if (alertBox) {
                            alertBox.style.opacity = '0';
                            setTimeout(() => alertBox.remove(), 500); // hapus setelah animasi
                        }
                    }, 3000); // 3 detik
                </script>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i data-lucide="user" class="text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Pendaftar</p>
                            <p class="text-2xl font-bold text-gray-900">{{ count($registrations) }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i data-lucide="clock" class="text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Menunggu</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $registrations->where('is_approved', false)->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i data-lucide="circle-check" class="text-green-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Disetujui</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $registrations->where('is_approved', true)->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between space-y-4 lg:space-y-0">
                    <div class="flex-1 max-w-md">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="search" class="text-gray-400"></i>
                            </div>
                            <input type="text"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                placeholder="Cari nama, nomor HP, email...">
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <button
                            class="filter-btn px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium shadow-sm hover:bg-blue-700 transition-colors duration-200 active">
                            Semua
                        </button>
                        <button
                            class="filter-btn px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors duration-200">
                            Menunggu
                        </button>
                        <button
                            class="filter-btn px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors duration-200">
                            Disetujui
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <span>Pendaftar</span>
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Informasi
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Kontak
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($registrations as $reg)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-12 w-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-sm">
                                                <span
                                                    class="text-white font-semibold text-lg">{{ substr($reg->full_name, 0, 1) }}</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900">{{ $reg->full_name }}</div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $reg->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ \Carbon\Carbon::parse($reg->birth_date)->format('d M Y') }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($reg->birth_date)->age }} tahun • {{ $reg->birth_place }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $reg->parent_phone }}</div>
                                        <div class="text-sm text-gray-500 truncate max-w-xs">
                                            {{ $reg->parent_email ?? 'Tidak ada email' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($reg->is_approved)
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                                <i data-lucide="circle-check" class="mr-1.5"></i>
                                                Disetujui
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                                <i data-lucide="clock" class="mr-1.5"></i>
                                                Menunggu
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.admin-register-online.show', $reg->id) }}"
                                                title="Lihat Detail Pendaftar"
                                                class="inline-flex items-center px-2 py-1 bg-blue-50 text-blue-700 rounded-lg text-sm font-medium hover:bg-blue-100 transition-colors duration-200">
                                                <i data-lucide="eye" class=""></i>
                                            </a>

                                            @if(!$reg->is_approved)
                                                <form action="{{ route('admin.admin-register-online.approve', $reg->id) }}" method="POST"
                                                    id="approveForm-{{ $reg->id }}">
                                                    @csrf
                                                </form>
                                                <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('approveForm-{{ $reg->id }}').submit(), {
                                                                                                title: 'Setujui Pendaftar',
                                                                                                message: 'Apakah Anda yakin ingin menyetujui pendaftar ini?',
                                                                                                confirmText: 'Ya, Setujui',
                                                                                                confirmColor: 'bg-green-600 hover:bg-green-700',
                                                                                                confirmIcon: 'check'
                                                                                            })" 
                                                    class="inline-flex items-center px-2 py-1 bg-green-50 text-green-700 rounded-lg text-sm font-medium hover:bg-green-100 transition-colors duration-200" 
                                                    title="Setujui Pendaftar">
                                                    <i data-lucide="check" class=""></i>
                                                </button>
                                            @endif
                                            <form action="{{ route('admin.admin-register-online.destroy', $reg->id) }}" method="POST" id="deleteForm-{{ $reg->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('deleteForm-{{ $reg->id }}').submit(), {
                                                                                                title: 'Hapus Pendaftar',
                                                                                                message: 'Apakah Anda yakin ingin menghapus pendaftar ini?',
                                                                                                confirmText: 'Ya, Hapus',
                                                                                                confirmColor: 'bg-red-600 hover:bg-red-700',
                                                                                                confirmIcon: 'trash'
                                                                                            })"
                                                class="inline-flex items-center px-2 py-1 bg-red-50 text-red-700 rounded-lg text-sm font-medium hover:bg-red-100
                                                transition-colors duration-200"
                                                title="Hapus Pendaftar">
                                                <i data-lucide="trash" class=""></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Empty State -->
                @if(count($registrations) == 0)
                    <div class="text-center py-16">
                        <div class="mx-auto h-24 w-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <i data-lucide="user" class="text-gray-400 text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada pendaftar</h3>
                        <p class="text-gray-500 max-w-md mx-auto mb-6">Belum ada pendaftaran online yang masuk. Data akan muncul
                            di sini setelah ada pendaftar baru.</p>
                        <button
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <i data-lucide="refresh-ccw" class="mr-2"></i>
                            Refresh Halaman
                        </button>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                <div class="text-sm text-gray-700">
                    Menampilkan <span class="font-semibold">{{ $registrations->firstItem() ?? 0 }}</span> sampai
                    <span class="font-semibold">{{ $registrations->lastItem() ?? 0 }}</span> dari
                    <span class="font-semibold">{{ $registrations->total() }}</span> hasil
                </div>
                <div class="flex space-x-2">
                    {{ $registrations->links() }}
                </div>
            </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchBox = document.querySelector('input[type="text"]');
            const filterButtons = document.querySelectorAll('.filter-btn');
            const tableRows = document.querySelectorAll('tbody tr');

            // Search functionality
            searchBox.addEventListener('input', function () {
                const searchTerm = this.value.toLowerCase();

                tableRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Filter buttons
            filterButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => {
                        btn.classList.remove('active', 'bg-blue-600', 'text-white');
                        btn.classList.add('bg-white', 'border', 'border-gray-300', 'text-gray-700');
                    });

                    // Add active class to clicked button
                    this.classList.remove('bg-white', 'border', 'border-gray-300', 'text-gray-700');
                    this.classList.add('active', 'bg-blue-600', 'text-white');

                    const filter = this.textContent.trim().toLowerCase();

                    tableRows.forEach(row => {
                        if (filter === 'semua') {
                            row.style.display = '';
                        } else if (filter === 'menunggu') {
                            if (row.querySelector('.bg-yellow-100')) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        } else if (filter === 'disetujui') {
                            if (row.querySelector('.bg-green-100')) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        }
                    });
                });
            });

            // Add hover effects to table rows
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function () {
                    this.classList.add('bg-gray-50');
                });

                row.addEventListener('mouseleave', function () {
                    if (!this.classList.contains('hover:bg-gray-50')) {
                        this.classList.remove('bg-gray-50');
                    }
                });
            });
        });
    </script>
@endsection