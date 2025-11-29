@extends('layouts.orangtuanofooter')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-white text-center">
    <h1 class="text-xl font-semibold text-gray-700 mb-3">Hasil Scan Berat Anak</h1>
    <p class="text-gray-600">Berat badan anak anda adalah <span class="font-semibold">25 kg</span>.</p>
    <a href="{{ route('scan_berat') }}" 
       class="mt-4 inline-block bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-full">
       Kembali
    </a>
</div>
@endsection
