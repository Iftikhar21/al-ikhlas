@extends('template')

@section('content')
    @php
        \Carbon\Carbon::setLocale('id');
    @endphp
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .islamic-font {
            font-family: 'Amiri', serif;
        }

        .islamic-pattern {
            background-color: #f0f9f4;
            background-image:
                repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(16, 185, 129, 0.03) 35px, rgba(16, 185, 129, 0.03) 70px),
                repeating-linear-gradient(-45deg, transparent, transparent 35px, rgba(16, 185, 129, 0.03) 35px, rgba(16, 185, 129, 0.03) 70px);
        }

        .mosque-silhouette {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23d4e8d9' fill-opacity='0.1' d='M0,160L48,144C96,128,192,96,288,101.3C384,107,480,149,576,165.3C672,181,768,171,864,149.3C960,128,1056,96,1152,96C1248,96,1344,128,1392,144L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: bottom;
        }

        .activity-badge {
            @apply py-1 px-3 rounded-full text-sm font-medium;
        }

        .tahsin { @apply bg-emerald-100 text-emerald-800; }
        .tahfidz { @apply bg-amber-100 text-amber-800; }
        .fiqih { @apply bg-blue-100 text-blue-800; }
        .aqidah { @apply bg-purple-100 text-purple-800; }
        .sejarah { @apply bg-red-100 text-red-800; }
        .bahasa { @apply bg-indigo-100 text-indigo-800; }
    </style>

    <div class="bg-gray-50 islamic-pattern">
        <!-- Hero Section -->
        <section class="py-12 bg-primary-dark text-white mosque-silhouette">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 islamic-font">Jadwal Kegiatan</h1>
                <p class="text-xl max-w-2xl mx-auto mb-8">"Ya Tuhanku, tambahkanlah kepadaku ilmu pengetahuan."
                    (QS. Thaha: 114)</p>
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6 max-w-3xl mx-auto">
                    <p class="text-lg">
                        Di Pusat Pembelajaran Islam kami, kami menekankan pentingnya disiplin dalam menuntut ilmu
                        sebagaimana
                        diajarkan oleh Nabi Muhammad ﷺ. Jadwal yang terstruktur membantu santri untuk membangun konsistensi
                        dan
                        kesungguhan dalam menuntut ilmu agama.
                    </p>
                </div>
            </div>
        </section>

        <!-- Weekly Schedule Section -->
        <section class="py-12">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-2 text-emerald-800 islamic-font">Jadwal Mingguan</h2>
                <p class="text-center text-gray-600 mb-8">Program pembelajaran lengkap untuk semua kelompok usia</p>

                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <!-- TABEL (hanya muncul di md ke atas) -->
                    <div class="overflow-x-auto hidden md:block">
                        <table class="w-full">
                            <thead class="bg-emerald-700 text-white">
                                <tr>
                                    <th class="py-4 px-6 text-left">Hari</th>
                                    <th class="py-4 px-6 text-left">Waktu</th>
                                    <th class="py-4 px-6 text-left">Kegiatan</th>
                                    <th class="py-4 px-6 text-left">Pengajar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($weeklySchedules as $schedule)
                                <tr class="border-b border-gray-100 hover:bg-emerald-50 transition">
                                    <td class="py-4 px-6 font-medium">
                                        @switch($schedule->day)
                                            @case('Monday') Senin @break
                                            @case('Tuesday') Selasa @break
                                            @case('Wednesday') Rabu @break
                                            @case('Thursday') Kamis @break
                                            @case('Friday') Jumat @break
                                            @case('Saturday') Sabtu @break
                                            @case('Sunday') Minggu @break
                                            @default {{ $schedule->day }}
                                        @endswitch
                                    </td>

                                    <td class="py-4 px-6">
                                        {{ formatTimeWithPeriod($schedule->start_time) }} - {{ formatTimeWithPeriod($schedule->end_time) }}
                                    </td>
                                    <td class="py-4 px-6">
                                        @php
                                            $activityClass = 'tahsin';
                                            if (str_contains(strtolower($schedule->activity), 'tahfidz')) {
                                                $activityClass = 'tahfidz';
                                            } elseif (str_contains(strtolower($schedule->activity), 'fiqih')) {
                                                $activityClass = 'fiqih';
                                            } elseif (str_contains(strtolower($schedule->activity), 'aqidah')) {
                                                $activityClass = 'aqidah';
                                            } elseif (str_contains(strtolower($schedule->activity), 'sejarah')) {
                                                $activityClass = 'sejarah';
                                            } elseif (str_contains(strtolower($schedule->activity), 'bahasa')) {
                                                $activityClass = 'bahasa';
                                            }
                                        @endphp
                                        <span class="activity-badge {{ $activityClass }}">
                                            {{ $schedule->activity }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">{{ $schedule->teacher }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-8 px-6 text-center text-gray-500">
                                        Tidak ada jadwal yang tersedia saat ini.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- CARD (hanya muncul di mobile) -->
                    <div class="space-y-4 p-4 md:hidden">
                        @forelse($weeklySchedules as $schedule)
                        <div class="p-4 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition">
                            <div class="flex justify-between">
                                <span class="font-semibold text-emerald-700">
                                    @switch($schedule->day)
                                        @case('Monday') Senin @break
                                        @case('Tuesday') Selasa @break
                                        @case('Wednesday') Rabu @break
                                        @case('Thursday') Kamis @break
                                        @case('Friday') Jumat @break
                                        @case('Saturday') Sabtu @break
                                        @case('Sunday') Minggu @break
                                        @default {{ $schedule->day }}
                                    @endswitch
                                </span>
                                <span class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - 
                                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                </span>
                            </div>
                            <div class="mt-2 flex justify-between items-center">
                                @php
                                    $activityClass = 'tahsin';
                                    if (str_contains(strtolower($schedule->activity), 'tahfidz')) {
                                        $activityClass = 'tahfidz';
                                    } elseif (str_contains(strtolower($schedule->activity), 'fiqih')) {
                                        $activityClass = 'fiqih';
                                    } elseif (str_contains(strtolower($schedule->activity), 'aqidah')) {
                                        $activityClass = 'aqidah';
                                    } elseif (str_contains(strtolower($schedule->activity), 'sejarah')) {
                                        $activityClass = 'sejarah';
                                    } elseif (str_contains(strtolower($schedule->activity), 'bahasa')) {
                                        $activityClass = 'bahasa';
                                    }
                                @endphp
                                <span class="activity-badge {{ $activityClass }}">
                                    {{ $schedule->activity }}
                                </span>
                                <span class="text-gray-700 text-sm">{{ $schedule->teacher }}</span>
                            </div>
                        </div>
                        @empty
                        <div class="p-4 border border-gray-200 rounded-lg shadow-sm text-center">
                            <span class="text-gray-500">Tidak ada jadwal yang tersedia saat ini.</span>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <!-- Quote Section -->
        <section class="py-12">
            <div class="container mx-auto px-4 text-center">
                <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-md p-8 md:p-12 relative">
                    <div class="absolute -top-4 -left-4 w-8 h-8 bg-amber-400 rounded-full"></div>
                    <div class="absolute -bottom-4 -right-4 w-8 h-8 bg-amber-400 rounded-full"></div>
                    <div class="relative z-10">
                        <svg class="w-12 h-12 text-emerald-600 mx-auto mb-6" fill="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 01-3.5 3.5c-1.073 0-2.099-.49-2.748-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 01-3.5 3.5c-1.073 0-2.099-.49-2.748-1.179z">
                            </path>
                        </svg>
                        @if($quote)
                        <p class="text-2xl md:text-3xl text-emerald-800 mb-6 islamic-font">"{{ $quote->quote }}"</p>
                        <p class="text-gray-600 text-lg">- {{ $quote->author }}</p>
                        @else
                        <p class="text-2xl md:text-3xl text-emerald-800 mb-6 islamic-font">"Menuntut ilmu adalah kewajiban
                            bagi setiap Muslim."</p>
                        <p class="text-gray-600 text-lg">- Nabi Muhammad ﷺ</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Upcoming Events Section -->
        <section class="py-16 px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-emerald-800 islamic-font mb-4">Acara Mendatang</h2>
                    <p class="text-lg text-emerald-700 max-w-2xl mx-auto">Ikuti acara-acara spesial yang kami
                        selenggarakan untuk mempererat ukhuwah, menambah ilmu, dan meningkatkan keimanan.</p>
                </div>

                <div class="space-y-10">
                    @forelse($eventSchedules as $event)
                    <!-- Event Item -->
                    <div class="flex flex-col md:flex-row bg-white rounded-xl shadow-lg overflow-hidden">
                        <!-- Date -->
                        <div class="flex items-center justify-center bg-emerald-600 text-white p-6 md:w-1/5">
                            <div class="text-center">
                                @php
                                    $eventDate = \Carbon\Carbon::parse($event->event_date);
                                    $day = $eventDate->format('d');
                                    $month = $eventDate->translatedFormat('F'); // nama bulan dalam bahasa Indonesia
                                    $year = $eventDate->format('Y');
                                @endphp

                                <p class="text-4xl font-bold">{{ $day }}</p>
                                <p class="uppercase tracking-wide">{{ $month }}</p>
                                <p class="text-sm">{{ $year }}</p>
                            </div>
                        </div>
                        <!-- Content -->
                        <div class="p-6 flex-1 flex flex-col">
                            <!-- Judul -->
                            <h3 class="text-2xl font-bold text-emerald-700 mb-2">{{ $event->title }}</h3>

                            <!-- Deskripsi -->
                            <p class="text-gray-700 mb-4 line-clamp-3">
                                {{ $event->description }}
                            </p>

                            <!-- Tanggal di paling bawah -->
                            <div class="flex items-center text-sm text-gray-600 mt-auto">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('l, d F Y') }}
                            </div>
                        </div>
                        <!-- Image -->
                        @if($event->image)
                        <div class="md:w-1/3">
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                                class="w-full h-32 lg:h-64 object-cover">
                        </div>
                        @else
                        <div class="md:w-1/3 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                        @endif
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-gray-600 text-lg">Tidak ada acara mendatang saat ini.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection