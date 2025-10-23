@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-pink-50 flex flex-col items-center justify-center py-10">
    @include('components.navbar')

    <div class="bg-white shadow-lg rounded-2xl p-8 max-w-lg text-center">
        <h2 class="text-xl font-bold text-gray-700 mb-3">Data Anak</h2>
        <p><strong>Nama:</strong> {{ $anak->nama_lengkap }}</p>
        <p><strong>Jenis Kelamin:</strong> {{ $anak->jenis_kelamin }}</p>
        <p><strong>Umur:</strong> {{ $anak->umur }} bulan</p>
        <p><strong>TTL:</strong> {{ $anak->ttl }}</p>

        <div class="my-6">
            <img src="data:image/png;base64,{{ $qrcode ?? '' }}" alt="QR Code" class="mx-auto">
        </div>

        <a href="{{ route('barcode.download', $anak->id) }}"
           class="inline-block bg-emerald-400 text-white px-4 py-2 rounded-lg hover:bg-emerald-500">
            Download Barcode
        </a>

        <a href="{{ route('scan_tinggi') }}" 
           class="inline-block ml-2 bg-pink-400 text-white px-4 py-2 rounded-lg hover:bg-pink-500">
            Lanjutkan Pengukuran
        </a>
    </div>
</div>
@endsection
