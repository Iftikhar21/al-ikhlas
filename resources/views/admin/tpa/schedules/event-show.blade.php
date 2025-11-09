@extends('admin.template-admin')
@section('title', 'Detail Event')
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <div class="container mx-auto max-w-4xl">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Detail Event</h1>
                <p class="text-gray-600">Informasi lengkap event</p>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                @if($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-64 object-cover">
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500 text-lg">No Image Available</span>
                    </div>
                @endif

                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $event->title }}</h2>
                            <p class="text-gray-600">
                                <i class="fas fa-calendar mr-2"></i>
                                {{ \Carbon\Carbon::parse($event->event_date)->format('l, d F Y') }}
                            </p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.tpa.events.edit', $event->id) }}"
                                class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm">
                                Edit
                            </a>
                            <a href="{{ route('admin.tpa.schedules.index') }}"
                                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
                                Kembali
                            </a>
                        </div>
                    </div>

                    <div class="prose max-w-none">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Deskripsi Event</h3>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $event->description }}</p>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>Dibuat: {{ $event->created_at->format('d M Y H:i') }}</span>
                            <span>Diupdate: {{ $event->updated_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection