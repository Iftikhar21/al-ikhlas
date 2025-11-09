@extends('admin.template-admin')
@section('title', 'Daftar Pengajar')
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <div class="container mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-sm p-4 lg:p-6 mb-6">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                    <div class="mb-4 lg:mb-0">
                        <h2 class="text-xl lg:text-3xl font-bold text-gray-800 mb-2">Manajemen Pengajar</h2>
                        <p class="text-gray-600 text-sm lg:text-base">Kelola data pengajar TPA</p>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div id="success-msg"
                    class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Main Content -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="border-b border-gray-200 p-4 lg:px-6 lg:py-4">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                        <h2 class="text-lg font-semibold text-gray-800">Daftar Pengajar</h2>

                        <!-- Search & Filter -->
                        <form method="GET" action="{{ route('admin.tpa.teachers.index') }}"
                            class="flex flex-col lg:flex-row gap-3 w-full lg:w-auto">
                            <div class="flex flex-col sm:flex-row gap-3 w-full">
                                <div class="relative flex-1">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="Cari nama..."
                                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-gray-700 w-full text-sm lg:text-base">
                                    <i data-lucide="search"
                                        class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>

                                <div class="relative flex-1">
                                    <input type="text" name="phone" value="{{ request('phone') }}"
                                        placeholder="Cari no. telepon..."
                                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-gray-700 w-full text-sm lg:text-base">
                                    <i data-lucide="phone"
                                        class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm flex items-center justify-center gap-2 transition-colors w-full sm:w-auto">
                                    <i data-lucide="filter" class="w-4 h-4"></i>
                                    Filter
                                </button>

                                @if(request('search') || request('phone'))
                                    <a href="{{ route('admin.tpa.teachers.index') }}"
                                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm flex items-center justify-center gap-2 transition-colors w-full sm:w-auto">
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                        Reset
                                    </a>
                                @endif

                                <a href="{{ route('admin.tpa.teachers.create') }}"
                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm flex items-center justify-center gap-2 transition-colors w-full sm:w-auto">
                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                    Tambah Pengajar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 hidden sm:table-header-group">
                            <tr>
                                <th
                                    class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama
                                </th>
                                <th
                                    class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Foto
                                </th>
                                <th
                                    class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jenis Kelamin
                                </th>
                                <th
                                    class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pendidikan
                                </th>
                                <th
                                    class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jabatan
                                </th>
                                <th
                                    class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No. Telepon
                                </th>
                                <th
                                    class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">
                                    Alamat
                                </th>
                                <th
                                    class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($teachers as $teacher)
                                <tr
                                    class="hover:bg-gray-50 transition-colors block sm:table-row mb-4 sm:mb-0 border border-gray-200 sm:border-none rounded-lg sm:rounded-none">
                                    <!-- Mobile Card View -->
                                    <td class="px-4 py-3 block sm:table-cell sm:whitespace-nowrap">
                                        <div class="flex justify-between sm:block">
                                            <span class="text-xs font-medium text-gray-500 sm:hidden">Nama:</span>
                                            <div class="text-sm font-medium text-gray-900">{{ $teacher->name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 block sm:table-cell sm:whitespace-nowrap">
                                        <div class="flex justify-between sm:block">
                                            <span class="text-xs font-medium text-gray-500 sm:hidden">Foto:</span>
                                            <div
                                                class="w-10 h-10 sm:w-12 sm:h-12 rounded-full overflow-hidden bg-gray-100 flex items-center justify-center">
                                                <img src="{{ $teacher->foto ? asset('storage/' . $teacher->foto) : asset('img/user.jpg') }}"
                                                    alt="{{ $teacher->name }}" class="w-full h-full object-cover">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 block sm:table-cell sm:whitespace-nowrap">
                                        <div class="flex justify-between sm:block">
                                            <span class="text-xs font-medium text-gray-500 sm:hidden">Jenis Kelamin:</span>
                                            <div class="text-sm text-gray-900">{{ $teacher->gender }}</div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 block sm:table-cell sm:whitespace-nowrap">
                                        <div class="flex justify-between sm:block">
                                            <span class="text-xs font-medium text-gray-500 sm:hidden">Pendidikan:</span>
                                            <div class="text-sm text-gray-900">{{ $teacher->last_education }}</div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 block sm:table-cell sm:whitespace-nowrap">
                                        <div class="flex justify-between sm:block">
                                            <span class="text-xs font-medium text-gray-500 sm:hidden">Jabatan:</span>
                                            <div class="text-sm text-gray-900">{{ $teacher->position }}</div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 block sm:table-cell sm:whitespace-nowrap">
                                        <div class="flex justify-between sm:block">
                                            <span class="text-xs font-medium text-gray-500 sm:hidden">No. Telepon:</span>
                                            <div class="text-sm text-gray-900">{{ $teacher->phone_number }}</div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 block sm:table-cell">
                                        <div class="flex justify-between sm:block">
                                            <span class="text-xs font-medium text-gray-500 sm:hidden">Alamat:</span>
                                            <div class="text-sm text-gray-900">{{ Str::limit($teacher->address, 30) }}</div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 block sm:table-cell sm:whitespace-nowrap">
                                        <div class="flex justify-between sm:block">
                                            <span class="text-xs font-medium text-gray-500 sm:hidden">Aksi:</span>
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('admin.tpa.teachers.edit', $teacher->id) }}"
                                                    class="inline-flex items-center p-2 bg-yellow-50 hover:bg-yellow-100 text-yellow-600 rounded-lg transition-colors duration-200 group"
                                                    title="Edit Pengajar">
                                                    <i data-lucide="pencil"
                                                        class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                                </a>

                                                <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('deleteForm-{{ $teacher->id }}').submit(), {
                                                                title: 'Hapus Pengajar',
                                                                message: 'Apakah Anda yakin ingin menghapus pengajar {{ $teacher->name }}?',
                                                                confirmText: 'Ya, Hapus',
                                                                confirmColor: 'bg-red-600 hover:bg-red-700',
                                                                confirmIcon: 'trash'
                                                            })"
                                                    class="inline-flex items-center p-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors duration-200 group"
                                                    title="Hapus Pengajar">
                                                    <i data-lucide="trash"
                                                        class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                                </button>

                                                <form action="{{ route('admin.tpa.teachers.destroy', $teacher->id) }}"
                                                    method="POST" id="deleteForm-{{ $teacher->id }}" class="hidden">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 lg:px-6 py-4 text-center text-sm text-gray-500">
                                        @if(request('search') || request('phone'))
                                            Tidak ada pengajar yang sesuai dengan filter.
                                        @else
                                            Belum ada data pengajar.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($teachers->hasPages())
                    <div class="border-t border-gray-200 px-4 lg:px-6 py-4">
                        {{ $teachers->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>

    <script>
        // Auto hide alerts
        setTimeout(() => {
            const success = document.getElementById('success-msg');
            if (success) success.style.display = 'none';
        }, 3000);
    </script>
@endsection