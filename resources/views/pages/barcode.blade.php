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

        <h2 class="text-xl font-semibold text-gray-800 mb-4">
            Barcode Hasil Anak
        </h2>

        <div class="border border-gray-300 rounded-xl p-4 flex justify-center mb-6">
            <div class="flex justify-center mb-6">
                {!! $qrcode !!}
            </div>
        </div>

        <div class="flex justify-center gap-4">
            <a href="{{ url()->previous() }}"
            class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-full shadow-md">
                Kembali
            </a>
            <a href="{{ route('barcode.download', $anak->id) }}"
               class="bg-pink-300 hover:bg-pink-400 text-white px-6 py-3 rounded-full shadow-md">
                Unduh
            </a>
        </div>
    </div>
</div>
@endsection
