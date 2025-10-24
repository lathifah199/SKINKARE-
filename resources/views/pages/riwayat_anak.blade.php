@extends('layouts.app')

@section('title', 'Riwayat')

@section('content')
<div class="min-h-[calc(100vh-160px)]n bg-white flex flex-col justify-center items-center px-4 py-6">

    {{-- Header --}}
    <div class="w-full max-w-4xl text-left mb-4">
        <h2 class="text-lg font-semibold text-gray-800 border-b pb-2">Riwayat</h2>
    </div>

    {{-- Tabel Riwayat --}}
    <div class="w-full max-w-4xl ">
        <table class="w-full text-sm text-left border border-gray-300 border-collapse table-fixed">
            <thead class="bg-gray-100">
                <tr>
                    <th class="w-1/2 px-4 py-2 border border-gray-400 text-gray-700 font-medium text-center">Nama Anak</th>
                    <th class="w-1/2 px-4 py-2 border border-gray-400 text-gray-700 font-medium text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Contoh data statis, nanti bisa diganti dengan @foreach --}}
                <tr class="border-t">
                    <td class="px-4 py-2 border border-gray-400 text-center text-gray-800">Budi</td>
                    <td class="px-4 py-2 border border-gray-400 text-center">
                        <button onclick="openDetailModal('Budi')" 
                                class="text-white bg-pink-300 hover:bg-pink-400 focus:ring-4 focus:ring-pink-200 font-medium rounded-full text-xs px-4 py-2 transition">
                            Lihat Detail
                        </button>
                    </td>
                </tr>
                {{-- Jika pakai data dinamis --}}
                {{-- 
                @foreach ($anak as $item)
                <tr class="border-t">
                    <td class="px-4 py-2 text-gray-800">{{ $item->nama_anak }}</td>
                    <td class="px-4 py-2 text-center">
                        <a href="{{ route('riwayat.detail', $item->id) }}" 
                           class="text-white bg-pink-300 hover:bg-pink-400 focus:ring-4 focus:ring-pink-200 font-medium rounded-full text-xs px-4 py-2 transition">
                           Lihat Detail
                        </a>
                    </td>
                </tr>
                @endforeach
                --}}
            </tbody>
        </table>
    </div>
    {{--pagination--}}
       <div class="mt-4">
            <div class="flex justify-center space-x-2">
                {{-- Contoh pagination statis --}}
                <div class="flex justify-center space-x-2">
                    <button class="px-3 py-1 text-sm text-gray-700 border rounded hover:bg-gray-100">«</button>
                    <button class="px-3 py-1 text-sm text-white bg-pink-400 rounded hover:bg-pink-500">1</button>
                    <button class="px-3 py-1 text-sm text-gray-700 border rounded hover:bg-gray-100">2</button>
                    <button class="px-3 py-1 text-sm text-gray-700 border rounded hover:bg-gray-100">»</button>
                </div>
            </div>

            {{-- Kalau pakai pagination Laravel --}}
            {{-- 
            <div class="mt-4">
                {{ $anak->links('vendor.pagination.tailwind') }}
            </div>
            --}}
        </div>

</div>
{{-- MODAL DETAIL --}}
<div id="detailModal" tabindex="-1" aria-hidden="true" 
     class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
    <div class="relative p-4 w-full max-w-md">
        <div class="relative bg-white rounded-lg shadow">
            {{-- Header Modal --}}
            <div class="flex items-center justify-between p-4 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">Detail Anak</h3>
                <button type="button" onclick="closeDetailModal()" 
                        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center">
                    ✕
                </button>
            </div>
            {{-- Body Modal --}}
            <div class="p-5 space-y-3">
                <p><span class="font-semibold">Nama:</span> <span id="detailNama" class="text-gray-700"></span></p>
                <p><span class="font-semibold">Umur:</span> 24 bulan</p>
                <p><span class="font-semibold">Tinggi Badan:</span> 85 cm</p>
                <p><span class="font-semibold">Berat Badan:</span> 11 kg</p>
                <p><span class="font-semibold">Status Gizi:</span> Normal</p>
            </div>
            {{-- Footer Modal --}}
            <div class="flex justify-end items-center p-4 border-t">
                <button onclick="closeDetailModal()" 
                        class="text-white bg-pink-400 hover:bg-pink-500 focus:ring-4 focus:ring-pink-200 font-medium rounded-lg text-sm px-4 py-2">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
{{-- SCRIPT --}}
<script>
    function openDetailModal(nama) {
        document.getElementById('detailNama').innerText = nama;
        document.getElementById('detailModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden'); // biar ga bisa scroll pas modal buka
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
</script>
@endsection