@extends('admin.template-admin')
@section('title', 'Tambah Sejarah')
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
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Tambah Sejarah Baru</h2>
                        <p class="text-gray-600">Buat konten sejarah dengan informasi yang akurat dan terstruktur</p>
                    </div>
                    <a href="{{ route('admin.history.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg shadow transition">
                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>

            <form id="createForm" action="{{ route('admin.history.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6" id="historyForm">
                @csrf

                <!-- Card Utama -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Header Card -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i data-lucide="info" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                            Informasi Sejarah
                        </h2>
                    </div>

                    <!-- Body Card -->
                    <div class="p-6 space-y-6">
                        <!-- Judul -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="captions" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                                Judul Sejarah
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 transition @error('title') border-red-500 @enderror"
                                placeholder="Masukkan judul sejarah yang menarik..." required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subjudul -->
                        <div>
                            <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="subtitles" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                                Subjudul Sejarah
                            </label>
                            <input type="text" id="subtitle" name="subtitle" value="{{ old('subtitle') }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 transition @error('subtitle') border-red-500 @enderror"
                                placeholder="Masukkan subjudul sejarah (opsional)...">
                            @error('subtitle')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gambar dengan Crop -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="camera" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                                Gambar Sejarah (Rasio 16:9) (MAX 10MB)
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
                                <div class="relative w-full max-w-2xl mx-auto">
                                    <div
                                        class="aspect-w-16 aspect-h-9 bg-gray-100 rounded-lg overflow-hidden border-2 {{ $errors->has('image') || $errors->has('image_data') ? 'border-red-500' : 'border-dashed border-gray-300' }}">
                                        <img id="imagePreview" class="w-full h-48 object-cover"
                                            src="{{ old('image_data') ? old('image_data') : '' }}" alt="Preview gambar">
                                    </div>
                                    <button type="button" onclick="removeImage()"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition">
                                        <i data-lucide="trash" class="w-4 h-4 text-white text-xs"></i>
                                    </button>
                                </div>
                                <p class="text-center text-sm text-gray-500 mt-2">Preview gambar - Pastikan gambar sesuai
                                    dengan area yang ditampilkan</p>
                            </div>

                            <!-- Upload Area -->
                            <div id="imageUploadArea"
                                class="border-2 border-dashed {{ $errors->has('image') || $errors->has('image_data') ? 'border-red-500' : 'border-gray-300' }} rounded-lg p-6 text-center hover:border-green-400 transition cursor-pointer bg-gray-50">
                                <div class="flex flex-col items-center justify-center">
                                    <i data-lucide="cloud" class="w-10 h-10 text-gray-500 mb-2"></i>
                                    <p class="text-sm text-gray-600 mb-1">Klik untuk upload gambar</p>
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
                                        <h3 class="text-lg font-semibold text-gray-800">Crop Gambar (16:9)</h3>
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
                                                <div class="bg-green-50 rounded-lg p-4 mb-4">
                                                    <h4 class="font-medium text-green-800 mb-2">Petunjuk:</h4>
                                                    <ul class="text-sm text-green-700 space-y-1">
                                                        <li>• Pilih area dengan rasio 16:9</li>
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
                                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center">
                                            <i data-lucide="check" class="w-4 h-4 mr-2 text-white-500 text-xs"></i>
                                            Terapkan Crop
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Konten Sejarah dengan Paragraf -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label class="block text-sm font-medium text-gray-700 flex items-center">
                                    <i data-lucide="text-align-start" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                                    Konten Sejarah
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <button type="button" onclick="addParagraph()"
                                    class="text-sm bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition flex items-center">
                                    <i data-lucide="plus" class="w-4 h-4 mr-2 text-xs"></i>
                                    Tambah Paragraf
                                </button>
                            </div>

                            @error('paragraphs')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('paragraphs.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <div id="paragraphsContainer" class="space-y-4">
                                <!-- Paragraf pertama -->
                                @if(old('paragraphs') && count(old('paragraphs')) > 0)
                                    @foreach(old('paragraphs') as $index => $paragraph)
                                        <div
                                            class="paragraph-group border {{ $errors->has('paragraphs.' . $index) ? 'border-red-500' : 'border-gray-200' }} rounded-lg p-4 bg-white">
                                            <div class="flex justify-between items-center mb-3">
                                                <span
                                                    class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">Paragraf
                                                    {{ $index + 1 }}</span>
                                                @if($index > 0)
                                                    <button type="button" onclick="removeParagraph(this)"
                                                        class="bg-red-500 hover:bg-red-700 text-sm text-white px-2 py-1 rounded flex items-center">
                                                        <i data-lucide="trash" class="w-4 h-4 mr-2 text-xs"></i> Hapus
                                                    </button>
                                                @endif
                                            </div>
                                            <textarea name="paragraphs[]" rows="4"
                                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-3 py-2 transition resize-none"
                                                placeholder="Tulis paragraf di sini..." required>{{ $paragraph }}</textarea>
                                            @error('paragraphs.' . $index)
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endforeach
                                @else
                                    <div class="paragraph-group border border-gray-200 rounded-lg p-4 bg-white">
                                        <div class="flex justify-between items-center mb-3">
                                            <span
                                                class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">Paragraf
                                                1</span>
                                        </div>
                                        <textarea name="paragraphs[]" rows="4"
                                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-3 py-2 transition resize-none"
                                            placeholder="Tulis paragraf di sini..." required></textarea>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Footer Card -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end">
                        <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('createForm').submit(), {
                                                    title: 'Simpan Sejarah',
                                                    message: 'Apakah Anda yakin ingin menyimpan sejarah ini?',
                                                    confirmText: 'Ya, Simpan',
                                                    confirmColor: 'bg-green-600 hover:bg-green-700',
                                                    confirmIcon: 'check'
                                                })"
                            class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow font-medium flex items-center">
                            <i data-lucide="check" class="w-4 h-4 mr-2"></i>
                            Simpan Sejarah
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

        .paragraph-group {
            transition: all 0.3s ease;
        }

        .paragraph-group:hover {
            border-color: #10b981;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.1);
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
        let paragraphCount = {{ old('paragraphs') ? count(old('paragraphs')) : 1 }};
        let supportPhotoCount = {{ old('support_photos') ? count(old('support_photos')) : 0 }};

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

        // Paragraph Management
        function addParagraph() {
            paragraphCount++;
            const container = document.getElementById('paragraphsContainer');
            const newParagraph = document.createElement('div');
            newParagraph.className = 'paragraph-group border border-gray-200 rounded-lg p-4 bg-white';
            newParagraph.innerHTML = `
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">Paragraf ${paragraphCount}</span>
                        <button type="button" onclick="removeParagraph(this)"
                            class="bg-red-500 hover:bg-red-700 text-sm text-white px-2 py-1 rounded flex items-center">
                            <i data-lucide="trash" class="w-4 h-4 mr-2 text-xs"></i> Hapus
                        </button>
                    </div>
                    <textarea name="paragraphs[]" rows="4" 
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-3 py-2 transition resize-none"
                        placeholder="Tulis paragraf di sini..." required></textarea>
                `;
            container.appendChild(newParagraph);
            lucide.replace();
        }

        function removeParagraph(button) {
            if (paragraphCount > 1) {
                const paragraphGroup = button.closest('.paragraph-group');
                paragraphGroup.style.opacity = '0';
                paragraphGroup.style.transform = 'translateX(-20px)';
                setTimeout(() => {
                    paragraphGroup.remove();
                    paragraphCount--;
                    // Update paragraph numbers
                    updateParagraphNumbers();
                }, 300);
            }
        }

        function updateParagraphNumbers() {
            const paragraphs = document.querySelectorAll('.paragraph-group');
            paragraphs.forEach((paragraph, index) => {
                const span = paragraph.querySelector('span');
                span.textContent = `Paragraf ${index + 1}`;
            });
            paragraphCount = paragraphs.length;
        }

        // Support Photos Management
        function addSupportPhoto() {
            supportPhotoCount++;
            const container = document.getElementById('supportPhotosContainer');
            const newPhoto = document.createElement('div');
            newPhoto.className = 'support-photo-item border border-gray-200 rounded-lg p-4 bg-white';
            newPhoto.innerHTML = `
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-sm font-medium text-gray-700">Foto Pendukung ${supportPhotoCount}</span>
                        <button type="button" onclick="removeSupportPhoto(this)"
                            class="text-white px-2 py-1 rounded bg-red-500 hover:bg-red-700 text-sm flex items-center">
                            <i data-lucide="trash" class="w-4 h-4 text-white text-xs"></i>
                            Hapus
                        </button>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <input type="file" name="support_photos[]" accept="image/*" class="support-photo-input hidden" onchange="previewSupportPhoto(this)">
                            <button type="button" onclick="triggerSupportPhoto(this)"
                                class="w-full h-32 border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center text-gray-600 hover:border-green-400 hover:text-green-600 transition">
                                <i data-lucide="cloud" class="w-10 h-10 text-gray-500 mb-2"></i>
                                <span class="text-sm">Pilih Foto</span>
                            </button>
                        </div>
                        <div class="support-photo-preview hidden flex-1">
                        </div>
                    </div>
                `;
            container.appendChild(newPhoto);
            lucide.replace();
        }

        function removeSupportPhoto(button) {
            const photoItem = button.closest('.support-photo-item');
            photoItem.style.opacity = '0';
            photoItem.style.transform = 'translateX(-20px)';
            setTimeout(() => {
                photoItem.remove();
                supportPhotoCount--;
                // Update photo numbers
                updateSupportPhotoNumbers();
            }, 300);
        }

        function updateSupportPhotoNumbers() {
            const photos = document.querySelectorAll('.support-photo-item');
            photos.forEach((photo, index) => {
                const span = photo.querySelector('span');
                span.textContent = `Foto Pendukung ${index + 1}`;
            });
            supportPhotoCount = photos.length;
        }

        function triggerSupportPhoto(button) {
            const input = button.previousElementSibling;
            input.click();
        }

        function previewSupportPhoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewContainer = input.closest('.flex').querySelector('.support-photo-preview');
                    previewContainer.innerHTML = `
                            <div class="relative">
                                <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg border border-gray-200">
                                <button type="button" onclick="removeSupportPhotoPreview(this)" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition">
                                    <i data-lucide="x" class="w-4 h-4 text-white text-xs"></i>
                                </button>
                            </div>
                        `;
                    previewContainer.classList.remove('hidden');
                    lucide.replace();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeSupportPhotoPreview(button) {
            const previewContainer = button.closest('.support-photo-preview');
            const input = previewContainer.previousElementSibling.querySelector('.support-photo-input');
            input.value = '';
            previewContainer.classList.add('hidden');
            previewContainer.innerHTML = '';
        }

        // Form validation
        document.getElementById('historyForm').addEventListener('submit', function (e) {
            let isValid = true;
            let errorMessages = [];

            // Check title
            const title = document.getElementById('title').value.trim();
            if (!title) {
                isValid = false;
                errorMessages.push('Judul sejarah harus diisi');
            }

            // Check image
            const imageData = document.getElementById('imageData').value;
            if (!imageData) {
                isValid = false;
                errorMessages.push('Gambar sejarah harus diisi');
            }

            // Check paragraphs
            const paragraphs = document.querySelectorAll('textarea[name="paragraphs[]"]');
            let hasParagraphContent = false;
            paragraphs.forEach(textarea => {
                if (textarea.value.trim()) {
                    hasParagraphContent = true;
                }
            });

            if (!hasParagraphContent) {
                isValid = false;
                errorMessages.push('Minimal satu paragraf harus diisi');
            }

            if (!isValid) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi:\n\n' + errorMessages.join('\n'));
            }
        });
    </script>
@endsection