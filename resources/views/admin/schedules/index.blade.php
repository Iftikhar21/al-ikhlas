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

            <!-- Weekly Schedule Section -->
            <div class="bg-white rounded-lg shadow mb-6">
                <div class="border-b border-gray-200 px-6 py-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-800">Jadwal Mingguan</h2>
                        <a href="{{ route('admin.weekly.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white px-2 py-1 rounded text-sm flex items-center gap-1">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            <span>Tambah Jadwal</span>
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Hari</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aktivitas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pengajar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($weeklySchedules as $schedule)
                                                            <tr>
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

                                $dayColors = [
                                    'Monday' => 'bg-blue-100 text-blue-800',
                                    'Tuesday' => 'bg-indigo-100 text-indigo-800',
                                    'Wednesday' => 'bg-purple-100 text-purple-800',
                                    'Thursday' => 'bg-pink-100 text-pink-800',
                                    'Friday' => 'bg-green-100 text-green-800',
                                    'Saturday' => 'bg-yellow-100 text-yellow-800',
                                    'Sunday' => 'bg-red-100 text-red-800',
                                ];
                                                                @endphp

                                                                <td class="px-6 py-4 whitespace-nowrap">
                                                                    <span
                                                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold 
                                                                                                                     {{ $dayColors[$schedule->day] ?? 'bg-gray-100 text-gray-800' }}">
                                                                        {{ $days[$schedule->day] ?? $schedule->day }}
                                                                    </span>
                                                                </td>

                                                                <td class="px-6 py-4 whitespace-nowrap">
                                                                    <div class="text-sm text-gray-900">
                                                                        {{ formatTimeWithPeriod($schedule->start_time) }} -
                                                                        {{ formatTimeWithPeriod($schedule->end_time) }}
                                                                    </div>
                                                                </td>

                                                                <td class="px-6 py-4">
                                                                    <div class="text-sm text-gray-900">{{ $schedule->activity }}</div>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap">
                                                                    <div class="text-sm text-gray-900">{{ $schedule->teacher }}</div>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                                    <div class="flex items-center gap-2">
                                                                        <!-- Edit -->
                                                                        <a href="{{ route('admin.weekly.edit', $schedule->id) }}"
                                                                            title="Edit Jadwal Mingguan"
                                                                            class="inline-flex items-center p-2 bg-yellow-50 hover:bg-yellow-100 text-yellow-600 rounded-lg transition-colors duration-200 group">
                                                                            <i data-lucide="pencil"
                                                                                class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                                                        </a>

                                                                        <!-- Delete Form -->
                                                                        <form action="{{ route('admin.weekly.destroy', $schedule->id) }}" method="POST"
                                                                            id="deleteForm-{{ $schedule->id }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                        </form>

                                                                        <!-- Delete Button -->
                                                                        <button type="button"
                                                                            onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('deleteForm-{{ $schedule->id }}').submit(), {
                                                                                                                                                                                                title: 'Hapus Jadwal Mingguan',
                                                                                                                                                                                                message: 'Apakah Anda yakin ingin menghapus jadwal mingguan ini?',
                                                                                                                                                                                                confirmText: 'Ya, Hapus',
                                                                                                                                                                                                confirmColor: 'bg-red-600 hover:bg-red-700',
                                                                                                                                                                                                confirmIcon: 'trash'
                                                                                                                                                                                            })"
                                                                            class="inline-flex items-center p-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors duration-200 group"
                                                                            title="Hapus Jadwal Mingguan">
                                                                            <i data-lucide="trash"
                                                                                class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Tidak ada data jadwal mingguan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Event Schedule Section -->
            <div class="bg-white rounded-lg shadow mb-6">
                <div class="border-b border-gray-200 px-6 py-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-800">Event</h2>
                        <a href="{{ route('admin.events.create') }}"
                            class="bg-green-500 hover:bg-green-700 text-white px-2 py-1 rounded text-sm flex items-center gap-1">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            <span>Tambah Event</span>
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                    @forelse($eventSchedules as $event)
                        <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                            @if($event->image)
                                <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}"
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
                                    <a href="{{ route('admin.events.show', $event->id) }}" title="Lihat Event"
                                        class="inline-flex items-center p-2 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition-colors duration-200 group">
                                        <i data-lucide="eye" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                    </a>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.events.edit', $event->id) }}" title="Edit Event"
                                            class="inline-flex items-center p-2 bg-yellow-50 hover:bg-yellow-100 text-yellow-600 rounded-lg transition-colors duration-200 group">
                                            <i data-lucide="pencil"
                                                class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                        </a>
                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST"
                                            id="deleteForm-{{ $event->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('deleteForm-{{ $event->id }}').submit(), {
                                                                                                                            title: 'Hapus Event',
                                                                                                                            message: 'Apakah Anda yakin ingin menghapus event ini?',
                                                                                                                            confirmText: 'Ya, Hapus',
                                                                                                                            confirmColor: 'bg-red-600 hover:bg-red-700',
                                                                                                                            confirmIcon: 'trash'
                                                                                                                        })"
                                            class="inline-flex items-center p-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors duration-200 group"
                                            title="Hapus Event">
                                            <i data-lucide="trash"
                                                class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
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
            <div class="bg-white rounded-lg shadow">
                <div class="border-b border-gray-200 px-6 py-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-800">Quotes</h2>
                        <a href="{{ route('admin.quotes.create') }}"
                            class="bg-purple-500 hover:bg-purple-700 text-white px-2 py-1 rounded text-sm flex items-center gap-1">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            <span>Tambah Quote</span>
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
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
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 italic">"{{ Str::limit($quote->quote, 100) }}"</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-medium">{{ $quote->author }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center gap-2">
                                            <!-- Lihat -->
                                            <a href="{{ route('admin.quotes.show', $quote->id) }}" title="Lihat Quote"
                                                class="inline-flex items-center p-2 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition-colors duration-200 group">
                                                <i data-lucide="eye"
                                                    class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                            </a>

                                            <!-- Edit -->
                                            <a href="{{ route('admin.quotes.edit', $quote->id) }}" title="Edit Quote"
                                                class="inline-flex items-center p-2 bg-yellow-50 hover:bg-yellow-100 text-yellow-600 rounded-lg transition-colors duration-200 group">
                                                <i data-lucide="pencil"
                                                    class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                                            </a>

                                            <!-- Delete Form -->
                                            <form action="{{ route('admin.quotes.destroy', $quote->id) }}" method="POST"
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
    </main>
@endsection