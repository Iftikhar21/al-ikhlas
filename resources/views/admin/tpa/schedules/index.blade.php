@extends('admin.template-admin')
@section('title', 'Daftar Jadwal')
@section('content')
                <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
                    <div class="container mx-auto">
                        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                            <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                                <div class="mb-4 lg:mb-0">
                                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Manajemen Jadwal</h2>
                                    <p class="text-gray-600">Kelola semua jadwal yang tersedia</p>
                                </div>
                            </div>
                        </div>

                        @if(session('success'))
                            <div id="success-msg" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div id="error-msg" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                {{ session('error') }}
                            </div>
                        @endif

                        <script>
                            // hilangkan success setelah 3 detik
                            setTimeout(() => {
                                const success = document.getElementById('success-msg');
                                if (success) success.style.display = 'none';

                                const error = document.getElementById('error-msg');
                                if (error) error.style.display = 'none';
                            }, 3000); // 3000ms = 3 detik
                        </script>

                        <div class="bg-white rounded-lg shadow mb-6 overflow-hidden">
                            <div class="border-b border-gray-200 px-6 py-4">
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg font-semibold text-gray-800">Daftar Level Ummi</h2>
                                    <button onclick="openModal('addUmmiModal')"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded text-sm flex items-center gap-1 transition-colors">
                                        <i data-lucide="plus" class="w-4 h-4"></i>
                                        <span>Tambah Level</span>
                                    </button>
                                </div>
                            </div>

                            @if(session('success'))
                                <div class="bg-green-50 border-l-4 border-green-500 p-4 mx-6 mt-4 rounded-lg shadow-sm">
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

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Nama Level
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Deskripsi
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($levels as $level)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">{{ $level->name }}</div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm text-gray-900">{{ $level->description ?? '-' }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center gap-2">
                                                        <!-- Edit Button -->
                                                        <button
                                                            onclick="openEditModal({{ $level->id }}, '{{ $level->name }}', '{{ $level->description }}')"
                                                            class="inline-flex items-center p-2 bg-yellow-50 hover:bg-yellow-100 text-yellow-600 rounded-lg transition-colors duration-200 group"
                                                            title="Edit Level">
                                                            <i data-lucide="pencil" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                                        </button>

                                                        <!-- Delete Form -->
                                                        <form action="{{ route('admin.tpa.ummi-levels.destroy', $level->id) }}" method="POST"
                                                            id="deleteUmmiForm-{{ $level->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                        <!-- Delete Button -->
                                                        <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('deleteUmmiForm-{{ $level->id }}').submit(), {
                                                                    title: 'Hapus Level Ummi',
                                                                    message: 'Apakah Anda yakin ingin menghapus level {{ $level->name }}?',
                                                                    confirmText: 'Ya, Hapus',
                                                                    confirmColor: 'bg-red-600 hover:bg-red-700',
                                                                    confirmIcon: 'trash'
                                                                })"
                                                            class="inline-flex items-center p-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors duration-200 group"
                                                            title="Hapus Level">
                                                            <i data-lucide="trash" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                                                    Belum ada level Ummi.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Modal Tambah -->
                        <div id="addUmmiModal" class="hidden fixed inset-0 backdrop-blur-xs bg-opacity-50 flex items-center justify-center p-4 z-50">
                            <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
                                <!-- Header -->
                                <div class="border-b border-gray-200 px-6 py-4">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                            <i data-lucide="plus-circle" class="w-5 h-5 text-blue-500 mr-2"></i>
                                            Tambah Level Ummi
                                        </h3>
                                        <button type="button" onclick="closeModal('addUmmiModal')"
                                            class="text-gray-400 hover:text-gray-600 transition-colors">
                                            <i data-lucide="x" class="w-5 h-5"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Form -->
                                <form action="{{ route('admin.tpa.ummi-levels.store') }}" method="POST">
                                    @csrf
                                    <div class="p-6 space-y-4">
                                        <!-- Nama Level -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Nama Level <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="name" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-gray-700 placeholder-gray-400"
                                                placeholder="Masukkan nama level">
                                            @error('name')
                                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                                    <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <!-- Deskripsi -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Deskripsi
                                            </label>
                                            <textarea name="description" rows="3"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-gray-700 placeholder-gray-400 resize-none"
                                                placeholder="Masukkan deskripsi level (opsional)"></textarea>
                                            @error('description')
                                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                                    <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Footer -->
                                    <div class="border-t border-gray-200 px-6 py-4">
                                        <div class="flex justify-end space-x-3">
                                            <button type="button" onclick="closeModal('addUmmiModal')"
                                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200 font-medium flex items-center gap-2">
                                                <i data-lucide="x" class="w-4 h-4"></i>
                                                Batal
                                            </button>
                                            <button type="submit"
                                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-200 font-medium flex items-center gap-2 shadow-sm">
                                                <i data-lucide="save" class="w-4 h-4"></i>
                                                Simpan
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Modal Edit -->
                        <div id="editUmmiModal" class="hidden fixed inset-0 backdrop-blur-xs bg-opacity-50 flex items-center justify-center p-4 z-50">
                            <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
                                <!-- Header -->
                                <div class="border-b border-gray-200 px-6 py-4">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                            <i data-lucide="edit-3" class="w-5 h-5 text-blue-500 mr-2"></i>
                                            Edit Level Ummi
                                        </h3>
                                        <button type="button" onclick="closeModal('editUmmiModal')"
                                            class="text-gray-400 hover:text-gray-600 transition-colors">
                                            <i data-lucide="x" class="w-5 h-5"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Form -->
                                <form id="editUmmiForm" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="p-6 space-y-4">
                                        <!-- Nama Level -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Nama Level <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="name" id="editName" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-gray-700 placeholder-gray-400"
                                                placeholder="Masukkan nama level">
                                            @error('name')
                                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                                    <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <!-- Deskripsi -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Deskripsi
                                            </label>
                                            <textarea name="description" id="editDescription" rows="3"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-gray-700 placeholder-gray-400 resize-none"
                                                placeholder="Masukkan deskripsi level (opsional)"></textarea>
                                            @error('description')
                                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                                    <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Footer -->
                                    <div class="border-t border-gray-200 px-6 py-4">
                                        <div class="flex justify-end space-x-3">
                                            <button type="button" onclick="closeModal('editUmmiModal')"
                                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200 font-medium flex items-center gap-2">
                                                <i data-lucide="x" class="w-4 h-4"></i>
                                                Batal
                                            </button>
                                            <button type="submit"
                                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-200 font-medium flex items-center gap-2 shadow-sm">
                                                <i data-lucide="save" class="w-4 h-4"></i>
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <script>
                            function openModal(id) {
                                document.getElementById(id).classList.remove('hidden');
                            }

                            function closeModal(id) {
                                document.getElementById(id).classList.add('hidden');
                            }

                            function openEditModal(id, name, description) {
                                document.getElementById('editName').value = name;
                                document.getElementById('editDescription').value = description ?? '';
                                const form = document.getElementById('editUmmiForm');
                                form.action = `/admin/ummi-levels/${id}`;
                                openModal('editUmmiModal');
                            }
                        </script>

                        <!-- Weekly Schedule Section -->
                        <div class="bg-white rounded-lg shadow mb-6 overflow-hidden">
                            <div class="border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                                <h2 class="text-lg font-semibold text-gray-800">Jadwal Mingguan</h2>
                                <a href="{{ route('admin.tpa.weekly.create') }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm flex items-center gap-1 transition-colors">
                                    <i data-lucide="plus" class="w-4 h-4"></i> Tambah Jadwal
                                </a>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full border-collapse">
                                    <thead class="bg-gray-50">
                                        <tr class="text-gray-600 uppercase text-xs font-semibold">
                                            <th class="px-4 py-3 text-left border-b border-gray-200">Hari</th>
                                            <th class="px-4 py-3 text-left border-b border-gray-200">Waktu</th>
                                            <th class="px-4 py-3 text-left border-b border-gray-200">Aktivitas</th>
                                            <th class="px-4 py-3 text-left border-b border-gray-200">Pengajar</th>
                                            <th class="px-4 py-3 text-left border-b border-gray-200">Level</th>
                                            <th class="px-4 py-3 text-center border-b border-gray-200">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @php
    $days = [
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu',
        'Sunday' => 'Minggu',
    ];
                                        @endphp

                                        @forelse ($weeklySchedules as $schedule)
                                            @php $rowCount = $schedule->items->count(); @endphp

                                            @if ($rowCount > 0)
                                                @foreach ($schedule->items as $index => $item)
                                                    <tr class="hover:bg-gray-50 transition-colors">
                                                        {{-- Hari pakai rowspan --}}
                                                        @if ($index === 0)
                                                            <td rowspan="{{ $rowCount }}"
                                                                class="px-4 py-3 font-semibold text-gray-800 align-top border-r border-gray-200 bg-gray-50 whitespace-nowrap">
                                                                {{ $days[$schedule->day] ?? $schedule->day }}
                                                            </td>
                                                        @endif

                                                        <td class="px-4 py-3 whitespace-nowrap">
                                                            {{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }} -
                                                            {{ \Carbon\Carbon::parse($item->end_time)->format('H:i') }}
                                                        </td>
                                                        <td class="px-4 py-3">{{ $item->activity }}</td>
                                                        <td class="px-4 py-3">{{ $item->teacher->name }}</td>
                                                        <td class="px-4 py-3">
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                {{ $item->ummiLevel->name ?? '-' }}
                                                            </span>
                                                        </td>

                                                        {{-- Aksi rowspan juga --}}
                                                        @if ($index === 0)
                                                            <td rowspan="{{ $rowCount }}"
                                                                class="px-4 py-3 text-center align-top border-l border-gray-200 bg-gray-50">
                                                                <div class="flex flex-col items-center justify-center gap-2">
                                                                    <a href="{{ route('admin.tpa.weekly.edit', $schedule->id) }}"
                                                                        class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 p-2 rounded-lg transition-colors"
                                                                        title="Edit Jadwal">
                                                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                                                    </a>

                                                                    <form action="{{ route('admin.tpa.weekly.destroy', $schedule->id) }}" method="POST"
                                                                        id="deleteScheduleForm-{{ $schedule->id }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    </form>

                                                                    <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('deleteScheduleForm-{{ $schedule->id }}').submit(), {
                                                                                                                title: 'Hapus Jadwal',
                                                                                                                message: 'Apakah Anda yakin ingin menghapus jadwal hari {{ $days[$schedule->day] ?? $schedule->day }}?',
                                                                                                                confirmText: 'Ya, Hapus',
                                                                                                                confirmColor: 'bg-red-600 hover:bg-red-700',
                                                                                                                confirmIcon: 'trash'
                                                                                                            })"
                                                                        class="bg-red-100 hover:bg-red-200 text-red-700 p-2 rounded-lg transition-colors"
                                                                        title="Hapus Jadwal">
                                                                        <i data-lucide="trash" class="w-4 h-4"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr class="border-b border-gray-200">
                                                    <td class="px-4 py-3 font-semibold text-gray-800 whitespace-nowrap">
                                                        {{ $days[$schedule->day] ?? $schedule->day }}</td>
                                                    <td colspan="5" class="px-4 py-3 text-gray-500 italic">Belum ada jadwal untuk hari ini.</td>
                                                </tr>
                                            @endif
                                        @empty
                                            <tr>
                                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">Tidak ada data jadwal mingguan.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Event Schedule Section -->
                        <div class="bg-white rounded-lg shadow mb-6 overflow-hidden">
                            <div class="border-b border-gray-200 px-6 py-4">
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg font-semibold text-gray-800">Event</h2>
                                    <a href="{{ route('admin.tpa.events.create') }}"
                                        class="bg-green-500 hover:bg-green-700 text-white px-3 py-2 rounded text-sm flex items-center gap-1 transition-colors">
                                        <i data-lucide="plus" class="w-4 h-4"></i>
                                        <span>Tambah Event</span>
                                    </a>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                                @forelse($eventSchedules as $event)
                                    <div
                                        class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 overflow-hidden transition-transform hover:shadow-md">
                                        @if($event->image)
                                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                                                class="w-full h-48 object-cover">
                                        @else
                                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                                <span class="text-gray-500">No Image</span>
                                            </div>
                                        @endif
                                        <div class="p-4">
                                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $event->title }}</h3>
                                            <p class="flex items-center text-sm text-gray-600 mb-2">
                                                <i data-lucide="calendar" class="mr-2 w-4 h-4"></i>
                                                {{ \Carbon\Carbon::parse($event->event_date)->locale('id')->translatedFormat('d F Y') }}
                                            </p>
                                            <p class="text-gray-700 text-sm mb-4 line-clamp-3">{{ Str::limit($event->description, 100) }}
                                            </p>
                                            <div class="flex justify-between items-center">
                                                <a href="{{ route('admin.tpa.events.show', $event->id) }}" title="Lihat Event"
                                                    class="inline-flex items-center p-2 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition-colors duration-200 group">
                                                    <i data-lucide="eye" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                                </a>
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('admin.tpa.events.edit', $event->id) }}" title="Edit Event"
                                                        class="inline-flex items-center p-2 bg-yellow-50 hover:bg-yellow-100 text-yellow-600 rounded-lg transition-colors duration-200 group">
                                                        <i data-lucide="pencil" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                                    </a>
                                                    <form action="{{ route('admin.tpa.events.destroy', $event->id) }}" method="POST"
                                                        id="deleteEventForm-{{ $event->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <button type="button"
                                                        onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('deleteEventForm-{{ $event->id }}').submit(), {
                                                                                                                                                            title: 'Hapus Event',
                                                                                                                                                            message: 'Apakah Anda yakin ingin menghapus event ini?',
                                                                                                                                                            confirmText: 'Ya, Hapus',
                                                                                                                                                            confirmColor: 'bg-red-600 hover:bg-red-700',
                                                                                                                                                            confirmIcon: 'trash'
                                                                                                                                                        })"
                                                        class="inline-flex items-center p-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors duration-200 group"
                                                        title="Hapus Event">
                                                        <i data-lucide="trash" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-span-3 text-center py-8">
                                        <p class="text-gray-500">Tidak ada data event.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Quote Schedule Section -->
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="border-b border-gray-200 px-6 py-4">
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg font-semibold text-gray-800">Quotes</h2>
                                    <a href="{{ route('admin.tpa.quotes.create') }}"
                                        class="bg-purple-500 hover:bg-purple-700 text-white px-3 py-2 rounded text-sm flex items-center gap-1 transition-colors">
                                        <i data-lucide="plus" class="w-4 h-4"></i>
                                        <span>Tambah Quote</span>
                                    </a>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Quote</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Author</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($quoteSchedules as $quote)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-6 py-4">
                                                    <div class="text-sm text-gray-900 italic">"{{ Str::limit($quote->quote, 100) }}"</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900 font-medium">{{ $quote->author }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center gap-2">
                                                        <!-- Lihat -->
                                                        <a href="{{ route('admin.tpa.quotes.show', $quote->id) }}" title="Lihat Quote"
                                                            class="inline-flex items-center p-2 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition-colors duration-200 group">
                                                            <i data-lucide="eye" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                                        </a>

                                                        <!-- Edit -->
                                                        <a href="{{ route('admin.tpa.quotes.edit', $quote->id) }}" title="Edit Quote"
                                                            class="inline-flex items-center p-2 bg-yellow-50 hover:bg-yellow-100 text-yellow-600 rounded-lg transition-colors duration-200 group">
                                                            <i data-lucide="pencil"
                                                                class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                                        </a>

                                                        <!-- Delete Form -->
                                                        <form action="{{ route('admin.tpa.quotes.destroy', $quote->id) }}" method="POST"
                                                            id="deleteForm-{{ $quote->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                        <!-- Delete Button -->
                                                        <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('deleteForm-{{ $quote->id }}').submit(), {
                                                                                                                                    title: 'Hapus Quote',
                                                                                                                                    message: 'Apakah Anda yakin ingin menghapus quote ini?',
                                                                                                                                    confirmText: 'Ya, Hapus',
                                                                                                                                    confirmColor: 'bg-red-600 hover:bg-red-700',
                                                                                                                                    confirmIcon: 'trash'
                                                                                                                                })"
                                                            class="inline-flex items-center p-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors duration-200 group"
                                                            title="Hapus Quote">
                                                            <i data-lucide="trash"
                                                                class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                                                    Tidak ada data quote.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    </div>
                </main>
@endsection