@extends('admin.template-admin')
@section('title', 'Dashboard')
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <!-- Welcome Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang, {{ auth()->user()->name }}</h2>
                    <p class="text-gray-600">Semoga harimu menyenangkan</p>
                </div>
                <div class="text-right">
                    <div class="text-4xl font-bold text-blue-600" id="clock"></div>
                    <div class="text-sm text-gray-500 mt-1" id="date"></div>
                </div>
            </div>
        </div>

        <!-- Quote of the Day -->
        @if($dailyQuote)
        <div class="bg-white rounded-lg shadow-sm p-6 text-white mb-8">
            <div class="text-center text-slate-900">
                <blockquote class="text-xl italic mb-4">"{{ $dailyQuote->quote }}"</blockquote>
                <p class="font-semibold">— {{ $dailyQuote->author }}</p>
            </div>
        </div>
        @endif

        <!-- Statistik Utama -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Pendaftaran Baru -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Pendaftaran Baru</p>
                        <h3 class="text-2xl font-bold">{{ $pendingRegistrations }}</h3>
                        <p class="text-xs text-gray-400">Menunggu persetujuan</p>
                    </div>
                </div>
            </div>

            <!-- Total Program -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Total Program</p>
                        <h3 class="text-2xl font-bold">{{ $totalPrograms }}</h3>
                        <p class="text-xs text-gray-400">Program aktif</p>
                    </div>
                </div>
            </div>

            <!-- Berita Terbaru -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9m0 0v12m0 0h2m-2 0h2"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Berita</p>
                        <h3 class="text-2xl font-bold">{{ $totalNews }}</h3>
                        <p class="text-xs text-gray-400">Artikel terbit</p>
                    </div>
                </div>
            </div>

            <!-- Event Mendatang -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-orange-100 rounded-lg">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500">Event Mendatang</p>
                        <h3 class="text-2xl font-bold">{{ $upcomingEvents }}</h3>
                        <p class="text-xs text-gray-400">Dalam 7 hari</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Menu Cepat</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('admin-news.create') }}"
                    class="bg-blue-500 text-white p-4 rounded-lg hover:bg-blue-600 transition transform hover:scale-105 flex items-center justify-center gap-2">
                    <i data-lucide="plus"></i>
                    <span class="font-medium">Tambah Berita</span>
                </a>


                <a href="{{ route('admin.events.create') }}" 
                   class="bg-green-500 text-white p-4 rounded-lg hover:bg-green-600 transition transform hover:scale-105 flex items-center justify-center gap-2">
                    <i data-lucide="plus"></i>
                    <span class="font-medium">Tambah Event</span>
                </a>

                <a href="{{ route('admin-programs.create') }}" 
                   class="bg-purple-500 text-white p-4 rounded-lg hover:bg-purple-600 transition transform hover:scale-105 flex items-center justify-center gap-2">
                    <i data-lucide="clipboard"></i>
                    <span class="font-medium">Tambah Program</span>
                </a>

                <a href="{{ route('admin.admin-register-online.index') }}" 
                   class="bg-orange-500 text-white p-4 rounded-lg hover:bg-orange-600 transition transform hover:scale-105 flex items-center justify-center gap-2">
                    <i data-lucide="bell"></i>
                    <span class="font-medium">Kelola Pendaftaran</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Pendaftaran Baru -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Pendaftaran Menunggu Persetujuan</h3>
                    <a href="{{ route('admin.admin-register-online.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        Lihat Semua →
                    </a>
                </div>

                @if($recentRegistrations->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-3 text-sm font-medium text-gray-600">Nama Lengkap</th>
                                    <th class="text-left py-3 text-sm font-medium text-gray-600">Jenis Kelamin</th>
                                    <th class="text-left py-3 text-sm font-medium text-gray-600">Tempat Lahir</th>
                                    <th class="text-left py-3 text-sm font-medium text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentRegistrations as $registration)
                                    <tr class="border-b hover:bg-gray-50 transition">
                                        <td class="py-3">
                                            <div class="font-medium text-gray-900">{{ $registration->full_name }}</div>
                                            <div class="text-sm text-gray-500">{{ $registration->birth_place }}, {{ \Carbon\Carbon::parse($registration->birth_date)->format('d/m/Y') }}</div>
                                        </td>
                                        <td class="py-3">
                                            <div class="text-sm">{{ $registration->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                                        </td>
                                        <td class="py-3 text-sm">{{ $registration->birth_place }}</td>
                                        <td class="py-3">
                                            <a href="{{ route('admin.admin-register-online.show', $registration->id) }}" 
                                               class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600 transition">
                                                Review
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                <div class="text-center py-8 text-gray-500">
                    <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="mt-2">Tidak ada pendaftaran baru</p>
                </div>
                @endif
            </div>

            <!-- Event & Jadwal -->
            <div class="space-y-6">
                <!-- Event Mendatang -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Event Mendatang</h3>
                        <a href="{{ route('admin.events.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Lihat Semua →
                        </a>
                    </div>
                    <div class="space-y-4">
                        @foreach($upcomingEventsList as $event)
                        <div class="flex items-start border-l-4 border-blue-500 pl-4 py-3 hover:bg-gray-50 rounded-r transition">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800">{{ $event->title }}</h4>
                                <div class="flex items-center mt-1 text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                                </div>
                                <p class="text-sm text-gray-500 mt-2">{{ Str::limit($event->description, 80) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Jadwal Hari Ini -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Jadwal Hari Ini</h3>
                    <div class="space-y-3">
                        @foreach($todaySchedules as $schedule)
                        <div class="flex justify-between items-center py-3 border-b hover:bg-gray-50 rounded px-2 transition">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800">{{ $schedule->activity }}</h4>
                                <p class="text-sm text-gray-600">{{ $schedule->teacher }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                </p>
                                <p class="text-xs text-gray-500 capitalize">{{ $schedule->day }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent News & Programs -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Berita Terbaru -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Berita Terbaru</h3>
                    <a href="{{ route('admin-news.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        Lihat Semua →
                    </a>
                </div>
                <div class="space-y-4">
                    @foreach($recentNews as $news)
                    <div class="flex items-center space-x-4 py-3 border-b hover:bg-gray-50 rounded px-2 transition">
                        @if($news->thumbnail)
                        <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}" 
                             class="w-16 h-16 object-cover rounded-lg">
                        @else
                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        @endif
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800">{{ Str::limit($news->title, 50) }}</h4>
                            <p class="text-sm text-gray-500 mt-1">{{ Str::limit(strip_tags($news->content), 70) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Program Aktif -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Program Aktif</h3>
                    <a href="{{ route('admin-programs.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        Lihat Semua →
                    </a>
                </div>
                <div class="space-y-4">
                    @foreach($activePrograms as $program)
                        <div class="shadow-lg rounded-lg p-4 hover:scale-101 transition">
                            <div class="flex items-start justify-between">
                                <!-- Teks kiri -->
                                <div class="flex-1 pr-4">
                                    <h4 class="font-semibold text-gray-800">{{ $program->title }}</h4>
                                    <p class="text-sm text-gray-500 mt-2">{{ Str::limit($program->description, 80) }}</p>
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-medium mt-2 inline-block">
                                        {{ $program->status }}
                                    </span>
                                </div>

                                <!-- Gambar kanan -->
                                <div class="w-16 h-16 flex-shrink-0">
                                    @if($program->thumbnail)
                                        <img src="{{ asset('storage/' . $program->thumbnail) }}" alt="{{ $program->title }}"
                                            class="w-16 h-16 object-cover rounded-lg">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    </script>
@endsection