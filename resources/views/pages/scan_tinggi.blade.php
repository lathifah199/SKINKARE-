@extends('layouts.orangtua')

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
        <h2 class="text-lg font-semibold text-gray-700 mb-3">Tinggi Badan :</h2>
        <div class="flex flex-col sm:flex-row justify-center gap-3">
            <a href="{{ route('hasil_scan') }}" onclick="openPopup()" class="bg-pink-400 hover:bg-pink-500 text-white px-6 py-2 rounded-full transition">
                Lanjut
            </a>
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-full transition"onclick="window.history.back()">
                Kembali
            </button>
        </div>
    </div>
    <!-- Popup -->
    <div id="popup" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-lg p-6 w-80 text-center">
            <p class="text-gray-800 mb-4">Hasil Scan Tinggi anak anda adalah</p>
            <input 
                type="text" 
                placeholder="Berat badan anak" 
                class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-4 text-center focus:ring focus:ring-purple-300"
            />
            <p class="text-gray-700 mb-4">Apakah anda ingin melakukan Input manual?</p>
            <div class="flex justify-center gap-3">
                <a href="{{ route('scan_berat') }}" 
                class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-full">
                Scan berat badan
                </a>
                <a href="{{ route('input_manual') }}" 
                class="bg-pink-300 hover:bg-pink-400 text-white px-4 py-2 rounded-full">
                Input Manual
                </a>
            </div>
            <button 
                onclick="closePopup()"
                class="mt-4 text-sm text-gray-500 hover:text-gray-700 underline">
                Tutup
            </button>
        </div>
    </div>

    <script>
        function openPopup() {
            document.getElementById('popup').classList.remove('hidden');
            document.getElementById('popup').classList.add('flex');
        }
        function closePopup() {
            document.getElementById('popup').classList.add('hidden');
            document.getElementById('popup').classList.remove('flex');
        }
    </script>
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
