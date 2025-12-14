@extends('layouts.app')

@section('title', 'Riwayat')

@section('content')
<div class="min-h-[calc(100vh-160px)] bg-white px-4 py-6">

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
                @foreach ($anak as $item)
                <tr class="border-t">
                    <td class="px-4 py-2 text-gray-800">{{ $item->nama_lengkap }}</td>
                    <td class="px-4 py-2 text-center">
                        @php
                            $tanggal = $item->created_at?->format("Y-m-d H:i:s") ?? "Tanggal Tidak Tersedia";
                        @endphp
                        <button onclick="openDetailModal(
                            '{{$item->nama_lengkap}}',
                            '{{$item->umur}}',
                            '{{$item->created_at?->format("Y-m-d H:i:s") ?? "Tanggal Tidak Tersedia" }}',
                            '{{$item->tinggi_badan}}',
                            '{{$item->berat_badan}}',
                            '{{$item->hasil_deteksi}}'                          
                            )" class="text-white bg-pink-300 hover:bg-pink-400 focus:ring-4 focus:ring-pink-200 font-medium rounded-full text-xs px-4 py-2 transition">
                                Lihat Detail
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $anak->links() }}
    </div>
</div>
{{-- MODAL DETAIL --}}
<div id="detailModal" tabindex="-1" aria-hidden="true" 
     class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
    <div class="relative p-4 w-full max-w-md">
        <div class="relative bg-white rounded-lg shadow">
            {{-- Header Modal --}}
            <div class="flex items-center justify-between p-4 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">Riwayat Pemeriksaan</h3>
                <button type="button" onclick="closeDetailModal()" 
                        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center">
                    ✕
                </button>
            </div>
            {{-- Body Modal --}}
            <div class="p-5">
                <table class="w-full text-sm">
                    <tr>
                        <td class="font-semibold w-32">Nama</td>
                        <td>: <span id="detailNama" class="text-gray-700"></span></td>
                    </tr>
                    <tr>
                        <td class="font-semibold">Umur</td>
                        <td>: <span id="detailUmur" class="text-gray-700"></span>bulan</td>
                    </tr>
                </table>
                <div class="p-5 space-y-3">
                    <table class="w-full text-sm border border-gray-300">
                        <tr class="border">
                            <td class="font-semibold px-3 py-2 w-32">Tanggal pemeriksaan</td>
                            <td class="px-3 py-2" id="detailTanggal"></td>
                        </tr>
                        <tr class="border">
                            <td class="font-semibold px-3 py-2">Tinggi Badan</td>
                            <td class="px-3 py-2" id="detailTinggi"></td>
                        </tr>
                        <tr class="border">
                            <td class="font-semibold px-3 py-2">Berat Badan</td>
                            <td class="px-3 py-2" id="detailBerat"></td>
                        </tr>
                        <tr class="border">
                            <td class="font-semibold px-3 py-2">Status Gizi</td>
                            <td class="px-3 py-2" id="detailStatus"></td>
                        </tr>
                    </table>
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
</div>
@push('scripts')
<script>
    function openDetailModal(nama, umur, created_at, tinggi, berat, hasil_deteksi) {
        console.log("MODAL DIPANGGIL");
        document.getElementById('detailNama').innerText = nama;
        document.getElementById('detailUmur').innerText = umur;
        document.getElementById('detailTanggal').innerText = created_at;
        document.getElementById('detailTinggi').innerText = tinggi;
        document.getElementById('detailBerat').innerText = berat;
        document.getElementById('detailStatus').innerHTML = hasil_deteksi.replace(/\n/g, '<br>');

        document.getElementById('detailModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden'); // biar ga bisa scroll pas modal buka
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
</script>
@endpush
@endsection
