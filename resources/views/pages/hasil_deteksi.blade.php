@extends('layouts.app') @section('content')
@section('content')
<div class="min-h-screen bg-pink-50/70 flex flex-col items-center justify-center py-20">
    @include('components.navbar')

    <div class="bg-white shadow-xl rounded-3xl p-10 w-full max-w-3xl border border-pink-100">
        <!-- Judul -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-semibold text-pink-500">Hasil Deteksi Kesehatan Anak</h1>
            <p class="text-gray-500 mt-2">Analisis berdasarkan data pertumbuhan dan status gizi anak Anda</p>
        </div>

        <!-- Data Anak -->
        <div class="bg-pink-100/50 rounded-2xl p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-3 border-b border-pink-200 pb-1">Data Anak</h2>
            <div class="grid grid-cols-2 gap-y-2 text-gray-700 text-sm">
                <p><strong>Nama</strong></p><p>: {{ $anak->nama_lengkap }}</p>
                <p><strong>Jenis Kelamin</strong></p><p>: {{ $anak->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                <p><strong>Umur</strong></p><p>: {{ $anak->umur }} bulan</p>
                <p><strong>Tinggi Badan</strong></p><p>: {{ number_format($anak->tinggi_badan, 1) }} cm</p>
                <p><strong>Berat Badan</strong></p><p>: {{ number_format($anak->berat_badan, 1) }} kg</p>
            </div>
        </div>

        <!-- Hasil Analisis -->
        <div class="text-center mb-6">
            <h3 class="text-xl font-semibold text-[#E573A8] mb-2">Hasil Analisis</h3>
            <div class="bg-gradient-to-r from-[#D8F3F1] to-[#FFE5EE] rounded-2xl shadow p-6">
                <p class="text-gray-700 text-sm mb-2">
                    Status: <span class="font-semibold">{{ $status }}</span>
                </p>
                <p class="text-gray-700 text-sm mb-2">
                    Z-Score: <span class="font-semibold">{{ $zscore }}</span>
                </p>
                <p class="text-gray-700 text-sm">
                    Risiko Stunting:
                    <span class="font-bold text-lg" style="color: {{ $warna }}">{{ $risiko }}%</span>
                    <span class="text-sm text-gray-600">({{ $kategori }})</span>
                </p>
            </div>
        </div>

        <!-- Interpretasi -->
        <div class="bg-gradient-to-r from-[#FFE6EE] to-[#D8F3F1] rounded-2xl shadow-md p-5 mb-8">
            <h4 class="font-semibold text-gray-700 text-base mb-2">Rekomendasi Gizi & Pencegahan:</h4>
            <div class="bg-white rounded-xl p-4 text-sm text-gray-700 leading-relaxed">
                {{ $hasil ?? 'Belum ada hasil interpretasi.' }}
            </div>
        </div>
<!-- Grafik Z-Score -->
<div class="bg-[#B9E9DD]/20 shadow-xl rounded-3xl p-8 mt-10 w-full max-w-3xl border border-pink-100">
    <h3 class="text-xl font-semibold text-pink-500 text-center mb-4">
        Grafik Tinggi Badan / Umur (Z-Score)
    </h3>

    <div class="w-full" style="height: 350px;">
        <canvas id="chartTbu"></canvas>
    </div>
</div>

        <!-- Tombol -->
        <div class="flex flex-col sm:flex-row mt-10 gap-4 w-full justify-center ">
            <a href="{{ route('barcode.download', $anak->id) }}" 
               class="bg-[#7DDCD3] hover:bg-[#6bc6bf] text-white font-semibold p-3 rounded-full shadow text-center transition">
                Download Barcode
            </a>
            <a href=""
               class="bg-[#E984A7] hover:bg-[#d97298] text-white font-semibold p-3 rounded-full shadow text-center transition">
               Kembali
            </a>
        </div>
    </div>
 </div><!-- CDN Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartTbu').getContext('2d');

const umurArr = [0, 6, 12, 24, 36, 48, 60];

const sdMinus3_vals = [45, 60, 71, 82, 89, 95, 100];
const sdMinus2_vals = [47, 63, 75, 86, 94, 100, 105];
const sdMinus1_vals = [49, 66, 78, 89, 97, 103, 108];
const sd0_vals      = [51, 68, 80, 92, 100, 106, 112];
const sdPlus1_vals  = [53, 70, 83, 95, 104, 110, 116];
const sdPlus2_vals  = [55, 72, 86, 98, 107, 113, 119];
const sdPlus3_vals  = [57, 75, 89, 101, 110, 116, 122];

// Convert
const pair = (xArr, yArr) => xArr.map((x,i)=>({x,y:yArr[i]}));

const umurAnak = {{ $anak->umur }};
const tinggiAnak = {{ $anak->tinggi_badan }};

new Chart(ctx, {
    type: 'line',
    data: {
        datasets: [
            { label: '-3 SD', data: pair(umurArr, sdMinus3_vals), borderColor: '#d2969bff', borderWidth: 3, pointRadius: 0, tension: 0.3 },
            { label: '-2 SD', data: pair(umurArr, sdMinus2_vals), borderColor: '#d2b196ff', borderWidth: 3, pointRadius: 0, tension: 0.3 },
            { label: '-1 SD', data: pair(umurArr, sdMinus1_vals), borderColor: '#ced296ff', borderWidth: 3, pointRadius: 0, tension: 0.3 },
            { label: 'Median', data: pair(umurArr, sd0_vals),      borderColor: '#61aa52ff', borderWidth: 3, pointRadius: 0, tension: 0.3 },
            { label: '+1 SD', data: pair(umurArr, sdPlus1_vals),   borderColor: '#96c3d2ff', borderWidth: 3, pointRadius: 0, tension: 0.3 },
            { label: '+2 SD', data: pair(umurArr, sdPlus2_vals),   borderColor: '#9f96d2ff', borderWidth: 3, pointRadius: 0, tension: 0.3 },
            { label: '+3 SD', data: pair(umurArr, sdPlus3_vals),   borderColor: '#d296bbff', borderWidth: 3, pointRadius: 0, tension: 0.3 },

            // Titik anak — persegi kecil
            {
                label: 'Anak',
                data: [{ x: umurAnak, y: tinggiAnak }],
                pointStyle: 'rect',
                pointBackgroundColor: 'black',
                pointBorderColor: 'black',
                pointRadius: 6,
                showLine: false
            }
        ]
    },

    options: {
        responsive: true,
        maintainAspectRatio: false,

        plugins: {
            legend: {
                position: 'top',
                labels: {
                    usePointStyle: true,
                    pointStyle: 'circle',
                    boxWidth: 8,
                    boxHeight: 8
                }
            }
        },

        scales: {
            x: { 
                type: 'linear',
                title: { display: true, text: 'Umur (bulan)' },
                min: 0, 
                max: 60
            },
            y: { 
                title: { display: true, text: 'Tinggi Badan (cm)' },
                min: 40, 
                max: 130
            }
        }
    }
});
</script>
@endsection
