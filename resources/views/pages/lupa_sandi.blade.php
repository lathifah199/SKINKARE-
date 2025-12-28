@extends('layouts.login')

@section('title', 'Lupa kata sandi')

@section('content')
<div class="min-h-screen flex items-start justify-center bg-cover bg-center px-4 pt-4 sm:pt-8 md:pt-12" style="background-image: url('/img/bg-login.jpg');">
    <div class="relative bg-[#E9B9C5]/75 backdrop-blur-md p-8 rounded-2xl shadow-lg w-full max-w-md sm:max-w-lg mt-[-1rem] sm:mt-[-0.5rem] md:mt-0">
  <h2 class="text-2xl font-bold text-center mb-1 text-gray-800">Lupa Kata Sandi?</h2>
  <h6 class="text-sm font-medium text-center mb-6 text-gray-700">Masukkan email dan kata sandi baru anda</h6>


@if(session('success'))
<div id="popupSuccess" class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50">
  <div class="bg-white text-gray-800 px-6 py-4 rounded-full shadow-lg flex items-center gap-3 animate-fadeIn border border-gray-200">
    <i class="fa-solid fa-circle-check text-green-600 text-lg"></i>
    <span class="text-sm">{{ session('success') }}</span>
    <button onclick="document.getElementById('popupSuccess').remove()" 
      class="ml-3 text-gray-500 hover:text-gray-800 text-sm">
      <i class="fa-solid fa-xmark"></i>
    </button>
  </div>
</div>
@endif


  <form method="POST" action="{{ route('lupaSandi.submit') }}">
    @csrf
  @if ($errors->any())
    <div class="bg-red-200 text-red-800 p-2 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <!-- Email -->
  <div class="mb-4 relative">
    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
      class="w-full px-5 py-3 rounded-full bg-white text-black placeholder-gray-400 focus:border-[#53AFA2] focus:ring-2 focus:ring-[#53AFA2]">
    <i class="fa-solid fa-envelope absolute right-4 top-1/2 transform -translate-y-1/2 text-black"></i>
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

  
  <div class="mt-6 flex flex-col gap-4">
  <button type="submit"
    class="mb-2 w-1/2 mx-auto bg-[#53AFA2] hover:bg-[#469488] text-white font-bold py-3 rounded-full transition-all duration-300 shadow-md hover:shadow-lg">
    Simpan
  </button>

  <a href="{{ route('login') }}"
    class="w-1/2 mx-auto text-center bg-[#22796d] hover:bg-[#53AFA2] text-white font-bold py-3 rounded-full transition-all duration-300 shadow-md hover:shadow-lg">
    Kembali
  </a>
</div>
  </form>
</div>

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
 


