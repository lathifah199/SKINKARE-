@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-50 to-emerald-50 py-16 flex flex-col items-center">
    @include('components.navbar')

    <div class="bg-white rounded-3xl shadow-xl border border-pink-100 p-8 w-full max-w-5xl">
        <h1 class="text-2xl font-bold text-center text-pink-500 mb-8">Hasil Deteksi Dini Kesehatan Anak</h1>

        <!-- Data Anak -->
        <div class="bg-pink-100/50 rounded-2xl p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-700 mb-3 border-b border-pink-200 pb-1">Data Anak</h2>
            <div class="grid grid-cols-2 gap-y-2 text-gray-700 text-sm">
                <p><strong>Nama</strong></p><p>: {{ $anak->nama_lengkap }}</p>
                <p><strong>Jenis Kelamin</strong></p>
                <p>:
                    @if($anak->jenis_kelamin === 'L')
                        Laki-laki (L)
                    @elseif($anak->jenis_kelamin === 'P')
                        Perempuan (P)
                    @else
                        {{ $anak->jenis_kelamin }}
                    @endif
                </p>
                <p><strong>Umur</strong></p><p>: {{ $anak->umur }} bulan</p>
                <p><strong>Tempat Lahir</strong></p><p>: {{ $anak->tempat_lahir }}</p>
                <p><strong>Tanggal Lahir</strong></p>
                <p>: {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->translatedFormat('d F Y') }}</p>
            </div>
        </div>

        <!-- Status utama -->
        <div class="bg-gradient-to-r from-pink-100 to-emerald-100 border border-pink-200 rounded-2xl p-6 mb-8 text-center">
            <h2 class="text-xl font-semibold text-pink-600 mb-3">Status Utama</h2>
            <p class="text-lg font-bold 
                {{ Str::contains(strtolower($hasil['status']), 'normal') ? 'text-emerald-600' : 'text-pink-600' }}">
                {{ $hasil['status'] ?? 'Tidak diketahui' }}
            </p>
            <p class="text-gray-700 text-base">
                <strong>Risiko Stunting (TB/U):</strong> {{ $hasil['persentase_stunting'] ?? 0 }}%
            </p>
            <p class="text-sm text-gray-600 mt-2 italic">
                Berdasarkan analisis indeks <strong>Tinggi Badan menurut Umur (TB/U)</strong>
                menggunakan metode <strong>Random Forest AI</strong>.
            </p>
        </div>

        <!-- Indeks antropometri (scroll horizontal) -->
        <div class="overflow-x-auto pb-4 mb-10">
            <div class="flex gap-6 min-w-max px-2">
                @php
                    $cards = [
                        ['label'=>'BB/U', 'color'=>'#f9a8d4', 'value'=>$hasil['bbu'] ?? '-'],
                        ['label'=>'TB/U', 'color'=>'#6ee7b7', 'value'=>$hasil['tbu'] ?? '-'],
                        ['label'=>'BB/TB', 'color'=>'#86efac', 'value'=>$hasil['bbtb'] ?? '-'],
                        ['label'=>'IMT/U', 'color'=>'#fbcfe8', 'value'=>$hasil['imtu'] ?? '-'],
                    ];
                @endphp

                @foreach ($cards as $c)
                    <div class="flex-none bg-white border border-pink-100 rounded-2xl shadow-md w-64 p-5 text-center hover:shadow-lg transition-shadow duration-300">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">{{ $c['label'] }}</h3>
                        <canvas id="chart_{{ $c['label'] }}"></canvas>
                        <p class="mt-3 text-gray-700 font-medium">{{ $c['value'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- IMT -->
        <div class="bg-pink-50 border border-pink-100 rounded-2xl p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Indeks Massa Tubuh (IMT)</h2>
            <p class="text-gray-600">Nilai IMT anak: <strong>{{ $hasil['imt'] ?? 0 }}</strong></p>
        </div>

        <!-- Rekomendasi & Pencegahan -->
        <div class="bg-gradient-to-br from-pink-50 to-emerald-50 border border-pink-100 rounded-2xl p-6 text-gray-700">
            <h3 class="text-lg font-semibold text-pink-600 mb-3">💡 Rekomendasi & Pencegahan</h3>
            @if(!empty($hasil['rekomendasi']))
                <ul class="list-disc pl-6 space-y-1 text-gray-700 text-sm">
                    @foreach ($hasil['rekomendasi'] as $r)
                        <li>{{ $r }}</li>
                    @endforeach
                </ul>
            @else
                <p>Tidak ada rekomendasi spesifik.</p>
            @endif
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
@php
    $colors = ['#f472b6','#10b981','#34d399','#ec4899'];
    $labels = ['BB/U','TB/U','BB/TB','IMT/U'];
@endphp

@foreach($labels as $i => $label)
new Chart(document.getElementById('chart_{{ $label }}'), {
    type: 'bar',
    data: {
        labels: ['{{ $label }}'],
        datasets: [{
            label: 'Indeks {{ $label }}',
            data: [{{ $hasil['imt'] ?? 0 }}], // sementara pakai nilai IMT numerik, bisa diganti Z-score dari Flask
            backgroundColor: '{{ $colors[$i] }}',
            borderRadius: 8,
        }]
    },
    options: {
        indexAxis: 'y',
        plugins: { legend: { display: false } },
        scales: {
            x: { beginAtZero: true, grid: { color: '#f3f4f6' } },
            y: { ticks: { color: '#374151' } }
        }
    }
});
@endforeach
</script>
@endsection