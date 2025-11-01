
 @extends('layouts.login')

@section('title', 'Login')

@section('content')
<div class="bg-[#E9B9C5]/75 backdrop-blur-md p-8 rounded-2xl shadow-lg w-full max-w-md">
        <!-- Gambar di tengah -->
      <div class="flex justify-center mb-1">
  <img src="{{ asset('images/logo.png') }}" alt="login" class="w-[70px] h-[70px] object-contain">
</div>
       <h2 class="text-2xl font-bold text-center mb-1 text-gray-800">Selamat Datang di SKINKARE</h2>
<h6 class="text-sm font-medium text-center mb-8 text-gray-700">Silakan melakukan login terlebih dahulu</h6>
        {{-- Pesan Error --}}
        @if($errors->any())
            <div class="mb-4 bg-red-50 border border-red-300 text-red-700 px-5 py-3 rounded-xl shadow-sm">
                <ul class="text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li><i class="fa-solid fa-circle-exclamation mr-2"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Pesan Sukses --}}
        @if(session('success'))
            <div id="popupSuccess" class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50">
                <div class="bg-white text-gray-800 px-6 py-3 rounded-full shadow-lg flex items-center gap-3 animate-fadeIn border border-[#53AFA2]">
                    <i class="fa-solid fa-circle-check text-[#53AFA2] text-lg"></i>
                    <span class="text-sm">{{ session('success') }}</span>
                    <button onclick="document.getElementById('popupSuccess').remove()" 
                        class="ml-2 text-gray-500 hover:text-gray-700 text-sm">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>
        @endif

        {{-- Form Login --}}
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            {{-- Nama Pengguna --}}
            <div class="mb-6">
                
                <div class="relative">
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama pengguna"
                        class="w-full py-3 pl-5 pr-12 rounded-full bg-white text-black placeholder-gray-400 border border-gray-300 focus:border-[#53AFA2] focus:ring-2 focus:ring-[#53AFA2]">
                    <i class='bx bxs-user absolute top-1/2 right-4 transform -translate-y-1/2 text-gray-500 text-xl'></i>
                </div>
            </div>

            <div class="mb-6">
                
                <div class="relative">
                    <input type="password" id="kata_sandi" name="kata_sandi" placeholder="Masukkan kata sandi"
                        class="w-full py-3 pl-5 pr-12 rounded-full bg-white text-black placeholder-gray-400 border border-gray-300 focus:border-[#53AFA2] focus:ring-2 focus:ring-[#53AFA2]">
                    
                    {{-- Tombol lihat sandi --}}
                    <button type="button" id="togglePassword"
                        class="absolute top-1/2 right-3 transform -translate-y-1/2 text-gray-500 hover:text-[#53AFA2] focus:outline-none">
                        <i id="eyeIcon" class='bx bx-show text-2xl'></i>
                    </button>
                </div>
            </div>

            <button type="submit"
                class="w-1/2 mx-auto flex justify-center text-xl bg-[#53AFA2] hover:bg-[#469488] text-white font-semibold py-3 rounded-full transition-all duration-300 shadow-md hover:shadow-lg">
                Masuk
            </button>

            <div class="text-center mt-4 text-sm text-gray-800">
                Lupa kata sandi? 
                <a href="{{ route('lupa_sandi') }}" class="text-black font-bold font-medium hover:underline">Klik di sini</a>
            </div>
            <div class="text-center text-sm text-gray-800 mt-2">
                Belum punya akun? 
                <a href="{{ route('registrasi') }}" class="text-black font-bold font-medium hover:underline">Daftar di sini</a>
            </div>
        </form>
    </div>
</div>

<script>
    // Auto-hide popup success
    setTimeout(() => {
        const popup = document.getElementById('popupSuccess');
        if (popup) popup.remove();
    }, 3000);

    // Fungsi toggle password
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('kata_sandi');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', () => {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        
        // Ganti ikon mata
        if (isPassword) {
            eyeIcon.classList.remove('bx-show');
            eyeIcon.classList.add('bx-hide');
        } else {
            eyeIcon.classList.remove('bx-hide');
            eyeIcon.classList.add('bx-show');
        }
    });
</script>

@endsection