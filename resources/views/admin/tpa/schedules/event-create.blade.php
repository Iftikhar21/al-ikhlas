@extends('admin.template-admin')
@section('title', 'Tambah Event')
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <div class="max-w-full mx-auto">

            <!-- Notifikasi Error -->
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i data-lucide="alert-triangle" class="w-5 h-5 text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                Terdapat {{ $errors->count() }} kesalahan dalam pengisian form
                            </h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-sm p-6 mb-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Tambah Event Baru</h2>
                        <p class="text-gray-600">Buat event dengan informasi yang lengkap dan menarik</p>
                    </div>
                    <a href="{{ route('admin.tpa.schedule.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg shadow transition">
                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>

            <form id="createForm" action="{{ route('admin.tpa.events.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <!-- Card Utama -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Header Card -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i data-lucide="calendar" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                            Informasi Event
                        </h2>
                    </div>

                    <!-- Body Card -->
                    <div class="p-6 space-y-6">
                        <!-- Judul Event -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="captions" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                                Judul Event
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 transition @error('title') border-red-500 @enderror"
                                placeholder="Masukkan judul event yang menarik..." required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Event -->
                        <div>
                            <label for="event_date" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="calendar" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                                Tanggal Event
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="date" id="event_date" name="event_date" value="{{ old('event_date') }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 transition @error('event_date') border-red-500 @enderror"
                                required>
                            @error('event_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gambar Event -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="camera" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                                Gambar Event (MAX 10MB)
                            </label>

                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <!-- Preview Gambar -->
                            <div id="imagePreviewContainer" class="hidden mb-4">
                                <div class="relative w-full max-w-2xl mx-auto">
                                    <div
                                        class="aspect-w-16 aspect-h-9 bg-gray-100 rounded-lg overflow-hidden border-2 {{ $errors->has('image') ? 'border-red-500' : 'border-dashed border-gray-300' }}">
                                        <img id="imagePreview" class="w-full h-48 object-cover" src="" alt="Preview gambar">
                                    </div>
                                    <button type="button" onclick="removeImage()"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition">
                                        <i data-lucide="trash" class="w-4 h-4 text-white text-xs"></i>
                                    </button>
                                </div>
                                <p class="text-center text-sm text-gray-500 mt-2">Preview gambar event</p>
                            </div>

                            <!-- Upload Area -->
                            <div id="imageUploadArea"
                                class="border-2 border-dashed {{ $errors->has('image') ? 'border-red-500' : 'border-gray-300' }} rounded-lg p-6 text-center hover:border-green-400 transition cursor-pointer bg-gray-50">
                                <div class="flex flex-col items-center justify-center">
                                    <i data-lucide="cloud" class="w-10 h-10 text-gray-500 mb-2"></i>
                                    <p class="text-sm text-gray-600 mb-1">Klik untuk upload gambar event</p>
                                    <p class="text-xs text-gray-500">Format: JPEG, PNG, JPG (Max: 10MB)</p>
                                </div>
                                <input type="file" id="image" name="image" accept="image/*" class="hidden">
                            </div>
                        </div>

                        <!-- Deskripsi Event -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="text-align-start" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                                Deskripsi Event
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <textarea id="description" name="description" rows="6"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 transition resize-none @error('description') border-red-500 @enderror"
                                placeholder="Tulis deskripsi lengkap event di sini..."
                                required>{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Footer Card -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end">
                        <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('createForm').submit(), {
                                                    title: 'Simpan Event',
                                                    message: 'Apakah Anda yakin ingin menyimpan event ini?',
                                                    confirmText: 'Ya, Simpan',
                                                    confirmColor: 'bg-green-600 hover:bg-green-700',
                                                    confirmIcon: 'check'
                                                })"
                            class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow font-medium flex items-center">
                            <i data-lucide="check" class="w-4 h-4 mr-2"></i>
                            Simpan Event
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <style>
        .aspect-w-16 {
            position: relative;
        }

        .aspect-w-16::before {
            content: '';
            display: block;
            padding-bottom: 56.25%;
            /* 16:9 Aspect Ratio */
        }

        .aspect-w-16>* {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>

    <script>
        // Preview gambar event
        document.getElementById('image').addEventListener('change', function (e) {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                const reader = new FileReader();

                reader.onload = function (e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('imagePreviewContainer').classList.remove('hidden');
                    document.getElementById('imageUploadArea').classList.add('hidden');
                };

                reader.readAsDataURL(file);
            }
        });

        // Hapus gambar
        function removeImage() {
            document.getElementById('imagePreviewContainer').classList.add('hidden');
            document.getElementById('imageUploadArea').classList.remove('hidden');
            document.getElementById('image').value = '';
        }

        // Trigger upload area
        document.getElementById('imageUploadArea').addEventListener('click', function () {
            document.getElementById('image').click();
        });

        // Form validation
        document.getElementById('createForm').addEventListener('submit', function (e) {
            let isValid = true;
            let errorMessages = [];

            // Check title
            const title = document.getElementById('title').value.trim();
            if (!title) {
                isValid = false;
                errorMessages.push('Judul event harus diisi');
            }

            // Check event date
            const eventDate = document.getElementById('event_date').value;
            if (!eventDate) {
                isValid = false;
                errorMessages.push('Tanggal event harus diisi');
            }

            // Check description
            const description = document.getElementById('description').value.trim();
            if (!description) {
                isValid = false;
                errorMessages.push('Deskripsi event harus diisi');
            }

            if (!isValid) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi:\n\n' + errorMessages.join('\n'));
            }
        });
    </script>
@endsection