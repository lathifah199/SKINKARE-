<div class="bg-[#E9B9C5]/30 rounded-2xl shadow-md p-4 mx-4 mt-5 text-center">
    <h3 class="font-semibold text-gray-700 mb-1">Tinggi Badan Sesuai Usia</h3>
    <p class="text-sm text-gray-500 mb-3">100.0 cm / 0 Hari</p>

    <h4 class="font-semibold text-gray-600 mb-2">Grafik WHO</h4>

    {{-- Grafik --}}
    <canvas id="growthChart" class="w-full h-48"></canvas>

    <p class="mt-2 text-sm text-gray-700"><span class="text-blue-600 font-semibold">●</span> Laju Pertumbuhan</p>
</div>

    <div class="flex justify-center mt-6 mb-10">
        <button class="bg-[#2A8C7E] text-white font-semibold px-8 py-2 rounded-xl shadow hover:bg-[#256d63] transition">
            Tambah Data
        </button>
    </div>
{{-- Chart.js Script --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('growthChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['0', '1', '2', '3'],
            datasets: [{
                label: 'Laju Pertumbuhan',
                data: [100, 102, 104, 107],
                borderColor: '#2A8C7E',
                backgroundColor: '#B9E9DD',
                tension: 0.4,
                fill: false,
                pointRadius: 4,
                pointBackgroundColor: '#2A8C7E'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'Tinggi (cm)' } },
                x: { title: { display: true, text: 'Usia (Bulan)' } }
            },
            plugins: { legend: { display: false } }
        }
    });
</script>
