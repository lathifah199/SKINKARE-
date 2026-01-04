<!-- Menu Section -->
<div class="bg-[#E9B9C5]/30 p-4 mt-4 text-center">
  <div class="flex flex-wrap justify-center gap-6 mt-6">

    <!-- Orang Tua -->
    <a href="{{ route('informasiortu') }}" class="flex flex-col items-center w-24 sm:w-28">
      <div class="bg-white w-16 h-16 sm:w-20 sm:h-20 rounded-2xl shadow-md flex items-center justify-center border hover:bg-[#B9E9DD] transition">
        <img src="{{ asset('images/orangtua.png') }}" alt="Ibu" class="w-8 h-8 sm:w-10 sm:h-10">
      </div>
      <p class="text-xs sm:text-sm font-medium mt-2 text-center">Orang Tua</p>
    </a>

    <!-- Riwayat -->
    <a href="{{ route('riwayat.anak') }}" class="flex flex-col items-center w-24 sm:w-28">
      <div class="bg-white w-16 h-16 sm:w-20 sm:h-20 rounded-2xl shadow-md flex items-center justify-center border hover:bg-[#B9E9DD] transition">
        <img src="{{ asset('images/riwayat.png') }}" alt="Lingkungan" class="w-8 h-8 sm:w-10 sm:h-10">
      </div>
      <p class="text-xs sm:text-sm font-medium mt-2 text-center">Riwayat</p>
    </a>

  </div>
</div>
