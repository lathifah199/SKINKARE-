@extends('layouts.login')

@section('title', 'Registrasi')

@section('content')
<!-- Success Popup -->
@if(session('success'))
<!-- Modal Popup -->
<div id="popupSuccess" class="flex justify-center items-start min-h-screen pt-10">
    <div class="bg-white rounded-xl p-6 shadow-lg text-center">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Registrasi Berhasil!</h2>
        <p class="text-gray-600 mb-4">{{ session('success') }}</p>
        <button onclick="document.getElementById('popupSuccess').remove()" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">
            Tutup
        </button>
    </div>
</div>
@endif

<!-- Container Tengah -->
<div class="min-h-screen flex items-start justify-center bg-cover bg-center px-4 pt-4 sm:pt-8 md:pt-12" style="background-image: url('/img/bg-login.jpg');">
    <div class="relative bg-[#E9B9C5]/75 backdrop-blur-md p-8 rounded-2xl shadow-lg w-full max-w-md sm:max-w-lg mt-[-1rem] sm:mt-[-0.5rem] md:mt-0">
      
        <!-- Form Registrasi -->
        <form action="{{ route('registrasi') }}" method="POST">
            @csrf

            <!-- Error Popup -->
            @if ($errors->any())
                <div class="bg-red-200 text-red-800 p-2 mb-4 rounded text-left">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Registrasi Akun</h2>
            <!-- Nama Pengguna -->
            <div class="mb-4 relative">
              <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama Lengkap"
                class="w-full px-5 py-3 rounded-full bg-white text-black placeholder-gray-400 focus:border-[#53AFA2] focus:ring-2 focus:ring-[#53AFA2]">
              <i class="fa-solid fa-user-circle absolute right-4 top-1/2 transform -translate-y-1/2 text-black"></i>
            </div>

            <!-- Email -->
            <div class="mb-4 relative">
              <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                class="w-full px-5 py-3 rounded-full bg-white text-black placeholder-gray-400 focus:border-[#53AFA2] focus:ring-2 focus:ring-[#53AFA2]">
              <i class="fa-solid fa-envelope absolute right-4 top-1/2 transform -translate-y-1/2 text-black"></i>
            </div>

            <!-- Nomor Telepon -->
            <div class="mb-4 relative">
              <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Nomor Hp"
                class="w-full px-5 py-3 rounded-full bg-white text-black placeholder-gray-400 focus:border-[#53AFA2] focus:ring-2 focus:ring-[#53AFA2]">
              <i class="fa-solid fa-phone absolute right-4 top-1/2 transform -translate-y-1/2 text-black"></i>
            </div>

            <!-- Domisili -->
          <div class="mb-4 relative">
            <select name="domisili" class="w-full px-5 py-3 rounded-full bg-white text-black focus:border-[#53AFA2] focus:ring-2 focus:ring-[#53AFA2]">
              <option value="">-- Pilih Provinsi Domisili --</option>
              <option value="Aceh">Aceh</option>
              <option value="Sumatera Utara">Sumatera Utara</option>
              <option value="Sumatera Barat">Sumatera Barat</option>
              <option value="Riau">Riau</option>
              <option value="Kepulauan Riau">Kepulauan Riau</option>
              <option value="Jambi">Jambi</option>
              <option value="Sumatera Selatan">Sumatera Selatan</option>
              <option value="Lampung">Lampung</option>
              <option value="DKI Jakarta">DKI Jakarta</option>
              <option value="Jawa Barat">Jawa Barat</option>
              <option value="Banten">Banten</option>
              <option value="Jawa Tengah">Jawa Tengah</option>
              <option value="DI Yogyakarta">DI Yogyakarta</option>
              <option value="Jawa Timur">Jawa Timur</option>
              <option value="Bali">Bali</option>
              <option value="Kalimantan Barat">Kalimantan Barat</option>
              <option value="Kalimantan Tengah">Kalimantan Tengah</option>
              <option value="Kalimantan Selatan">Kalimantan Selatan</option>
              <option value="Kalimantan Timur">Kalimantan Timur</option>
              <option value="Sulawesi Selatan">Sulawesi Selatan</option>
              <option value="Sulawesi Tengah">Sulawesi Tengah</option>
              <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
              <option value="Papua">Papua</option>
            </select>
            <i class="fa-solid fa-map-pin absolute right-4 top-1/2 transform -translate-y-1/2 text-black"></i>
          </div>
          <!-- Kata Sandi -->
          <div class="mb-6 relative">
            <input type="password" name="kata_sandi" id="kata_sandi" placeholder="Kata Sandi (Min 6 Karakter)"
              class="w-full px-5 py-3 rounded-full bg-white text-black placeholder-gray-400 focus:border-[#53AFA2] focus:ring-2 focus:ring-[#53AFA2]">
            <button type="button" id="togglePassword1"
              class="absolute top-1/2 right-3 transform -translate-y-1/2 text-gray-500 hover:text-[#53AFA2] focus:outline-none">
              <i id="eyeIcon1" class="fa-solid fa-eye"></i>
            </button>
          </div>

          <!-- Konfirmasi Kata Sandi -->
          <div class="mb-6 relative">
            <input type="password" name="kata_sandi_confirmation" id="kata_sandi_confirmation" placeholder="Konfirmasi Kata Sandi"
              class="w-full px-5 py-3 rounded-full bg-white text-black placeholder-gray-400 focus:border-[#53AFA2] focus:ring-2 focus:ring-[#53AFA2]">
            <button type="button" id="togglePassword2"
              class="absolute top-1/2 right-3 transform -translate-y-1/2 text-gray-500 hover:text-[#53AFA2] focus:outline-none">
              <i id="eyeIcon2" class="fa-solid fa-eye"></i>
            </button>
          </div>

          <!-- Tombol Registrasi -->
          <button type="submit"
            class="w-1/2 mx-auto flex justify-center bg-[#53AFA2] hover:bg-[#469488] text-white font-bold py-3 rounded-full transition-all duration-300 shadow-md hover:shadow-lg">
            Daftar
          </button>

          <!-- Link ke login -->
          <div class="mt-4 text-sm text-gray-700 text-center">
            Sudah punya akun? <a href="{{ route('login') }}" class="font-bold hover:underline">Klik Disini</a>
          </div>
        </form>
@endsection

@section('scripts')
<script>
    setTimeout(() => {
        const popup = document.getElementById('popupSuccess');
        if (popup) popup.remove();
    }, 3000); // 3 detik

    // Fungsi toggle password untuk field pertama
    const togglePassword1 = document.getElementById('togglePassword1');
    const passwordInput1 = document.getElementById('kata_sandi');
    const eyeIcon1 = document.getElementById('eyeIcon1');

    if (togglePassword1 && passwordInput1 && eyeIcon1) {
        togglePassword1.addEventListener('click', () => {
            const isPassword = passwordInput1.type === 'password';
            passwordInput1.type = isPassword ? 'text' : 'password';
            
            // Ganti ikon mata
            if (isPassword) {
                eyeIcon1.classList.remove('fa-eye');
                eyeIcon1.classList.add('fa-eye-slash');
            } else {
                eyeIcon1.classList.remove('fa-eye-slash');
                eyeIcon1.classList.add('fa-eye');
            }
        });
    }

    // Fungsi toggle password untuk field kedua
    const togglePassword2 = document.getElementById('togglePassword2');
    const passwordInput2 = document.getElementById('kata_sandi_confirmation');
    const eyeIcon2 = document.getElementById('eyeIcon2');

    if (togglePassword2 && passwordInput2 && eyeIcon2) {
        togglePassword2.addEventListener('click', () => {
            const isPassword = passwordInput2.type === 'password';
            passwordInput2.type = isPassword ? 'text' : 'password';
            
            // Ganti ikon mata
            if (isPassword) {
                eyeIcon2.classList.remove('fa-eye');
                eyeIcon2.classList.add('fa-eye-slash');
            } else {
                eyeIcon2.classList.remove('fa-eye-slash');
                eyeIcon2.classList.add('fa-eye');
            }
        });
    }
</script>
@endsection