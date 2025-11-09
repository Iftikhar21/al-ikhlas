{{-- components/confirm-modal.blade.php --}}
@props([
    'id' => 'confirmModal',
    'title' => 'Konfirmasi',
    'message' => 'Apakah Anda yakin?',
    'confirmText' => 'Ya',
    'cancelText' => 'Batal',
    'confirmColor' => 'bg-red-600 hover:bg-red-700',
    'confirmIcon' => 'alert-triangle',
])

<div id="{{ $id }}" 
     class="fixed inset-0 bg-opacity-50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-120 max-w-md p-6 animate-fade-in">
        <div class="flex items-center mb-4">
            <i data-lucide="{{ $confirmIcon }}" class="w-6 h-6 text-red-500 mr-2"></i>
            <h2 class="text-lg font-semibold text-gray-800">{{ $title }}</h2>
        </div>

        <p class="text-gray-600 mb-6">{{ $message }}</p>

        <div class="flex justify-end gap-3">
            <button type="button"
                onclick="closeConfirmModal('{{ $id }}')"
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg text-sm font-medium transition">
                {{ $cancelText }}
            </button>
            <button type="button"
                id="{{ $id }}-confirm"
                class="px-4 py-2 {{ $confirmColor }} text-white rounded-lg text-sm font-medium flex items-center gap-2 transition">
                <i data-lucide="{{ $confirmIcon }}" class="w-4 h-4"></i>
                <span>{{ $confirmText }}</span>
            </button>
        </div>
    </div>
</div>