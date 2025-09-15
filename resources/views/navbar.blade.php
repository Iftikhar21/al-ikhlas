<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <div class="w-12 h-12">
                    <img src="{{ asset('img/al_ikhlas_logo.jpg') }}" alt="Logo TPA">
                </div>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="#"
                        class="text-primary hover:text-primary-dark px-3 py-2 text-sm font-medium transition-colors">Beranda</a>
                    <a href="#"
                        class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium transition-colors">Tentang
                        Kami</a>
                    <a href="#"
                        class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium transition-colors">Program</a>
                    <a href="#"
                        class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium transition-colors">Jadwal</a>
                    <a href="#"
                        class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium transition-colors">Pendaftaran</a>
                    <a href="#"
                        class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium transition-colors">Kontak</a>
                </div>
            </div>

            <div class="hidden md:block">
                <button
                    class="bg-accent hover:bg-accent-dark text-gray-800 font-medium px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-105">
                    Daftar Sekarang
                </button>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button class="text-gray-600 hover:text-primary p-2" onclick="toggleMobileMenu()">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden pb-4">
            <div class="flex flex-col space-y-2">
                <a href="#" class="text-primary hover:text-primary-dark px-3 py-2 text-sm font-medium">Beranda</a>
                <a href="#" class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium">Tentang Kami</a>
                <a href="#" class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium">Program</a>
                <a href="#" class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium">Jadwal</a>
                <a href="#" class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium">Pendaftaran</a>
                <a href="#" class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium">Kontak</a>
                <button class="bg-accent hover:bg-accent-dark text-gray-800 font-medium px-4 py-2 rounded-lg w-fit">
                    Daftar Sekarang
                </button>
            </div>
        </div>
    </div>
</nav>