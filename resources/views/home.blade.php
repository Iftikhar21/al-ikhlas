@extends('template')

@section('content')
    <style>
        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-bg {
            background: linear-gradient(rgba(21, 128, 61, 0.7), rgba(21, 128, 61, 0.7)), url('https://images.unsplash.com/photo-1542816417-0983c9c9ad53?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
    <section class="hero-bg min-h-screen flex items-center justify-center text-white">
        <div class="max-w-4xl mx-auto px-4 text-center fade-in">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Selamat Datang di<br>TPA Masjid Al-Ikhlas
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-100">
                Mencetak Generasi Qur'ani dengan Cinta Al-Qur'an
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button
                    class="bg-primary hover:bg-primary-dark text-white font-medium px-8 py-3 rounded-lg transition-all duration-300 transform hover:scale-105">
                    Lihat Program
                </button>
                <button
                    class="bg-accent hover:bg-accent-dark text-gray-800 font-medium px-8 py-3 rounded-lg transition-all duration-300 transform hover:scale-105">
                    Daftar Santri
                </button>
            </div>
        </div>
    </section>

    <!-- Profil Singkat -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="fade-in">
                    <h2 class="text-3xl font-bold text-primary mb-6">Tentang TPA Al-Ikhlas</h2>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        TPA Masjid Al-Ikhlas hadir sebagai lembaga pendidikan Al-Qur'an yang berkomitmen untuk mencetak
                        generasi qur'ani dengan metode pembelajaran yang menyenangkan dan mudah dipahami.
                    </p>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Dengan tenaga pengajar yang berpengalaman dan berkualitas, kami mengutamakan pembentukan akhlak
                        mulia, pemahaman Al-Qur'an yang mendalam, serta penerapan nilai-nilai Islam dalam kehidupan
                        sehari-hari.
                    </p>
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div class="bg-green-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-primary">200+</div>
                            <div class="text-sm text-gray-600">Santri Aktif</div>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-primary">15+</div>
                            <div class="text-sm text-gray-600">Ustadz/ah</div>
                        </div>
                    </div>
                </div>
                <div class="fade-in">
                    <img src="https://images.unsplash.com/photo-1544717297-fa95b6ee9643?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                        alt="Anak-anak mengaji" class="rounded-lg shadow-lg w-full h-96 object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Program Unggulan -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12 fade-in">
                <h2 class="text-3xl font-bold text-primary mb-4">Program Kami</h2>
                <p class="text-gray-600">Beragam program pembelajaran Al-Qur'an yang disesuaikan dengan usia dan
                    kemampuan santri</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div
                    class="bg-white p-6 rounded-lg shadow-md border-l-4 border-primary hover:shadow-lg transition-shadow fade-in">
                    <div class="text-3xl mb-4 text-primary">📖</div>
                    <h3 class="text-xl font-semibold text-primary mb-2">Tahsin</h3>
                    <p class="text-gray-600 text-sm">Perbaikan bacaan Al-Qur'an dengan metode yang mudah dan
                        menyenangkan</p>
                </div>

                <div
                    class="bg-white p-6 rounded-lg shadow-md border-l-4 border-primary hover:shadow-lg transition-shadow fade-in">
                    <div class="text-3xl mb-4 text-primary">🕌</div>
                    <h3 class="text-xl font-semibold text-primary mb-2">Tahfidz</h3>
                    <p class="text-gray-600 text-sm">Program menghafal Al-Qur'an dengan bimbingan ustadz berpengalaman
                    </p>
                </div>

                <div
                    class="bg-white p-6 rounded-lg shadow-md border-l-4 border-primary hover:shadow-lg transition-shadow fade-in">
                    <div class="text-3xl mb-4 text-primary">🤲</div>
                    <h3 class="text-xl font-semibold text-primary mb-2">Adab & Akhlak</h3>
                    <p class="text-gray-600 text-sm">Pembentukan karakter islami dan adab berinteraksi sesuai ajaran
                        Islam</p>
                </div>

                <div
                    class="bg-white p-6 rounded-lg shadow-md border-l-4 border-primary hover:shadow-lg transition-shadow fade-in">
                    <div class="text-3xl mb-4 text-primary">🎯</div>
                    <h3 class="text-xl font-semibold text-primary mb-2">Iqra & Dasar</h3>
                    <p class="text-gray-600 text-sm">Pembelajaran membaca Al-Qur'an dari dasar untuk pemula</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Jadwal Kegiatan -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4">
            <div class="text-center mb-12 fade-in">
                <h2 class="text-3xl font-bold text-primary mb-4">Jadwal Kegiatan</h2>
                <p class="text-gray-600">Jadwal pembelajaran yang terstruktur dan fleksibel</p>
            </div>

            <div class="bg-gradient-to-r from-green-50 to-yellow-50 p-6 rounded-lg shadow-md fade-in">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-semibold text-primary mb-4">Senin - Kamis</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span>Ba'da Maghrib</span>
                                <span class="font-medium">Tahsin & Iqra</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Ba'da Isya</span>
                                <span class="font-medium">Tahfidz</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-primary mb-4">Sabtu - Minggu</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span>08:00 - 10:00</span>
                                <span class="font-medium">Adab & Akhlak</span>
                            </div>
                            <div class="flex justify-between">
                                <span>10:30 - 12:00</span>
                                <span class="font-medium">Muroja'ah</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-6">
                    <button
                        class="bg-primary hover:bg-primary-dark text-white font-medium px-6 py-2 rounded-lg transition-all duration-300">
                        Lihat Semua Jadwal
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Singkat -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12 fade-in">
                <h2 class="text-3xl font-bold text-primary mb-4">Galeri Kegiatan</h2>
                <p class="text-gray-600">Dokumentasi kegiatan pembelajaran dan acara TPA</p>
            </div>

            <div class="grid md:grid-cols-3 gap-4 mb-8">
                <div class="fade-in">
                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                        alt="Kegiatan mengaji"
                        class="rounded-lg shadow-md w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="fade-in">
                    <img src="https://images.unsplash.com/photo-1609220136736-443140cffec6?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                        alt="Kegiatan belajar"
                        class="rounded-lg shadow-md w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="fade-in">
                    <img src="https://images.unsplash.com/photo-1544717297-fa95b6ee9643?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                        alt="Santri belajar"
                        class="rounded-lg shadow-md w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                </div>
            </div>

            <div class="text-center fade-in">
                <button
                    class="bg-primary hover:bg-primary-dark text-white font-medium px-8 py-3 rounded-lg transition-all duration-300 transform hover:scale-105">
                    Lihat Galeri Lengkap
                </button>
            </div>
        </div>
    </section>

    <!-- CTA Donasi -->
    <section class="py-16 bg-primary-dark text-white">
        <div class="max-w-4xl mx-auto px-4 text-center fade-in">
            <h2 class="text-3xl font-bold mb-4">Dukung Dakwah & Pendidikan Qur'ani</h2>
            <p class="text-xl mb-8 text-gray-100">
                Berpartisipasilah dalam menyebarkan ilmu Al-Qur'an dan mencetak generasi qur'ani yang berakhlak mulia
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button
                    class="bg-accent hover:bg-accent-dark text-gray-800 font-medium px-8 py-3 rounded-lg transition-all duration-300 transform hover:scale-105">
                    Donasi Sekarang
                </button>
                <button
                    class="border-2 border-white text-white hover:bg-white hover:text-primary font-medium px-8 py-3 rounded-lg transition-all duration-300">
                    Pelajari Program
                </button>
            </div>
        </div>
    </section>
    <script>
        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        }, observerOptions);

        // Observe all sections
        document.querySelectorAll('section > div, .fade-in').forEach(el => {
            observer.observe(el);
        }); 
    </script>
@endsection