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

<!-- Form Registrasi -->
<form action="{{ route('registrasi') }}" method="POST" class="bg-[#E9B9C5] p-8 rounded-2xl shadow-xl w-full max-w-md text-center backdrop-blur-sm">
  @csrf
  <h2 class="text-2xl font-bold text-gray-800 mb-6">Registrasi</h2>

  <!-- Nama Pengguna -->
  <div class="mb-4 relative">
    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama  Lengkap"
      class="w-full px-5 py-3 rounded-full bg-[#ffffff]-800 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600">
    <i class="fa-solid fa-user-circle absolute right-4 top-1/2 transform -translate-y-1/2 text-black"></i>
  </div>

  <!-- Email -->
  <div class="mb-4 relative">
    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
      class="w-full px-5 py-3 rounded-full bg-[#ffffff]-800 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600">
    <i class="fa-solid fa-envelope absolute right-4 top-1/2 transform -translate-y-1/2 text-black"></i>
  </div>

  <!-- Nomor Telepon -->
  <div class="mb-4 relative">
    <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Nomor Hp"
      class="w-full px-5 py-3 rounded-full bg-[#ffffff]-800 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600">
    <i class="fa-solid fa-phone absolute right-4 top-1/2 transform -translate-y-1/2 text-black"></i>
  </div>

  <!-- alamat -->
  <div class="mb-4 relative">
    <input type="text" name="alamat" value="{{ old('alamat') }}" placeholder="Alamat"
      class="w-full px-5 py-3 rounded-full bg-[#ffffff]-800 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600">
    <i class="fa-solid fa-map-pin absolute right-4 top-1/2 transform -translate-y-1/2 text-black"></i>
  </div>

  <!-- Kata Sandi -->
  <div class="mb-6 relative">
    <input type="password" name="kata_sandi" placeholder="Kata Sandi"
      class="w-full px-5 py-3 rounded-full bg-[#ffffff]-800 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600">
    <i class="fa-solid fa-lock absolute right-4 top-1/2 transform -translate-y-1/2 text-black"></i>
  </div>

  <!-- Konfirmasi Kata Sandi -->
<div class="mb-6 relative">
  <input type="password" name="kata_sandi_confirmation" placeholder="Konfirmasi Kata Sandi"
    class="w-full px-5 py-3 rounded-full bg-[#ffffff]-800 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600">
  <i class="fa-solid fa-lock absolute right-4 top-1/2 transform -translate-y-1/2 text-black"></i>
</div>

  <!-- Tombol Registrasi -->
  <button type="submit"
    class="w-full bg-[#53AFA2] hover:bg-[#53AFA2]-900 text-white font-semibold py-3 rounded-full transition">
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
</script>
@endsection
