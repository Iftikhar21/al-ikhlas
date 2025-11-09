@extends('admin.template-admin')
@section('title', 'Edit Pengajar')
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Edit Pengajar</h2>
                        <p class="text-gray-600">Perbarui data pengajar</p>
                    </div>
                    <a href="{{ route('admin.tpa.teachers.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg shadow transition">
                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>

            <!-- Error Alert -->
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i data-lucide="alert-triangle" class="w-5 h-5 text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                Terdapat {{ $errors->count() }} kesalahan dalam pengisian form:
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

            <!-- Form Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <form action="{{ route('admin.tpa.teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
 
                     <!-- Card Header -->
                     <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                         <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                             <i data-lucide="user" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                             Informasi Pengajar
                         </h2>
                     </div>
 
                     <!-- Card Body -->
                     <div class="p-6 space-y-6">
                        <!-- Nama -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="text" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Nama Lengkap
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name', $teacher->name) }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition @error('name') border-red-500 @enderror"
                                placeholder="Masukkan nama lengkap pengajar" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="users" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Jenis Kelamin
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <select id="gender" name="gender"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition @error('gender') border-red-500 @enderror"
                                required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('gender', $teacher->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender', $teacher->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pendidikan Terakhir -->
                        <div>
                            <label for="last_education" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="graduation-cap" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Pendidikan Terakhir
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" id="last_education" name="last_education" 
                                value="{{ old('last_education', $teacher->last_education) }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition @error('last_education') border-red-500 @enderror"
                                placeholder="Contoh: S1 Pendidikan Islam" required>
                            @error('last_education')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="briefcase" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Jabatan
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" id="position" name="position" 
                                value="{{ old('position', $teacher->position) }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition @error('position') border-red-500 @enderror"
                                placeholder="Contoh: Guru Al-Quran" required>
                            @error('position')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No. Telepon -->
                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="phone" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                No. Telepon
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="tel" id="phone_number" name="phone_number" 
                                value="{{ old('phone_number', $teacher->phone_number) }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition @error('phone_number') border-red-500 @enderror"
                                placeholder="Contoh: 08123456789" required>
                            @error('phone_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Alamat
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <textarea id="address" name="address" rows="3"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 transition resize-none @error('address') border-red-500 @enderror"
                                placeholder="Masukkan alamat lengkap" required>{{ old('address', $teacher->address) }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
 
                        <!-- Foto (edit) -->
                        <div>
                            <label for="foto" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="image" class="w-4 h-4 mr-2 text-blue-500 text-xs"></i>
                                Foto Pengajar
                            </label>
 
                            <div class="flex items-start gap-4">
                                <div class="w-28 h-28 bg-gray-50 rounded-lg border border-gray-200 flex items-center justify-center overflow-hidden">
                                    <img id="fotoPreview" src="{{ $teacher->foto ? asset('storage/' . $teacher->foto) : asset('img/placeholder-user.png') }}" alt="Preview" class="w-full h-full object-cover">
                                </div>
 
                                <div class="flex-1">
                                    <input id="foto" type="file" name="foto" accept="image/png,image/jpeg,image/jpg"
                                        class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4
                                               file:rounded-lg file:border-0 file:text-sm file:font-semibold
                                               file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('foto') border-red-500 @enderror">
                                    <p class="mt-2 text-xs text-gray-500">Format: jpg, jpeg, png. Maks 2MB. Kosongkan jika tidak ingin mengganti.</p>
                                    @error('foto')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                     </div>
 
                     <!-- Card Footer -->
                     <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
                        <a href="{{ route('admin.tpa.teachers.index') }}"
                            class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition">
                            <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition">
                            <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                            Simpan Perubahan
                        </button>
                     </div>
                 </form>
             </div>
         </div>
     </main>
 @endsection
 
 <script>
     // Preview foto (edit)
     document.addEventListener('DOMContentLoaded', function () {
         const input = document.getElementById('foto');
         const preview = document.getElementById('fotoPreview');
 
         if (!input) return;
 
         input.addEventListener('change', function (e) {
             const file = e.target.files && e.target.files[0];
             if (!file) {
                 preview.src = "{{ $teacher->foto ? asset('storage/' . $teacher->foto) : asset('img/placeholder-user.png') }}";
                 return;
             }
             if (!file.type.startsWith('image/')) {
                 preview.src = "{{ $teacher->foto ? asset('storage/' . $teacher->foto) : asset('img/placeholder-user.png') }}";
                 return;
             }
             const reader = new FileReader();
             reader.onload = function (ev) {
                 preview.src = ev.target.result;
             };
             reader.readAsDataURL(file);
         });
     });
 </script>