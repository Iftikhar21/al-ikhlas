@extends('admin.template-admin')
@section('title', 'Edit Berita')
@section('content')
                    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
                        <div class="max-w-full mx-auto">
                            <!-- Header -->
                            <div class="bg-white rounded-lg shadow-sm p-6 mb-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Edit Berita</h2>
                                        <p class="text-gray-600">Perbarui informasi berita yang sudah ada</p>
                                    </div>
                                    <a href="{{ route('admin.news.index') }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg shadow transition">
                                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                                        <span>Kembali</span>
                                    </a>
                                </div>
                            </div>
                            <form id="updateForm" action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data"
                                class="space-y-6">
                                @csrf @method('PUT')

                                <!-- Card Utama -->
                                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                    <!-- Header Card -->
                                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                                            <i data-lucide="pencil" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                            Edit Informasi Berita
                                        </h2>
                                    </div>

                                    <!-- Body Card -->
                                    <div class="p-6 space-y-6">
                                        <!-- Judul -->
                                        <div>
                                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                <i data-lucide="captions" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                                Judul Berita
                                            </label>
                                            <input type="text" id="title" name="title"
                                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition"
                                                value="{{ old('title', $news->title) }}" required>
                                        </div>

                                        <!-- Thumbnail -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                <i data-lucide="camera" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                                Thumbnail Berita (Rasio 16:9) (MAX 10MB)
                                            </label>

                                            @if($news->thumbnail)
                                                <!-- Preview Thumbnail Lama -->
                                                <div id="thumbnailPreviewContainer" class="mb-4">
                                                    <div class="relative w-full max-w-2xl mx-auto">
                                                        <div class="aspect-w-16 aspect-h-9 bg-gray-100 rounded-lg overflow-hidden border">
                                                            <img id="thumbnailPreview" class="w-full h-48 object-cover"
                                                                src="{{ asset('storage/' . $news->thumbnail) }}" alt="Thumbnail">
                                                        </div>
                                                        <button type="button" onclick="removeThumbnail()"
                                                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition">
                                                            <i data-lucide="trash" class="w-4 h-4 text-white text-xs"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Upload Area -->
                                            <div id="thumbnailUploadArea"
                                                class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition cursor-pointer bg-gray-50 {{ $news->thumbnail ? 'hidden' : '' }}">

                                                <div class="flex flex-col items-center justify-center">
                                                    <i data-lucide="cloud" class="w-10 h-10 text-gray-500 mb-2"></i>
                                                    <p class="text-sm text-gray-600 mb-1">Klik untuk upload thumbnail</p>
                                                    <p class="text-xs text-gray-500">Rekomendasi: Minimal 800x450px, Format JPG/PNG</p>
                                                </div>

                                                <input type="file" id="thumbnail" name="thumbnail" accept="image/*" class="hidden">
                                                <input type="hidden" id="thumbnailData" name="thumbnail_data">
                                            </div>

                                            <div id="cropModal"
                                                class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4">
                                                <div class="bg-white rounded-xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
                                                    <div class="flex justify-between items-center p-4 border-b border-gray-200">
                                                        <h3 class="text-lg font-semibold text-gray-800">Crop Thumbnail (16:9)</h3>
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

                                        <!-- Konten Paragraf -->
                                        <div>
                                            <div class="flex justify-between items-center mb-2">
                                                <label class="block text-sm font-medium text-gray-700 flex items-center">
                                                    <i data-lucide="text-align-start" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                                    Konten Berita
                                                </label>
                                                <button type="button" onclick="addParagraph()"
                                                    class="text-sm bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition flex items-center">
                                                    <i data-lucide="plus" class="w-4 h-4 mr-2 text-xs"></i>
                                                    Tambah Paragraf
                                                </button>
                                            </div>

                                            <div id="paragraphsContainer" class="space-y-4">
                                                @php
    $paragraphs = explode("\n\n", $news->content);
                                                @endphp
                                                @foreach($paragraphs as $i => $para)
                                                    <div class="paragraph-group border border-gray-200 rounded-lg p-4 bg-white">
                                                        <div class="flex justify-between items-center mb-3">
                                                            <span
                                                                class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">Paragraf
                                                                {{ $i + 1 }}</span>
                                                            <button type="button" onclick="removeParagraph(this)"
                                                                class="text-white bg-red-500 hover:bg-red-600 py-1 px-2 rounded text-sm flex items-center cursor-pointer">
                                                                <i data-lucide="trash" class="w-4 h-4 mr-2 text-xs"></i> Hapus
                                                            </button>
                                                        </div>
                                                        <textarea name="paragraphs[]" rows="4"
                                                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2 transition resize-none"
                                                            placeholder="Tulis paragraf di sini...">{{ $para }}</textarea>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <!-- Foto Pendukung -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                <i data-lucide="camera" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                                Foto Pendukung
                                            </label>

                                            <div id="supportPhotosContainer" class="space-y-4">
                                                @foreach($news->photos as $i => $photo)
                                                    <div class="support-photo-item border border-gray-200 rounded-lg p-4 bg-white">
                                                        <div class="flex justify-between items-center mb-3">
                                                            <span class="text-sm font-medium text-gray-700">Foto Pendukung {{ $i + 1 }}</span>
                                                            <button type="button" onclick="markDeletePhoto({{ $photo->id }}, this)"
                                                                class="text-white bg-red-500 hover:bg-red-600 py-1 px-2 rounded text-sm flex items-center cursor-pointer">
                                                                <i data-lucide="trash" class="w-4 h-4 mr-2 text-xs"></i> Hapus
                                                            </button>
                                                        </div>
                                                        <div class="flex gap-4">
                                                            <div class="flex-1">
                                                                <img src="{{ asset('storage/' . $photo->path) }}"
                                                                    class="w-full h-32 object-cover rounded-lg border">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <button type="button" onclick="addSupportPhoto()"
                                                class="mt-3 w-full border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-400 transition bg-gray-50">
                                                <div class="text-center">
                                                    <!-- icon + teks sejajar -->
                                                    <div class="flex items-center justify-center mb-1">
                                                        <i data-lucide="plus" class="w-5 h-5 mr-2 text-blue-500"></i>
                                                        <span class="text-blue-600 font-medium">Tambah Foto Pendukung</span>
                                                    </div>

                                                    <!-- teks kecil di bawah -->
                                                    <p class="text-xs text-gray-500">Upload foto tambahan untuk melengkapi berita</p>
                                                </div>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Footer Card -->
                                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end">
                                        <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('updateForm').submit(), {
                                                title: 'Update Berita',
                                                message: 'Apakah Anda yakin ingin mengupdate berita ini?',
                                                confirmText: 'Ya, Update',
                                                confirmColor: 'bg-blue-600 hover:bg-blue-700',
                                                confirmIcon: 'check'
                                            })" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow font-medium flex items-center">
                                            <i data-lucide="check" class="w-4 h-4 mr-2"></i>
                                            Update Berita
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
                            border-color: #3b82f6;
                            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.1);
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
                        let paragraphCount = document.querySelectorAll('.paragraph-group').length;


                        function markDeletePhoto(photoId, button) {
                            // tambahin input hidden ke form
                            const form = button.closest('form');
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'delete_photos[]';
                            input.value = photoId;
                            form.appendChild(input);

                            // sembunyikan item dari UI
                            const photoItem = button.closest('.support-photo-item');
                            photoItem.style.opacity = "0.5";
                            photoItem.style.pointerEvents = "none";
                        }
                    </script>

                    <script>
                        // Variabel global
                        let cropper;
                        let currentImageFile;
                        let supportPhotoCount = 0;

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

                                    // Convert ke data URL
                                    const croppedImageUrl = canvas.toDataURL('image/jpeg', 0.9);

                                    let previewContainer = document.getElementById('thumbnailPreviewContainer');
                                    if (!previewContainer) {
                                        // Buat container baru jika belum ada
                                        previewContainer = document.createElement('div');
                                        previewContainer.id = 'thumbnailPreviewContainer';
                                        previewContainer.className = 'mb-4';

                                        const innerDiv = document.createElement('div');
                                        innerDiv.className = 'relative w-full max-w-2xl mx-auto';
                                        previewContainer.appendChild(innerDiv);

                                        const img = document.createElement('img');
                                        img.id = 'thumbnailPreview';
                                        img.className = 'w-full h-48 object-cover rounded-lg border';
                                        innerDiv.appendChild(img);

                                        const removeBtn = document.createElement('button');
                                        removeBtn.type = 'button';
                                        removeBtn.onclick = removeThumbnail;
                                        removeBtn.className = 'absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition';
                                        removeBtn.innerHTML = `<i data-lucide="trash" class="w-4 h-4 text-white text-xs"></i>`;
                                        innerDiv.appendChild(removeBtn);

                                        // Masukkan sebelum area upload
                                        const uploadArea = document.getElementById('thumbnailUploadArea');
                                        uploadArea.parentNode.insertBefore(previewContainer, uploadArea);
                                    }

                                    // Update image src
                                    document.getElementById('thumbnailPreview').src = croppedImageUrl;

                                    // Pastikan muncul dan sembunyikan area upload
                                    previewContainer.classList.remove('hidden');
                                    document.getElementById('thumbnailUploadArea').classList.add('hidden');

                                    // Simpan data base64
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

                        // Paragraph Management
                        function addParagraph() {
                            paragraphCount++;
                            const container = document.getElementById('paragraphsContainer');
                            const newParagraph = document.createElement('div');
                            newParagraph.className = 'paragraph-group border border-gray-200 rounded-lg p-4 bg-white';
                            newParagraph.innerHTML = `
                                                                                                                                                                                                <div class="flex justify-between items-center mb-3">
                                                                                                                                                                                                    <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">Paragraf ${paragraphCount}</span>
                                                                                                                                                                                                    <button type="button" onclick="removeParagraph(this)" class="text-red-500 hover:text-red-700 text-sm flex items-center">
                                                                                                                                                                                                        Hapus
                                                                                                                                                                                                    </button>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                <textarea name="paragraphs[]" rows="4" 
                                                                                                                                                                                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2 transition resize-none"
                                                                                                                                                                                                    placeholder="Tulis paragraf di sini..."></textarea>
                                                                                                                                                                                            `;
                            container.appendChild(newParagraph);
                        }

                        function removeParagraph(button) {
                            const paragraphGroup = button.closest('.paragraph-group');
                            paragraphGroup.remove(); // beneran ilang dari DOM
                            updateParagraphNumbers();
                        }

                        function updateParagraphNumbers() {
                            const paragraphs = document.querySelectorAll('.paragraph-group');
                            paragraphs.forEach((paragraph, index) => {
                                const span = paragraph.querySelector('span');
                                span.textContent = `Paragraf ${index + 1}`;
                            });
                            paragraphCount = paragraphs.length;
                        }

                        function triggerParagraphImage(button) {
                            const input = button.previousElementSibling;
                            input.click();
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
                                                                                                                                                                                                    <button type="button" onclick="removeSupportPhoto(this)" class="text-red-500 hover:text-red-700 text-sm flex items-center">
                                                                                                                                                                                                        Hapus
                                                                                                                                                                                                    </button>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                <div class="flex flex-col sm:flex-row gap-4">
                                                                                                                                                                                                    <div class="flex-1">
                                                                                                                                                                                                        <input type="file" name="support_photos[]" accept="image/*" class="support-photo-input hidden" onchange="previewSupportPhoto(this)">
                                                                                                                                                                                                        <button type="button" onclick="triggerSupportPhoto(this)" 
                                                                                                                                                                                                            class="w-full h-32 border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center text-gray-600 hover:border-blue-400 hover:text-blue-600 transition">
                                                                                                                                                                                                            <span class="text-sm">Pilih Foto</span>
                                                                                                                                                                                                        </button>
                                                                                                                                                                                                    </div>
                                                                                                                                                                                                    <div class="support-photo-preview hidden flex-1">
                                                                                                                                                                                                    </div>
                                                                                                                                                                                                </div>
                                                                                                                                                                                            `;
                            container.appendChild(newPhoto);
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
                                                                                                                                                                                                                Hapus
                                                                                                                                                                                                            </button>
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                    `;
                                    previewContainer.classList.remove('hidden');
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
                    </script>

@endsection