
   <!-- Profil Anak Section -->
    <section id="tambah_anak">
  <div class="bg-[#53AFA2] text-white px-5 py-4 rounded-b-3xl">
    <h1 class="text-lg font-semibold">Profil Anak</h1>
  </div>

  <div class="flex justify-center space-x-4 mt-5 px-4">
    <!-- Kartu Anak -->
    <div class="bg-[#E9B9C5] w-40 h-24 rounded-2xl shadow-md p-3 flex flex-col justify-between">
      <div class="flex items-center space-x-2">
        <img src="/images/anakpr.png" alt="Anak" class="w-10 h-10 rounded-full bg-white p-1">
        <div>
          <p class="text-base font-semibold text-white">amey</p>
          <p class="text-xs text-white/90">16 Hari</p>
        </div>
      </div>
    </div>

    <!-- Tambah Anak -->
    <a href="{{ route('login') }}">
  <div class="bg-white w-40 h-24 rounded-2xl shadow-md flex flex-col justify-center items-center border border-[#53AFA2] hover:bg-[#B9E9DD] transition">
      <div class="bg-[#53AFA2] text-white w-8 h-8 flex items-center justify-center rounded-full mb-1">+</div>
      <p class="text-sm text-[#53AFA2] font-semibold">Tambah Anak</p>
  </div>
    </a>
  </div>
