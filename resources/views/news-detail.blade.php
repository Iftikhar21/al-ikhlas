@extends('template')

@section('title', $news->title)

@section('content')
            <style>
                /* Tambahan untuk views counter */
                .views-counter {
                    display: inline-flex;
                    align-items: center;
                    padding: 0.25rem 0.75rem;
                    background: #15803d33;
                    color: #15803d;
                    border-radius: 20px;
                    font-size: 0.875rem;
                    font-weight: 600;
                    margin-left: 1rem;
                }

                .popular-sidebar-item {
                    padding: 0.75rem;
                    border-radius: 8px;
                    transition: all 0.2s ease;
                }

                .popular-sidebar-item:hover {
                    background: #f8fafc;
                }
            </style>

            <div class="news-detail">
                <!-- Kode tetap sama seperti sebelumnya, hanya tambahkan views counter di meta informasi -->
                <main class="max-w-4xl mx-auto px-4 py-8">
                    <!-- Header Artikel -->
                    <header class="mb-8 text-center border-b border-gray-100 pb-8">
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-4">{{ $news->title }}</h1>

                        <!-- Meta Informasi - TAMBAHKAN VIEWS COUNTER -->
                        <div class="flex flex-wrap items-center justify-center gap-4 text-gray-600 mb-4">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm">{{ $news->created_at->format('d F Y') }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm">{{ $news->created_at->format('H:i') }} WIB</span>
                            </div>
                            <!-- TAMBAH VIEWS COUNTER DISINI -->
                            <div class="flex items-center views-counter">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>{{ $news->views }} views</span>
                            </div>
                        </div>
                    </header>

                    <!-- Thumbnail Utama -->
                    @if($news->thumbnail)
                        <div class="mb-8">
                            <div class="relative overflow-hidden rounded-xl shadow-lg">
                                <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="Thumbnail {{ $news->title }}"
                                    class="w-full h-auto object-cover transition-transform duration-500 hover:scale-105">
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/50 to-transparent p-4">
                                    <p class="text-white text-sm text-center">Gambar utama berita</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Konten Artikel -->
                    <article class="prose prose-lg max-w-none">
                        <!-- Garis pemisah dekoratif -->
                        <div class="flex items-center justify-center mb-8">
                            <div class="w-20 h-1 bg-blue-500 rounded-full"></div>
                            <div class="w-2 h-2 bg-blue-500 rounded-full mx-2"></div>
                            <div class="w-20 h-1 bg-blue-500 rounded-full"></div>
                        </div>

                        @php
    $paragraphs = preg_split('/\n\s*\n/', $news->content);
                        @endphp

                        @foreach($paragraphs as $index => $paragraph)
                            @if(trim($paragraph))
                                <div class="mb-8 last:mb-0">
                                    <p class="text-gray-800 leading-relaxed text-lg">
                                        {{ trim($paragraph) }}
                                    </p>

                                    <!-- Tambahkan jarak ekstra setiap 3 paragraf -->
                                    @if(($index + 1) % 3 === 0)
                                        <div class="my-6 border-l-4 border-blue-200 pl-4">
                                            <p class="text-gray-500 text-sm italic">
                                                "Konten berita yang informatif dan terpercaya"
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </article>

                    <!-- Galeri Foto Pendukung -->
                    @if($news->photos->count())
                        <section class="mt-12 pt-8 border-t border-gray-200">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Galeri Foto
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($news->photos as $photo)
                                    <div
                                        class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                                        <img src="{{ asset('storage/' . $photo->path) }}" alt="Foto Pendukung {{ $loop->iteration }}"
                                            class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110">
                                        <div
                                            class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 flex items-center justify-center">
                                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <!-- Footer Artikel -->
                    <footer class="mt-12 pt-8 border-t border-gray-200">
                        <div class="bg-gray-50 rounded-xl p-6">
                            <div class="flex flex-col sm:flex-row items-center justify-between">
                                <div class="flex items-center mb-4 sm:mb-0">
                                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 005 10a6 6 0 0112 0c0 .-.1.39-.03.666A5 5 0 0010 11z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="flex items-center text-sm text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd"
                                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>{{ $news->views }} views</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center sm:text-right">
                                    <p class="text-sm text-gray-500">Terakhir diperbarui</p>
                                    <p class="font-medium text-gray-900">{{ $news->updated_at->format('d F Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Share Buttons -->
                        <div class="flex justify-center space-x-4 mt-6">
                            <button id="shareBtn"
                                class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z">
                                    </path>
                                </svg>
                                Bagikan
                            </button>
                        </div>
                    </footer>
                </main>

                <!-- Rekomendasi Berita Lain dengan Views -->
                <section class="max-w-full mx-auto px-4 py-12 bg-gray-50 mt-8">
                    <div class="container mx-auto">
                        <h2 class="text-3xl font-bold text-gray-900 text-center mb-8">Berita Lainnya</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($otherNews as $item)
                                <a href="{{ route('news-detail', $item->slug) }}"
                                    class="bg-white rounded-lg shadow-md overflow-hidden group hover:shadow-lg transition">
                                    <div class="h-48 overflow-hidden">
                                        @if($item->thumbnail)
                                            <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}"
                                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                        @else
                                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                                No Image
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-4">
                                        <div class="flex items-center justify-between mb-2">
                                            @if($item->category)
                                                <span
                                                    class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">{{ $item->category }}</span>
                                            @endif
                                            <span class="flex items-center text-xs text-gray-500">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path fill-rule="evenodd"
                                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ $item->views }}
                                            </span>
                                        </div>
                                        <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 text-lg lg:text-xl">
                                            {{ $item->title }}
                                        </h3>
                                        <p class="text-gray-600 text-sm line-clamp-3">
                                            {{ Str::limit(strip_tags($item->content), 100) }}
                                        </p>

                                        <!-- Tanggal berita -->
                                        <div class="flex items-center text-xs text-gray-500 mt-3">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 
                                                            00-2 2v10a2 2 0 002 2h12a2 2 0 
                                                            002-2V6a2 2 0 00-2-2h-1V3a1 1 
                                                            0 10-2 0v1H7V3a1 1 0 00-1-1zm0 
                                                            5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $item->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>

            <script>
                document.getElementById("shareBtn").addEventListener("click", async () => {
                    const shareData = {
                        title: "{{ $news->title }}",
                        text: "Baca berita terbaru: {{ $news->title }}",
                        url: "{{ url()->current() }}"
                    };

                    if (navigator.share) {
                        try {
                            await navigator.share(shareData);
                        } catch (err) {
                            console.error("Gagal share:", err);
                        }
                    } else {
                        // fallback: copy link ke clipboard
                        navigator.clipboard.writeText(shareData.url).then(() => {
                            alert("Link berita disalin ke clipboard!");
                        });
                    }
                });
            </script>
@endsection