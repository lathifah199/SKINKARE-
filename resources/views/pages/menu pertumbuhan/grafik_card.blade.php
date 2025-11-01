<div class=" max-w-4xl mx-auto px-4 mt-10">
  <!-- Card Grafik -->
  <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
    <!-- Header -->
    <div class="bg-[#B9E9DD] p-6 text-center">
      <h3 class="font-bold text-gray-800 text-xl md:text-2xl mb-2">Tinggi Badan Sesuai Usia</h3>
      <p class="text-gray-700 text-sm md:text-base">100.0 cm / 0 Hari</p>
    </div>

    <!-- Content -->
    <div class="p-6 md:p-8">
      <div class="flex items-center justify-center mb-4">
        <h4 class="font-semibold text-gray-700 text-lg">Grafik WHO</h4>
      </div>

      <!-- Chart Container -->
      <div class="relative w-full" style="height: 300px;">
        <canvas id="growthChart"></canvas>
      </div>

      <!-- Legend -->
      <div class="flex items-center justify-center mt-6 gap-2">
        <span class="text-[#2A8C7E] font-bold text-xl">●</span>
        <p class="text-gray-700 font-medium">Laju Pertumbuhan</p>
      </div>
    </div>
  </div>
</div>


<script>
  const ctx = document.getElementById('growthChart');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['0', '1', '2', '3', '4', '5', '6'],
      datasets: [{
        label: 'Laju Pertumbuhan',
        data: [100, 102, 104, 107, 109, 111, 114],
        borderColor: '#2A8C7E',
        backgroundColor: 'rgba(185, 233, 221, 0.2)',
        tension: 0.4,
        fill: true,
        pointRadius: 5,
        pointHoverRadius: 7,
        pointBackgroundColor: '#2A8C7E',
        pointBorderColor: '#fff',
        pointBorderWidth: 2,
        borderWidth: 3
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Tinggi (cm)',
            font: { size: 14, weight: 'bold' },
            color: '#374151'
          },
          grid: {
            color: 'rgba(0, 0, 0, 0.05)'
          },
          ticks: {
            color: '#6B7280',
            font: { size: 12 }
          }
        },
        x: {
          title: {
            display: true,
            text: 'Usia (Bulan)',
            font: { size: 14, weight: 'bold' },
            color: '#374151'
          },
          grid: {
            color: 'rgba(0, 0, 0, 0.05)'
          },
          ticks: {
            color: '#6B7280',
            font: { size: 12 }
          }
        }
      },
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: 'rgba(42, 140, 126, 0.9)',
          titleColor: '#fff',
          bodyColor: '#fff',
          padding: 12,
          displayColors: false,
          callbacks: {
            label: function(context) {
              return 'Tinggi: ' + context.parsed.y + ' cm';
            }
          }
        }
      }
    }
  });
</script>