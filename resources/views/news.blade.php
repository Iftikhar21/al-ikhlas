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

        /* News Card Styles */
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

        /* Popular Section Styles */
        .popular-section {
            border-radius: 16px;
            margin-bottom: 2rem;
        }

        .popular-main-card {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            background: white;
            border-radius: 16px;
            padding: 2rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .popular-main-image {
            flex-shrink: 0;
            width: 350px;
            height: 250px;
            border-radius: 12px;
            overflow: hidden;
        }

        .popular-main-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .popular-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .popular-small-card {
            display: flex;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            padding: 1rem;
            flex-direction: column;
            gap: 0.75rem;
        }

        .popular-small-image {
            width: 100%;
            height: 150px;
            border-radius: 12px;
            overflow: hidden;
        }

        .popular-small-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Recommended Section Styles */
        .recommended-section {
            border-radius: 16px;
            margin-bottom: 2rem;
        }

        .recommended-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        .recommended-item {
            display: flex;
            background: white;
            gap: 1rem;
            padding: 1rem;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .recommended-item:hover {
            background: #f8fafc;
        }

        .recommended-image {
            flex-shrink: 0;
            width: 100px;
            height: 100px;
            border-radius: 8px;
            overflow: hidden;
        }

        .recommended-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Section Headers */
        .section-header {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .section-header-blue {
            background: #15803d33;
            color: #15803d;
        }

        .section-header-light-blue {
            background: #15803d33;
            color: #15803d;
        }

        /* News Grid for Latest News */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .popular-main-card {
                flex-direction: column;
            }

            .popular-main-image {
                width: 100%;
            }

            .popular-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .news-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .popular-grid {
                grid-template-columns: 1fr;
            }

            .recommended-grid {
                grid-template-columns: 1fr;
            }

            .news-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <!-- Main Content -->
    <div class="islamic-pattern">
        <main class="container mx-auto px-4 py-8 min-h-screen">

            <!-- Popular News Section (Moved to Top) -->
            @if(count($popularNews) > 0)
                <section class="popular-section">
                    <div class="section-header section-header-blue">
                        Berita Populer
                    </div>

                    <!-- Main Popular News (First Item) -->
                    <div class="popular-main-card">
                        <div class="popular-main-image">
                            @if($popularNews[0]->thumbnail)
                                <img src="{{ asset('storage/' . $popularNews[0]->thumbnail) }}" alt="{{ $popularNews[0]->title }}">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <i data-lucide="image" class="text-6xl text-gray-500"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="text-sm text-green-600">
                                    {{ $popularNews[0]->created_at->format('d F Y') }}
                                </span>

                                <span class="inline-flex items-center gap-1 px-2 py-0.5 
                                             text-xs bg-green-100 text-green-700 rounded-full">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd"
                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $popularNews[0]->views }}
                                </span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-3 hover:text-green-600 transition cursor-pointer">
                                <a href="{{ route('news-detail', $popularNews[0]->slug) }}">{{ $popularNews[0]->title }}</a>
                            </h3>
                            @if($popularNews[0]->content)
                                <p class="text-gray-600 mb-4">
                                    {{ Str::limit(strip_tags($popularNews[0]->content), 200) }}
                                </p>
                            @endif
                            <a href="{{ route('news-detail', $popularNews[0]->slug) }}"
                                class="inline-flex items-center text-green-600 hover:text-green-700 font-medium transition">
                                Baca Selengkapnya →
                            </a>
                        </div>
                    </div>

                    <!-- Other Popular News (Grid) -->
                    @if(count($popularNews) > 1)
                        <div class="popular-grid">
                            @foreach($popularNews->skip(1)->take(3) as $popular)
                                <div class="popular-small-card">
                                    <div class="popular-small-image">
                                        @if($popular->thumbnail)
                                            <img src="{{ asset('storage/' . $popular->thumbnail) }}" alt="{{ $popular->title }}">
                                        @else
                                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                <i data-lucide="image" class="text-4xl text-gray-500"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="text-xs text-green-600">
                                                {{ $popular->created_at->format('d F Y') }}
                                            </span>

                                            <span class="inline-flex items-center gap-1 px-2 py-1
                                                         text-xs bg-green-100 text-green-700 rounded-full">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path fill-rule="evenodd"
                                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 0 018 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ $popular->views }}
                                            </span>
                                        </div>
                                        <h4 class="font-semibold text-gray-800 hover:text-green-600 transition mb-2 line-clamp-2">
                                            <a href="{{ route('news-detail', $popular->slug) }}">{{ $popular->title }}</a>
                                        </h4>
                                        <a href="{{ route('news-detail', $popular->slug) }}"
                                            class="inline-flex items-center text-green-600 hover:text-green-700 text-sm font-medium transition">
                                            Baca Selengkapnya →
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>
            @endif

            <!-- Latest News Section -->
            <section class="mb-12">
                <div class="section-header section-header-blue">
                    Berita Terbaru
                </div>

                @if(count($newsList) > 0)
                    <div class="news-grid">
                        @foreach($newsList as $news)
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
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-sm text-green-600">
                                            {{ $news->created_at->format('d F Y') }}
                                        </span>

                                        <span class="inline-flex items-center gap-1 px-2 py-0.5
                                                     text-xs bg-green-100 text-green-700 rounded-full">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd"
                                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 0 018 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            {{ $news->views }}
                                        </span>
                                    </div>
                                    <h3
                                        class="text-lg font-bold text-gray-800 mb-3 hover:text-green-600 transition cursor-pointer line-clamp-2">
                                        <a href="{{ route('news-detail', $news->slug) }}">{{ $news->title }}</a>
                                    </h3>
                                    <a href="{{ route('news-detail', $news->slug) }}"
                                        class="inline-flex items-center text-green-600 hover:text-green-700 text-sm font-medium transition">
                                        Baca Selengkapnya →
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8 flex justify-center">
                        {{ $newsList->links() }}
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center text-center h-[70vh]">
                        <svg class="w-20 h-20 text-primary mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h2 class="text-2xl font-semibold text-gray-700 mb-2">Belum ada berita tersedia</h2>
                        <p class="text-gray-500 max-w-md">Saat ini belum ada berita yang dapat ditampilkan. Silakan cek kembali
                            nanti untuk mendapatkan kabar terbaru dari kami.</p>
                    </div>
                @endif
            </section>

            <!-- Recommended News Section -->
            @if(count($recommendedNews) > 0)
                <section class="recommended-section">
                    <div class="section-header section-header-light-blue">
                        Rekomendasi Berita
                    </div>

                    <div class="recommended-grid">
                        @foreach($recommendedNews as $news)
                            <a href="{{ route('news-detail', $news->slug) }}" class="block">
                                <div class="recommended-item">
                                    <div class="recommended-image">
                                        @if($news->thumbnail)
                                            <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}">
                                        @else
                                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                <i data-lucide="image" class="text-4xl text-gray-500"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="text-xs text-green-600">
                                                {{ $news->created_at->format('d F Y') }}
                                            </span>

                                            <span class="inline-flex items-center gap-1 px-2 py-1
                                                         text-xs bg-green-100 text-green-700 rounded-full">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path fill-rule="evenodd"
                                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 0 11-8 0 4 0 018 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ $news->views }}
                                            </span>
                                        </div>
                                        <h4 class="font-semibold text-gray-800 hover:text-green-600 transition mb-2 line-clamp-2">
                                            {{ $news->title }}
                                        </h4>
                                        <span
                                            class="inline-flex items-center text-green-600 hover:text-green-700 text-sm font-medium transition">
                                            Baca Selengkapnya →
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </main>
    </div>
@endsection