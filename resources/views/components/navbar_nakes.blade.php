<nav class="fixed top-0 left-0 w-full bg-[#E9B9C5] shadow-md z-[1000]">
  <div class="flex items-center justify-between px-4 sm:px-6 h-16">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-[45px] w-auto">
      <a href="halaman_nakes">
      <h1 class="text-white font-bold text-xl sm:text-2xl tracking-wider drop-shadow-sm">
        SKINKARE
      </h1>
      </a>
    </div>

    <!-- Menu Desktop -->
    <div class="hidden md:flex text-white items-center space-x-20">
        <a href="halaman_nakes" class="px-4 py-2 rounded-md hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition">
          Beranda
        </a>
      <a href="tambah-data-anak" class="px-4 py-2 font-medium rounded-md hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition duration-300">Periksa Anak</a>
      <a href="data-anak" class="px-4 py-2 font-medium rounded-md hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition duration-300">Data Anak</a>
      <a href="data-wali" class="px-4 py-2 font-medium rounded-md hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition duration-300">Data Orangtua</a>
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
          <div class="px-5 py-4 bg-gradient-to-r from-[#9fc4bb] to-[#147375] text-white rounded-t-lg">
            <div class="font-bold text-lg">Selamat Datang Tenaga Kesehatan</div>
            <div class="text-sm">
        
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

  <!-- Menu Mobile -->
  <div id="mobile-menu"
    class="hidden md:hidden flex flex-col items-center bg-white shadow-md space-y-2 py-4 transition-all duration-300">
     <a href="halaman_nakes" class="block w-full text-center py-2 text-gray-800 hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition">Periksa Anak</a>
    <a href="tambah-data-anak" class="block w-full text-center py-2 text-gray-800 hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition">Periksa Anak</a>
    <a href="data-anak" class="block w-full text-center py-2 text-gray-800 hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition">Data Anak</a>
    <a href="data-wali.index" class="block w-full text-center py-2 text-gray-800 hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition">Data Orangtua</a>
  </div>
</nav>

<script>
  const burgerBtn = document.getElementById('burger-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  const dropdownBtn = document.getElementById('dropdownUserButton');
  const dropdownMenu = document.getElementById('userDropdown');

  // === BURGER MENU ===
  burgerBtn.addEventListener('click', (e) => {
    e.stopPropagation(); // biar gak langsung ketutup
    mobileMenu.classList.toggle('hidden');
    dropdownMenu.classList.add('hidden'); // tutup dropdown kalau burger dibuka
  });

  // === PROFIL DROPDOWN ===
  dropdownBtn.addEventListener('click', (e) => {
    e.stopPropagation(); // cegah auto-close
    dropdownMenu.classList.toggle('hidden');
    mobileMenu.classList.add('hidden'); // tutup burger kalau buka dropdown
  });

  // === TUTUP JIKA KLIK DI LUAR NAV / MENU ===
  document.addEventListener('click', (e) => {
    const klikDiluarBurger = !mobileMenu.classList.contains('hidden') &&
      !mobileMenu.contains(e.target) &&
      !burgerBtn.contains(e.target);

    const klikDiluarDropdown = !dropdownMenu.classList.contains('hidden') &&
      !dropdownMenu.contains(e.target) &&
      !dropdownBtn.contains(e.target);

    if (klikDiluarBurger) mobileMenu.classList.add('hidden');
    if (klikDiluarDropdown) dropdownMenu.classList.add('hidden');
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
