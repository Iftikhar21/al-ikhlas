@extends('admin.template-admin')
@section('title', 'Edit Footer')

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
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Edit Footer</h2>
                        <p class="text-gray-600">Perbarui informasi footer website</p>
                    </div>
                    <a href="{{ route('admin.footer.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg shadow transition">
                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>

            <form id="updateForm" action="{{ route('admin.footer.update', $footer->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Card Utama -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Header Card -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i data-lucide="settings" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                            Edit Informasi Footer
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

                            @if($footer->logo)
                                <!-- Preview Logo Lama -->
                                <div id="logoPreviewContainer" class="mb-4">
                                    <div class="relative w-full max-w-xl mx-auto">
                                        <div class="aspect-w-10 aspect-h-10 bg-[#166534] rounded-lg overflow-hidden border">
                                            <img id="logoPreview" class="w-24 h-24 object-contain"
                                                src="{{ asset('storage/' . $footer->logo) }}" alt="Logo">
                                        </div>
                                        <button type="button" onclick="removeLogo()"
                                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition">
                                            <i data-lucide="trash" class="w-4 h-4 text-white text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif

                            <!-- Upload Area -->
                            <div id="logoUploadArea"
                                class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition cursor-pointer bg-gray-50 {{ $footer->logo ? 'hidden' : '' }}">

                                <div class="flex flex-col items-center justify-center">
                                    <i data-lucide="cloud" class="w-10 h-10 text-gray-500 mb-2"></i>
                                    <p class="text-sm text-gray-600 mb-1">Klik untuk upload logo</p>
                                    <p class="text-xs text-gray-500">Rekomendasi: Format JPG/PNG</p>
                                </div>

                                <input type="file" id="logo" name="logo" accept="image/*" class="hidden">
                                <input type="hidden" id="logoData" name="logo_data">
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
                                value="{{ old('slogan', $footer->slogan) }}">
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="align-left" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Deskripsi
                            </label>
                            <textarea id="deskripsi" name="deskripsi" rows="3"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition resize-none"
                                placeholder="Tulis deskripsi singkat tentang organisasi...">{{ old('deskripsi', $footer->deskripsi) }}</textarea>
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Alamat
                            </label>
                            <textarea id="alamat" name="alamat" rows="3"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition resize-none"
                                placeholder="Masukkan alamat lengkap...">{{ old('alamat', $footer->alamat) }}</textarea>
                        </div>

                        <!-- Telepon -->
                        <div>
                            <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="phone" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Telepon
                            </label>
                            <input type="text" id="telepon" name="telepon"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition"
                                value="{{ old('telepon', $footer->telepon) }}">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="mail" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Email
                            </label>
                            <input type="email" id="email" name="email"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition"
                                value="{{ old('email', $footer->email) }}">
                        </div>

                        <!-- Maps -->
                        <div>
                            <label for="map_embed" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="map" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Google Maps Embed
                            </label>
                            <textarea id="map_embed" name="map_embed" rows="3"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition resize-none"
                                placeholder="Masukkan kode embed Google Maps...">{{ old('map_embed', $footer->map_embed) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Masukkan <code class="bg-gray-100 px-1 rounded">src</code>
                                embed dari Google Maps</p>
                        </div>

                        <!-- Social Media -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="share-2" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Sosial Media
                            </label>

                            <div id="social-wrapper" class="space-y-3">
                                @foreach($footer->socials as $index => $social)
                                    <div class="flex gap-3 items-center">
                                        <input type="text" name="socials[{{ $index }}][platform]"
                                            value="{{ old("socials.$index.platform", $social->platform) }}"
                                            placeholder="Platform (contoh: instagram)"
                                            class="w-1/3 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition">

                                        <input type="text" name="socials[{{ $index }}][url]"
                                            value="{{ old("socials.$index.url", $social->url) }}"
                                            placeholder="URL (contoh: https://instagram.com/...)"
                                            class="w-2/3 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition">
                                    </div>
                                @endforeach
                            </div>

                            <!-- Tombol tambah sosial media -->
                            <button type="button" id="add-social"
                                class="mt-3 inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow transition">
                                <i data-lucide="plus" class="w-4 h-4"></i>
                                <span>Tambah Sosial Media</span>
                            </button>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end">
                        <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('updateForm').submit(), {
                                                                                        title: 'Update Footer',
                                                                                        message: 'Apakah Anda yakin ingin mengupdate footer ini?',
                                                                                        confirmText: 'Ya, Update',
                                                                                        confirmColor: 'bg-blue-600 hover:bg-blue-700',
                                                                                        confirmIcon: 'check'
                                                                                    })"
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow font-medium flex items-center">
                            <i data-lucide="check" class="w-4 h-4 mr-2"></i>
                            Update Footer
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
        // Logo Upload Handler
        document.getElementById('logoUploadArea').addEventListener('click', function () {
            document.getElementById('logo').click();
        });

        document.getElementById('logo').addEventListener('change', function (e) {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                const reader = new FileReader();

                reader.onload = function (e) {
                    let previewContainer = document.getElementById('logoPreviewContainer');
                    if (!previewContainer) {
                        // Buat container baru jika belum ada
                        previewContainer = document.createElement('div');
                        previewContainer.id = 'logoPreviewContainer';
                        previewContainer.className = 'mb-4';

                        const innerDiv = document.createElement('div');
                        innerDiv.className = 'relative w-full max-w-2xl mx-auto';
                        previewContainer.appendChild(innerDiv);

                        const img = document.createElement('img');
                        img.id = 'logoPreview';
                        img.className = 'w-48 h-48 object-contain rounded-lg border';
                        innerDiv.appendChild(img);

                        const removeBtn = document.createElement('button');
                        removeBtn.type = 'button';
                        removeBtn.onclick = removeLogo;
                        removeBtn.className = 'absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition';
                        removeBtn.innerHTML = `<i data-lucide="trash" class="w-4 h-4 text-white text-xs"></i>`;
                        innerDiv.appendChild(removeBtn);

                        // Masukkan sebelum area upload
                        const uploadArea = document.getElementById('logoUploadArea');
                        uploadArea.parentNode.insertBefore(previewContainer, uploadArea);
                    }

                    // Update image src
                    document.getElementById('logoPreview').src = e.target.result;

                    // Pastikan muncul dan sembunyikan area upload
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
            const wrapper = document.getElementById('social-wrapper');
            const index = wrapper.children.length;

            const div = document.createElement('div');
            div.classList.add('flex', 'gap-3', 'items-center');
            div.innerHTML = `
                    <input type="text" name="socials[${index}][platform]" 
                        placeholder="Platform (contoh: instagram)"
                        class="w-1/3 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition">
                    <input type="text" name="socials[${index}][url]" 
                        placeholder="URL (contoh: https://instagram.com/...)"
                        class="w-2/3 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition">
                `;
            wrapper.appendChild(div);
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
            document.getElementById('updateForm').submit();
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

            if (!isValid) {
                alert('Mohon lengkapi semua field yang wajib diisi:\n\n' + errorMessages.join('\n'));
            }

            return isValid;
        }
    </script>
@endsection