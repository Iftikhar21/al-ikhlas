@extends('admin.template-admin')
@section('title', 'Tambah Program')
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
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Tambah Program Baru</h2>
                        <p class="text-gray-600">Buat program dengan informasi yang lengkap dan menarik</p>
                    </div>
                    <a href="{{ route('admin.tpa.programs.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg shadow transition">
                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>

            <form id="createForm" action="{{ route('admin.tpa.programs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6"
                id="programForm">
                @csrf

                <!-- Card Utama -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Header Card -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i data-lucide="info" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                            Informasi Program
                        </h2>
                    </div>

                    <!-- Body Card -->
                    <div class="p-6 space-y-6">
                        <!-- Judul -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="captions" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Judul Program
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition @error('title') border-red-500 @enderror"
                                placeholder="Masukkan judul program yang menarik..." required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="align-left" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Deskripsi Program
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <textarea id="description" name="description" rows="5"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition resize-none @error('description') border-red-500 @enderror"
                                placeholder="Tulis deskripsi lengkap tentang program ini..."
                                required>{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Thumbnail dengan Crop -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="camera" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Thumbnail Program (Rasio 1:1) (MAX 10MB)
                                <span class="text-red-500 ml-1">*</span>
                            </label>

                            @error('thumbnail')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('thumbnail_data')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <!-- Preview Thumbnail -->
                            <div id="thumbnailPreviewContainer" class="{{ old('thumbnail_data') ? '' : 'hidden' }} mb-4">
                                <div class="relative w-full max-w-2xl mx-auto">
                                    <div
                                        class="aspect-w-10 aspect-h-10 bg-gray-100 rounded-lg overflow-hidden border-2 {{ $errors->has('thumbnail') || $errors->has('thumbnail_data') ? 'border-red-500' : 'border-dashed border-gray-300' }}">
                                        <img id="thumbnailPreview" class="w-full h-48 object-cover"
                                            src="{{ old('thumbnail_data') ? old('thumbnail_data') : '' }}"
                                            alt="Preview thumbnail">
                                    </div>
                                    <button type="button" onclick="removeThumbnail()"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition">
                                        <i data-lucide="trash" class="w-4 h-4 text-white text-xs"></i>
                                    </button>
                                </div>
                                <p class="text-center text-sm text-gray-500 mt-2">Preview thumbnail - Pastikan gambar sesuai
                                    dengan area yang ditampilkan</p>
                            </div>

                            <!-- Upload Area -->
                            <div id="thumbnailUploadArea"
                                class="border-2 border-dashed {{ $errors->has('thumbnail') || $errors->has('thumbnail_data') ? 'border-red-500' : 'border-gray-300' }} rounded-lg p-6 text-center hover:border-blue-400 transition cursor-pointer bg-gray-50">
                                <div class="flex flex-col items-center justify-center">
                                    <i data-lucide="cloud" class="w-10 h-10 text-gray-500 mb-2"></i>
                                    <p class="text-sm text-gray-600 mb-1">Klik untuk upload thumbnail</p>
                                    <p class="text-xs text-gray-500">Rekomendasi: Minimal 800x800px, Format JPG/PNG</p>
                                </div>

                                <input type="file" id="thumbnail" name="thumbnail" accept="image/*" class="hidden">
                                <input type="hidden" id="thumbnailData" name="thumbnail_data"
                                    value="{{ old('thumbnail_data') }}">
                            </div>

                            <!-- Crop Modal -->
                            <div id="cropModal"
                                class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4">
                                <div class="bg-white rounded-xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
                                    <div class="flex justify-between items-center p-4 border-b border-gray-200">
                                        <h3 class="text-lg font-semibold text-gray-800">Crop Thumbnail (1:1)</h3>
                                        <button type="button" onclick="closeCropModal()"
                                            class="text-gray-400 hover:text-gray-600">
                                            <i data-lucide="x" class="w-4 h-4 mr-2 text-gray-500 text-xs"></i>
                                        </button>
                                    </div>
                                    <div class="p-4">
                                        <div class="flex flex-col lg:flex-row gap-6">
                                            <div class="lg:w-2/3">
                                                <div id="cropContainer" class="bg-gray-100 rounded-lg overflow-hidden">
                                                    <!-- Cropper akan diinisialisasi di sini -->
                                                </div>
                                            </div>
                                            <div class="lg:w-1/3">
                                                <div class="bg-blue-50 rounded-lg p-4 mb-4">
                                                    <h4 class="font-medium text-blue-800 mb-2">Petunjuk:</h4>
                                                    <ul class="text-sm text-blue-700 space-y-1">
                                                        <li>• Pilih area dengan rasio 1:1</li>
                                                        <li>• Geser dan zoom untuk menyesuaikan</li>
                                                        <li>• Pastikan bagian penting terlihat</li>
                                                    </ul>
                                                </div>
                                                <div class="space-y-3">
                                                    <label class="block text-sm font-medium text-gray-700">Zoom</label>
                                                    <input type="range" id="zoomSlider" min="0.1" max="3" step="0.1"
                                                        value="1" class="w-full">

                                                    <label class="block text-sm font-medium text-gray-700">Rotate</label>
                                                    <input type="range" id="rotateSlider" min="-180" max="180" step="1"
                                                        value="0" class="w-full">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex justify-end gap-3 p-4 border-t border-gray-200">
                                        <button type="button" onclick="closeCropModal()"
                                            class="px-4 py-2 text-gray-600 hover:text-gray-800 transition">
                                            Batal
                                        </button>
                                        <button type="button" onclick="applyCrop()"
                                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center">
                                            <i data-lucide="check" class="w-4 h-4 mr-2 text-white-500 text-xs"></i>
                                            Terapkan Crop
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="toggle-left" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Status Program
                            </label>
                            <select id="status" name="status"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition @error('status') border-red-500 @enderror">
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published
                                </option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Footer Card -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end">
                        <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('createForm').submit(), {
                                title: 'Simpan Program',
                                message: 'Apakah Anda yakin ingin menyimpan program ini?',
                                confirmText: 'Ya, Simpan',
                                confirmColor: 'bg-blue-600 hover:bg-blue-700',
                                confirmIcon: 'check'
                            })" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow font-medium flex items-center">
                            <i data-lucide="check" class="w-4 h-4 mr-2"></i>
                            Simpan Program
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- Include Cropper.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <style>
        .aspect-w-10 {
            position: relative;
        }

        .aspect-w-10::before {
            content: '';
            display: block;
            padding-bottom: 56.25%;
            /* 16:9 Aspect Ratio */
        }

        .aspect-w-10>* {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>

    <script>
        // Variabel global
        let cropper;
        let currentImageFile;

        // Inisialisasi thumbnail jika ada data sebelumnya
        document.addEventListener('DOMContentLoaded', function () {
            @if(old('thumbnail_data'))
                document.getElementById('thumbnailPreview').src = '{{ old('thumbnail_data') }}';
                document.getElementById('thumbnailPreviewContainer').classList.remove('hidden');
                document.getElementById('thumbnailUploadArea').classList.add('hidden');
            @endif
            });

        // Thumbnail Upload Handler
        document.getElementById('thumbnailUploadArea').addEventListener('click', function () {
            document.getElementById('thumbnail').click();
        });

        document.getElementById('thumbnail').addEventListener('change', function (e) {
            if (e.target.files.length > 0) {
                currentImageFile = e.target.files[0];
                openCropModal(currentImageFile);
            }
        });

        // Crop Modal Functions
        function openCropModal(file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('cropContainer').innerHTML = '<img id="imageToCrop" src="' + e.target.result + '">';
                document.getElementById('cropModal').classList.remove('hidden');

                // Initialize cropper
                const image = document.getElementById('imageToCrop');
                cropper = new Cropper(image, {
                    aspectRatio: 1 / 1,
                    viewMode: 2,
                    autoCropArea: 1,
                    responsive: true,
                    guides: true
                });

                // Zoom slider
                document.getElementById('zoomSlider').addEventListener('input', function (e) {
                    cropper.zoomTo(parseFloat(e.target.value));
                });

                // Rotate slider
                document.getElementById('rotateSlider').addEventListener('input', function (e) {
                    cropper.rotateTo(parseInt(e.target.value));
                });
            };
            reader.readAsDataURL(file);
        }

        function closeCropModal() {
            document.getElementById('cropModal').classList.add('hidden');
            if (cropper) {
                cropper.destroy();
            }
        }

        function applyCrop() {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas({
                    width: 800,
                    height: 800,
                    imageSmoothingQuality: 'high'
                });

                // Convert to data URL and display preview
                const croppedImageUrl = canvas.toDataURL('image/jpeg', 0.9);
                document.getElementById('thumbnailPreview').src = croppedImageUrl;
                document.getElementById('thumbnailPreviewContainer').classList.remove('hidden');
                document.getElementById('thumbnailUploadArea').classList.add('hidden');

                // Store cropped image data
                document.getElementById('thumbnailData').value = croppedImageUrl;

                closeCropModal();
            }
        }

        function removeThumbnail() {
            document.getElementById('thumbnailPreviewContainer').classList.add('hidden');
            document.getElementById('thumbnailUploadArea').classList.remove('hidden');
            document.getElementById('thumbnail').value = '';
            document.getElementById('thumbnailData').value = '';
        }

        function submitForm() {
            document.getElementById('programForm').submit();
        }

        // Form validation
        function validateForm() {
            let isValid = true;
            let errorMessages = [];

            // Check title
            const title = document.getElementById('title').value.trim();
            if (!title) {
                isValid = false;
                errorMessages.push('Judul program harus diisi');
            }

            // Check description
            const description = document.getElementById('description').value.trim();
            if (!description) {
                isValid = false;
                errorMessages.push('Deskripsi program harus diisi');
            }

            // Check thumbnail
            const thumbnailData = document.getElementById('thumbnailData').value;
            if (!thumbnailData) {
                isValid = false;
                errorMessages.push('Thumbnail program harus diisi');
            }

            if (!isValid) {
                alert('Mohon lengkapi semua field yang wajib diisi:\n\n' + errorMessages.join('\n'));
            }

            return isValid;
        }
    </script>
@endsection