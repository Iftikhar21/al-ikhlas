@extends('template')

@section('content')
    <style>
        .gradient-overlay {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.4) 40%, rgba(0, 0, 0, 0) 100%);
        }

        .card-hover:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }

        .dot.active {
            background-color: white;
            opacity: 1;
            width: 16px;
        }

        .dot {
            transition: all 0.3s ease;
        }
    </style>
    <div class="relative">
        <div id="carousel" class="carousel-container flex overflow-x-hidden snap-x snap-mandatory">
            <!-- Slide 1 -->
            <div class="carousel-item min-w-full h-[70vh] md:h-screen relative snap-start">
                <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1600&h=900&fit=crop"
                    alt="Technology" class="w-full h-full object-cover">
                <div class="gradient-overlay absolute inset-0"></div>
                <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-8 md:p-12 lg:p-16">
                    <div class="max-w-4xl">
                        <span
                            class="inline-block px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded-full mb-2 sm:mb-4">TECHNOLOGY</span>
                        <h1
                            class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-6xl font-bold text-white mb-2 sm:mb-4 leading-tight">
                            The Future of AI: Transforming Industries Worldwide</h1>
                        <p class="text-gray-200 text-sm sm:text-base md:text-lg lg:text-xl mb-4 sm:mb-6 max-w-2xl">
                            Artificial intelligence is reshaping how we work, live, and interact with technology in
                            unprecedented ways.</p>
                        <button
                            class="px-4 py-2 sm:px-6 sm:py-3 bg-white text-gray-900 rounded-full font-semibold hover:bg-gray-100 transition-all text-sm sm:text-base">Read
                            More</button>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item min-w-full h-[70vh] md:h-screen relative snap-start">
                <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1600&h=900&fit=crop"
                    alt="Environment" class="w-full h-full object-cover">
                <div class="gradient-overlay absolute inset-0"></div>
                <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-8 md:p-12 lg:p-16">
                    <div class="max-w-4xl">
                        <span
                            class="inline-block px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded-full mb-2 sm:mb-4">ENVIRONMENT</span>
                        <h1
                            class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-6xl font-bold text-white mb-2 sm:mb-4 leading-tight">
                            Climate Action: Global Leaders Unite for Change</h1>
                        <p class="text-gray-200 text-sm sm:text-base md:text-lg lg:text-xl mb-4 sm:mb-6 max-w-2xl">
                            Nations commit to ambitious targets as climate summit delivers groundbreaking agreements.
                        </p>
                        <button
                            class="px-4 py-2 sm:px-6 sm:py-3 bg-white text-gray-900 rounded-full font-semibold hover:bg-gray-100 transition-all text-sm sm:text-base">Read
                            More</button>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item min-w-full h-[70vh] md:h-screen relative snap-start">
                <img src="https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?w=1600&h=900&fit=crop"
                    alt="Innovation" class="w-full h-full object-cover">
                <div class="gradient-overlay absolute inset-0"></div>
                <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-8 md:p-12 lg:p-16">
                    <div class="max-w-4xl">
                        <span
                            class="inline-block px-3 py-1 bg-purple-600 text-white text-xs font-semibold rounded-full mb-2 sm:mb-4">INNOVATION</span>
                        <h1
                            class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-6xl font-bold text-white mb-2 sm:mb-4 leading-tight">
                            Space Exploration Reaches New Milestones</h1>
                        <p class="text-gray-200 text-sm sm:text-base md:text-lg lg:text-xl mb-4 sm:mb-6 max-w-2xl">
                            Breakthrough discoveries push the boundaries of human knowledge and exploration beyond
                            Earth.</p>
                        <button
                            class="px-4 py-2 sm:px-6 sm:py-3 bg-white text-gray-900 rounded-full font-semibold hover:bg-gray-100 transition-all text-sm sm:text-base">Read
                            More</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carousel Dots -->
        <div class="absolute bottom-4 sm:bottom-6 md:bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-2">
            <button class="dot w-2 h-2 rounded-full bg-white bg-opacity-50 active" onclick="scrollToSlide(0)"></button>
            <button class="dot w-2 h-2 rounded-full bg-white bg-opacity-50" onclick="scrollToSlide(1)"></button>
            <button class="dot w-2 h-2 rounded-full bg-white bg-opacity-50" onclick="scrollToSlide(2)"></button>
        </div>

        <!-- Navigation Arrows -->
        <button onclick="scrollCarousel(-1)" class="hidden md:flex absolute left-2 md:left-4 top-1/2 -translate-y-1/2 
                           w-8 h-8 md:w-12 md:h-12 bg-white cursor-pointer hover:bg-white/30 backdrop-blur-sm 
                           rounded-full items-center justify-center transition-all">
            <svg class="w-4 h-4 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <button onclick="scrollCarousel(1)" class="hidden md:flex absolute right-2 md:right-4 top-1/2 -translate-y-1/2 
                           w-8 h-8 md:w-12 md:h-12 bg-white cursor-pointer hover:bg-white/30 backdrop-blur-sm 
                           rounded-full items-center justify-center transition-all">
            <svg class="w-4 h-4 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>

    <!-- News Grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 md:py-16">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 sm:mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4 sm:mb-0">Latest Stories</h2>
            <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold flex items-center">
                View All
                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <!-- Card 1 -->
            <article class="card-hover bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-md sm:shadow-lg">
                <div class="relative h-48 sm:h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1488590528505-98d2b5aba04b?w=800&h=600&fit=crop" alt="Tech"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <span
                        class="absolute top-3 sm:top-4 left-3 sm:left-4 px-2 sm:px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded-full">TECH</span>
                </div>
                <div class="p-4 sm:p-6">
                    <h3
                        class="text-lg sm:text-xl font-bold text-gray-900 mb-2 hover:text-blue-600 transition-colors cursor-pointer">
                        Quantum Computing Breakthrough Announced</h3>
                    <p class="text-gray-600 text-sm sm:text-base mb-3 sm:mb-4">Researchers achieve quantum supremacy
                        milestone with new processor architecture.</p>
                    <div class="flex items-center text-xs sm:text-sm text-gray-500">
                        <span>5 hours ago</span>
                        <span class="mx-2">•</span>
                        <span>3 min read</span>
                    </div>
                </div>
            </article>

            <!-- Card 2 -->
            <article class="card-hover bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-md sm:shadow-lg">
                <div class="relative h-48 sm:h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800&h=600&fit=crop"
                        alt="Business" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <span
                        class="absolute top-3 sm:top-4 left-3 sm:left-4 px-2 sm:px-3 py-1 bg-orange-600 text-white text-xs font-semibold rounded-full">BUSINESS</span>
                </div>
                <div class="p-4 sm:p-6">
                    <h3
                        class="text-lg sm:text-xl font-bold text-gray-900 mb-2 hover:text-blue-600 transition-colors cursor-pointer">
                        Global Markets React to Economic Data</h3>
                    <p class="text-gray-600 text-sm sm:text-base mb-3 sm:mb-4">Stock markets show resilience as
                        investors digest quarterly earnings reports.</p>
                    <div class="flex items-center text-xs sm:text-sm text-gray-500">
                        <span>8 hours ago</span>
                        <span class="mx-2">•</span>
                        <span>4 min read</span>
                    </div>
                </div>
            </article>

            <!-- Card 3 -->
            <article class="card-hover bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-md sm:shadow-lg">
                <div class="relative h-48 sm:h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1540747913346-19e32dc3e97e?w=800&h=600&fit=crop"
                        alt="Health" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <span
                        class="absolute top-3 sm:top-4 left-3 sm:left-4 px-2 sm:px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded-full">HEALTH</span>
                </div>
                <div class="p-4 sm:p-6">
                    <h3
                        class="text-lg sm:text-xl font-bold text-gray-900 mb-2 hover:text-blue-600 transition-colors cursor-pointer">
                        Revolutionary Medical Treatment Approved</h3>
                    <p class="text-gray-600 text-sm sm:text-base mb-3 sm:mb-4">New therapy offers hope for millions
                        affected by chronic conditions worldwide.</p>
                    <div class="flex items-center text-xs sm:text-sm text-gray-500">
                        <span>12 hours ago</span>
                        <span class="mx-2">•</span>
                        <span>6 min read</span>
                    </div>
                </div>
            </article>

            <!-- Card 4 -->
            <article class="card-hover bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-md sm:shadow-lg">
                <div class="relative h-48 sm:h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1477346611705-65d1883cee1e?w=800&h=600&fit=crop"
                        alt="Culture" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <span
                        class="absolute top-3 sm:top-4 left-3 sm:left-4 px-2 sm:px-3 py-1 bg-pink-600 text-white text-xs font-semibold rounded-full">CULTURE</span>
                </div>
                <div class="p-4 sm:p-6">
                    <h3
                        class="text-lg sm:text-xl font-bold text-gray-900 mb-2 hover:text-blue-600 transition-colors cursor-pointer">
                        Art Exhibition Breaks Attendance Records</h3>
                    <p class="text-gray-600 text-sm sm:text-base mb-3 sm:mb-4">Contemporary art showcase attracts
                        visitors from around the globe in historic numbers.</p>
                    <div class="flex items-center text-xs sm:text-sm text-gray-500">
                        <span>1 day ago</span>
                        <span class="mx-2">•</span>
                        <span>5 min read</span>
                    </div>
                </div>
            </article>

            <!-- Card 5 -->
            <article class="card-hover bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-md sm:shadow-lg">
                <div class="relative h-48 sm:h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=800&h=600&fit=crop"
                        alt="Sports" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <span
                        class="absolute top-3 sm:top-4 left-3 sm:left-4 px-2 sm:px-3 py-1 bg-yellow-600 text-white text-xs font-semibold rounded-full">SPORTS</span>
                </div>
                <div class="p-4 sm:p-6">
                    <h3
                        class="text-lg sm:text-xl font-bold text-gray-900 mb-2 hover:text-blue-600 transition-colors cursor-pointer">
                        Championship Finals Set Record Viewership</h3>
                    <p class="text-gray-600 text-sm sm:text-base mb-3 sm:mb-4">Thrilling match captivates millions as
                        underdog team defies all expectations.</p>
                    <div class="flex items-center text-xs sm:text-sm text-gray-500">
                        <span>1 day ago</span>
                        <span class="mx-2">•</span>
                        <span>4 min read</span>
                    </div>
                </div>
            </article>

            <!-- Card 6 -->
            <article class="card-hover bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-md sm:shadow-lg">
                <div class="relative h-48 sm:h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=800&h=600&fit=crop"
                        alt="Travel" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <span
                        class="absolute top-3 sm:top-4 left-3 sm:left-4 px-2 sm:px-3 py-1 bg-teal-600 text-white text-xs font-semibold rounded-full">TRAVEL</span>
                </div>
                <div class="p-4 sm:p-6">
                    <h3
                        class="text-lg sm:text-xl font-bold text-gray-900 mb-2 hover:text-blue-600 transition-colors cursor-pointer">
                        Hidden Gems: Destinations for 2025</h3>
                    <p class="text-gray-600 text-sm sm:text-base mb-3 sm:mb-4">Discover the world's most breathtaking
                        locations that remain off the beaten path.</p>
                    <div class="flex items-center text-xs sm:text-sm text-gray-500">
                        <span>2 days ago</span>
                        <span class="mx-2">•</span>
                        <span>7 min read</span>
                    </div>
                </div>
            </article>
        </div>
    </section>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        const carousel = document.getElementById('carousel');
        const dots = document.querySelectorAll('.dot');
        let currentSlide = 0;
        let autoScrollInterval;

        function scrollCarousel(direction) {
            const slideWidth = carousel.offsetWidth;
            currentSlide = (currentSlide + direction + 3) % 3;
            carousel.scrollTo({
                left: slideWidth * currentSlide,
                behavior: 'smooth'
            });
            updateDots();
        }

        function scrollToSlide(index) {
            const slideWidth = carousel.offsetWidth;
            currentSlide = index;
            carousel.scrollTo({
                left: slideWidth * index,
                behavior: 'smooth'
            });
            updateDots();
        }

        function updateDots() {
            dots.forEach((dot, index) => {
                if (index === currentSlide) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }

        // Update dots on scroll
        carousel.addEventListener('scroll', () => {
            const slideWidth = carousel.offsetWidth;
            const scrolled = carousel.scrollLeft;
            currentSlide = Math.round(scrolled / slideWidth);
            updateDots();
        });

        // Auto-scroll carousel
        function startAutoScroll() {
            autoScrollInterval = setInterval(() => {
                scrollCarousel(1);
            }, 5000);
        }

        function stopAutoScroll() {
            clearInterval(autoScrollInterval);
        }

        // Pause auto-scroll on hover
        carousel.addEventListener('mouseenter', stopAutoScroll);
        carousel.addEventListener('mouseleave', startAutoScroll);

        // Touch swipe support
        let touchStartX = 0;
        let touchEndX = 0;

        carousel.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
            stopAutoScroll();
        });

        carousel.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            if (touchStartX - touchEndX > 50) {
                scrollCarousel(1);
            } else if (touchEndX - touchStartX > 50) {
                scrollCarousel(-1);
            }
            startAutoScroll();
        });

        // Start auto-scroll on page load
        startAutoScroll();
    </script>
@endsection