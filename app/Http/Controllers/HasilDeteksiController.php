@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-50 to-emerald-50 py-16 flex flex-col items-center">
    @include('components.navbar')

    <div class="bg-white rounded-3xl shadow-xl border border-pink-100 p-8 w-full max-w-5xl">
        <h1 class="text-2xl font-bold text-center text-pink-500 mb-8">Hasil Deteksi Dini Kesehatan Anak</h1>

        <!-- Data Anak - tetap sama -->
        <!-- ... -->

        <!-- Status utama - tetap sama -->
        <!-- ... -->

        <!-- Indeks antropometri (scroll horizontal) -->
        <div class="overflow-x-auto pb-4 mb-10">
            <div class="flex gap-6 min-w-max px-2">
                @php
                    $cards = [
                        ['label'=>'BB/U', 'key'=>'bbu', 'z_key'=>'z_bbu', 'color'=>'#f9a8d4'],  // Pink pastel
                        ['label'=>'TB/U', 'key'=>'tbu', 'z_key'=>'z_tbu', 'color'=>'#6ee7b7'],  // Tosca pastel
                        ['label'=>'BB/TB', 'key'=>'bbtb', 'z_key'=>'z_bbtb', 'color'=>'#86efac'], // Tosca lebih terang
                        ['label'=>'IMT/U', 'key'=>'imtu', 'z_key'=>'z_imtu', 'color'=>'#fbcfe8'], // Pink lebih terang
                    ];
                @endphp

                @foreach ($cards as $c)
                    <div class="flex-none bg-white border border-pink-100 rounded-2xl shadow-md w-64 p-5 text-center hover:shadow-lg transition-shadow duration-300">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">{{ $c['label'] }}</h3>
                        <canvas id="chart_{{ $c['key'] }}"></canvas>
                        <p class="mt-3 text-gray-700 font-medium">{{ $hasil[$c['key']] ?? '-' }}</p>  <!-- Kategori -->
                        <p class="text-sm text-gray-500">Z-Score: {{ $hasil[$c['z_key']] ?? 0 }}</p>  <!-- Z-score numerik -->
                    </div>
                @endforeach
            </div>
        </div>

        <!-- IMT - tetap sama -->
        <!-- ... -->

        <!-- Rekomendasi & Pencegahan - tetap sama -->
        <!-- ... -->
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
@php
    $colors = ['#f9a8d4','#6ee7b7','#86efac','#fbcfe8'];  // Pink dan tosca pastel
    $keys = ['bbu','tbu','bbtb','imtu'];
@endphp

@foreach($keys as $i => $key)
new Chart(document.getElementById('chart_{{ $key }}'), {
    type: 'bar',
    data: {
        labels: ['{{ strtoupper($key) }}'],
        datasets: [{
            label: 'Z-Score {{ strtoupper($key) }}',
            data: [{{ $hasil['z_' . $key] ?? 0 }}],  // Gunakan Z-score numerik
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