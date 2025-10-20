@extends('layouts.orangtua')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-white text-center">
    <h1 class="text-xl font-semibold text-gray-700 mb-3">Input Manual Berat Badan Anak</h1>
    <form class="space-y-4 w-64">
        <input type="number" name="berat" placeholder="Masukkan berat (kg)"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-center focus:ring focus:ring-purple-300" />
        <button type="submit"
            class="w-full bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-full">
            Simpan
        </button>
    </form>
</div>
@endsection
