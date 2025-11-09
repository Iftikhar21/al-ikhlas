@extends('admin.template-admin')
@section('title', 'Detail Quote')
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <div class="container mx-auto max-w-4xl">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Detail Quote</h1>
                <p class="text-gray-600">Quote inspiratif</p>
            </div>

            <div class="bg-white rounded-lg shadow p-8">
                <div class="text-center">
                    <div class="mb-6">
                        <span class="text-6xl text-purple-500">"</span>
                    </div>

                    <blockquote class="text-2xl text-gray-800 italic leading-relaxed mb-6">
                        "{{ $quote->quote }}"
                    </blockquote>

                    <div class="border-t border-gray-200 pt-6">
                        <cite class="text-lg font-semibold text-gray-700 not-italic">— {{ $quote->author }}</cite>
                    </div>

                    <div class="mt-8 flex justify-center space-x-3">
                        <a href="{{ route('admin.tpa.quotes.edit', $quote->id) }}"
                            class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-2 rounded-lg">
                            Edit Quote
                        </a>
                        <a href="{{ route('admin.tpa.schedules.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                            Kembali ke Daftar
                        </a>
                    </div>

                    <div class="mt-6 text-sm text-gray-500">
                        <p>Dibuat: {{ $quote->created_at->format('d M Y H:i') }}</p>
                        <p>Diupdate: {{ $quote->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection