@extends('template')
@section('title', 'Struktur Organisasi')
@section('content')
    <style>
        .islamic-pattern {
            background-color: #f0f9f4;
            background-image:
                repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(16, 185, 129, 0.03) 35px, rgba(16, 185, 129, 0.03) 70px),
                repeating-linear-gradient(-45deg, transparent, transparent 35px, rgba(16, 185, 129, 0.03) 35px, rgba(16, 185, 129, 0.03) 70px);
        }
    </style>

    <div class="islamic-pattern min-h-screen py-16 md:py-24 px-4">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12 text-center">
                <div class="mb-8">
                    <div class="flex flex-col items-center justify-center gap-3 mb-2">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800">
                            Struktur Organisasi TPA Al-Ikhlas
                        </h2>
                    </div>
                    <p class="text-lg text-green-600 font-semibold">
                        Susunan Pengurus & Penanggung Jawab
                    </p>
                </div>

                @if($structure?->image)
                    <div class="flex justify-center">
                        <img src="{{ asset('storage/' . $structure->image) }}" alt="Struktur Organisasi"
                            class="rounded-xl shadow-md w-full max-w-4xl object-contain">
                    </div>
                @else
                    <div class="py-12 text-gray-500 text-lg">
                        Belum ada gambar struktur organisasi yang ditambahkan.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection