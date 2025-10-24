<!-- === NAVBAR PROFIL === -->
<div class="bg-[#E9B9C5] p-4 flex items-center justify-between rounded-b-3xl shadow">
  <!-- Kiri: Tombol Back + Profil Anak -->
  <div class="flex items-center space-x-3">
    <!-- Tombol Back -->
    <button>
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
    </button>

    <!-- Foto & Info Anak -->
    <img src="{{ asset('images/anakpr.png') }}" alt="Foto Anak" class="w-10 h-10 rounded-full">
    <div>
      <h2 class="font-semibold text-gray-800">Amey</h2>
      <p class="text-gray-500 text-sm">23 Hari</p>
    </div>
  </div>

  <!-- Kanan: Burger + Profil -->
  <div class="flex items-center space-x-3">
    <!-- Burger Menu -->
    <button id="burger-btn" class="md:hidden text-gray-700 focus:outline-none">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
        class="w-7 h-7">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <!-- Profil Dropdown -->
    <div class="relative">
      <!-- Tombol Profil -->
      <button id="dropdownUserButton" class="flex text-sm rounded-full focus:ring-4 focus:ring-gray-300">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#555"
          class="bi bi-person-circle" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
          <path fill-rule="evenodd"
            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 
              11.37C3.242 11.226 4.805 10 8 10s4.757 
              1.225 5.468 2.37A7 7 0 0 0 8 1" />
        </svg>
      </button>

      <!-- Isi Dropdown -->
      <div id="userDropdown"
        class="hidden absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg border border-gray-200 z-[9999]">
        <!-- Header Dropdown -->
        <div class="px-5 py-4 bg-gradient-to-r from-[#E9B9C5] to-[#219FE3] text-white rounded-t-lg">
          <div class="font-bold text-lg">Selamat Datang Tenaga Kesehatan,</div>
          <div class="text-sm mt-1">
            @if(Auth::guard('')->check())
            <p><strong>Nama:</strong> {{ Auth::guard('penyewa')->user()->nama_penyewa }}</p>
            <p><strong>Email:</strong> {{ Auth::guard('penyewa')->user()->email }}</p>
            <p><strong>No HP:</strong> {{ Auth::guard('penyewa')->user()->nomor_telepon }}</p>
            @endif
          </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="py-2 px-2 bg-white rounded-b-lg">
          <a href="#"
            class="block w-full text-sm font-medium text-white bg-blue-950 px-4 py-2 rounded mb-2 text-center">
            Edit Profil
          </a>
          <a href="#" onclick="confirmLogout(event)"
            class="block w-full text-sm font-medium text-white bg-red-800 px-4 py-2 rounded text-center">
            Keluar
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- === MENU MOBILE === -->
<div id="mobile-menu"
  class="hidden md:hidden flex flex-col items-center bg-white shadow-md space-y-2 py-4 transition-all duration-300">
  <a href="tambah-data-anak"
    class="block w-full text-center py-2 text-gray-800 hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition">
    Periksa Anak
  </a>
  <a href="data-anak"
    class="block w-full text-center py-2 text-gray-800 hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition">
    Data Anak
  </a>
  <a href="data-wali"
    class="block w-full text-center py-2 text-gray-800 hover:bg-[#B9E9DD] hover:text-[#53AFA2] transition">
    Data Orangtua
  </a>
</div>

<!-- === SCRIPT NAVBAR === -->
<script>
  const burgerBtn = document.getElementById('burger-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  const dropdownBtn = document.getElementById('dropdownUserButton');
  const dropdownMenu = document.getElementById('userDropdown');

  // === BURGER MENU ===
  burgerBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    mobileMenu.classList.toggle('hidden');
    dropdownMenu.classList.add('hidden');
  });

  // === PROFIL DROPDOWN ===
  dropdownBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    dropdownMenu.classList.toggle('hidden');
    mobileMenu.classList.add('hidden');
  });

  // === TUTUP SAAT KLIK DI LUAR ===
  document.addEventListener('click', (e) => {
    const klikDiluarBurger =
      !mobileMenu.classList.contains('hidden') &&
      !mobileMenu.contains(e.target) &&
      !burgerBtn.contains(e.target);

    const klikDiluarDropdown =
      !dropdownMenu.classList.contains('hidden') &&
      !dropdownMenu.contains(e.target) &&
      !dropdownBtn.contains(e.target);

    if (klikDiluarBurger) mobileMenu.classList.add('hidden');
    if (klikDiluarDropdown) dropdownMenu.classList.add('hidden');
  });

  // === KONFIRMASI LOGOUT ===
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
