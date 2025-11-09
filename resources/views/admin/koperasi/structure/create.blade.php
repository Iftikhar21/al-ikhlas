@extends('admin.template-admin')
@section('title', 'Tambah Struktur Organisasi Koperasi')
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
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Tambah Struktur Organisasi Koperasi Baru</h2>
                        <p class="text-gray-600">Upload gambar struktur organisasi koperasi Anda</p>
                    </div>
                    <a href="{{ route('admin.koperasi.structure.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg shadow transition">
                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>

            <form id="createForm" action="{{ route('admin.koperasi.structure.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6" id="structureForm">
                @csrf

                <!-- Card Utama -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Header Card -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i data-lucide="info" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                            Informasi Struktur Organisasi
                        </h2>
                    </div>

                    <!-- Body Card -->
                    <div class="p-6 space-y-6">

                        <!-- Gambar dengan Crop -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="camera" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Gambar Struktur Organisasi (Rasio 16:9) (MAX 10MB)
                                <span class="text-red-500 ml-1">*</span>
                            </label>

                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('image_data')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <!-- Preview Gambar -->
                            <div id="imagePreviewContainer" class="{{ old('image_data') ? '' : 'hidden' }} mb-4">
                                <div class="relative w-full max-w-4xl mx-auto">
                                    <div
                                        class="aspect-w-16 aspect-h-9 bg-gray-100 rounded-lg overflow-hidden border-2 {{ $errors->has('image') || $errors->has('image_data') ? 'border-red-500' : 'border-dashed border-gray-300' }}">
                                        <img id="imagePreview" class="w-full h-64 object-contain"
                                            src="{{ old('image_data') ? old('image_data') : '' }}"
                                            alt="Preview gambar struktur">
                                    </div>
                                    <button type="button" onclick="removeImage()"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition">
                                        <i data-lucide="trash" class="w-4 h-4 text-white text-xs"></i>
                                    </button>
                                </div>
                                <p class="text-center text-sm text-gray-500 mt-2">Preview gambar struktur organisasi -
                                    Pastikan gambar sesuai dengan area yang ditampilkan</p>
                            </div>

                            <!-- Upload Area -->
                            <div id="imageUploadArea"
                                class="border-2 border-dashed {{ $errors->has('image') || $errors->has('image_data') ? 'border-red-500' : 'border-gray-300' }} rounded-lg p-6 text-center hover:border-blue-400 transition cursor-pointer bg-gray-50">
                                <div class="flex flex-col items-center justify-center">
                                    <i data-lucide="cloud" class="w-10 h-10 text-gray-500 mb-2"></i>
                                    <p class="text-sm text-gray-600 mb-1">Klik untuk upload gambar struktur organisasi</p>
                                    <p class="text-xs text-gray-500">Rekomendasi: Minimal 800x450px, Format JPG/PNG</p>
                                </div>

                                <input type="file" id="image" name="image" accept="image/*" class="hidden">
                                <input type="hidden" id="imageData" name="image_data" value="{{ old('image_data') }}">
                            </div>

                            <!-- Crop Modal -->
                            <div id="cropModal"
                                class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4">
                                <div class="bg-white rounded-xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
                                    <div class="flex justify-between items-center p-4 border-b border-gray-200">
                                        <h3 class="text-lg font-semibold text-gray-800">Crop Gambar Struktur (16:9)</h3>
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
                                                        <li>• Pilih area dengan rasio 16:9</li>
                                                        <li>• Geser dan zoom untuk menyesuaikan</li>
                                                        <li>• Pastikan seluruh struktur terlihat jelas</li>
                                                        <li>• Teks harus terbaca dengan baik</li>
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
                    </div>

                    <!-- Footer Card -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
                        <a href="{{ route('admin.koperasi.structure.index') }}"
                            class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-lg shadow font-medium flex items-center">
                            <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                            Batal
                        </a>
                        <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('createForm').submit(), {
                                                        title: 'Simpan Struktur Organisasi',
                                                        message: 'Apakah Anda yakin ingin menyimpan struktur organisasi ini?',
                                                        confirmText: 'Ya, Simpan',
                                                        confirmColor: 'bg-blue-600 hover:bg-blue-700',
                                                        confirmIcon: 'check'
                                                    })"
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow font-medium flex items-center">
                            <i data-lucide="check" class="w-4 h-4 mr-2"></i>
                            Simpan Struktur
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

        .support-photo-item {
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        // Variabel global
        let cropper;
        let currentImageFile;

        // Inisialisasi gambar jika ada data sebelumnya
        document.addEventListener('DOMContentLoaded', function () {
            @if(old('image_data'))
                document.getElementById('imagePreview').src = '{{ old('image_data') }}';
                document.getElementById('imagePreviewContainer').classList.remove('hidden');
                document.getElementById('imageUploadArea').classList.add('hidden');
            @endif
            });

        // Gambar Upload Handler
        document.getElementById('imageUploadArea').addEventListener('click', function () {
            document.getElementById('image').click();
        });

        document.getElementById('image').addEventListener('change', function (e) {
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
                    aspectRatio: 16 / 9,
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
                    height: 450,
                    imageSmoothingQuality: 'high'
                });

                // Convert to data URL and display preview
                const croppedImageUrl = canvas.toDataURL('image/jpeg', 0.9);
                document.getElementById('imagePreview').src = croppedImageUrl;
                document.getElementById('imagePreviewContainer').classList.remove('hidden');
                document.getElementById('imageUploadArea').classList.add('hidden');

                // Store cropped image data
                document.getElementById('imageData').value = croppedImageUrl;

                closeCropModal();
            }
        }

        function removeImage() {
            document.getElementById('imagePreviewContainer').classList.add('hidden');
            document.getElementById('imageUploadArea').classList.remove('hidden');
            document.getElementById('image').value = '';
            document.getElementById('imageData').value = '';
        }

        // Form validation
        document.getElementById('structureForm').addEventListener('submit', function (e) {
            let isValid = true;
            let errorMessages = [];

            // Check title
            const title = document.getElementById('title').value.trim();
            if (!title) {
                isValid = false;
                errorMessages.push('Judul struktur organisasi harus diisi');
            }

            // Check image
            const imageData = document.getElementById('imageData').value;
            if (!imageData) {
                isValid = false;
                errorMessages.push('Gambar struktur organisasi harus diisi');
            }

            if (!isValid) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi:\n\n' + errorMessages.join('\n'));
            }
        });

        // Fungsi untuk modal konfirmasi
        function openConfirmModal(modalId, confirmAction, options = {}) {
            // Implementasi modal konfirmasi sesuai dengan sistem yang sudah ada
            if (confirm(options.message || 'Apakah Anda yakin?')) {
                confirmAction();
            }
        }

        // Inisialisasi Lucide icons
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
@endsection