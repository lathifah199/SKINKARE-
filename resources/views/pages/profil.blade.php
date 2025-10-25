@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="min-h-screen bg-gray-50 flex justify-center items-center pt-20 pb-10">
    <div class="bg-white border border-gray-200 shadow-md rounded-2xl w-full max-w-md mx-4 p-6">
        <!-- Header -->
        <div class="flex flex-col items-center border-b border-gray-200 pb-4 mb-4">
            <div class="bg-emerald-500 text-white rounded-full p-4 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A7 7 0 0112 15a7 7 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <h2 class="text-base font-semibold text-gray-800">Nama Pengguna</h2>
            <p class="text-sm text-gray-500">user@example.com</p>
        </div>

        <!-- Info -->
        <div class="space-y-3 text-sm">
            <div>
                <p class="text-gray-600">Nama Lengkap</p>
                <p class="font-medium text-gray-800">Kharina</p>
            </div>
            <div>
                <p class="text-gray-600">Alamat</p>
                <p class="font-medium text-gray-800">Tiban</p>
            </div>
            <div>
                <p class="text-gray-600">Nomor HP</p>
                <p class="font-medium text-gray-800">08123456789</p>
            </div>
        </div>

        <!-- Tombol Edit -->
        <div class="flex justify-center mt-6">
            <button onclick="openEditModal()"
                class="bg-emerald-500 hover:bg-emerald-600 text-white font-medium rounded-full px-6 py-2 text-sm transition-all">
                Edit Profil
            </button>
        </div>
    </div>
</div>

@include('pages.edit.edit_profil')
@endsection
