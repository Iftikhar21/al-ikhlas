<footer class="bg-primary-dark text-white py-12">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid md:grid-cols-4 gap-8">

            {{-- Logo & Slogan --}}
            <div class="flex flex-col items-center justify-center">
                @if($footer && $footer->logo)
                    <img src="{{ asset('storage/' . $footer->logo) }}" alt="Logo TPA" class="mb-4">
                @else
                    <img src="{{ asset('img/al_ikhlas_logo_white.png') }}" alt="Logo Default" class="mb-4">
                @endif
            
                <div class="text-center">
                    @if($footer && $footer->slogan)
                        <p class="text-white font-semibold text-lg italic">"{{ $footer->slogan }}"</p>
                    @endif
                </div>
            </div>

            {{-- Deskripsi & Sosial Media --}}
            <div>
                <h3 class="text-xl text-accent font-bold mb-4">TPA Masjid Al-Ikhlas</h3>
                <p class="text-gray-300 mb-4 text-sm leading-relaxed">
                    {{ $footer->deskripsi ?? 'Deskripsi belum diatur.' }}
                </p>

                {{-- Sosial Media --}}
                @if($footer && $footer->socials->count() > 0)
                    <div class="flex space-x-3 mb-4">
                        @foreach($footer->socials as $social)
                            <a href="{{ $social->url }}" target="_blank"
                                class="text-white hover:text-accent transition text-xl">
                                <i data-lucide="{{ $social->platform }}"></i>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Menu Cepat --}}
            <div>
                <h4 class="text-xl text-accent font-semibold mb-4">Menu Cepat</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white">Beranda</a></li>
                    <li><a href="{{ route('news') }}" class="text-gray-300 hover:text-white">Berita</a></li>
                    <li><a href="{{ route('program') }}" class="text-gray-300 hover:text-white">Program</a></li>
                    <li><a href="{{ route('schedule') }}" class="text-gray-300 hover:text-white">Jadwal</a></li>
                    <li><a href="{{ route('register-online') }}" class="text-gray-300 hover:text-white">Pendaftaran</a>
                    </li>
                    <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white">Kontak</a></li>
                </ul>
            </div>

            {{-- Kontak & Maps --}}
            <div>
                <h4 class="text-lg text-accent font-semibold mb-4">Kontak & Alamat</h4>
                <div class="space-y-3 text-sm text-gray-300 mb-4">
                    @if($footer && $footer->alamat)
                        <div class="flex items-start">
                            <i data-lucide="map-pin" class="mr-2 mt-1 flex-shrink-0"></i>
                            <span>{{ $footer->alamat }}</span>
                        </div>
                    @endif

                    @if($footer && $footer->map_embed)
                        <div class="w-full h-32 rounded-lg overflow-hidden shadow-lg border border-white">
                            <iframe src="{!! $footer->map_embed !!}" class="w-full h-full border-0" allowfullscreen=""
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    @endif

                    @if($footer && $footer->telepon)
                        @php
                            // Tambahkan '-' setiap 4 digit, kecuali di akhir jika kurang dari 4
                            $formattedPhone = preg_replace('/(\d{4})(?=\d)/', '$1-', $footer->telepon);
                        @endphp
                        <div class="flex items-center">
                            <i data-lucide="phone" class="mr-2"></i>
                            <span>{{ $formattedPhone }}</span>
                        </div>
                    @endif

                    @if($footer && $footer->email)
                        <div class="flex items-center">
                            <i data-lucide="mail" class="mr-2"></i>
                            <span>{{ $footer->email }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="border-t border-gray-700 mt-8 pt-8 text-center">
            <p class="text-gray-400 text-sm">
                © {{ date('Y') }} TPA Masjid Al-Ikhlas. Semua hak dilindungi undang-undang.
            </p>
        </div>
    </div>
</footer>