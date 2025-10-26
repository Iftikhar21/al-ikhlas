@extends('template')
@section('title', 'Berita Terbaru')
@section('content')
    <style>
        .arabic-font {
            font-family: 'Amiri', serif;
        }

        /* Islamic Pattern Background */
        .islamic-pattern {
            background-image:
                repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(139, 195, 74, 0.06) 35px, rgba(139, 195, 74, 0.06) 70px),
                repeating-linear-gradient(-45deg, transparent, transparent 35px, rgba(76, 175, 80, 0.06) 35px, rgba(76, 175, 80, 0.06) 70px);
        }

        /* Decorative Motif */
        .motif-decoration {
            position: relative;
        }

        .motif-decoration::before,
        .motif-decoration::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 60px;
            background: radial-gradient(circle, rgba(139, 195, 74, 0.2) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 0;
        }

        .motif-decoration::before {
            top: -20px;
            left: -20px;
        }

        .motif-decoration::after {
            bottom: -20px;
            right: -20px;
        }

        /* Decorative Corner */
        .corner-decoration {
            position: absolute;
            width: 100px;
            height: 100px;
            opacity: 0.1;
        }

        .corner-decoration.top-left {
            top: 0;
            left: 0;
            background: linear-gradient(135deg, #8BC34A 0%, transparent 100%);
            border-radius: 0 0 100% 0;
        }

        .corner-decoration.bottom-right {
            bottom: 0;
            right: 0;
            background: linear-gradient(-45deg, #4CAF50 0%, transparent 100%);
            border-radius: 100% 0 0 0;
        }

        /* News Grid */
        .news-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .news-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .news-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .news-card:hover img {
            transform: scale(1.05);
        }

        /* Badge */
        .category-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: linear-gradient(135deg, #8BC34A 0%, #689F38 100%);
            color: white;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .slide-image {
                height: 350px;
            }
        }

        @media (max-width: 480px) {
            .slide-image {
                height: 300px;
            }
        }
    </style>

    <!-- Main Content -->
    <div class="islamic-pattern">
        <main class="container mx-auto px-4 py-8 min-h-screen">
            <!-- Latest News Section -->
            <section class="mb-12">
                @forelse($newsList as $news)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <article class="news-card">
                            <div class="overflow-hidden">
                                @if($news->thumbnail)
                                    <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <i data-lucide="image" class="text-6xl text-gray-500"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-5">
                                <span class="category-badge mb-3">{{ $news->category ?? 'Umum' }}</span>
                                <h3 class="text-xl font-bold text-gray-800 mb-2 hover:text-green-600 transition cursor-pointer">
                                    <a href="">{{ $news->title }}</a>
                                </h3>
                                <p class="text-gray-600 mb-4">{{ Str::limit($news->content ?? '', 100) }}</p>

                                <div class="flex items-center justify-between text-sm text-gray-500 mt-3">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ $news->created_at->format('d F Y') }}</span>
                                    </div>

                                    <a href="{{ route('news-detail', $news->id) }}"
                                        class="px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center text-center h-[70vh]">
                        <svg class="w-20 h-20 text-primary mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h2 class="text-2xl font-semibold text-gray-700 mb-2">Belum ada berita tersedia</h2>
                        <p class="text-gray-500 max-w-md">Saat ini belum ada berita yang dapat ditampilkan. Silakan cek kembali
                            nanti untuk mendapatkan kabar terbaru dari kami.</p>
                    </div>
                @endforelse
            </section>
        </main>
    </div>
@endsection