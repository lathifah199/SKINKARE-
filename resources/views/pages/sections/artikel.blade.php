<!-- Bagian Artikel Kesehatan -->
<section id="Artikel" class="py-16 bg-white shadow-lg">
  <div class="max-w-7xl mx-auto px-4">
    <h2 class="text-2xl font-bold text-[#53AFA2] mb-12 text-center tracking-wide">ARTIKEL KESEHATAN</h2>

    <!-- Container tombol navigasi -->
    <div class="relative">
      <!-- Tombol kiri -->
      <button id="prevArticle" class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white hover:bg-[#B9E9DD] text-[#53AFA2] p-3 rounded-full shadow-md hover:shadow-lg transition-all duration-300 disabled:opacity-30">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
      </button>

      <!-- Tombol kanan -->
      <button id="nextArticle" class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white hover:bg-[#B9E9DD] text-[#53AFA2] p-3 rounded-full shadow-md hover:shadow-lg transition-all duration-300 disabled:opacity-30">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
      </button>

      <!-- Track artikel -->
      <div class="overflow-hidden mx-10">
        <div id="artikel-container" class="flex transition-transform duration-500 ease-in-out gap-6">
          <!-- Artikel akan dimuat lewat HTML -->
          <div class="article-card bg-[#D5E8E3] rounded-2xl shadow p-4 flex flex-col items-center">
            <img src="{{ asset('images/artikel/keuangan.png') }}" alt="Artikel" class="w-40 rounded-xl mb-3">
            <h3 class="text-[#3C4A47] font-semibold text-sm text-center mb-1">Solusi Keuangan untuk Ibu dan Bayi</h3>
            <p class="text-xs text-gray-700 font-medium text-center mb-1">Tabulin (Tabungan Ibu Hamil)</p>
            <p class="text-xs text-gray-600 text-center">Pahami pentingnya menyiapkan tabungan demi mencegah stunting.</p>
          </div>

          <div class="article-card bg-[#E9B9C5] rounded-2xl shadow p-4 flex flex-col items-center">
            <img src="{{ asset('images/artikel/makanan.png') }}" alt="Artikel" class="w-40 rounded-xl mb-3">
            <h3 class="text-[#3C4A47] font-semibold text-sm text-center mb-1">Nutrisi Seimbang untuk Anak</h3>
            <p class="text-xs text-gray-700 font-medium text-center mb-1">Penuhi kebutuhan gizi harian</p>
            <p class="text-xs text-gray-600 text-center">Pastikan anak mendapatkan nutrisi cukup dari makanan bergizi.</p>
          </div>

          <div class="article-card bg-[#B9E9DD] rounded-2xl shadow p-4 flex flex-col items-center">
            <img src="{{ asset('images/artikel/tidur.png') }}" alt="Artikel" class="w-40 rounded-xl mb-3">
            <h3 class="text-[#3C4A47] font-semibold text-sm text-center mb-1">Pentingnya Waktu Tidur Anak</h3>
            <p class="text-xs text-gray-700 font-medium text-center mb-1">Kualitas tidur dan tumbuh kembang</p>
            <p class="text-xs text-gray-600 text-center">Tidur cukup membantu meningkatkan daya tahan tubuh anak.</p>
          </div>

          <div class="article-card bg-[#FBE7E8] rounded-2xl shadow p-4 flex flex-col items-center">
            <img src="{{ asset('images/artikel/bermain.png') }}" alt="Artikel" class="w-40 rounded-xl mb-3">
            <h3 class="text-[#3C4A47] font-semibold text-sm text-center mb-1">Peran Bermain untuk Anak</h3>
            <p class="text-xs text-gray-700 font-medium text-center mb-1">Belajar sambil bermain</p>
            <p class="text-xs text-gray-600 text-center">Aktivitas bermain membantu stimulasi otak dan sosial anak.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Dot indikator -->
    <div id="dots-article" class="flex justify-center mt-8 gap-2"></div>
  </div>
</section>

<style>
  /* Ukuran dan layout kartu artikel */
  #artikel-container .article-card {
    min-width: 300px;
    max-width: 300px;
    flex-shrink: 0;
  }

  /* Gaya dot */
  .dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: #d1d5db;
    transition: all 0.3s ease;
    cursor: pointer;
  }

  .dot.active {
    background-color: #53AFA2;
    transform: scale(1.2);
  }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  let currentSlide = 0;
  let slidesToShow = 3;
  const track = document.getElementById('artikel-container');
  const dotsContainer = document.getElementById('dots-article');
  const cards = document.querySelectorAll('.article-card');
  const totalArticles = cards.length;

  function updateSlidesToShow() {
    if (window.innerWidth < 768) slidesToShow = 1;
    else if (window.innerWidth < 1024) slidesToShow = 2;
    else slidesToShow = 3;
  }

  function createDots() {
    dotsContainer.innerHTML = '';
    const totalSlides = Math.max(0, totalArticles - slidesToShow + 1);
    for (let i = 0; i < totalSlides; i++) {
      const dot = document.createElement('div');
      dot.className = `dot ${i === currentSlide ? 'active' : ''}`;
      dot.addEventListener('click', () => goToSlide(i));
      dotsContainer.appendChild(dot);
    }
  }

  function updateSliderPosition() {
    const translateX = -currentSlide * (300 + 24);
    track.style.transform = `translateX(${translateX}px)`;
    document.querySelectorAll('#dots-article .dot').forEach((dot, i) => {
      dot.classList.toggle('active', i === currentSlide);
    });
  }

  function goToSlide(index) {
    const maxSlide = Math.max(0, totalArticles - slidesToShow);
    currentSlide = Math.max(0, Math.min(index, maxSlide));
    updateSliderPosition();
    updateNav();
  }

  function updateNav() {
    document.getElementById('prevArticle').disabled = currentSlide <= 0;
    document.getElementById('nextArticle').disabled = currentSlide >= totalArticles - slidesToShow;
  }

  document.getElementById('nextArticle').addEventListener('click', () => goToSlide(currentSlide + 1));
  document.getElementById('prevArticle').addEventListener('click', () => goToSlide(currentSlide - 1));

  window.addEventListener('resize', () => {
    updateSlidesToShow();
    currentSlide = 0;
    updateSliderPosition();
    createDots();
  });

  updateSlidesToShow();
  createDots();
  updateSliderPosition();
  updateNav();
});
</script>
