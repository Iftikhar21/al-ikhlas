@extends('template')

@section('content')
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-out forwards;
        }

        .card-enter {
            opacity: 0;
            transform: translateY(30px);
        }

        .program-card {
            transition: all 0.3s ease;
        }

        .program-card:hover {
            transform: translateY(-8px);
        }

        .icon-container {
            transition: all 0.4s ease;
        }

        .program-card:hover .icon-container {
            transform: scale(1.1) rotate(5deg);
        }

        .btn-hover {
            transition: all 0.3s ease;
        }

        .btn-hover:hover {
            transform: translateX(5px);
        }

        /* Stagger animation delays */
        .card-1 {
            animation-delay: 0.1s;
        }

        .card-2 {
            animation-delay: 0.2s;
        }

        .card-3 {
            animation-delay: 0.3s;
        }

        .card-4 {
            animation-delay: 0.4s;
        }

        .card-5 {
            animation-delay: 0.5s;
        }

        .card-6 {
            animation-delay: 0.6s;
        }
    </style>

    <!-- Header Section -->
    <header class="pt-16 pb-12 px-4 animate-fade-in">
        <div class="max-w-7xl mx-auto text-center">
            <h1
                class="text-5xl md:text-6xl font-bold bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-600 bg-clip-text text-transparent mb-6">
                Our Programs
            </h1>
            <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Discover our comprehensive Islamic education programs designed to nurture spiritual growth,
                strengthen faith, and build a deeper connection with the Quran and Islamic teachings.
            </p>
        </div>
    </header>

    <!-- Programs Grid -->
    <main class="max-w-7xl mx-auto px-4 pb-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Tahsin Program -->
            <div
                class="program-card card-enter animate-fade-in-up card-1 bg-white rounded-2xl shadow-lg hover:shadow-2xl p-8 border border-gray-100">
                <div
                    class="icon-container w-16 h-16 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Tahsin</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Perfect your Quranic recitation with proper pronunciation, tajweed rules, and beautiful
                    articulation. Master the art of reading the Quran correctly.
                </p>
                <button class="btn-hover flex items-center text-emerald-600 font-semibold group">
                    Learn More
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </button>
            </div>

            <!-- Tahfidz Program -->
            <div
                class="program-card card-enter animate-fade-in-up card-2 bg-white rounded-2xl shadow-lg hover:shadow-2xl p-8 border border-gray-100">
                <div
                    class="icon-container w-16 h-16 bg-gradient-to-br from-purple-400 to-indigo-500 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Tahfidz</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Embark on a transformative journey to memorize the Holy Quran. Structured lessons with proven
                    techniques to help you become a Hafiz.
                </p>
                <button class="btn-hover flex items-center text-purple-600 font-semibold group">
                    Learn More
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </button>
            </div>

            <!-- Adab Program -->
            <div
                class="program-card card-enter animate-fade-in-up card-3 bg-white rounded-2xl shadow-lg hover:shadow-2xl p-8 border border-gray-100">
                <div
                    class="icon-container w-16 h-16 bg-gradient-to-br from-rose-400 to-pink-500 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Adab</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Learn Islamic etiquette and manners to develop noble character. Build strong moral foundations based
                    on prophetic teachings and values.
                </p>
                <button class="btn-hover flex items-center text-rose-600 font-semibold group">
                    Learn More
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </button>
            </div>

            <!-- Fiqh Program -->
            <div
                class="program-card card-enter animate-fade-in-up card-4 bg-white rounded-2xl shadow-lg hover:shadow-2xl p-8 border border-gray-100">
                <div
                    class="icon-container w-16 h-16 bg-gradient-to-br from-amber-400 to-orange-500 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Fiqh</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Understand Islamic jurisprudence and apply religious rulings in daily life. Learn practical guidance
                    for worship, transactions, and family matters.
                </p>
                <button class="btn-hover flex items-center text-amber-600 font-semibold group">
                    Learn More
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </button>
            </div>

            <!-- Arabic Language Program -->
            <div
                class="program-card card-enter animate-fade-in-up card-5 bg-white rounded-2xl shadow-lg hover:shadow-2xl p-8 border border-gray-100">
                <div
                    class="icon-container w-16 h-16 bg-gradient-to-br from-cyan-400 to-blue-500 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Arabic Language</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Master the language of the Quran from basics to advanced levels. Develop reading, writing, speaking,
                    and comprehension skills in Classical Arabic.
                </p>
                <button class="btn-hover flex items-center text-cyan-600 font-semibold group">
                    Learn More
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </button>
            </div>

            <!-- Aqidah Program -->
            <div
                class="program-card card-enter animate-fade-in-up card-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl p-8 border border-gray-100">
                <div
                    class="icon-container w-16 h-16 bg-gradient-to-br from-violet-400 to-purple-500 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Aqidah</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Strengthen your Islamic faith and belief system. Study the fundamental principles of Islamic creed
                    and theology with authentic sources.
                </p>
                <button class="btn-hover flex items-center text-violet-600 font-semibold group">
                    Learn More
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </button>
            </div>

        </div>

        <!-- Call to Action Section -->
        <div class="mt-20 text-center animate-fade-in-up" style="animation-delay: 0.7s;">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-3xl p-12 shadow-2xl">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Ready to Begin Your Journey?
                </h2>
                <p class="text-indigo-100 text-lg mb-8 max-w-2xl mx-auto">
                    Join thousands of students who have transformed their lives through our comprehensive Islamic
                    education programs.
                </p>
                <button
                    class="bg-white text-indigo-600 px-8 py-4 rounded-full font-bold text-lg hover:shadow-xl transition-all hover:scale-105">
                    Enroll Now
                </button>
            </div>
        </div>
    </main>
@endsection