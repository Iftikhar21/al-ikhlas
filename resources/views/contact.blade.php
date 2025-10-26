@extends('template')

@section('content')
    <style>
        .islamic-bg {
            background: linear-gradient(135deg, #0d9488 0%, #059669 100%);
        }

        .islamic-pattern {
            background-image:
                repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(139, 195, 74, 0.06) 35px, rgba(139, 195, 74, 0.06) 70px),
                repeating-linear-gradient(-45deg, transparent, transparent 35px, rgba(76, 175, 80, 0.06) 35px, rgba(76, 175, 80, 0.06) 70px);    
        }

        .contact-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .islamic-border {
            border: 2px solid #d1fae5;
        }

        .arabic-decoration {
            font-family: 'Traditional Arabic', 'Scheherazade', serif;
        }
    </style>
    <!-- Header -->
    <header class="islamic-bg text-white islamic-pattern">
        <div class="container mx-auto px-6 py-20">
            <div class="text-center">
                @if($footer && $footer->logo)
                    <div class="flex justify-center mb-6">
                        <img src="{{ asset('storage/' . $footer->logo) }}" alt="{{ $footer->slogan ?? 'Logo TPA' }}"
                            class="h-48 w-auto rounded-full islamic-border p-4 bg-primary">
                    </div>
                @endif
                <div class="mb-4">
                    <span class="arabic-decoration text-primary text-2xl opacity-80">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيم</span>
                </div>
                <p class="text-xl opacity-90 max-w-2xl mx-auto leading-relaxed text-primary italic mb-6">
                    "{{ $footer->slogan ?? 'Mari bergabung dalam pendidikan Al-Quran dan Sunnah untuk generasi muslim yang shalih dan shalihah' }}"
                </p>
                <h1 class="text-4xl md:text-5xl text-primary font-bold">Hubungi TPA Kami</h1>
            </div>
        </div>
    </header>

    <!-- Contact Information Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <i data-lucide="book-open" class="w-8 h-8 text-green-600"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Informasi Kontak</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    {{ $footer->slogan ?? 'Silakan hubungi kami untuk informasi pendaftaran dan kegiatan' }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Phone -->
                @if($footer && $footer->telepon)
                    @php
                        $formattedPhone = preg_replace('/(\d{4})(?=\d)/', '$1-', $footer->telepon);
                    @endphp

                    <div class="contact-card bg-white rounded-xl p-6 text-center shadow-lg islamic-border">
                        <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="phone" class="w-7 h-7 text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Telepon/Ustadz</h3>
                        <p class="text-gray-600 mb-3">Hubungi pengasuh</p>
                        <a href="tel:{{ $footer->telepon }}" class="text-blue-600 font-semibold hover:text-blue-700 transition">
                            {{ $formattedPhone }}
                        </a>
                    </div>
                @endif

                <!-- Email -->
                @if($footer && $footer->email)
                    <div class="contact-card bg-white rounded-xl p-6 text-center shadow-lg islamic-border">
                        <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="mail" class="w-7 h-7 text-green-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Email</h3>
                        <p class="text-gray-600 mb-3">Email aktif kami</p>
                        <a href="mailto:{{ $footer->email }}"
                            class="text-green-600 font-semibold hover:text-green-700 transition">
                            {{ $footer->email }}
                        </a>
                    </div>
                @endif

                <!-- Address -->
                @if($footer && $footer->alamat)
                    <div class="contact-card bg-white rounded-xl p-6 text-center shadow-lg islamic-border">
                        <div class="w-14 h-14 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="map-pin" class="w-7 h-7 text-amber-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Alamat TPA</h3>
                        <p class="text-gray-600 mb-3">Lokasi belajar</p>
                        <p class="text-amber-600 font-semibold text-sm">
                            {{ $footer->alamat }}
                        </p>
                    </div>
                @endif

                <!-- Social Media -->
                @if($footer && $footer->socials->count() > 0)
                    <div class="contact-card bg-white rounded-xl p-6 text-center shadow-lg islamic-border">
                        <div class="w-14 h-14 bg-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="share-2" class="w-7 h-7 text-cyan-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Media Sosial</h3>
                        <p class="text-gray-600 mb-3">Ikuti kegiatan kami</p>
                        <div class="flex justify-center space-x-3">
                            @foreach($footer->socials as $social)
                                <a href="{{ $social->url }}" target="_blank"
                                    class="social-icon text-gray-500 hover:text-green-600 transition bg-gray-100 p-2 rounded-full"
                                    title="{{ ucfirst($social->platform) }}">
                                    @php
        $platformIcons = [
            'instagram' => 'instagram',
            'facebook' => 'facebook',
            'youtube' => 'youtube',
            'whatsapp' => 'message-circle',
        ];
        $icon = $platformIcons[strtolower($social->platform)] ?? 'share-2';
                                    @endphp
                                    <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Map Section -->
    @if($footer && $footer->map_embed)
        <section class="py-16 bg-green-50">
            <div class="container mx-auto px-6">
                <div class="max-w-6xl mx-auto">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full mb-4 shadow-sm">
                            <i data-lucide="map-pin" class="w-8 h-8 text-green-600"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">Lokasi TPA</h2>
                        <p class="text-gray-600">Silakan datang ke lokasi kami untuk pendaftaran dan informasi</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden islamic-border">
                        <div class="w-full h-120">
                            <<iframe src="{!! $footer->map_embed !!}" width="100%" height="100%" style="border:0;"
                                                    allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
@endsection