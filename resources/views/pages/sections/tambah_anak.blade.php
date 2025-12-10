<!-- Profil Anak Section -->
<section id="tambah_anak">
  <div class="bg-[#53AFA2]/65 text-white px-5 py-4 rounded-b-3xl">
    <h1 class="text-lg font-bold">Profil Anak</h1>
  </div>

  <!-- Wrapper scroll horizontal -->
  <div class="overflow-x-auto mt-5 px-4 pb-3">
    <!-- Flex container untuk menengah dan desktop -->
    <div class="flex justify-center space-x-4 min-w-max">
      
      <!-- Loop Data Anak -->
      @forelse ($anak as $a)
       <a href="{{ route('scan.hasil', ['id' => $a->id]) }}">
        <div class="bg-[#E9B9C5] w-40  h-[100px] rounded-2xl shadow-md p-3 flex flex-col justify-between flex-shrink-0">
          <div class="flex items-center space-x-2">
            @if ($a->foto)
              <img src="{{ asset('storage/'.$a->foto) }}" alt="Anak" class="w-10 h-10 rounded-full bg-white p-1">
            @else
              @if ($a->jenis_kelamin == 'L')
                <img src="/images/anak lk.png" alt="Anak Laki-laki" class="w-10 h-10 rounded-full bg-white p-1">
              @else
                <img src="/images/anakpr.png" alt="Anak Perempuan" class="w-10 h-10 rounded-full bg-white p-1">
              @endif
            @endif
            <div>
              <p class="font-bold text-m text-white">{{ $a->nama_lengkap }}</p>
              <p class="font-semibold text-s text-white">
                {{ $a->umur }} {{ $a->umur > 1 ? 'Bulan' : 'Bulan' }}
              </p>
            </div>
          </div>
        </div>
      </a>
      @empty
      @endforelse

      <!-- Tambah Anak -->
      <a href="{{ route('tambah.data.anak') }}">
        <div class="bg-white w-40 h-24 rounded-2xl shadow-md flex flex-col justify-center items-center border border-[#53AFA2] hover:bg-[#B9E9DD] transition flex-shrink-0">
          <div class="bg-[#53AFA2] text-white w-8 h-8 flex items-center justify-center rounded-full mb-1">+</div>
          <p class="text-sm text-[#53AFA2] font-semibold">Tambah Anak</p>
        </div>
      </a>

    </div>
  </div>
</section>
