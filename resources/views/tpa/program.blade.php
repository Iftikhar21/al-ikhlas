@extends('template')
@section('title', 'Program Kami')
@section('content')
        <style>
            .arabic-font {
                font-family: 'Amiri', serif;
            }

            .islamic-pattern {
                background-color: #f0f9f4;
                background-image:
                    repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(16, 185, 129, 0.03) 35px, rgba(16, 185, 129, 0.03) 70px),
                    repeating-linear-gradient(-45deg, transparent, transparent 35px, rgba(16, 185, 129, 0.03) 35px, rgba(16, 185, 129, 0.03) 70px);
            }

            .card-hover {
                transition: all 0.3s ease;
            }

            .card-hover:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }

            .gold-accent {
                color: #d4af37;
            }

            .btn-primary {
                background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
                transition: all 0.3s ease;
            }

            .btn-primary:hover {
                transform: scale(1.05);
                box-shadow: 0 10px 15px -3px rgba(212, 175, 55, 0.3);
            }
        </style>
        <div class="islamic-pattern">
            <!-- Hero Section -->
            <section class="bg-primary-dark text-white py-20 px-4">
                <div class="max-w-7xl mx-auto text-center">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6 arabic-font">
                        Selamat Datang di TPA Al-Ikhlas
                    </h1>
                    <p class="text-xl md:text-2xl mb-4 opacity-90">
                        Menyentuh Hati, Mencerahkan Pikiran
                    </p>
                    <p class="text-lg md:text-xl mb-8 max-w-3xl mx-auto opacity-80">
                        Bergabunglah dengan program pembelajaran Islam kami, tempat anak-anak dan orang dewasa
                        belajar Al-Qur'an, nilai-nilai Islam, serta pembentukan akhlak dalam suasana hangat dan penuh dukungan.
                    </p>
                    <a href="{{ route('tpa.register') }}" class="btn-primary text-green-900 font-bold py-4 px-8 rounded-full text-lg shadow-lg">
                        Daftar Sekarang
                    </a>
                </div>
            </section>

            <!-- Programs Section -->
            <section id="programs" class="py-16 px-4">
                <div class="max-w-7xl mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="text-4xl font-bold text-green-800 mb-4">Program Kami</h2>
                        <div class="w-24 h-1 bg-gradient-to-r from-green-600 to-yellow-500 mx-auto mb-4"></div>
                        <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                            Program pendidikan Islam yang dirancang untuk memperkuat iman dan membentuk akhlak mulia
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @php
$colors = ['green', 'yellow', 'emerald', 'teal', 'blue', 'purple']; // Warna Tailwind
                        @endphp

                        @forelse($programs as $index => $program)
                            @php
    $color = $colors[$index % count($colors)]; // putar warna jika program lebih banyak
                            @endphp

                            <div
                                class="bg-white rounded-2xl shadow-lg p-6 card-hover border-t-4 border-{{ $color }}-600 max-h-[300px] flex flex-col justify-between">
                                <!-- Thumbnail & Title -->
                                <div class="text-center mb-4">
                                    <div class="inline-block p-3 bg-{{ $color }}-100 rounded-full mb-3 flex items-center justify-center">
                                        @if($program->thumbnail)
                                            <img src="{{ asset('storage/' . $program->thumbnail) }}" class="w-12 h-12 object-cover rounded-full"
                                                alt="{{ $program->title }}">
                                        @else
                                            <!-- Default icon -->
                                            <svg class="w-12 h-12 text-{{ $color }}-700" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2 truncate">{{ $program->title }}</h3>
                                </div>

                                <!-- Deskripsi -->
                                <p class="text-gray-600 mb-4 text-center truncate">
                                    {{ $program->description }}
                                </p>

                                <!-- Tombol -->
                                <a href="{{ route('tpa.program-detail', $program->slug) }}"
                                    class="w-full bg-{{ $color }}-600 hover:bg-{{ $color }}-700 text-white font-semibold py-2 rounded-lg transition text-center inline-block">
                                    Selengkapnya
                                </a>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500">Belum ada program.</p>
                        @endforelse
                    </div>
                </div>
            </section>

        </div>
@endsection