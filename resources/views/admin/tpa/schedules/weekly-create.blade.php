@extends('admin.template-admin')
@section('title', 'Tambah Jadwal Mingguan')
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <div class="max-w-full mx-auto">

            {{-- Alert --}}
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i data-lucide="check-circle" class="w-5 h-5 text-green-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i data-lucide="alert-circle" class="w-5 h-5 text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Header -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Tambah Jadwal Mingguan</h2>
                        <p class="text-gray-600">Tambahkan jadwal aktivitas untuk satu hari</p>
                    </div>
                </div>
            </div>

            <!-- Form Container -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <form action="{{ route('admin.tpa.weekly.store') }}" method="POST">
                    @csrf

                    <!-- Card Form -->
                    <div class="space-y-6">
                        <!-- Pilih Hari -->
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i data-lucide="calendar" class="w-5 h-5 mr-2 text-blue-500"></i>
                                Informasi Hari
                            </h3>
                            <div class="max-w-md">
                                <label for="day" class="block text-sm font-medium text-gray-700 mb-2">Pilih Hari *</label>
                                <select name="day" id="day" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-gray-700">
                                    <option value="">Pilih Hari</option>
                                    <option value="Monday" {{ old('day') == 'Monday' ? 'selected' : '' }}>Senin</option>
                                    <option value="Tuesday" {{ old('day') == 'Tuesday' ? 'selected' : '' }}>Selasa</option>
                                    <option value="Wednesday" {{ old('day') == 'Wednesday' ? 'selected' : '' }}>Rabu</option>
                                    <option value="Thursday" {{ old('day') == 'Thursday' ? 'selected' : '' }}>Kamis</option>
                                    <option value="Friday" {{ old('day') == 'Friday' ? 'selected' : '' }}>Jumat</option>
                                    <option value="Saturday" {{ old('day') == 'Saturday' ? 'selected' : '' }}>Sabtu</option>
                                    <option value="Sunday" {{ old('day') == 'Sunday' ? 'selected' : '' }}>Minggu</option>
                                </select>
                                @error('day')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Daftar Jadwal -->
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                    <i data-lucide="clock" class="w-5 h-5 mr-2 text-green-500"></i>
                                    Jadwal Aktivitas
                                </h3>
                                <button type="button" id="add-row"
                                    class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200 shadow-sm">
                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                    Tambah Baris
                                </button>
                            </div>

                            <div id="schedule-items" class="space-y-4">
                                <!-- Baris Pertama -->
                                <div class="bg-white rounded-lg border border-gray-200 p-4 schedule-row">
                                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                                        <!-- Level Ummi -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Level Ummi *</label>
                                            <select name="items[0][ummi_level_id]" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 text-sm">
                                                <option value="">Pilih Level</option>
                                                @foreach ($levels as $level)
                                                    <option value="{{ $level->id }}" {{ old('items.0.ummi_level_id') == $level->id ? 'selected' : '' }}>
                                                        {{ $level->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('items.0.ummi_level_id')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Waktu Mulai -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Waktu Mulai
                                                *</label>
                                            <input type="time" name="items[0][start_time]" required
                                                value="{{ old('items.0.start_time') }}"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 text-sm">
                                            @error('items.0.start_time')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Waktu Selesai -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Waktu Selesai
                                                *</label>
                                            <input type="time" name="items[0][end_time]" required
                                                value="{{ old('items.0.end_time') }}"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 text-sm">
                                            @error('items.0.end_time')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Aktivitas -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Aktivitas *</label>
                                            <input type="text" name="items[0][activity]"
                                                value="{{ old('items.0.activity') }}" placeholder="Tahsin, Tahfidz, dll."
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 text-sm"
                                                required>
                                            @error('items.0.activity')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Pengajar -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Pengajar *</label>
                                            <select name="items[0][teacher]" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 text-sm">
                                                <option value="">Pilih Pengajar</option>
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}" {{ old('items.0.teacher') == $teacher->id ? 'selected' : '' }}>
                                                        {{ $teacher->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('items.0.teacher')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                            <p class="mt-1 text-xs text-amber-600 flex items-center">
                                                <i data-lucide="alert-circle" class="w-3 h-3 mr-1"></i>
                                                Pengajar yang tampil di pilihan, hanya pengajar yang sudah ditambahkan di menu pengajar
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Text -->
                            <div class="mt-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                                <div class="flex items-start">
                                    <i data-lucide="info" class="w-4 h-4 text-blue-500 mt-0.5 mr-2 flex-shrink-0"></i>
                                    <p class="text-sm text-blue-700">
                                        Tambahkan semua jadwal aktivitas untuk hari yang dipilih. Setiap baris mewakili satu
                                        sesi kegiatan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-3 pt-6 mt-6 border-t border-gray-200">
                        <a href="{{ route('admin.tpa.schedule.index') }}"
                            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200 font-medium flex items-center gap-2">
                            <i data-lucide="arrow-left" class="w-4 h-4"></i>
                            Kembali
                        </a>
                        <button type="submit"
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-200 font-medium flex items-center gap-2 shadow-sm">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            Simpan Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addRowButton = document.getElementById('add-row');
            const scheduleContainer = document.getElementById('schedule-items');
            let rowCount = 1;

            addRowButton.addEventListener('click', function () {
                // Dapatkan baris pertama sebagai template
                const firstRow = scheduleContainer.querySelector('.schedule-row');
                const newRow = firstRow.cloneNode(true);

                // Update semua input dan select di baris baru
                newRow.querySelectorAll('input, select').forEach(input => {
                    // Update name attribute
                    const oldName = input.getAttribute('name');
                    const newName = oldName.replace('[0]', `[${rowCount}]`);
                    input.setAttribute('name', newName);

                    // Clear values
                    if (input.tagName === 'SELECT') {
                        input.selectedIndex = 0;
                        input.classList.remove('border-red-500');
                    } else if (input.tagName === 'INPUT') {
                        input.value = '';
                        input.classList.remove('border-red-500');
                    }

                    // Hapus pesan error jika ada
                    const errorElement = input.parentNode.querySelector('.text-red-600');
                    if (errorElement) {
                        errorElement.remove();
                    }
                });

                // Hapus semua pesan error yang tersisa
                newRow.querySelectorAll('.text-red-600').forEach(error => error.remove());

                // Tambah tombol hapus untuk baris baru (kecuali baris pertama)
                if (rowCount > 0) {
                    const removeButton = document.createElement('button');
                    removeButton.type = 'button';
                    removeButton.className = 'flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded text-sm transition duration-200 mt-4 w-full justify-center';
                    removeButton.innerHTML = '<i data-lucide="trash-2" class="w-4 h-4"></i> Hapus Baris Ini';
                    removeButton.onclick = function () {
                        if (scheduleContainer.querySelectorAll('.schedule-row').length > 1) {
                            newRow.remove();
                        }
                    };

                    newRow.appendChild(removeButton);
                }

                // Tambah baris baru ke container
                scheduleContainer.appendChild(newRow);

                // Initialize Lucide icons untuk elemen baru
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }

                // Increment counter
                rowCount++;

                // Scroll ke baris baru
                newRow.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            });

            // Handle penghapusan baris
            scheduleContainer.addEventListener('click', function (e) {
                if (e.target.closest('button') && e.target.closest('button').textContent.includes('Hapus')) {
                    const rowToRemove = e.target.closest('.schedule-row');
                    const allRows = scheduleContainer.querySelectorAll('.schedule-row');

                    if (rowToRemove && allRows.length > 1) {
                        rowToRemove.remove();
                        // Reindex rows setelah penghapusan
                        reindexRows();
                    }
                }
            });

            function reindexRows() {
                const rows = scheduleContainer.querySelectorAll('.schedule-row');
                rows.forEach((row, index) => {
                    row.querySelectorAll('input, select').forEach(input => {
                        const oldName = input.getAttribute('name');
                        const newName = oldName.replace(/\[\d+\]/, `[${index}]`);
                        input.setAttribute('name', newName);
                    });
                });
                // Update row count
                rowCount = rows.length;
            }
        });
    </script>
@endsection