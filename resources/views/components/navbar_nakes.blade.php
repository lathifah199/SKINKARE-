<nav class="fixed top-0 left-0 w-full bg-[#E9B9C5] shadow-md z-[1000]">
  <div class="flex items-center justify-between px-4 sm:px-6 h-16">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-[45px] w-auto">
        <h1 class="text-white font-bold text-xl sm:text-2xl tracking-wider drop-shadow-sm">
          SKINKARE
        </h1>
    </div>

    <!-- Menu Desktop -->
    <div class="hidden md:flex text-white items-center space-x-20">
 <a href="halaman_nakes" class="px-4 py-2 rounded-md hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition">Beranda</a>
      <a href="tambah-data-anak" class="px-4 py-2 font-medium rounded-md hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition">Periksa Anak</a>
      <a href="data-anak" class="px-4 py-2 font-medium rounded-md hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition">Data Anak</a>
      <a href="data-wali" class="px-4 py-2 font-medium rounded-md hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition">Data Orangtua</a>
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

        <div id="userDropdown"
          class="hidden absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg border border-gray-200 z-[9999]">
          <div class="px-5 py-4 bg-gradient-to-r from-[#E9B9C5] to-[#be6178] text-white rounded-t-lg">
            <div class="font-bold text-lg">Selamat Datang, </div>
            <div class="text-sm">
              @if(Auth::guard('nakes')->check())
              <p><strong>Email:</strong> {{ Auth::guard('nakes')->user()->email }}</p>
              @endif
            </div>
          </div>

          <div class="py-2 px-2 bg-white rounded-b-lg">
            <a href="profil" class="block w-full text-sm font-medium text-white bg-blue-950 px-4 py-2 rounded mb-2 text-center">Lihat Profil</a>
            <button type="button"
              onclick="document.getElementById('logout-form').submit();"
              class="block w-full text-sm font-medium text-white bg-red-800 px-4 py-2 rounded text-center">
              Keluar
            </button>

            <!-- FORM LOGOUT -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
              @csrf
            </form>
          </div>
        </div>
      </div>
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
      <a href="halaman_nakes" class="text-white font-medium border-b border-white pb-1 hover:text-[#B9E9DD] hover:border-[#B9E9DD] transition duration-300">Beranda</a>
    <a href="tambah-data-anak" class="text-white font-medium border-b border-white pb-1 hover:text-[#B9E9DD] hover:border-[#B9E9DD] transition duration-300">Periksa Anak</a>
    <a href="data-anak" class="text-white font-medium border-b border-white pb-1 hover:text-[#B9E9DD] hover:border-[#B9E9DD] transition duration-300">Data Anak</a>
    <a href="data-wali" class="text-white font-medium border-b border-white pb-1 hover:text-[#B9E9DD] hover:border-[#B9E9DD] transition duration-300">Data Orangtua</a>
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
