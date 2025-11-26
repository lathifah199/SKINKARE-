@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-pink-100 flex flex-col">
    
    {{-- Navbar --}}
    @include('components.navbar')

    <!-- Background dan form -->
    <div class="flex-grow bg-cover bg-center flex items-center justify-center py-16"
         style="background-image: url('https://source.unsplash.com/800x600/?family,child');">
         
        <div class="bg-white/90 backdrop-blur-md p-8 rounded-2xl shadow-lg w-full max-w-md mt-10 mb-10">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-700">Isi Data Anak</h2>
               <a href="{{ route('halaman_orangtua') }}" class="text-gray-500 hover:text-red-500 text-lg sm:text-xl">&times;</a>
            </div>

            {{-- Notifikasi sukses --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-2 mb-3 rounded">{{ session('success') }}</div>
            @endif

            {{-- Form Tambah Anak --}}
            <form action="{{ route('anak.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-600">Nama Lengkap</label>
                    <input name="nama_lengkap" type="text" placeholder="Masukkan nama lengkap"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-300 outline-none">
                </div>

                <div>
                    <label class="block text-gray-600">Jenis Kelamin</label>
                    <select name="jenis_kelamin"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-300 outline-none">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-600">Umur (bulan)</label>
                    <input name="umur" type="number" placeholder="Masukkan umur (dalam bulan)"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-300 outline-none">
                </div>

                <div>
                    <label class="block text-gray-600">Tempat, Tanggal Lahir</label>
                    <input name="tempat_lahir" type="text" placeholder="Masukkan Tempat, tanggal lahir"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-300 outline-none">
                </div>

                <button type="submit"
                        class="w-full bg-emerald-400 hover:bg-emerald-500 text-white font-semibold py-2 rounded-full mt-4 transition">
                    Mulai Scan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
