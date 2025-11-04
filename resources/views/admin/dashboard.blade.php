@extends('admin.template-admin')
@section('title', 'Dashboard')
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <!-- Welcome Section -->
        <div class="bg-white rounded-lg shadow-sm p-4 md:p-6 mb-6 md:mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex-1">
                    <h2 class="text-xl md:text-3xl font-bold text-gray-800 mb-2">Selamat Datang, {{ auth()->user()->name }}</h2>
                    <p class="text-gray-600 text-sm md:text-base">Semoga harimu menyenangkan</p>
                </div>
                <div class="text-left md:text-right">
                    <div class="text-2xl md:text-4xl font-bold text-blue-600" id="clock"></div>
                    <div class="text-xs md:text-sm text-gray-500 mt-1" id="date"></div>
                </div>
            </div>
        </div>

        <!-- Quote of the Day -->
        @if($dailyQuote)
        <div class="bg-white rounded-lg shadow-sm p-4 lg:p-6 text-white mb-6 lg:mb-8">
            <div class="text-center text-slate-900">
                <blockquote class="text-base lg:text-xl italic mb-3 lg:mb-4">"{{ $dailyQuote->quote }}"</blockquote>
                <p class="font-semibold text-sm lg:text-base">— {{ $dailyQuote->author }}</p>
            </div>
        </div>
        @endif

        <!-- Statistik Utama -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-6 mb-6 lg:mb-8">
            <!-- Pendaftaran Baru -->
            <div class="bg-white rounded-lg shadow p-3 lg:p-6">
                <div class="flex items-center">
                    <div class="p-2 lg:p-3 bg-blue-100 rounded-lg">
                        <svg class="w-4 h-4 lg:w-6 lg:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                    </div>
                    <div class="ml-2 lg:ml-4">
                        <p class="text-xs lg:text-sm text-gray-500">Pendaftaran Baru</p>
                        <h3 class="text-lg lg:text-2xl font-bold">{{ $pendingRegistrations }}</h3>
                        <p class="text-xs text-gray-400">Menunggu persetujuan</p>
                    </div>
                </div>
            </div>

            <!-- Total Program -->
            <div class="bg-white rounded-lg shadow p-3 lg:p-6">
                <div class="flex items-center">
                    <div class="p-2 lg:p-3 bg-green-100 rounded-lg">
                        <svg class="w-4 h-4 lg:w-6 lg:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="ml-2 lg:ml-4">
                        <p class="text-xs lg:text-sm text-gray-500">Total Program</p>
                        <h3 class="text-lg lg:text-2xl font-bold">{{ $totalPrograms }}</h3>
                        <p class="text-xs text-gray-400">Program aktif</p>
                    </div>
                </div>
            </div>

            <!-- Berita Terbaru -->
            <div class="bg-white rounded-lg shadow p-3 lg:p-6">
                <div class="flex items-center">
                    <div class="p-2 lg:p-3 bg-purple-100 rounded-lg">
                        <svg class="w-4 h-4 lg:w-6 lg:h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9m0 0v12m0 0h2m-2 0h2"/>
                        </svg>
                    </div>
                    <div class="ml-2 lg:ml-4">
                        <p class="text-xs lg:text-sm text-gray-500">Berita</p>
                        <h3 class="text-lg lg:text-2xl font-bold">{{ $totalNews }}</h3>
                        <p class="text-xs text-gray-400">Artikel terbit</p>
                    </div>
                </div>
            </div>

            <!-- Event Mendatang -->
            <div class="bg-white rounded-lg shadow p-3 lg:p-6">
                <div class="flex items-center">
                    <div class="p-2 lg:p-3 bg-orange-100 rounded-lg">
                        <svg class="w-4 h-4 lg:w-6 lg:h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <div class="ml-2 lg:ml-4">
                        <p class="text-xs lg:text-sm text-gray-500">Event Mendatang</p>
                        <h3 class="text-lg lg:text-2xl font-bold">{{ $upcomingEvents }}</h3>
                        <p class="text-xs text-gray-400">Dalam 7 hari</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-sm p-4 lg:p-6 mb-6 lg:mb-8">
            <h3 class="text-lg lg:text-xl font-bold text-gray-800 mb-4">Menu Cepat</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-4">
                <a href="{{ route('admin.news.create') }}"
                    class="bg-blue-500 text-white p-3 lg:p-4 rounded-lg hover:bg-blue-600 transition transform hover:scale-105 flex items-center justify-center gap-2 text-sm lg:text-base">
                    <i data-lucide="plus" class="w-4 h-4 lg:w-5 lg:h-5"></i>
                    <span class="font-medium">Tambah Berita</span>
                </a>

                <a href="{{ route('admin.events.create') }}" 
                   class="bg-green-500 text-white p-3 lg:p-4 rounded-lg hover:bg-green-600 transition transform hover:scale-105 flex items-center justify-center gap-2 text-sm lg:text-base">
                    <i data-lucide="plus" class="w-4 h-4 lg:w-5 lg:h-5"></i>
                    <span class="font-medium">Tambah Event</span>
                </a>

                <a href="{{ route('admin.programs.create') }}" 
                   class="bg-purple-500 text-white p-3 lg:p-4 rounded-lg hover:bg-purple-600 transition transform hover:scale-105 flex items-center justify-center gap-2 text-sm lg:text-base">
                    <i data-lucide="clipboard" class="w-4 h-4 lg:w-5 lg:h-5"></i>
                    <span class="font-medium">Tambah Program</span>
                </a>

                <a href="{{ route('admin.admin-register-online.index') }}" 
                   class="bg-orange-500 text-white p-3 lg:p-4 rounded-lg hover:bg-orange-600 transition transform hover:scale-105 flex items-center justify-center gap-2 text-sm lg:text-base">
                    <i data-lucide="bell" class="w-4 h-4 lg:w-5 lg:h-5"></i>
                    <span class="font-medium">Kelola Pendaftaran</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 lg:gap-8 mb-6 lg:mb-8">
            <!-- Pendaftaran Baru -->
            <div class="bg-white rounded-lg shadow-sm p-4 lg:p-6">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-4">
                    <h3 class="text-lg lg:text-xl font-bold text-gray-800">Pendaftaran Menunggu</h3>
                    <a href="{{ route('admin.admin-register-online.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium self-start sm:self-auto">
                        Lihat Semua →
                    </a>
                </div>

                @if($recentRegistrations->count() > 0)
                    <div class="overflow-x-auto -mx-4 lg:mx-0">
                        <div class="min-w-full inline-block align-middle">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-b">
                                        <th class="text-left py-3 px-4 text-xs lg:text-sm font-medium text-gray-600">Nama Lengkap</th>
                                        <th class="text-left py-3 px-4 text-xs lg:text-sm font-medium text-gray-600 hidden sm:table-cell">Jenis Kelamin</th>
                                        <th class="text-left py-3 px-4 text-xs lg:text-sm font-medium text-gray-600 hidden md:table-cell">Tempat Lahir</th>
                                        <th class="text-left py-3 px-4 text-xs lg:text-sm font-medium text-gray-600">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentRegistrations as $registration)
                                        <tr class="border-b hover:bg-gray-50 transition">
                                            <td class="py-3 px-4">
                                                <div class="font-medium text-gray-900 text-sm lg:text-base">{{ $registration->full_name }}</div>
                                                <div class="text-xs lg:text-sm text-gray-500 sm:hidden">
                                                    {{ $registration->gender === 'L' ? 'Laki-laki' : 'Perempuan' }} • 
                                                    {{ $registration->birth_place }}
                                                </div>
                                                <div class="text-xs text-gray-400 md:hidden">{{ \Carbon\Carbon::parse($registration->birth_date)->format('d/m/Y') }}</div>
                                            </td>
                                            <td class="py-3 px-4 hidden sm:table-cell">
                                                <div class="text-sm">{{ $registration->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                                            </td>
                                            <td class="py-3 px-4 text-sm hidden md:table-cell">{{ $registration->birth_place }}</td>
                                            <td class="py-3 px-4">
                                                <a href="{{ route('admin.admin-register-online.show', $registration->id) }}" 
                                                   class="bg-blue-500 text-white px-3 py-1 rounded text-xs lg:text-sm hover:bg-blue-600 transition inline-block">
                                                    Review
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                <div class="text-center py-6 lg:py-8 text-gray-500">
                    <svg class="w-10 h-10 lg:w-12 lg:h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="mt-2 text-sm lg:text-base">Tidak ada pendaftaran baru</p>
                </div>
                @endif
            </div>

            <!-- Event & Jadwal -->
            <div class="space-y-4 lg:space-y-6">
                <!-- Event Mendatang -->
                <div class="bg-white rounded-lg shadow-sm p-4 lg:p-6">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-4">
                        <h3 class="text-lg lg:text-xl font-bold text-gray-800">Event Mendatang</h3>
                        <a href="{{ route('admin.schedules.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium self-start sm:self-auto">
                            Lihat Semua →
                        </a>
                    </div>
                    <div class="space-y-3 lg:space-y-4">
                        @foreach($upcomingEventsList as $event)
                        <div class="flex items-start border-l-4 border-blue-500 pl-3 lg:pl-4 py-2 lg:py-3 hover:bg-gray-50 rounded-r transition">
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-800 text-sm lg:text-base">{{ $event->title }}</h4>
                                <div class="flex items-center mt-1 text-xs lg:text-sm text-gray-600">
                                    <svg class="w-3 h-3 lg:w-4 lg:h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                                </div>
                                <p class="text-xs lg:text-sm text-gray-500 mt-2 line-clamp-2">{{ Str::limit($event->description, 80) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Jadwal Hari Ini -->
                <div class="bg-white rounded-lg shadow-sm p-4 sm:p-5 lg:p-6">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-4">Jadwal Hari Ini</h3>

                    <div class="space-y-3">
                        @if ($todaySchedules && $todaySchedules->items->count() > 0)
                            <div class="grid gap-3 sm:gap-4">
                                @foreach ($todaySchedules->items as $item)
                                    <div class="bg-white rounded-lg border border-gray-200 p-3 sm:p-4 hover:bg-gray-50 transition-colors">
                                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">

                                            <!-- Bagian kiri: waktu & aktivitas -->
                                            <div class="flex flex-col sm:flex-row sm:items-center gap-3 flex-1 min-w-0">
                                                <!-- Waktu -->
                                                <div class="bg-blue-50 border border-blue-200 rounded-lg px-3 py-2 flex-shrink-0">
                                                    <div
                                                        class="flex items-center justify-center gap-1 text-xs sm:text-sm font-semibold text-blue-700">
                                                        <div>{{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }}</div>
                                                        <div class="text-[10px] sm:text-xs text-blue-500">s/d</div>
                                                        <div>{{ \Carbon\Carbon::parse($item->end_time)->format('H:i') }}</div>
                                                    </div>
                                                </div>

                                                <!-- Info Aktivitas -->
                                                <div class="space-y-1 min-w-0 flex-1">
                                                    <h4 class="font-semibold text-gray-800 text-sm sm:text-base truncate">
                                                        {{ $item->activity }}
                                                    </h4>
                                                    <div
                                                        class="flex flex-col xs:flex-row xs:items-center gap-1 xs:gap-3 text-xs sm:text-sm text-gray-600">
                                                        <span class="flex items-center gap-1 truncate">
                                                            <i data-lucide="user" class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0"></i>
                                                            <span class="truncate">{{ $item->teacher }}</span>
                                                        </span>
                                                        <span class="flex items-center gap-1 truncate">
                                                            <i data-lucide="layers" class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0"></i>
                                                            <span class="truncate">{{ $item->ummiLevel->name ?? '-' }}</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Status -->
                                            <div
                                                class="bg-green-100 text-green-800 px-2.5 py-1 rounded-full text-xs sm:text-sm font-medium flex-shrink-0 self-start md:self-auto">
                                                Aktif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 sm:p-4">
                                <div class="flex items-start sm:items-center gap-3">
                                    <i data-lucide="calendar-off" class="w-5 h-5 text-yellow-500 flex-shrink-0"></i>
                                    <div>
                                        <p class="text-yellow-800 font-medium text-sm sm:text-base">Tidak ada jadwal hari ini</p>
                                        <p class="text-yellow-600 text-xs sm:text-sm">Tidak ada aktivitas yang dijadwalkan untuk hari ini.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <!-- Recent News & Programs -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 lg:gap-8 mb-6 lg:mb-8">
            <!-- Berita Terbaru -->
            <div class="bg-white rounded-lg shadow-sm p-4 lg:p-6">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-4">
                    <h3 class="text-lg lg:text-xl font-bold text-gray-800">Berita Terbaru</h3>
                    <a href="{{ route('admin.news.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium self-start sm:self-auto">
                        Lihat Semua →
                    </a>
                </div>
                <div class="space-y-3 lg:space-y-4">
                    @foreach($recentNews as $news)
                    <div class="flex items-center space-x-3 lg:space-x-4 py-2 lg:py-3 border-b hover:bg-gray-50 rounded px-2 transition">
                        @if($news->thumbnail)
                        <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}" 
                             class="w-12 h-12 lg:w-16 lg:h-16 object-cover rounded-lg flex-shrink-0">
                        @else
                        <div class="w-12 h-12 lg:w-16 lg:h-16 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 lg:w-6 lg:h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-gray-800 text-sm lg:text-base line-clamp-2">{{ Str::limit($news->title, 50) }}</h4>
                            <p class="text-xs lg:text-sm text-gray-500 mt-1 line-clamp-2">{{ Str::limit(strip_tags($news->content), 70) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Program Aktif -->
            <div class="bg-white rounded-lg shadow-sm p-4 lg:p-6">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-4">
                    <h3 class="text-lg lg:text-xl font-bold text-gray-800">Program Aktif</h3>
                    <a href="{{ route('admin.programs.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium self-start sm:self-auto">
                        Lihat Semua →
                    </a>
                </div>
                <div class="space-y-3 lg:space-y-4">
                    @foreach($activePrograms as $program)
                        <div class="shadow-lg rounded-lg p-3 lg:p-4 hover:scale-101 transition">
                            <div class="flex items-start justify-between gap-3">
                                <!-- Teks kiri -->
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-800 text-sm lg:text-base line-clamp-2">{{ $program->title }}</h4>
                                    <p class="text-xs lg:text-sm text-gray-500 mt-2 line-clamp-2">{{ Str::limit($program->description, 80) }}</p>
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-medium mt-2 inline-block">
                                        {{ $program->status }}
                                    </span>
                                </div>

                                <!-- Gambar kanan -->
                                <div class="w-12 h-12 lg:w-16 lg:h-16 flex-shrink-0">
                                    @if($program->thumbnail)
                                        <img src="{{ asset('storage/' . $program->thumbnail) }}" alt="{{ $program->title }}"
                                            class="w-12 h-12 lg:w-16 lg:h-16 object-cover rounded-lg">
                                    @else
                                        <div class="w-12 h-12 lg:w-16 lg:h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 lg:w-6 lg:h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <style>
        /* Tambahan CSS untuk mobile responsiveness */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        @media (max-width: 640px) {
            .min-w-full {
                min-width: 640px;
            }
        }

        @media (max-width: 480px) {
            .xs\:flex-row {
                flex-direction: row;
            }

            .xs\:items-center {
                align-items: center;
            }

            .xs\:gap-3 {
                gap: 0.75rem;
            }
        }
    </style>

    <script>
        // Real-time clock dengan tanggal Indonesia
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('clock').textContent = `${hours}.${minutes}.${seconds}`;

            // Format tanggal Indonesia
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const dateString = now.toLocaleDateString('id-ID', options);
            document.getElementById('date').textContent = dateString;
        }

        updateClock();
        setInterval(updateClock, 1000);

        // Initialize Lucide icons
        lucide.createIcons();
    </script>
@endsection