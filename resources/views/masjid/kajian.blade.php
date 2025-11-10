<?php
$meta_title = "Jadwal Kajian | Masjid Al-Ikhlas Dalang";
$meta_description = "Jadwal kajian rutin dan kegiatan ilmiah di Masjid Al-Ikhlas Dalang. Tingkatkan ilmu agama Anda bersama ustadz dan ulama terpercaya.";
$meta_keywords = "kajian islam, jadwal kajian, kajian rutin, masjid al ikhlas, pengajian, ceramah agama, tabligh akbar";
?>

@extends('template')

@section('title', $meta_title)

@section('meta')
    <meta name="description" content="{{ $meta_description }}">
    <meta name="keywords" content="{{ $meta_keywords }}">
    <meta property="og:title" content="{{ $meta_title }}">
    <meta property="og:description" content="{{ $meta_description }}">
    <meta property="og:image" content="{{ asset('img/al_ikhlas_logo.jpg') }}">
    <meta property="og:type" content="website">
@endsection

@section('content')
    <!-- Hero Section -->
    <section
        class="relative h-[40vh] min-h-[400px] bg-gradient-to-br from-emerald-700 via-emerald-800 to-emerald-900 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\" 60\"
                height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\"
                fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.1\"%3E%3Cpath d=\"M36
                34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6
                4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="relative z-10 container mx-auto px-4 h-full flex flex-col items-center justify-center text-center">
            <!-- Mosque Icon -->
            <div class="mb-6 p-2 w-32 h-32 bg-white/10 rounded-full backdrop-blur-sm">
                <img src="{{ asset('img/al_ikhlas_logo.jpg') }}" class="rounded-full" alt="Logo Masjid Al-Ikhlas">
            </div>

            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 font-serif">Jadwal Kajian</h1>
            <div class="w-20 h-1 bg-amber-400 mb-4"></div>
            <p class="text-lg text-white/90 max-w-2xl">
                Menuntut ilmu adalah ibadah. Mari hadiri kajian rutin bersama para ustadz dan ulama terpercaya
            </p>
        </div>
    </section>

    <!-- Kajian List Section -->
    <section class="py-12 px-4 bg-gradient-to-b from-emerald-50 to-white">
        <div class="container mx-auto max-w-6xl">
            <!-- Section Header -->
            <div class="text-center mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-emerald-900 mb-3 font-serif">Kajian Rutin Masjid</h2>
                <p class="text-emerald-700 max-w-2xl mx-auto">
                    Jadwal kajian ilmiah yang diselenggarakan secara rutin untuk meningkatkan pemahaman agama
                </p>
            </div>

            <!-- Filter & Stats -->
            <div class="mb-8 bg-white rounded-xl shadow-sm p-4 border border-emerald-100">
                <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
                    <!-- Filter Buttons -->
                    <div class="flex flex-wrap gap-2">
                        <button data-filter="all"
                            class="filter-btn px-4 py-2 rounded-full bg-emerald-600 text-white hover:bg-emerald-700 transition-all text-sm flex items-center gap-2">
                            <i data-lucide="calendar" class="w-4 h-4"></i>
                            Semua Kajian
                        </button>
                        <button data-filter="weekly"
                            class="filter-btn px-4 py-2 rounded-full bg-white text-emerald-700 border border-emerald-200 hover:bg-emerald-50 transition-all text-sm flex items-center gap-2">
                            <i data-lucide="clock" class="w-4 h-4"></i>
                            Pekanan
                        </button>
                        <button data-filter="monthly"
                            class="filter-btn px-4 py-2 rounded-full bg-white text-emerald-700 border border-emerald-200 hover:bg-emerald-50 transition-all text-sm flex items-center gap-2">
                            <i data-lucide="calendar-days" class="w-4 h-4"></i>
                            Bulanan
                        </button>
                    </div>

                    <!-- Stats -->
                    <div class="flex items-center gap-4 text-sm text-emerald-700">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                            <span>{{ count($kajians) }} Kajian Aktif</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kajian List -->
            <div class="space-y-6">
                @forelse($kajians as $kajian)
                    <div class="kajian-item bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-emerald-100 overflow-hidden"
                        data-frequency="{{ $kajian->jenis_kajian }}" data-tanggal="{{ $kajian->tanggal?->format('Y-m-d') }}">
                        <div class="flex flex-col lg:flex-row">
                            <!-- Konten utama -->
                            <div class="lg:w-2/3 p-6">
                                <div class="flex flex-col h-full">
                                    <!-- Header dengan judul dan badge -->
                                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 mb-4">
                                        <div class="flex-1">
                                            <h3 class="text-xl font-bold text-emerald-900 mb-2 font-serif line-clamp-2">
                                                {{ $kajian->judul }}
                                            </h3>
                                            <div class="flex flex-wrap gap-2">
                                                <span
                                                    class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-medium rounded-full flex items-center gap-1">
                                                    <i data-lucide="star" class="w-3 h-3"></i>
                                                    {{ $kajian->jenis_kajian }}
                                                </span>
                                                <span
                                                    class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-medium rounded-full">
                                                    {{ $kajian->hari ?? 'Belum ada tanggal' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Materi -->
                                    <div class="mb-4">
                                        <div
                                            class="text-base font-semibold text-emerald-800 leading-relaxed bg-emerald-50 p-4 rounded-lg border border-emerald-100 shadow-sm italic">
                                            “{{ $kajian->materi }}”
                                        </div>
                                    </div>

                                    <!-- Info Grid -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <!-- Pembicara -->
                                        <div class="flex items-center gap-3">
                                            <div class="p-2 bg-emerald-100 rounded-lg">
                                                <i data-lucide="user" class="w-4 h-4 text-emerald-600"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-emerald-900">Pemateri</div>
                                                <div class="text-emerald-700 font-semibold">{{ $kajian->pembicara }}</div>
                                            </div>
                                        </div>

                                        <!-- Tanggal -->
                                        <div class="flex items-center gap-3">
                                            <div class="p-2 bg-indigo-100 rounded-lg">
                                                <i data-lucide="calendar" class="w-4 h-4 text-indigo-600"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-indigo-900">Hari</div>
                                                <div class="text-indigo-700 font-semibold capitalize">
                                                    {{ $kajian->hari }}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Waktu -->
                                        <div class="flex items-center gap-3">
                                            <div class="p-2 bg-amber-100 rounded-lg">
                                                <i data-lucide="clock" class="w-4 h-4 text-amber-600"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-amber-900">Waktu</div>
                                                <div class="text-amber-800 font-semibold">
                                                    @if($kajian->jenis_kajian === 'pekanan')
                                                        Maghrib - Isya
                                                    @elseif($kajian->waktu_mulai)
                                                        {{ date('H:i', strtotime($kajian->waktu_mulai)) }}
                                                        @if($kajian->waktu_selesai)
                                                            - {{ date('H:i', strtotime($kajian->waktu_selesai)) }}
                                                        @endif
                                                        WIB
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Lokasi -->
                                        <div class="flex items-center gap-3">
                                            <div class="p-2 bg-blue-100 rounded-lg">
                                                <i data-lucide="map-pin" class="w-4 h-4 text-blue-600"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-blue-900">Tempat</div>
                                                <div class="text-blue-700 font-semibold">{{ $kajian->lokasi }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons & Additional Info -->
                                    <div
                                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-4 border-t border-gray-100 mt-auto">
                                        <div class="flex items-center gap-4 text-xs text-gray-500">
                                            <div class="flex items-center gap-1">
                                                <i data-lucide="info" class="w-3 h-3"></i>
                                                <span>{{ $kajian->keterangan }}</span>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <i data-lucide="heart" class="w-3 h-3 text-rose-500"></i>
                                                <span>Gratis</span>
                                            </div>
                                        </div>
                                        <button onclick="shareKajian('{{ $kajian->judul }}', '{{ $kajian->pembicara }}')"
                                            class="px-4 py-2 bg-emerald-100 hover:bg-emerald-200 text-emerald-700 rounded-lg flex items-center justify-center gap-2 transition-all text-sm font-medium">
                                            <i data-lucide="share-2" class="w-4 h-4"></i>
                                            <span>Bagikan</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Poster - tanpa space di kanan -->
                            <div class="lg:w-1/3">
                                <div
                                    class="h-full min-h-[300px] lg:min-h-full relative bg-gradient-to-br from-emerald-50 to-amber-50 overflow-hidden">
                                    @if($kajian->poster)
                                        <img src="{{ asset('storage/' . $kajian->poster) }}" alt="{{ $kajian->judul }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center p-6 text-center">
                                            <i data-lucide="book-open" class="w-12 h-12 text-emerald-400 mb-3"></i>
                                            <h4 class="text-sm font-semibold text-emerald-800 mb-1">{{ $kajian->judul }}</h4>
                                            <p class="text-xs text-emerald-600">Kajian bersama {{ $kajian->pembicara }}</p>
                                        </div>
                                    @endif

                                    <!-- Gradient Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/20 to-transparent"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <div class="max-w-md mx-auto">
                            <div class="p-6 bg-white rounded-xl shadow-sm border border-emerald-100">
                                <i data-lucide="calendar-x" class="w-16 h-16 mx-auto text-emerald-400 mb-4"></i>
                                <h3 class="text-xl font-bold text-emerald-900 mb-3 font-serif">Belum Ada Jadwal Kajian</h3>
                                <p class="text-emerald-700 mb-4">
                                    Saat ini belum ada jadwal kajian yang tersedia. Silakan cek kembali di lain waktu.
                                </p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #059669;
        }

        /* Hover effects for list items */
        .kajian-item:hover {
            transform: translateY(-2px);
        }
    </style>

    <script>
        function shareKajian(title, ustadz) {
            const shareData = {
                title: 'Kajian: ' + title,
                text: 'Jangan lewatkan kajian "' + title + '" bersama ' + ustadz + ' di Masjid Al-Ikhlas Dalang',
                url: window.location.href
            };

            if (navigator.share) {
                navigator.share(shareData)
                    .then(() => console.log('Berhasil berbagi'))
                    .catch((error) => console.log('Error sharing:', error));
            } else {
                // Fallback untuk browser yang tidak support Web Share API
                const textArea = document.createElement('textarea');
                textArea.value = `${shareData.title}\n\n${shareData.text}\n\n${shareData.url}`;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);

                alert('Link kajian telah disalin ke clipboard!');
            }
        }

        // Initialize Lucide icons
        lucide.createIcons();

        // Filter functionality
        document.addEventListener('DOMContentLoaded', function () {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const kajianItems = document.querySelectorAll('.kajian-item');

            function updateActiveButton(clickedButton) {
                // Remove active state from all buttons
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-emerald-600', 'text-white');
                    btn.classList.add('bg-white', 'text-emerald-700');
                });

                // Add active state to clicked button
                clickedButton.classList.remove('bg-white', 'text-emerald-700');
                clickedButton.classList.add('bg-emerald-600', 'text-white');
            }

            function filterKajian(filter) {
                // filter hanya berdasarkan jenis_kajian (data-frequency)
                kajianItems.forEach(item => {
                    const frequency = (item.dataset.frequency || '').toLowerCase();
                    let show = false;

                    if (filter === 'all') {
                        show = true;
                    } else if (filter === 'weekly') {
                        // cocokkan label 'pekanan' (atau 'weekly' jika ada)
                        show = frequency.includes('pekanan') || frequency.includes('weekly');
                    } else if (filter === 'monthly') {
                        // cocokkan label 'bulanan' (atau 'monthly' jika ada)
                        show = frequency.includes('bulanan') || frequency.includes('monthly');
                    }

                    item.style.display = show ? 'flex' : 'none';
                });

                // cek jika tidak ada item yg terlihat -> tampilkan pesan
                const visibleItems = Array.from(kajianItems).filter(item => item.style.display !== 'none');
                const noResultsMessage = document.querySelector('.no-results');

                if (visibleItems.length === 0) {
                    if (!noResultsMessage) {
                        const message = document.createElement('div');
                        message.className = 'no-results text-center py-8';
                        message.innerHTML = `
                                    <div class="max-w-md mx-auto">
                                        <div class="p-6 bg-white rounded-xl shadow-sm border border-emerald-100">
                                            <i data-lucide="search-x" class="w-12 h-12 mx-auto text-emerald-400 mb-3"></i>
                                            <h3 class="text-lg font-semibold text-emerald-900 mb-2">Tidak ada kajian ditemukan</h3>
                                            <p class="text-emerald-600 text-sm">Tidak ada kajian yang sesuai dengan filter yang dipilih</p>
                                        </div>
                                    </div>
                                `;
                        document.querySelector('.space-y-6').appendChild(message);
                        lucide.createIcons();
                    }
                } else if (noResultsMessage) {
                    noResultsMessage.remove();
                }
            }

            // Add click handlers to filter buttons
            filterButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const filter = this.dataset.filter;
                    updateActiveButton(this);
                    filterKajian(filter);
                });
            });

            // initialize: show all (controller already returns today+)
            filterKajian('all');
        });
    </script>
@endsection