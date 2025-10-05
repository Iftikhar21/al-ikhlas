@extends('template')

@section('content')
    <div class="min-h-screen py-8 px-4">
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header -->
            <div class="bg-green-600 py-6 px-6 text-white">
                <div class="flex items-center justify-center mb-2">
                    <i data-lucide="book-text" class="text-3xl mr-3"></i>
                    <h1 class="text-3xl font-bold">Pendaftaran TPA/TPQ</h1>
                </div>
                <p class="text-center text-green-100">Formulir Pendaftaran Murid Baru</p>
            </div>

            <!-- Form Container -->
            <div class="p-6">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        <div class="flex items-center">
                            <i data-lucide="check" class="mr-2"></i>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <div class="flex items-center">
                            <i data-lucide="circle-alert" class="mr-2"></i>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <div class="flex items-center">
                            <i data-lucide="circle-alert" class="mr-2"></i>
                            Terdapat kesalahan dalam pengisian form. Silakan periksa kembali.
                        </div>
                    </div>
                @endif
                <form id="registrationForm" action="{{ route('register.store') }}" method="POST">
                    @csrf
                    <!-- Data Calon Murid -->
                    <div class="bg-green-50 p-5 rounded-lg border border-green-200">
                        <h2 class="text-xl font-semibold text-green-800 mb-4 flex items-center">
                            <i data-lucide="graduation-cap" class="mr-2"></i>
                            Data Calon Murid
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nama Lengkap -->
                            <div>
                                <label for="fullName" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="fullName" name="fullName"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                    placeholder="Masukkan nama lengkap">
                                <div class="error-message text-red-500 text-sm mt-1" id="fullNameError"></div>
                            </div>

                            <!-- Nomor Telepon/HP Murid -->
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">
                                    Jenis Kelamin <span class="text-red-500">*</span>
                                </label>
                                <select id="gender" name="gender"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <div class="error-message text-red-500 text-sm mt-1" id="genderError"></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <!-- Tempat Lahir -->
                            <div>
                                <label for="birthPlace" class="block text-sm font-medium text-gray-700 mb-1">
                                    Tempat Lahir <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="birthPlace" name="birthPlace"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                    placeholder="Kota kelahiran">
                                <div class="error-message text-red-500 text-sm mt-1" id="birthPlaceError"></div>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div>
                                <label for="birthDate" class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal Lahir <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="birthDate" name="birthDate"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
                                <div class="error-message text-red-500 text-sm mt-1" id="birthDateError"></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <!-- Alamat -->
                            <div class="md:col-span-2">
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                                    Alamat Lengkap <span class="text-red-500">*</span>
                                </label>
                                <textarea id="address" name="address" rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                    placeholder="Alamat tempat tinggal lengkap"></textarea>
                                <div class="error-message text-red-500 text-sm mt-1" id="addressError"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Orang Tua/Wali -->
                    <div class="bg-green-50 p-5 rounded-lg border border-green-200 mt-2">
                        <h2 class="text-xl font-semibold text-green-800 mb-4 flex items-center">
                            <i data-lucide="user" class="mr-2"></i>
                            Data Orang Tua/Wali
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nama Ayah -->
                            <div>
                                <label for="fatherName" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nama Ayah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="fatherName" name="fatherName"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                    placeholder="Nama lengkap ayah">
                                <div class="error-message text-red-500 text-sm mt-1" id="fatherNameError"></div>
                            </div>

                            <!-- Pekerjaan Ayah -->
                            <div>
                                <label for="fatherOccupation" class="block text-sm font-medium text-gray-700 mb-1">
                                    Pekerjaan Ayah
                                </label>
                                <input type="text" id="fatherOccupation" name="fatherOccupation"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                    placeholder="Pekerjaan ayah">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <!-- Nama Ibu -->
                            <div>
                                <label for="motherName" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nama Ibu <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="motherName" name="motherName"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                    placeholder="Nama lengkap ibu">
                                <div class="error-message text-red-500 text-sm mt-1" id="motherNameError"></div>
                            </div>

                            <!-- Pekerjaan Ibu -->
                            <div>
                                <label for="motherOccupation" class="block text-sm font-medium text-gray-700 mb-1">
                                    Pekerjaan Ibu
                                </label>
                                <input type="text" id="motherOccupation" name="motherOccupation"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                    placeholder="Pekerjaan ibu">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <!-- Nomor Telepon Orang Tua -->
                            <div>
                                <label for="parentPhone" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nomor Telepon/HP Orang Tua <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" id="parentPhone" name="parentPhone"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                    placeholder="Contoh: 081234567890">
                                <div class="error-message text-red-500 text-sm mt-1" id="parentPhoneError"></div>
                            </div>

                            <!-- Email Orang Tua -->
                            <div>
                                <label for="parentEmail" class="block text-sm font-medium text-gray-700 mb-1">
                                    Email Orang Tua
                                </label>
                                <input type="email" id="parentEmail" name="parentEmail"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                    placeholder="email@contoh.com">
                                <div class="error-message text-red-500 text-sm mt-1" id="parentEmailError"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Persetujuan -->
                    <div class="bg-yellow-50 p-5 rounded-lg border border-yellow-200 mt-2">
                        <div class="flex items-start">
                            <input type="checkbox" id="agreement" name="agreement"
                                class="mt-1 mr-3 w-5 h-5 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                            <label for="agreement" class="block text-sm text-gray-700">
                                <span class="text-red-500">*</span> Saya menyatakan bahwa data yang diisi adalah benar
                                dan siap mengikuti aturan yang berlaku di TPA/TPQ
                            </label>
                        </div>
                        <div class="error-message text-red-500 text-sm mt-1" id="agreementError"></div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex flex-col sm:flex-row gap-3 justify-end pt-4">
                        <button type="reset"
                            class="px-6 py-3 bg-gray-200 text-gray-800 rounded-lg font-medium hover:bg-gray-300 transition flex items-center justify-center">
                            <i data-lucide="rotate-ccw" class="mr-2"></i> Reset Form
                        </button>
                        <button type="submit"
                            class="px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition flex items-center justify-center">
                            <i data-lucide="send" class="mr-2"></i> Kirim Pendaftaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('registrationForm').addEventListener('submit', function (event) {
            event.preventDefault();

            if (validateForm()) {
                // Jika validasi berhasil, submit form secara normal
                this.submit();
            }
        });

        function validateForm() {
            let isValid = true; // PASTIKAN menggunakan let, bukan const

            // Reset error messages
            document.querySelectorAll('.error-message').forEach(function (element) {
                element.textContent = '';
            });

            // Validasi Nama Lengkap
            const fullName = document.getElementById('fullName').value.trim();
            if (!fullName) {
                document.getElementById('fullNameError').textContent = 'Nama lengkap harus diisi';
                isValid = false;
            }

            // Validasi Jenis Kelamin
            const gender = document.getElementById('gender').value;
            if (!gender) {
                document.getElementById('genderError').textContent = 'Jenis kelamin harus dipilih';
                isValid = false;
            }

            // Validasi Tempat Lahir
            const birthPlace = document.getElementById('birthPlace').value.trim();
            if (!birthPlace) {
                document.getElementById('birthPlaceError').textContent = 'Tempat lahir harus diisi';
                isValid = false;
            }

            // Validasi Tanggal Lahir
            const birthDate = document.getElementById('birthDate').value;
            if (!birthDate) {
                document.getElementById('birthDateError').textContent = 'Tanggal lahir harus diisi';
                isValid = false;
            } else {
                // Validasi usia minimal 4 tahun
                const today = new Date();
                const birthDateObj = new Date(birthDate);
                let age = today.getFullYear() - birthDateObj.getFullYear();
                const monthDiff = today.getMonth() - birthDateObj.getMonth();

                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDateObj.getDate())) {
                    age--;
                }

                if (age < 4) {
                    document.getElementById('birthDateError').textContent = 'Usia minimal 4 tahun untuk mendaftar';
                    isValid = false;
                }
            }

            // Validasi Alamat
            const address = document.getElementById('address').value.trim();
            if (!address) {
                document.getElementById('addressError').textContent = 'Alamat harus diisi';
                isValid = false;
            }

            // Validasi Nama Ayah
            const fatherName = document.getElementById('fatherName').value.trim();
            if (!fatherName) {
                document.getElementById('fatherNameError').textContent = 'Nama ayah harus diisi';
                isValid = false;
            }

            // Validasi Nama Ibu
            const motherName = document.getElementById('motherName').value.trim();
            if (!motherName) {
                document.getElementById('motherNameError').textContent = 'Nama ibu harus diisi';
                isValid = false;
            }

            // Validasi Nomor Telepon Orang Tua
            const parentPhone = document.getElementById('parentPhone').value.trim();
            if (!parentPhone) {
                document.getElementById('parentPhoneError').textContent = 'Nomor telepon orang tua harus diisi';
                isValid = false;
            } else if (!/^[0-9+\-\s()]{10,}$/.test(parentPhone)) {
                document.getElementById('parentPhoneError').textContent = 'Format nomor telepon tidak valid';
                isValid = false;
            }

            // Validasi Email (jika diisi)
            const parentEmail = document.getElementById('parentEmail').value.trim();
            if (parentEmail && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(parentEmail)) {
                document.getElementById('parentEmailError').textContent = 'Format email tidak valid';
                isValid = false;
            }

            // Validasi Persetujuan
            const agreement = document.getElementById('agreement').checked;
            if (!agreement) {
                document.getElementById('agreementError').textContent = 'Anda harus menyetujui pernyataan ini';
                isValid = false;
            }

            return isValid;
        }
    </script>
@endsection