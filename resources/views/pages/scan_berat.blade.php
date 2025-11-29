@php
    if (Auth::guard('orangtua')->check()) {
        $layout = 'layouts.orangtuanofooter';
    } else {
        $layout = 'layouts.app_nakesnofooter';
    }
@endphp
@extends($layout)
@section('content')
<div class="min-h-screen bg-white flex flex-col items-center justify-between p-4">

    {{-- Bagian ikon kamera --}}
    <div class="flex-1 flex items-center justify-center">
        <label for="cameraInput" class="cursor-pointer flex flex-col items-center">
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor"
                class="w-16 h-16 text-gray-700 hover:text-purple-500 transition">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 7.5h2.25l1.5-2.25h10.5l1.5 2.25H21M4.5 7.5V18a2.25 2.25 0 002.25 2.25h10.5A2.25 2.25 0 0019.5 18V7.5m-7.5 3.75a3 3 0 110 6 3 3 0 010-6z" />
            </svg>
            <span class="text-sm text-gray-500 mt-2">Scan atau Ambil Foto</span>
        </label>

        {{-- Input kamera (langsung buka kamera di HP) --}}
        <input 
            type="file" 
            accept="image/*" 
            capture="environment" 
            id="cameraInput" 
            class="hidden"
            onchange="previewImage(event)"
        />
    </div>

    {{-- Preview gambar setelah di-scan --}}
    <div id="previewContainer" class="hidden mb-4">
        <img id="previewImage" class="w-48 h-48 object-cover rounded-xl shadow-lg mx-auto" />
    </div>

    {{-- Daftar item --}}
    <div class="w-full max-w-md bg-purple-50 rounded-xl shadow p-4 mb-4">
        @foreach (['List item', 'List item', 'List item'] as $item)
        <div class="flex items-center justify-between mb-3 last:mb-0">
            <div class="flex items-center space-x-3">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-purple-300 text-white font-semibold">
                    A
                </div>
                <span class="text-gray-800">{{ $item }}</span>
            </div>
            <input type="checkbox" checked class="w-5 h-5 text-purple-500 border-gray-300 rounded focus:ring-purple-400" />
        </div>
        @endforeach
    </div>

    {{-- Bagian bawah --}}
    <div class="w-full bg-green-100 rounded-t-3xl py-4 px-6 text-center">
        <h2 class="text-lg font-semibold text-gray-700 mb-3">Berat Badan :</h2>
        <div class="flex flex-col sm:flex-row justify-center gap-3">
            <button class="bg-pink-400 hover:bg-pink-500 text-white px-6 py-2 rounded-full transition">
                Lanjut
            </button>
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-full transition">
                Kembali
            </button>
        </div>
    </div>

</div>

{{-- Script preview foto --}}
<script>
    function previewImage(event) {
        const image = document.getElementById('previewImage');
        const container = document.getElementById('previewContainer');
        image.src = URL.createObjectURL(event.target.files[0]);
        container.classList.remove('hidden');
    }
</script>
@endsection
