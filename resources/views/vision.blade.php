@extends('template')

@section('content')
    <style>
        .islamic-pattern {
            background-color: #f0f9f4;
            background-image:
                repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(16, 185, 129, 0.03) 35px, rgba(16, 185, 129, 0.03) 70px),
                repeating-linear-gradient(-45deg, transparent, transparent 35px, rgba(16, 185, 129, 0.03) 35px, rgba(16, 185, 129, 0.03) 70px);
        }
    </style>

    <div class="islamic-pattern min-h-[100vh] d-flex justify-center">
        <!-- Vision & Mission Section -->
        <section class="py-16 md:py-24 px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Visi & Misi</h2>
                    <p class="text-lg text-gray-600">Panduan kami dalam membentuk generasi Qur'ani yang berakhlak mulia</p>
                </div>

                @if($visions->isNotEmpty())
                    @foreach($visions as $vision)
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Vision -->
                            <div
                                class="bg-gradient-to-br from-green-500 to-green-600 rounded-3xl p-8 md:p-10 text-white shadow-xl transform hover:scale-105 transition-transform duration-300">
                                <div class="flex items-center gap-4 mb-6">
                                    <div class="p-3 bg-white bg-opacity-20 rounded-full">
                                        <i data-lucide="eye" class="w-10 h-10 text-slate-500"></i>
                                    </div>
                                    <h3 class="text-2xl md:text-3xl font-bold">Visi</h3>
                                </div>
                                <p class="text-lg leading-relaxed italic">
                                    "{{ $vision->vision }}"
                                </p>
                            </div>

                            <!-- Mission -->
                            <div
                                class="bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-3xl p-8 md:p-10 text-white shadow-xl transform hover:scale-105 transition-transform duration-300">
                                <div class="flex items-center gap-4 mb-6">
                                    <div class="p-3 bg-white bg-opacity-20 rounded-full">
                                        <i data-lucide="target" class="w-10 h-10 text-slate-500"></i>
                                    </div>
                                    <h3 class="text-2xl md:text-3xl font-bold">Misi</h3>
                                </div>
                                <ul class="space-y-3 text-lg">
                                    @foreach($vision->missions as $mission)
                                        <li class="flex items-start gap-3">
                                            <i data-lucide="check-circle" class="w-6 h-6 flex-shrink-0 mt-1"></i>
                                            <span>{{ $mission }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center text-gray-500 italic">
                        Belum ada data visi & misi yang ditambahkan.
                    </div>
                @endif
            </div>
        </section>
    </div>
    <script>
        lucide.createIcons();
    </script>
@endsection