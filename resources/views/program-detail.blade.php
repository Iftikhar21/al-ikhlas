@extends('template')
@section('title', 'Detail Program')
@section('content')
    <style>
        .program-image {
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex items-center space-x-2 text-sm text-gray-600">
                    <li><a href="{{ route('program') }}" class="hover:text-green-700 transition">Program</a></li>
                    <li><span class="mx-2">›</span></li>
                    <li class="text-green-700 font-semibold">{{ $program->title }}</li>
                </ol>
            </nav>

            <div class="bg-white rounded-xl shadow-sm p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                    <!-- Bagian Kiri - Gambar Program -->
                    <div>
                        @if($program->thumbnail)
                            <img src="{{ asset('storage/' . $program->thumbnail) }}" alt="{{ $program->title }}"
                                class="w-full h-auto program-image">
                        @else
                            <div
                                class="w-full aspect-square bg-gray-100 rounded-xl flex items-center justify-center program-image">
                                <svg class="w-24 h-24 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Bagian Kanan - Informasi Program -->
                    <div class="flex flex-col justify-center">
                        <!-- Nama Program -->
                        <h1 class="text-4xl font-bold text-gray-800 mb-6">
                            {{ $program->title }}
                        </h1>

                        <!-- Deskripsi Program -->
                        <div class="prose max-w-none text-gray-700 leading-relaxed text-lg">
                            {!! nl2br(e($program->description)) !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection