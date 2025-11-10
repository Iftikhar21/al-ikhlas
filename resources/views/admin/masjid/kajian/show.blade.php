@extends('admin.template-admin')
@section('title', 'Detail Kajian')
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex items-center justify-between">
                <h2 class="text-3xl font-bold text-gray-800">Detail Kajian</h2>
                <a href="{{ route('admin.masjid.kajian.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg shadow transition">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm max-w-4xl mx-auto overflow-hidden">
            <!-- Poster Section -->
            <div class="relative w-full max-w-2xl mx-auto p-6">
                @if($kajian->poster)
                    <div class="aspect-w-3 aspect-h-4 rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $kajian->poster) }}" alt="Poster Kajian"
                            class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="aspect-w-3 aspect-h-4 bg-gray-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="image" class="w-16 h-16 text-gray-400"></i>
                    </div>
                @endif
            </div>

            <!-- Content Section -->
            <div class="p-6 space-y-6 border-t border-gray-200">
                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            @if($kajian->jenis_kajian === 'Pekanan')
                                KAJIAN RUTIN PEKANAN
                            @elseif($kajian->jenis_kajian === 'Bulanan')
                                KAJIAN RUTIN BULANAN
                            @else
                                {{ strtoupper($kajian->jenis_kajian) }}
                            @endif
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-center text-gray-600">
                                <i data-lucide="tag" class="w-5 h-5 mr-3 text-green-500"></i>
                                <span>{{ $kajian->jenis_kajian }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i data-lucide="user" class="w-5 h-5 mr-3 text-green-500"></i>
                                <span>{{ $kajian->pembicara }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i data-lucide="calendar" class="w-5 h-5 mr-3 text-green-500"></i>
                                <span>{{ $kajian->hari ?? 'Belum ditentukan' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center text-gray-600">
                            <i data-lucide="clock" class="w-5 h-5 mr-3 text-green-500"></i>
                            <span>
                                @if($kajian->waktu_mulai && $kajian->waktu_selesai)
                                    {{ \Carbon\Carbon::parse($kajian->waktu_mulai)->format('H:i') }} WIB -
                                    {{ \Carbon\Carbon::parse($kajian->waktu_selesai)->format('H:i') }} WIB
                                @elseif($kajian->waktu_mulai)
                                    {{ \Carbon\Carbon::parse($kajian->waktu_mulai)->format('H:i') }} WIB
                                @else
                                    Tidak ada waktu ditentukan
                                @endif
                            </span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i data-lucide="map-pin" class="w-5 h-5 mr-3 text-green-500"></i>
                            <span>{{ $kajian->lokasi }}</span>
                        </div>
                    </div>
                </div>

                <!-- Materi -->
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Materi Kajian</h4>
                    <p class="text-gray-600">{{ $kajian->materi }}</p>
                </div>

                <!-- Keterangan -->
                @if($kajian->keterangan)
                    <div>
                        <h4 class="font-medium text-gray-700 mb-2">Keterangan Tambahan</h4>
                        <p class="text-gray-600">{{ $kajian->keterangan }}</p>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex items-center gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.masjid.kajian.edit', $kajian->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition">
                        <i data-lucide="pencil" class="w-4 h-4 mr-2"></i>
                        Edit Kajian
                    </a>

                    <form action="{{ route('admin.masjid.kajian.destroy', $kajian->id) }}" method="POST"
                        id="deleteKajianForm-{{ $kajian->id }}" class="inline">
                        @csrf
                        @method('DELETE')
                    </form>

                    <button type="button" onclick="openConfirmModal('globalConfirmModal', () => document.getElementById('deleteKajianForm-{{ $kajian->id }}').submit(), {
                                title: 'Hapus Kajian',
                                message: 'Apakah Anda yakin ingin menghapus kajian ini?',
                                confirmText: 'Ya, Hapus',
                                confirmColor: 'bg-red-600 hover:bg-red-700',
                                confirmIcon: 'trash'
                            })"
                        class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition">
                        <i data-lucide="trash" class="w-4 h-4 mr-2"></i>
                        Hapus Kajian
                    </button>
                </div>
            </div>
        </div>
    </main>

    <style>
        .aspect-w-3 {
            position: relative;
            padding-bottom: 133.333333%;
        }

        .aspect-w-3>* {
            position: absolute;
            height: 100%;
            width: 100%;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }
    </style>
@endsection