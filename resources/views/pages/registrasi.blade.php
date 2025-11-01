@extends('layouts.regis')

@section('title', 'Registrasi')

@section('content')
<!-- Success Popup -->
@if(session('success'))
<!-- Modal Popup -->
<div id="popupSuccess" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 shadow-lg w-96 text-center">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Registrasi Berhasil!</h2>
        <p class="text-gray-600 mb-4">{{ session('success') }}</p>
        <button onclick="document.getElementById('popupSuccess').remove()" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">
            Tutup
        </button>
    </div>
</div>
@endif

<!-- Form Registrasi -->
<form action="{{ route('registrasi') }}" method="POST" class="bg-[#E9B9C5]/75 backdrop-blur-md p-8 text-center rounded-2xl shadow-lg w-full max-w-md">
  @csrf
  <!-- Error Popup -->
  @if ($errors->any())
    <div class="bg-red-200 text-red-800 p-2 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <h2 class="text-2xl font-bold text-gray-800 mb-6">Registrasi</h2>

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

  <!-- alamat -->
  <div class="mb-4 relative">
    <input type="text" name="alamat" value="{{ old('alamat') }}" placeholder="Alamat"
      class="w-full px-5 py-3 rounded-full bg-white text-black placeholder-gray-400 focus:border-[#53AFA2] focus:ring-2 focus:ring-[#53AFA2]">
    <i class="fa-solid fa-map-pin absolute right-4 top-1/2 transform -translate-y-1/2 text-black"></i>
  </div>

  <!-- Kata Sandi -->
  <div class="mb-6 relative">
    <input type="password" name="kata_sandi" id="kata_sandi" placeholder="Kata Sandi"
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
  <div class="mt-4 text-sm text-gray-700">
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