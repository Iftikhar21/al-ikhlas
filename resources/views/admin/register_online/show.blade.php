@extends('admin.template-admin')
@section('title', 'Daftar Detail ' . $registration->full_name)
@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <!-- Header Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                <div class="mb-4 lg:mb-0">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Detail Pendaftar</h2>
                    <p class="text-gray-600">Informasi lengkap mengenai pendaftar</p>
                </div>
                <div class="text-center lg:text-right">
                    @if($registration->is_approved)
                        <div class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-800 mt-4 md:mt-0">
                            <i data-lucide="check" class="mr-2"></i>
                            <span class="font-semibold">Disetujui</span>
                        </div>
                    @else
                        <div class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-100 text-yellow-800 mt-4 md:mt-0">
                            <i data-lucide="clock" class="mr-2"></i>
                            <span class="font-semibold">Menunggu Persetujuan</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Personal Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Personal Information Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i data-lucide="user" class="text-blue-500 mr-3"></i>
                            Informasi Pribadi
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex flex-col space-y-1">
                                <span class="text-sm text-gray-500 font-medium">Nama Lengkap</span>
                                <span class="text-gray-900 font-semibold">{{ $registration->full_name }}</span>
                            </div>
                            <div class="flex flex-col space-y-1">
                                <span class="text-sm text-gray-500 font-medium">Jenis Kelamin</span>
                                <span
                                    class="text-gray-900 font-semibold">{{ $registration->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                            </div>
                            <div class="flex flex-col space-y-1">
                                <span class="text-sm text-gray-500 font-medium">Tempat Lahir</span>
                                <span class="text-gray-900 font-semibold">{{ $registration->birth_place }}</span>
                            </div>
                            <div class="flex flex-col space-y-1">
                                <span class="text-sm text-gray-500 font-medium">Tanggal Lahir</span>
                                <span
                                    class="text-gray-900 font-semibold">{{ \Carbon\Carbon::parse($registration->birth_date)->format('d F Y') }}</span>
                            </div>
                            <div class="md:col-span-2 flex flex-col space-y-1">
                                <span class="text-sm text-gray-500 font-medium">Alamat Lengkap</span>
                                <span class="text-gray-900 font-semibold">{{ $registration->address }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Parents Information Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i data-lucide="user" class="text-green-500 mr-3"></i>
                            Informasi Orang Tua
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Father's Information -->
                            <div class="space-y-4">
                                <h3 class="text-md font-semibold text-gray-700 border-b pb-2">Ayah</h3>
                                <div class="space-y-3">
                                    <div class="flex flex-col space-y-1">
                                        <span class="text-sm text-gray-500 font-medium">Nama Ayah</span>
                                        <span class="text-gray-900 font-semibold">{{ $registration->father_name }}</span>
                                    </div>
                                    <div class="flex flex-col space-y-1">
                                        <span class="text-sm text-gray-500 font-medium">Pekerjaan Ayah</span>
                                        <span
                                            class="text-gray-900 font-semibold">{{ $registration->father_occupation ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Mother's Information -->
                            <div class="space-y-4">
                                <h3 class="text-md font-semibold text-gray-700 border-b pb-2">Ibu</h3>
                                <div class="space-y-3">
                                    <div class="flex flex-col space-y-1">
                                        <span class="text-sm text-gray-500 font-medium">Nama Ibu</span>
                                        <span class="text-gray-900 font-semibold">{{ $registration->mother_name }}</span>
                                    </div>
                                    <div class="flex flex-col space-y-1">
                                        <span class="text-sm text-gray-500 font-medium">Pekerjaan Ibu</span>
                                        <span
                                            class="text-gray-900 font-semibold">{{ $registration->mother_occupation ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Contact & Actions -->
            <div class="space-y-6">
                <!-- Contact Information Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i data-lucide="map-pin-house" class="text-purple-500 mr-3"></i>
                            Kontak
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex flex-col space-y-1">
                                <span class="text-sm text-gray-500 font-medium">Nomor HP Orang Tua</span>
                                <div class="flex items-center">
                                    <i data-lucide="phone" class="text-gray-400 mr-2"></i>
                                    <span class="text-gray-900 font-semibold">{{ $registration->parent_phone }}</span>
                                </div>
                            </div>
                            <div class="flex flex-col space-y-1">
                                <span class="text-sm text-gray-500 font-medium">Email Orang Tua</span>
                                <div class="flex items-center">
                                    <i data-lucide="at-sign" class="text-gray-400 mr-2"></i>
                                    <span
                                        class="text-gray-900 font-semibold">{{ $registration->parent_email ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i data-lucide="ellipsis" class="text-gray-500 mr-3"></i>
                            Aksi
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="{{ route('admin.admin-register-online.index') }}"
                                class="w-full flex items-center justify-center px-4 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                                <i data-lucide="chevron-left" class="mr-2"></i>
                                Kembali ke Daftar
                            </a>

                            @if(!$registration->is_approved)
                                <form action="{{ route('admin.admin-register-online.approve', $registration->id) }}"
                                    method="POST" class="w-full">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center justify-center px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                        <i data-lucide="check" class="mr-2"></i>
                                        Approve Pendaftaran
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('admin.admin-register-online.destroy', $registration->id) }}"
                                method="POST" onsubmit="return confirm('Yakin ingin menghapus pendaftar ini?');"
                                class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full flex items-center justify-center px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                    <i data-lucide="trash" class="mr-2"></i>
                                    Hapus Pendaftar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Additional Info Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i data-lucide="info" class="text-blue-500 mr-3"></i>
                            Informasi Tambahan
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Tanggal Pendaftaran</span>
                                <span
                                    class="text-gray-900 font-medium">{{ $registration->created_at->format('d M Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Terakhir Diupdate</span>
                                <span
                                    class="text-gray-900 font-medium">{{ $registration->updated_at->format('d M Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Add some interactive functionality
        document.addEventListener('DOMContentLoaded', function () {
            // Add hover effects to cards
            const cards = document.querySelectorAll('.bg-white');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.classList.add('shadow-md');
                    this.classList.remove('shadow-sm');
                });

                card.addEventListener('mouseleave', function () {
                    this.classList.remove('shadow-md');
                    this.classList.add('shadow-sm');
                });
            });

            // Add confirmation for delete action
            const deleteForms = document.querySelectorAll('form[onsubmit]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    if (!confirm('Yakin ingin menghapus pendaftar ini? Tindakan ini tidak dapat dibatalkan.')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
@endsection