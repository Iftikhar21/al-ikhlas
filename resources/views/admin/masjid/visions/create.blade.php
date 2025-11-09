@extends('admin.template-admin')
@section('title', isset($vision) ? 'Edit Visi & Misi Masjid' : 'Tambah Visi & Misi Masjid Baru')
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
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">
                            {{ isset($vision) ? 'Edit Visi & Misi Masjid' : 'Tambah Visi & Misi Masjid Baru' }}
                        </h2>
                        <p class="text-gray-600">
                            {{ isset($vision) ? 'Perbarui informasi visi dan misi masjid yang sudah ada' : 'Buat visi dan misi masjid dengan informasi yang jelas dan terstruktur' }}
                        </p>
                    </div>
                    <a href="{{ route('admin.masjid.visions.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg shadow transition">
                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>

            <form id="visionForm" method="POST"
                action="{{ isset($vision) ? route('admin.masjid.visions.update', $vision->id) : route('admin.masjid.visions.store') }}"
                class="space-y-6">
                @csrf
                @if(isset($vision))
                    @method('PUT')
                @endif

                <!-- Card Utama -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Header Card -->
                    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i data-lucide="target" class="w-4 h-4 mr-2 text-purple-500 text-xs"></i>
                            Informasi Visi & Misi
                        </h2>
                    </div>

                    <!-- Body Card -->
                    <div class="p-6 space-y-6">
                        <!-- Visi -->
                        <div>
                            <label for="vision" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i data-lucide="eye" class="w-4 h-4 mr-2 text-purple-500 text-xs"></i>
                                Visi Masjid
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <textarea id="vision" name="vision" rows="4"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 px-4 py-3 transition @error('vision') border-red-500 @enderror"
                                placeholder="Tuliskan visi masjid yang jelas dan inspiratif..."
                                required>{{ old('vision', $vision->vision ?? '') }}</textarea>
                            @error('vision')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Visi harus mencerminkan tujuan jangka panjang masjid</p>
                        </div>

                        <!-- Misi -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label class="block text-sm font-medium text-gray-700 flex items-center">
                                    <i data-lucide="list" class="w-4 h-4 mr-2 text-purple-500 text-xs"></i>
                                    Misi Masjid
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <button type="button" onclick="addMission()"
                                    class="text-sm bg-purple-500 text-white px-3 py-1 rounded-lg hover:bg-purple-600 transition flex items-center">
                                    <i data-lucide="plus" class="w-4 h-4 mr-2 text-xs"></i>
                                    Tambah Misi
                                </button>
                            </div>

                            @error('missions')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('missions.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <div id="missions" class="space-y-3">
                                @php
                                    $missions = old('missions', $vision->missions ?? ['']);
                                    // Pastikan minimal ada satu input misi
                                    if (empty($missions)) {
                                        $missions = [''];
                                    }
                                @endphp

                                @foreach($missions as $index => $mission)
                                    <div class="mission-group flex items-start gap-3">
                                        <div
                                            class="flex items-center justify-center w-6 h-6 bg-purple-100 text-purple-600 rounded-full text-xs font-medium mt-2 flex-shrink-0">
                                            {{ $index + 1 }}
                                        </div>
                                        <div class="flex-1">
                                            <input type="text" name="missions[]" value="{{ $mission }}"
                                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 px-4 py-2 transition @error('missions.' . $index) border-red-500 @enderror"
                                                placeholder="Tuliskan poin misi masjid...">
                                            @error('missions.' . $index)
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        @if($index > 0)
                                            <button type="button" onclick="removeMission(this)"
                                                class="mt-2 bg-red-500 hover:bg-red-700 text-white p-2 rounded-lg transition flex items-center">
                                                <i data-lucide="trash" class="w-4 h-4 text-xs"></i>
                                            </button>
                                        @else
                                            <div class="w-10"></div> <!-- Spacer untuk alignment -->
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Misi harus spesifik, terukur, dan dapat diimplementasikan
                            </p>
                        </div>
                    </div>

                    <!-- Footer Card -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
                        <a href="{{ route('admin.masjid.visions.index') }}"
                            class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-lg shadow font-medium flex items-center">
                            <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                            Batal
                        </a>
                        <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('visionForm').submit(), {
                                            title: '{{ isset($vision) ? 'Update' : 'Simpan' }} Visi & Misi',
                                            message: 'Apakah Anda yakin ingin {{ isset($vision) ? 'mengupdate' : 'menyimpan' }} visi & misi ini?',
                                            confirmText: 'Ya, {{ isset($vision) ? 'Update' : 'Simpan' }}',
                                            confirmColor: 'bg-purple-600 hover:bg-purple-700',
                                            confirmIcon: 'check'
                                        })"
                            class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg shadow font-medium flex items-center">
                            <i data-lucide="check" class="w-4 h-4 mr-2"></i>
                            {{ isset($vision) ? 'Update' : 'Simpan' }} Visi & Misi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <style>
        .mission-group {
            transition: all 0.3s ease;
        }

        .mission-group:hover {
            transform: translateX(4px);
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
        let missionCount = {{ count($missions) }};

        // Inisialisasi Lucide icons
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });

        function addMission() {
            missionCount++;
            const container = document.getElementById('missions');
            const newMission = document.createElement('div');
            newMission.className = 'mission-group flex items-start gap-3';
            newMission.style.animation = 'slideIn 0.3s ease';
            newMission.innerHTML = `
                        <div class="flex items-center justify-center w-6 h-6 bg-purple-100 text-purple-600 rounded-full text-xs font-medium mt-2 flex-shrink-0">
                            ${missionCount}
                        </div>
                        <div class="flex-1">
                            <input type="text" name="missions[]" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 px-4 py-2 transition"
                                placeholder="Tuliskan poin misi masjid...">
                        </div>
                        <button type="button" onclick="removeMission(this)"
                            class="mt-2 bg-red-500 hover:bg-red-700 text-white p-2 rounded-lg transition flex items-center">
                            <i data-lucide="trash" class="w-4 h-4 text-xs"></i>
                        </button>
                    `;
            container.appendChild(newMission);

            // Refresh Lucide icons untuk icon trash yang baru
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }

        function removeMission(button) {
            if (missionCount > 1) {
                const missionGroup = button.closest('.mission-group');
                missionGroup.style.opacity = '0';
                missionGroup.style.transform = 'translateX(-20px)';
                setTimeout(() => {
                    missionGroup.remove();
                    missionCount--;
                    // Update mission numbers
                    updateMissionNumbers();
                }, 300);
            }
        }

        function updateMissionNumbers() {
            const missions = document.querySelectorAll('.mission-group');
            missions.forEach((mission, index) => {
                const numberDiv = mission.querySelector('div:first-child');
                numberDiv.textContent = index + 1;
            });
            missionCount = missions.length;
        }

        // Form validation
        document.getElementById('visionForm').addEventListener('submit', function (e) {
            let isValid = true;
            let errorMessages = [];

            // Check vision
            const vision = document.getElementById('vision').value.trim();
            if (!vision) {
                isValid = false;
                errorMessages.push('Visi masjid harus diisi');
            }

            // Check missions
            const missions = document.querySelectorAll('input[name="missions[]"]');
            let hasMissionContent = false;
            missions.forEach(input => {
                if (input.value.trim()) {
                    hasMissionContent = true;
                }
            });

            if (!hasMissionContent) {
                isValid = false;
                errorMessages.push('Minimal satu misi harus diisi');
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
    </script>
@endsection