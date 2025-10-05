@extends('admin.template-admin')
@section('title', 'Kelola Footer')

@section('content')
    <main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">
        <div class="max-w-full mx-auto">
            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Kelola Footer</h2>
                        <p class="text-gray-600">Kelola informasi footer website dan media sosial</p>
                    </div>
                </div>
            </div>

            {{-- Alert sukses --}}
            @if(session('success'))
                <div class="p-4 mb-6 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center">
                    <i data-lucide="check" class="mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($footer)
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Left Column - Company Info -->
                                <div class="space-y-6">
                                    <!-- Logo & Slogan Card -->
                                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                            <i data-lucide="image" class="h-5 w-5 mr-2 text-blue-500 mr-2"></i>
                                            Logo & Slogan
                                        </h2>

                                        @if($footer->logo)
                                            <div class="mb-4">
                                                <p class="text-sm font-medium text-gray-700 mb-2">Logo</p>
                                                <div class="bg-[#166534] p-4 rounded-lg inline-block">
                                                    <img src="{{ asset('storage/' . $footer->logo) }}" alt="Logo" class="h-32">
                                                </div>
                                            </div>
                                        @endif

                                        <div>
                                            <p class="text-sm font-medium text-gray-700 mb-1">Slogan</p>
                                            <p class="text-gray-800 italic">"{{ $footer->slogan }}"</p>
                                        </div>
                                    </div>

                                    <!-- Contact Info Card -->
                                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                            <i data-lucide="phone" class="h-5 w-5 mr-2 text-blue-500 mr-2"></i>
                                            Informasi Kontak
                                        </h2>

                                        <div class="space-y-4">
                                            <div>
                                                <p class="text-sm font-medium text-gray-700 mb-1">Alamat</p>
                                                <p class="text-gray-800">{{ $footer->alamat }}</p>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-700 mb-1">Telepon</p>
                                                    <p class="text-gray-800">{{ $footer->telepon }}</p>
                                                </div>

                                                <div>
                                                    <p class="text-sm font-medium text-gray-700 mb-1">Email</p>
                                                    <p class="text-gray-800">{{ $footer->email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Description Card -->
                                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                            <i data-lucide="info" class="h-5 w-5 mr-2 text-blue-500 mr-2"></i>
                                            Deskripsi
                                        </h2>

                                        <div>
                                            <p class="text-sm font-medium text-gray-700 mb-1">Deskripsi</p>
                                            <p class="text-gray-800">{{ $footer->deskripsi }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column - Maps & Social Media -->
                                <div class="space-y-6">
                                    <!-- Maps Card -->
                                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                            <i data-lucide="map-pin" class="h-5 w-5 mr-2 text-blue-500 mr-2"></i>
                                            Lokasi
                                        </h2>

                                        @if(!empty($footer->map_embed))
                                            <div class="rounded-lg overflow-hidden border border-gray-200">
                                                <iframe src="{!! $footer->map_embed !!}" width="100%" height="300" style="border:0;"
                                                    allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                            </div>
                                        @else
                                            <div class="bg-gray-100 rounded-lg p-8 text-center">
                                                <i data-lucide="map-pin" class="h-5 w-5 mr-2 text-blue-500 mr-2"></i>
                                                <p class="mt-2 text-gray-500">Peta belum ditambahkan</p>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Social Media Card -->
                                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                            <i data-lucide="thumbs-up" class="h-5 w-5 mr-2 text-blue-500 mr-2"></i>
                                            Media Sosial
                                        </h2>

                                        @if($footer->socials->count() > 0)
                                            <div class="space-y-3">
                                                @foreach($footer->socials as $social)
                                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                                        <div class="flex items-center">
                                                            @php
            $icons = [
                'facebook' => 'facebook',
                'instagram' => 'instagram',
                'twitter' => 'twitter',
                'youtube' => 'youtube',
                'linkedin' => 'linkedin',
                'tiktok' => 'music',
            ];
            $icon = $icons[strtolower($social->platform)] ?? 'globe';
            $colors = [
                'facebook' => 'text-blue-600',
                'instagram' => 'text-pink-600',
                'twitter' => 'text-blue-400',
                'youtube' => 'text-red-600',
                'linkedin' => 'text-blue-700',
                'tiktok' => 'text-black',
            ];
            $color = $colors[strtolower($social->platform)] ?? 'text-gray-700';
                                                            @endphp

                                                            <div class="p-2 rounded-md bg-white shadow-sm mr-3">
                                                                <i data-lucide="{{ $icon }}" class="w-5 h-5 {{ $color }}"></i>
                                                            </div>

                                                            <div>
                                                                <p class="font-medium text-gray-800">{{ ucfirst($social->platform) }}</p>
                                                                <a href="{{ $social->url }}" target="_blank"
                                                                    class="text-sm text-blue-600 hover:underline truncate block max-w-xs">
                                                                    {{ $social->url }}
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="text-gray-400">
                                                            <i data-lucide="chevrons-right" class="h-5 w-5 mr-2 text-blue-500 mr-2"></i>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-center py-8">
                                                <i data-lucide="circle-alert" class="h-5 w-5 mr-2 text-blue-500 mr-2"></i>
                                                <p class="mt-2 text-gray-500">Belum ada media sosial ditambahkan</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Tombol aksi --}}
                            <div class="mt-8 flex gap-3 justify-end">
                                <a href="{{ route('admin.footer.edit', $footer->id) }}"
                                    class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg flex items-center transition-colors">
                                    <i data-lucide="pencil" class="h-5 w-5 mr-2"></i>
                                    Edit Footer
                                </a>
                                <form action="{{ route('admin.footer.destroy', $footer->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus footer?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg flex items-center transition-colors">
                                        <i data-lucide="trash" class="h-5 w-5 mr-2"></i>
                                        Hapus Footer
                                    </button>
                                </form>
                            </div>
            @else
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                    <i data-lucide="circle-alert" class="h-5 w-5 mr-2 text-blue-500 mr-2"></i>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Footer Belum Ditambahkan</h3>
                    <p class="mt-2 text-gray-500">Tambahkan informasi footer untuk website Anda.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.footer.create') }}"
                            class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg inline-flex items-center transition-colors">
                            <i data-lucide="plus" class="h-5 w-5 mr-2 text-blue-500 mr-2"></i>
                            Tambah Footer
                        </a>
                    </div>
                </div>
            @endif
        </div>

        {{-- Pastikan lucide di-load --}}
        <script>
            lucide.createIcons();
        </script>
    </main>
@endsection