@php
    if (Auth::guard('orangtua')->check()) {
        $layout = 'layouts.orangtuanofooter';
    } else {
        $layout = 'layouts.app_nakesnofooter';
    }
@endphp

@extends($layout)

@section('content')
<div class="min-h-screen bg-white flex items-center justify-center p-6 pt-20">
    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md text-center border border-pink-200">

        <h2 class="text-2xl font-bold text-gray-800 mb-2">
            Input Manual Berat Badan Anak
        </h2>
        <p class="text-gray-600 mb-6">
            Masukkan berat badan anak (dalam kg).
        </p>

<form id="formBerat" method="POST" action="{{ route('scan.berat.store', $pemeriksaan->id_pemeriksaan) }}">
    @csrf
    <input type="number" name="berat_badan"
           class="w-full border border-gray-300 rounded-lg px-4 py-3 text-center text-lg mb-6 focus:ring-2 focus:ring-pink-300"
           placeholder="contoh: 12.5" required>

    <div class="flex justify-center gap-4">
        <button type="submit"
            class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-full shadow-md">
            Simpan
        </button>

        <a href="{{ route('scan_tinggi', $anak->id) }}"
           class="bg-pink-300 hover:bg-pink-400 text-white px-6 py-3 rounded-full shadow-md">
            Kembali
        </a>
    </div>
</form>
</div>
</div>
@endsection