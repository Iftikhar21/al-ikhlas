@extends('admin.template-admin')
@section('title', 'Tambah Footer')

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
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Tambah Footer</h2>
                        <p class="text-gray-600">Buat informasi footer website baru</p>
                    </div>
                    <a href="{{ route('admin.footer.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg shadow transition">
                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>

            <form id="createForm" action="{{ route('admin.footer.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <!-- Card Utama -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Header Card -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i data-lucide="plus-circle" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                            Informasi Footer Baru
                        </h2>
                    </div>

                    <!-- Body Card -->
                    <div class="p-6 space-y-6">
                        <!-- Logo -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="image" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Logo Footer (MAX 10MB)
                            </label>

                            <!-- Upload Area -->
                            <div id="logoUploadArea"
                                class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition cursor-pointer bg-gray-50">

                                <div class="flex flex-col items-center justify-center">
                                    <i data-lucide="cloud" class="w-10 h-10 text-gray-500 mb-2"></i>
                                    <p class="text-sm text-gray-600 mb-1">Klik untuk upload logo</p>
                                    <p class="text-xs text-gray-500">Rekomendasi: Format JPG/PNG</p>
                                </div>

                                <input type="file" id="logo" name="logo" accept="image/*" class="hidden">
                                <input type="hidden" id="logoData" name="logo_data">
                            </div>

                            <!-- Preview Container (akan muncul setelah upload) -->
                            <div id="logoPreviewContainer" class="mb-4 hidden">
                                <div class="relative w-full max-w-2xl mx-auto">
                                    <div class="aspect-w-10 aspect-h-10 bg-gray-100 rounded-lg overflow-hidden border">
                                        <img id="logoPreview" class="w-48 h-48 object-contain" src="" alt="Logo Preview">
                                    </div>
                                    <button type="button" onclick="removeLogo()"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition">
                                        <i data-lucide="trash" class="w-4 h-4 text-white text-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Slogan -->
                        <div>
                            <label for="slogan" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="quote" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Slogan
                            </label>
                            <input type="text" id="slogan" name="slogan"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition"
                                value="{{ old('slogan') }}" placeholder="Masukkan slogan">
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="align-left" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Deskripsi
                            </label>
                            <textarea id="deskripsi" name="deskripsi" rows="3"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition resize-none"
                                placeholder="Tulis deskripsi singkat...">{{ old('deskripsi') }}</textarea>
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Alamat
                            </label>
                            <textarea id="alamat" name="alamat" rows="3"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition resize-none"
                                placeholder="Masukkan alamat lengkap...">{{ old('alamat') }}</textarea>
                        </div>

                        <!-- Telepon -->
                        <div>
                            <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="phone" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Telepon
                            </label>
                            <input type="number" id="telepon" name="telepon"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition"
                                value="{{ old('telepon') }}" placeholder="Masukkan nomor telepon">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="mail" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Email
                            </label>
                            <input type="email" id="email" name="email"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition"
                                value="{{ old('email') }}" placeholder="Masukkan alamat email">
                        </div>

                        <!-- Maps -->
                        <div>
                            <label for="map_embed" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="map" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Google Maps Embed
                            </label>
                            <textarea id="map_embed" name="map_embed" rows="3"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition resize-none"
                                placeholder="Masukkan kode embed Google Maps...">{{ old('map_embed') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Paste langsung link <code
                                    class="bg-gray-100 px-1 rounded">src</code> dari Google Maps</p>
                        </div>

                        <!-- Social Media -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="share-2" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Sosial Media
                            </label>

                            <div id="socials-wrapper" class="space-y-3">
                                <div class="flex gap-3 items-center">
                                    <input type="text" name="socials[0][platform]" value="{{ old('socials.0.platform') }}"
                                        placeholder="Platform (contoh: instagram, facebook)"
                                        class="w-1/3 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition">
                                    <input type="url" name="socials[0][url]" value="{{ old('socials.0.url') }}"
                                        placeholder="URL Profil (contoh: https://instagram.com/...)"
                                        class="w-2/3 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition">
                                </div>
                            </div>

                            <!-- Tombol tambah sosial media -->
                            <button type="button" id="add-social"
                                class="mt-3 inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow transition">
                                <i data-lucide="plus" class="w-4 h-4"></i>
                                <span>Tambah Sosial Media</span>
                            </button>
                        </div>
                    </div>

                    <!-- Footer Card -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end">
                        <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('createForm').submit(), {
                                                                                                            title: 'Simpan Footer',
                                                                                                            message: 'Apakah Anda yakin ingin menyimpan footer ini?',
                                                                                                            confirmText: 'Ya, Simpan',
                                                                                                            confirmColor: 'bg-green-600 hover:bg-green-700',
                                                                                                            confirmIcon: 'check'
                                                                                                        })"
                            class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow font-medium flex items-center">
                            <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                            Simpan Footer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <style>
        .aspect-w-10 {
            position: relative;
        }

        .aspect-w-10::before {
            content: '';
            display: block;
            padding-bottom: 100%;
            /* 1:1 Aspect Ratio */
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
        let socialIndex = 1;

        // Logo Upload Handler
        document.getElementById('logoUploadArea').addEventListener('click', function () {
            document.getElementById('logo').click();
        });

        document.getElementById('logo').addEventListener('change', function (e) {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                const reader = new FileReader();

                reader.onload = function (e) {
                    const previewContainer = document.getElementById('logoPreviewContainer');
                    const logoPreview = document.getElementById('logoPreview');

                    // Update image src
                    logoPreview.src = e.target.result;

                    // Tampilkan preview dan sembunyikan area upload
                    previewContainer.classList.remove('hidden');
                    document.getElementById('logoUploadArea').classList.add('hidden');

                    // Simpan data base64
                    document.getElementById('logoData').value = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        function removeLogo() {
            document.getElementById('logoPreviewContainer').classList.add('hidden');
            document.getElementById('logoUploadArea').classList.remove('hidden');
            document.getElementById('logo').value = '';
            document.getElementById('logoData').value = '';
        }

        // Social Media Handler
        document.getElementById('add-social').addEventListener('click', function () {
            const wrapper = document.getElementById('socials-wrapper');
            const div = document.createElement('div');
            div.classList.add('flex', 'gap-3', 'items-center');
            div.innerHTML = `
                    <input type="text" name="socials[${socialIndex}][platform]" 
                        placeholder="Platform (contoh: instagram, facebook)"
                        class="w-1/3 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition">
                    <input type="url" name="socials[${socialIndex}][url]" 
                        placeholder="URL Profil (contoh: https://instagram.com/...)"
                        class="w-2/3 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition">
                `;
            wrapper.appendChild(div);
            socialIndex++;
        });

        // Confirm Modal Functions
        function openConfirmModal() {
            // Validasi form sebelum menampilkan modal konfirmasi
            if (validateForm()) {
                document.getElementById('confirmModal').classList.remove('hidden');
            }
        }

        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }

        function submitForm() {
            document.getElementById('createForm').submit();
        }

        // Form validation
        function validateForm() {
            let isValid = true;
            let errorMessages = [];

            // Check required fields
            const requiredFields = [
                { id: 'slogan', name: 'Slogan' },
                { id: 'deskripsi', name: 'Deskripsi' },
                { id: 'alamat', name: 'Alamat' },
                { id: 'telepon', name: 'Telepon' },
                { id: 'email', name: 'Email' }
            ];

            requiredFields.forEach(field => {
                const value = document.getElementById(field.id).value.trim();
                if (!value) {
                    isValid = false;
                    errorMessages.push(`${field.name} harus diisi`);
                }
            });

            // Validate email format
            const email = document.getElementById('email').value.trim();
            if (email && !/^\S+@\S+\.\S+$/.test(email)) {
                isValid = false;
                errorMessages.push('Format email tidak valid');
            }

            // Validate social media (minimal satu harus terisi)
            const socialPlatforms = document.querySelectorAll('input[name^="socials"][name$="[platform]"]');
            const socialUrls = document.querySelectorAll('input[name^="socials"][name$="[url]"]');

            let hasSocialMedia = false;
            for (let i = 0; i < socialPlatforms.length; i++) {
                if (socialPlatforms[i].value.trim() || socialUrls[i].value.trim()) {
                    hasSocialMedia = true;
                    break;
                }
            }

            if (!hasSocialMedia) {
                isValid = false;
                errorMessages.push('Minimal satu sosial media harus diisi');
            }

            if (!isValid) {
                alert('Mohon lengkapi semua field yang wajib diisi:\n\n' + errorMessages.join('\n'));
            }

            return isValid;
        }
    </script>
@endsection