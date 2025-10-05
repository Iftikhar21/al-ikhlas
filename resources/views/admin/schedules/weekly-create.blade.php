@extends('admin.template-admin')
@section('title', 'Tambah Jadwal Mingguan')
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <div class="container mx-auto max-w-4xl">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Tambah Jadwal Mingguan</h1>
                <p class="text-gray-600">Tambahkan jadwal aktivitas mingguan baru</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('admin.weekly.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="day" class="block text-sm font-medium text-gray-700 mb-2">Hari *</label>
                            <select name="day" id="day"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
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
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="teacher" class="block text-sm font-medium text-gray-700 mb-2">Pengajar *</label>
                            <input type="text" name="teacher" id="teacher" value="{{ old('teacher') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Nama pengajar" required>
                            @error('teacher')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">Waktu Mulai
                                *</label>
                            <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                            @error('start_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700 mb-2">Waktu Selesai
                                *</label>
                            <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                            @error('end_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="activity" class="block text-sm font-medium text-gray-700 mb-2">Aktivitas *</label>
                            <input type="text" name="activity" id="activity" value="{{ old('activity') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Deskripsi aktivitas" required>
                            @error('activity')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('admin.schedules.index') }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition duration-200">
                            Batal
                        </a>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition duration-200">
                            Simpan Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection