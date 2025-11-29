<div class="bg-[#E9B9C5] p-4 flex items-center justify-between rounded-b-3xl shadow"> <!-- Kiri: Tombol Back + Profil Anak --> 
  <div class="flex items-center space-x-3"> <!-- Tombol Back --> 
    <button> </button>
      <!-- Tombol Back -->
      <button onclick="window.history.back()" class="focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 hover:text-gray-900 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>

      <!-- Foto & Info Anak -->
      @if(isset($anak))
        <img src="{{ asset('images/anakpr.png') }}" alt="Foto Anak" class="w-10 h-10 rounded-full object-cover">
        <div>
          <h2 class="font-semibold text-gray-800">{{ $anak->nama_lengkap }}</h2>
          <p class="text-gray-600 text-sm">{{ $anak->umur }} Bulan</p>
        </div>
      @else
        <div class="text-gray-500 text-sm">Tidak ada data anak</div>
      @endif
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

        <!-- Isi Dropdown Profil -->
        <div id="userDropdown"
          class="hidden absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg border border-gray-200 z-[9999]">
          <div class="px-5 py-4 bg-gradient-to-r from-[#E9B9C5] to-[#be6178] text-white rounded-t-lg">
            <div class="font-bold text-lg">Selamat Datang,</div>
            <div class="text-sm mt-1">
              @if(Auth::guard('orangtua')->check())
                <p><strong>Nama:</strong> {{ Auth::guard('orangtua')->user()->nama }}</p>
                <p><strong>Email:</strong> {{ Auth::guard('orangtua')->user()->email }}</p>
                <p><strong>No HP:</strong> {{ Auth::guard('orangtua')->user()->no_hp }}</p>
              @endif
            </div>
          </div>

          <div class="py-2 px-2 bg-white rounded-b-lg">
            <a href="{{ route('profil') }}"
              class="block w-full text-sm font-medium text-white bg-blue-950 px-4 py-2 rounded mb-2 text-center">
              Lihat Profil
            </a>
            <button type="button" onclick="confirmLogout(event)"
              class="block w-full text-sm font-medium text-white bg-red-800 px-4 py-2 rounded text-center">
              Keluar
            </button>

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
      <h2 class="text-white font-bold text-xl">Menu</h2>
      <button id="close-sidebar" class="text-white text-2xl font-bold">&times;</button>
    </div>

    <!-- Tombol Edit Data Anak -->
    @if(isset($anak))
    <div class="px-6">
      <a href="{{ route('anak.edit', $anak->id) }}"
        class="block text-center bg-white text-[#E9B9C5] font-semibold rounded-full py-2 mb-3 shadow hover:bg-[#fdf4f6] transition">
        ✏️ Edit Data Anak
      </a>
    </div>
    @endif

    <nav class="flex flex-col space-y-4 mt-2 px-6">
      <a href="halaman_orangtua" class="text-white font-medium border-b border-white pb-1 hover:text-[#B9E9DD] hover:border-[#B9E9DD] transition duration-300">Beranda</a>
      <a href="pertumbuhan" class="text-white font-medium border-b border-white pb-1 hover:text-[#B9E9DD] hover:border-[#B9E9DD] transition duration-300">Pertumbuhan Anak</a>
      <a href="informasiortu" class="text-white font-medium border-b border-white pb-1 hover:text-[#B9E9DD] hover:border-[#B9E9DD] transition duration-300">Informasi Kesehatan</a>
    </nav>
  </div>
</nav>

<!-- === SCRIPT === -->
<script>
  const burgerBtn = document.getElementById('burger-btn');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');
  const closeSidebar = document.getElementById('close-sidebar');
  const dropdownBtn = document.getElementById('dropdownUserButton');
  const dropdownMenu = document.getElementById('userDropdown');

  // === BURGER MENU ===
  burgerBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    sidebar.classList.remove('-translate-x-full');
    overlay.classList.remove('hidden');
    dropdownMenu.classList.add('hidden');
  });

  closeSidebar.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
  });

  overlay.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
    dropdownMenu.classList.add('hidden');
  });

  // === DROPDOWN PROFIL ===
  dropdownBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    dropdownMenu.classList.toggle('hidden');
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
  });

  document.addEventListener('click', (e) => {
    if (!dropdownMenu.contains(e.target) && !dropdownBtn.contains(e.target)) {
      dropdownMenu.classList.add('hidden');
    }
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
