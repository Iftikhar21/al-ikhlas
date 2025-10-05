@extends('admin.template-admin')
@section('title', 'Tambah Quote')
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <div class="container mx-auto max-w-4xl">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Tambah Quote</h1>
                <p class="text-gray-600">Tambahkan quote inspiratif baru</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('admin.quotes.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="quote" class="block text-sm font-medium text-gray-700 mb-2">Quote *</label>
                            <textarea name="quote" id="quote" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="Tulis quote inspiratif di sini..." required>{{ old('quote') }}</textarea>
                            @error('quote')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="author" class="block text-sm font-medium text-gray-700 mb-2">Author *</label>
                            <input type="text" name="author" id="author" value="{{ old('author') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="Nama author" required>
                            @error('author')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('admin.schedules.index') }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition duration-200">
                            Batal
                        </a>
                        <button type="submit"
                            class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-2 rounded-lg transition duration-200">
                            Simpan Quote
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection