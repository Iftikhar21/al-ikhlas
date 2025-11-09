@extends('admin.template-admin')
@section('title', 'Tambah Kajian')
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
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Tambah Kajian Baru</h2>
                        <p class="text-gray-600">Buat kajian dengan informasi yang lengkap dan menarik</p>
                    </div>
                    <a href="{{ route('admin.masjid.kajian.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg shadow transition">
                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>

            <form id="createForm" action="{{ route('admin.masjid.kajian.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <!-- Card Utama -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Header Card -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i data-lucide="book-open" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                            Informasi Kajian
                        </h2>
                    </div>

                    <!-- Body Card -->
                    <div class="p-6 space-y-6">
                        <!-- Judul Kajian -->
                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="captions" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                                Judul Kajian
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 transition @error('judul') border-red-500 @enderror"
                                placeholder="Contoh: Kajian Rutin Riyadhus Shalihin" required>
                            @error('judul')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Materi Kajian -->
                        <div>
                            <label for="materi" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="book-text" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                                Materi Kajian
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" id="materi" name="materi" value="{{ old('materi') }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 transition @error('materi') border-red-500 @enderror"
                                placeholder="Contoh: Syarah Hadits Riyadhus Shalihin" required>
                            @error('materi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pembicara -->
                        <div>
                            <label for="pembicara" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="user" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                                Pembicara
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" id="pembicara" name="pembicara" value="{{ old('pembicara') }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 transition @error('pembicara') border-red-500 @enderror"
                                placeholder="Contoh: Ust. Zaky Mubarok, Lc., M.Pd." required>
                            @error('pembicara')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Kajian -->
                        <div>
                            <label for="jenis_kajian"
                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="tag" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                                Jenis Kajian
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <select id="jenis_kajian" name="jenis_kajian"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 transition @error('jenis_kajian') border-red-500 @enderror"
                                required>
                                <option value="">Pilih Jenis Kajian</option>
                                <option value="Mingguan" {{ old('jenis_kajian') == 'Mingguan' ? 'selected' : '' }}>Mingguan
                                </option>
                                <option value="Bulanan" {{ old('jenis_kajian') == 'Bulanan' ? 'selected' : '' }}>Bulanan
                                </option>
                            </select>
                            @error('jenis_kajian')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal -->
                        <div>
                            <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="calendar" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                                Tanggal
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="date" id="tanggal" name="tanggal" 
                                value="{{ old('tanggal') }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 transition @error('tanggal') border-red-500 @enderror"
                                required>
                            @error('tanggal')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Waktu Mulai & Selesai -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="waktu_mulai"
                                    class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                    <i data-lucide="clock" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                                    Waktu Mulai
                                </label>
                                <input type="time" id="waktu_mulai" name="waktu_mulai" value="{{ old('waktu_mulai') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 transition @error('waktu_mulai') border-red-500 @enderror">
                                @error('waktu_mulai')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="waktu_selesai"
                                    class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                    <i data-lucide="clock" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                                    Waktu Selesai
                                </label>
                                <input type="time" id="waktu_selesai" name="waktu_selesai"
                                    value="{{ old('waktu_selesai') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 transition @error('waktu_selesai') border-red-500 @enderror">
                                @error('waktu_selesai')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Lokasi -->
                        <div>
                            <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                                Lokasi
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 transition @error('lokasi') border-red-500 @enderror"
                                placeholder="Contoh: Masjid Al Ikhlas Dalang, Jl. Dalang RT 12/RW 05" required>
                            @error('lokasi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Keterangan -->
                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="info" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                                Keterangan
                            </label>
                            <textarea id="keterangan" name="keterangan" rows="3"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 transition resize-none @error('keterangan') border-red-500 @enderror"
                                placeholder="Contoh: Terbuka untuk Umum, Ikhwan & Akhwat, Gratis">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Poster dengan Crop -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="image" class="w-4 h-4 mr-2 text-green-500 text-xs"></i>
                                Poster Kajian (Rasio 3:4) (MAX 2MB)
                            </label>

                            @error('poster')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('poster_data')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <!-- Preview Poster -->
                            <div id="posterPreviewContainer" class="{{ old('poster_data') ? '' : 'hidden' }} mb-4">
                                <div class="relative w-full max-w-2xl mx-auto">
                                    <div
                                        class="aspect-w-3 aspect-h-4 bg-gray-100 rounded-lg overflow-hidden border-2 {{ $errors->has('poster') || $errors->has('poster_data') ? 'border-red-500' : 'border-dashed border-gray-300' }}">
                                        <img id="posterPreview" class="w-full h-64 object-cover"
                                            src="{{ old('poster_data') ? old('poster_data') : '' }}" alt="Preview poster">
                                    </div>
                                    <button type="button" onclick="removePoster()"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition">
                                        <i data-lucide="trash" class="w-4 h-4 text-white text-xs"></i>
                                    </button>
                                </div>
                                <p class="text-center text-sm text-gray-500 mt-2">Preview poster - Rasio 3:4 (Portrait)</p>
                            </div>

                            <!-- Upload Area -->
                            <div id="posterUploadArea"
                                class="border-2 border-dashed {{ $errors->has('poster') || $errors->has('poster_data') ? 'border-red-500' : 'border-gray-300' }} rounded-lg p-6 text-center hover:border-green-400 transition cursor-pointer bg-gray-50">
                                <div class="flex flex-col items-center justify-center">
                                    <i data-lucide="cloud-upload" class="w-10 h-10 text-gray-500 mb-2"></i>
                                    <p class="text-sm text-gray-600 mb-1">Klik untuk upload poster</p>
                                    <p class="text-xs text-gray-500">Rekomendasi: 600x800px, Format JPG/PNG</p>
                                </div>

                                <input type="file" id="poster" name="poster" accept="image/*" class="hidden">
                                <input type="hidden" id="posterData" name="poster_data" value="{{ old('poster_data') }}">
                            </div>

                            <!-- Crop Modal -->
                            <div id="cropModal"
                                class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4">
                                <div class="bg-white rounded-xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
                                    <div class="flex justify-between items-center p-4 border-b border-gray-200">
                                        <h3 class="text-lg font-semibold text-gray-800">Crop Poster (3:4)</h3>
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
                                                        <li>• Pilih area dengan rasio 3:4</li>
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
                    </div>

                    <!-- Footer Card -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end">
                        <button type="submit"
                            class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow font-medium flex items-center">
                            <i data-lucide="check" class="w-4 h-4 mr-2"></i>
                            Simpan Kajian
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
        .aspect-w-3 {
            position: relative;
        }

        .aspect-w-3::before {
            content: '';
            display: block;
            padding-bottom: 133.33%;
            /* 4:3 Aspect Ratio (inversed for 3:4) */
        }

        .aspect-w-3>* {
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

        // Inisialisasi poster jika ada data sebelumnya
        document.addEventListener('DOMContentLoaded', function () {
            @if(old('poster_data'))
                document.getElementById('posterPreview').src = '{{ old('poster_data') }}';
                document.getElementById('posterPreviewContainer').classList.remove('hidden');
                document.getElementById('posterUploadArea').classList.add('hidden');
            @endif
                });

        // Poster Upload Handler
        document.getElementById('posterUploadArea').addEventListener('click', function () {
            document.getElementById('poster').click();
        });

        document.getElementById('poster').addEventListener('change', function (e) {
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
                    aspectRatio: 3 / 4, // Rasio 3:4 untuk poster portrait
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
                    width: 600,
                    height: 800,
                    imageSmoothingQuality: 'high'
                });

                // Convert to data URL and display preview
                const croppedImageUrl = canvas.toDataURL('image/jpeg', 0.9);
                document.getElementById('posterPreview').src = croppedImageUrl;
                document.getElementById('posterPreviewContainer').classList.remove('hidden');
                document.getElementById('posterUploadArea').classList.add('hidden');

                // Store cropped image data
                document.getElementById('posterData').value = croppedImageUrl;

                closeCropModal();
            }
        }

        function removePoster() {
            document.getElementById('posterPreviewContainer').classList.add('hidden');
            document.getElementById('posterUploadArea').classList.remove('hidden');
            document.getElementById('poster').value = '';
            document.getElementById('posterData').value = '';
        }
    </script>
@endsection