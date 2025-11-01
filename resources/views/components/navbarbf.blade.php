<nav class="fixed top-0 left-0 w-full bg-[#E9B9C5] shadow-md z-[1000]">
  <div class="flex items-center justify-between px-4 sm:px-8 h-16">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-[45px] w-auto">
      <h1 class="text-white font-bold text-xl sm:text-2xl tracking-wider drop-shadow-sm">
        SKINKARE
      </h1>
    </div>

    <!-- Menu Desktop (tengah) -->
    <div class="hidden md:flex flex-1 justify-center">
      <div class="flex items-center space-x-12 text-white font-medium">
        <a href="halamanbf" class="px-4 py-2 rounded-md hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition">
          Beranda
        </a>
        <a href="login" class="px-4 py-2 rounded-md hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition">
          Pertumbuhan Anak
        </a>
        <a href="informasiortubf" class="px-4 py-2 rounded-md hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition">
          Informasi Kesehatan
        </a>
      </div>
    </div>

    <!-- Burger + Login -->
    <div class="flex items-center space-x-3">
      <!-- Burger (mobile) -->
      <button id="burger-btn" class="md:hidden text-white focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-7 h-7">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <!-- Tombol Login (desktop) -->
      <a href="{{ route('login') }}"
        class="hidden md:inline-block px-5 py-2 bg-white text-[#E9B9C5] font-semibold rounded-lg hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition">
        Login
      </a>
    </div>
  </div>

  <!-- Overlay -->
  <div id="overlay" class="hidden fixed inset-0 bg-black bg-opacity-40 z-[999]"></div>

  <!-- Sidebar Mobile -->
  <div id="sidebar"
    class="fixed top-0 left-0 h-full w-64 bg-[#E9B9C5] shadow-lg transform -translate-x-full transition-transform duration-300 z-[1000]">
    <div class="flex justify-between items-center px-4 py-4">
      <h2 class="text-white font-bold text-xl">SKINKARE</h2>
      <button id="close-sidebar" class="text-white text-2xl font-bold">&times;</button>
    </div>
<nav class="flex flex-col space-y-4 mt-4 px-6">
  <a href="halamanbf" class="text-white font-medium border-b border-white pb-1 hover:text-[#B9E9DD] hover:border-[#B9E9DD] transition duration-300">Beranda</a>
  <a href="login" class="text-white font-medium border-b border-white pb-1 hover:text-[#B9E9DD] hover:border-[#B9E9DD] transition duration-300">Pertumbuhan Anak</a>
  <a href="informasiortubf" class="text-white font-medium border-b border-white pb-1 hover:text-[#B9E9DD] hover:border-[#B9E9DD] transition duration-300">Informasi Kesehatan</a>
</nav>

  </div>
</nav>

<script>
  const burgerBtn = document.getElementById('burger-btn');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');
  const closeSidebar = document.getElementById('close-sidebar');

  // === BURGER MENU (SIDEBAR) ===
  burgerBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    sidebar.classList.remove('-translate-x-full');
    overlay.classList.remove('hidden');
  });

  closeSidebar.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
  });

  overlay.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
  });
</script>
