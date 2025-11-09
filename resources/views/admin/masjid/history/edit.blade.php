@extends('admin.template-admin')
@section('title', 'Edit Sejarah Masjid')
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

            <!-- Header -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Edit Sejarah Masjid</h2>
                        <p class="text-gray-600">Perbarui informasi sejarah masjid yang sudah ada</p>
                    </div>
                    <a href="{{ route('admin.masjid.history.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg shadow transition">
                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>

            <form id="updateForm" action="{{ route('admin.masjid.history.update', $history->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Card Utama -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Header Card -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i data-lucide="pencil" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                            Edit Informasi Sejarah
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
                            <input type="text" id="title" name="title"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 transition @error('title') border-red-500 @enderror"
                                value="{{ old('title', $history->title) }}" required
                                placeholder="Masukkan judul sejarah yang menarik...">
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
                            <input type="text" id="subtitle" name="subtitle"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 transition @error('subtitle') border-red-500 @enderror"
                                value="{{ old('subtitle', $history->subtitle) }}"
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
                            </label>

                            @if($history->image)
                                <!-- Preview Gambar Lama -->
                                <div id="imagePreviewContainer" class="mb-4">
                                    <div class="relative w-full max-w-2xl mx-auto">
                                        <div class="aspect-w-16 aspect-h-9 bg-gray-100 rounded-lg overflow-hidden border">
                                            <img id="imagePreview" class="w-full h-48 object-cover"
                                                src="{{ asset('storage/' . $history->image) }}" alt="Gambar Sejarah">
                                        </div>
                                        <button type="button" onclick="removeImage()"
                                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition">
                                            <i data-lucide="trash" class="w-4 h-4 text-white text-xs"></i>
                                        </button>
                                    </div>
                                    <p class="text-center text-sm text-gray-500 mt-2">Gambar saat ini</p>
                                </div>
                            @endif

                            <!-- Upload Area -->
                            <div id="imageUploadArea"
                                class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-green-400 transition cursor-pointer bg-gray-50 {{ $history->image ? 'hidden' : '' }}">

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

                        <!-- Konten Paragraf -->
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
                                @php
                                    // Pisahkan konten menjadi paragraf berdasarkan double newline
                                    $paragraphs = explode("\n\n", $history->content);
                                    // Hilangkan paragraf kosong
                                    $paragraphs = array_filter($paragraphs, function ($para) {
                                        return trim($para) !== '';
                                    });
                                    // Reset index array
                                    $paragraphs = array_values($paragraphs);
                                @endphp

                                @if(count($paragraphs) > 0)
                                    @foreach($paragraphs as $i => $para)
                                        <div
                                            class="paragraph-group border {{ $errors->has('paragraphs.' . $i) ? 'border-red-500' : 'border-gray-200' }} rounded-lg p-4 bg-white">
                                            <div class="flex justify-between items-center mb-3">
                                                <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                                    Paragraf {{ $i + 1 }}
                                                </span>
                                                @if($i > 0)
                                                    <button type="button" onclick="removeParagraph(this)"
                                                        class="bg-red-500 hover:bg-red-700 text-sm text-white px-2 py-1 rounded flex items-center">
                                                        <i data-lucide="trash" class="w-4 h-4 mr-2 text-xs"></i> Hapus
                                                    </button>
                                                @endif
                                            </div>
                                            <textarea name="paragraphs[]" rows="4"
                                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-3 py-2 transition resize-none"
                                                placeholder="Tulis paragraf di sini..." required>{{ trim($para) }}</textarea>
                                            @error('paragraphs.' . $i)
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endforeach
                                @else
                                    <!-- Jika tidak ada paragraf, buat satu paragraf kosong -->
                                    <div class="paragraph-group border border-gray-200 rounded-lg p-4 bg-white">
                                        <div class="flex justify-between items-center mb-3">
                                            <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                                Paragraf 1
                                            </span>
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
                        <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('updateForm').submit(), {
                                    title: 'Update Sejarah',
                                    message: 'Apakah Anda yakin ingin mengupdate sejarah ini?',
                                    confirmText: 'Ya, Update',
                                    confirmColor: 'bg-green-600 hover:bg-green-700',
                                    confirmIcon: 'check'
                                })"
                            class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow font-medium flex items-center">
                            <i data-lucide="check" class="w-4 h-4 mr-2"></i>
                            Update Sejarah
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
    </style>

    <script>
        // Variabel global
        let cropper;
        let currentImageFile;
        let paragraphCount = document.querySelectorAll('.paragraph-group').length;

        // Inisialisasi Lucide icons
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
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

                // Convert ke data URL
                const croppedImageUrl = canvas.toDataURL('image/jpeg', 0.9);

                let previewContainer = document.getElementById('imagePreviewContainer');
                if (!previewContainer) {
                    // Buat container baru jika belum ada
                    previewContainer = document.createElement('div');
                    previewContainer.id = 'imagePreviewContainer';
                    previewContainer.className = 'mb-4';

                    const innerDiv = document.createElement('div');
                    innerDiv.className = 'relative w-full max-w-2xl mx-auto';
                    previewContainer.appendChild(innerDiv);

                    const img = document.createElement('img');
                    img.id = 'imagePreview';
                    img.className = 'w-full h-48 object-cover rounded-lg border';
                    innerDiv.appendChild(img);

                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.onclick = removeImage;
                    removeBtn.className = 'absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition';
                    removeBtn.innerHTML = `<i data-lucide="trash" class="w-4 h-4 text-white text-xs"></i>`;
                    innerDiv.appendChild(removeBtn);

                    // Masukkan sebelum area upload
                    const uploadArea = document.getElementById('imageUploadArea');
                    uploadArea.parentNode.insertBefore(previewContainer, uploadArea);
                }

                // Update image src
                document.getElementById('imagePreview').src = croppedImageUrl;

                // Pastikan muncul dan sembunyikan area upload
                previewContainer.classList.remove('hidden');
                document.getElementById('imageUploadArea').classList.add('hidden');

                // Simpan data base64
                document.getElementById('imageData').value = croppedImageUrl;

                closeCropModal();

                // Refresh Lucide icons
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            }
        }

        function removeImage() {
            document.getElementById('imagePreviewContainer').classList.add('hidden');
            document.getElementById('imageUploadArea').classList.remove('hidden');
            document.getElementById('image').value = '';
            document.getElementById('imageData').value = '';

            // Tambahkan input hidden untuk menandai penghapusan gambar
            const form = document.getElementById('updateForm');
            const deleteInput = document.createElement('input');
            deleteInput.type = 'hidden';
            deleteInput.name = 'delete_image';
            deleteInput.value = '1';
            form.appendChild(deleteInput);
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

            // Refresh Lucide icons untuk icon trash yang baru
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
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

        // Form validation
        document.getElementById('updateForm').addEventListener('submit', function (e) {
            let isValid = true;
            let errorMessages = [];

            // Check title
            const title = document.getElementById('title').value.trim();
            if (!title) {
                isValid = false;
                errorMessages.push('Judul sejarah harus diisi');
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