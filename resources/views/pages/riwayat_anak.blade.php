@extends('layouts.app')

@section('title', 'Riwayat')

@section('content')
<div class="min-h-[calc(100vh-160px)] bg-white px-4 py-6 mt-20">

    {{-- Header --}}
<div class="w-full max-w-4xl text-left mb-4 ">
        <h2 class="text-lg font-semibold text-gray-800 text-center border-b pb-2">Riwayat Pemeriksaan</h2>
    </div>
    {{-- Tabel Riwayat --}}
    <div class="w-full flex justify-center">
        <div class="w-full max-w-4xl overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">
                            Nama Anak
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($riwayat as $item)
                    <tr class="hover:bg-gray-50">
                        {{-- Nama Anak --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="h-10 w-10 rounded-full bg-[#F3C0CD] flex items-center justify-center text-white font-semibold">
                                    {{ strtoupper(substr($item['anak']['nama_lengkap'],0,1)) }}
                                </div>
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $item['anak']['nama_lengkap'] }}
                                </div>
                            </div>
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-4 text-center">
                            <button
                                onclick='openDetailModal(@json($item["anak"]["nama_lengkap"]), @json($item["pemeriksaan"]))'
                                    class="inline-flex items-center px-4 py-2 bg-[#F3C0CD] hover:bg-[#E8A8B8] text-white text-sm rounded-lg shadow">
                                        Lihat Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="px-6 py-12 text-center text-gray-500">
                            Belum ada pemeriksaan
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- MODAL DETAIL --}}
<div id="detailModal" tabindex="-1" aria-hidden="true" 
     class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
    <div class="relative p-4 w-full max-w-md">
        <div class="relative bg-white rounded-lg shadow">
            {{-- Header Modal --}}
            <div class="flex items-center justify-center p-4 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900 text-center ">
                    Riwayat Pemeriksaan <span id="detailNamaHeader"></span>
                </h3>

                <button type="button" onclick="closeDetailModal()" 
                        class="absolute right-4 text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center">
                    ✕
                </button>
            </div>
            {{-- Body Modal --}}
            <div class="p-5">
                <div class="p-5 space-y-3">
                    <table class="w-full text-sm border border-gray-300">
                        <tr class="border">
                            <td class="font-semibold px-3 py-2 w-32">Tanggal pemeriksaan</td>
                            <td class="px-3 py-2">
                                <select id="tanggalSelect"
                                    class="w-full border rounded px-2 py-1"
                                    onchange="updateDetail(this.value)">
                                </select>
                            </td>
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
                            <td class="font-semibold px-3 py-2">Status beresiko </td>
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
let pemeriksaanData = [];

function openDetailModal(nama, data) {
    console.log('Nama:', nama);
    console.log('Data pemeriksaan:', data);

    // Validasi data
    if (!data || data.length === 0) {
        alert('Tidak ada data pemeriksaan');
        return;
    }

    pemeriksaanData = data;
    document.getElementById('detailNamaHeader').innerText = nama;

    // Populate dropdown tanggal
    const select = document.getElementById('tanggalSelect');
    select.innerHTML = '';

    data.forEach((p, index) => {
        const opt = document.createElement('option');
        opt.value = index;
        opt.textContent = p.tanggal_pemeriksaan;
        select.appendChild(opt);
    });

    // Tampilkan detail pemeriksaan pertama
    updateDetail(0);

    // Tampilkan modal
    const modal = document.getElementById('detailModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

function updateDetail(index) {
    const p = pemeriksaanData[index];

    document.getElementById('detailTinggi').innerText = (p.tinggi_badan || 0) + ' cm';
    document.getElementById('detailBerat').innerText = (p.berat_badan || 0) + ' kg';
    document.getElementById('detailStatus').innerText = p.kategori_risiko || 'Belum ada hasil';
}

function closeDetailModal() {
    const modal = document.getElementById('detailModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
}

// Event listener untuk menutup modal saat klik di luar
document.getElementById('detailModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeDetailModal();
    }
});
</script>
@endpush
