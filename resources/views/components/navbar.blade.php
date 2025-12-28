<nav class="fixed top-0 left-0 w-full bg-[#E9B9C5] shadow-md z-[1000] pointer-events-auto">
  <div class="flex items-center justify-between px-4 sm:px-6 h-16">
    <!-- Logo -->
    <div class="flex items-center gap-2 min-w-0">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-9 sm:h-11 w-auto shrink-0">
        <h1 class="text-white font-bold text-lg sm:text-xl tracking-wide truncate">
          SKINKARE
        </h1>
    </div>

    <!-- Menu Desktop -->
    <div class="hidden md:flex text-white items-center space-x-20">
      <a href="{{ route('halaman_orangtua') }}" class="px-4 py-2 font-medium rounded-md hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition">Beranda</a>
      <!--<a href="{{ route('pertumbuhan') }}" class="px-4 py-2 font-medium rounded-md hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition">Pertumbuhan Anak</a>-->
      <a href="{{ route('informasiortu') }}" class="px-4 py-2 font-medium rounded-md hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition">Informasi Kesehatan</a>
    </div>

    <!-- Burger + Profil -->
    <div class="flex items-center space-x-3">
      <!-- Burger -->
      <button id="burger-btn" class="md:hidden text-white focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-7 h-7">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <!-- Profil -->
      <div class="relative">
        <button id="dropdownUserButton" class="flex text-sm rounded-full focus:ring-4 focus:ring-gray-300">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#fff" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
            <path fill-rule="evenodd"
              d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
          </svg>
        </button>

  <!-- Dropdown User -->
<div id="userDropdown"
  class="hidden absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-xl border border-gray-200
  z-[9999] overflow-hidden animate-fadeIn">

  <!-- Header Dropdown -->
  <div class="px-5 py-4 bg-gradient-to-r from-[#E9B9C5] to-[#be6178] text-white">
    <div class="font-semibold text-lg">
      Selamat Datang,
      @if(Auth::guard('orangtua')->check())
        <span class="block text-base font-light mt-1">
          {{ Auth::guard('orangtua')->user()->nama }}
        </span>
      @endif
    </div>
  </div>

  <!-- Isi Dropdown -->
  <div class="py-3 px-3 bg-white">
    <a href="profil"
      class="block w-full text-sm font-medium text-center text-white bg-[#53AFA2] hover:bg-[#469488]
      px-4 py-2 rounded-full transition-all duration-300 shadow-sm mb-2">
      <i class="fa-solid fa-user me-1"></i> Lihat Profil
    </a>

    <button type="button"
      onclick="document.getElementById('logout-form').submit();"
      class="block w-full text-sm font-medium text-center text-white bg-[#be6178] hover:bg-[#a55269]
      px-4 py-2 rounded-full transition-all duration-300 shadow-sm">
      <i class="fa-solid fa-right-from-bracket me-1"></i> Keluar
    </button>

      <!-- FORM LOGOUT -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
      @csrf
    </form>
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
      <a href="{{ route('halaman_orangtua') }}" class="text-white font-medium border-b border-white pb-1 hover:text-[#B9E9DD] hover:border-[#B9E9DD] transition duration-300">Beranda</a>
      <!--<a href="{{ route('pertumbuhan') }}" class="text-white font-medium border-b border-white pb-1 hover:text-[#B9E9DD] hover:border-[#B9E9DD] transition duration-300">Pertumbuhan Anak</a>-->
      <a href="{{ route('informasiortu') }}" class="text-white font-medium border-b border-white pb-1 hover:text-[#B9E9DD] hover:border-[#B9E9DD] transition duration-300">Informasi Kesehatan</a>
    </nav>
  </div>
</nav>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
   @csrf
</form>
<script>
  const burgerBtn = document.getElementById('burger-btn');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');
  const closeSidebar = document.getElementById('close-sidebar');

  const dropdownBtn = document.getElementById('dropdownUserButton');
  const dropdownMenu = document.getElementById('userDropdown');

  // === BURGER MENU (SIDEBAR) ===
  burgerBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    sidebar.classList.remove('-translate-x-full');
    overlay.classList.remove('hidden');
    dropdownMenu.classList.add('hidden'); // tutup dropdown kalau buka sidebar
  });

  closeSidebar.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
  });

  overlay.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
    dropdownMenu.classList.add('hidden'); // tutup dropdown juga kalau klik overlay
  });

  // === PROFIL DROPDOWN ===
  dropdownBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    dropdownMenu.classList.toggle('hidden');
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
  });

  // === AUTO CLOSE PROFIL DROPDOWN SAAT KLIK DI LUAR ===
  document.addEventListener('click', (e) => {
    const klikDiluarDropdown =
      !dropdownMenu.classList.contains('hidden') &&
      !dropdownMenu.contains(e.target) &&
      !dropdownBtn.contains(e.target);

    if (klikDiluarDropdown) {
      dropdownMenu.classList.add('hidden');
    }
  });

  // === LOGOUT KONFIRMASI ===
  function confirmLogout(event) {
    event.preventDefault();
    Swal.fire({
      title: 'Yakin keluar?',
      text: 'Anda akan keluar dari akun Anda.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Ya, keluar',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) document.getElementById('logout-form').submit();
    });
  }
</script>