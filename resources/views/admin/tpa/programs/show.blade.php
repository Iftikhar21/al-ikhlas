@extends('admin.template-admin')
@section('title', 'Detail Program')
@section('content')
<main class="pt-23 p-4 lg:ml-80 transition-all bg-gray-100">

    <div class="bg-white p-6 rounded-lg shadow max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-2">{{ $program->title }}</h1>

        <p class="text-gray-500 mb-4">
            Status: 
            <span class="px-2 py-1 rounded text-xs 
                {{ $program->status == 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-700' }}">
                {{ ucfirst($program->status) }}
            </span>
        </p>

        @if($program->thumbnail)
            <img src="{{ asset('storage/' . $program->thumbnail) }}" alt="Thumbnail {{ $program->title }}"
                 class="w-full rounded mb-6 shadow">
        @endif

        <div class="prose max-w-none mb-6">
            {!! nl2br(e($program->description)) !!}
        </div>

        <div class="mt-6">
            <a href="{{ route('admin.tpa.programs.index') }}" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded">
                Kembali
            </a>
        </div>
    </div>

</main>
@endsection
