<!-- Menu Periksa Anak -->
<div class="flex justify-center mt-6">
  <div class="w-80 h-28 rounded-3xl shadow-md overflow-hidden border border-gray-300 flex">
    
    <!-- Bagian kiri (warna tosca) -->
    <div class="bg-[#B9E9DD] w-1/3 flex items-center justify-center rounded-l-3xl">
      <img src="{{ asset('images/pertumbuhan.png') }}" alt="Anak" class="w-16 h-16 bg-[#EAD9F7] rounded-full p-3">
    </div>

    <!-- Bagian kanan (putih) langsung jadi link -->
    <a href="{{ route('tambah.data.anak') }}" class="bg-white w-2/3 flex flex-col justify-center items-center border border-[#53AFA2] hover:bg-[#B9E9DD] transition rounded-r-3xl">
      <div class="bg-[#53AFA2] text-white w-8 h-8 flex items-center justify-center rounded-full mb-1">+</div>
      <p class="text-sm text-[#53AFA2] font-semibold">Tambah Periksa Anak</p>
    </a>

  </div>
</div>
