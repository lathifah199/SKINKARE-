@extends('layouts.login')

@section('title', 'Lupa kata sandi')

@section('content')
<div class="bg-[#E9B9C5] p-8 rounded-2xl shadow-lg w-full max-w-md">
  <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Lupa kata sandi?</h2>
  <h6 class="text-sm font-medium text-center mb-6 text-gray-700">Masukkan email dan kata sandi baru anda</h6>

  @if($errors->any())
  <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg">
    <ul class="text-sm list-disc list-inside">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

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

@if($errors->any())
  <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg">
    <ul class="text-sm list-disc list-inside">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

  <form method="POST" action="{{ route('lupaSandi.submit') }}">
    @csrf
    <div class="mb-6">
      <label for="email" class="block font-semibold text-gray-700 mb-1 ml-2">Email</label>
      <div class="relative">
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
          class="w-full py-3 pl-5 pr-12 rounded-full bg-[#ffffff]-800 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600">
        <i class="fa-solid fa-envelope absolute right-4 top-1/2 transform -translate-y-1/2 text-black"></i>
      </div>
    </div>

    <div class="mb-6">
      <label for="kata_sandi" class="block font-semibold text-gray-700 mb-1 ml-2">Kata Sandi</label>
      <div class="relative">
        <input type="password" id="kata_sandi" name="kata_sandi" placeholder="Masukkan kata sandi"
          class="w-full py-3 pl-5 pr-12 rounded-full bg-[#ffffff]-800 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600">
        <i class='bx bxs-lock absolute top-1/2 right-4 transform -translate-y-1/2 text-black text-xl'></i>
      </div>
    </div>

    <div class="mb-6">
      <label for="kata_sandi" class="block font-semibold text-gray-700 mb-1 ml-2">Konfirmasi Kata Sandi</label>
      <div class="relative">
        <input type="password" id="kata_sandi" name="kata_sandi" placeholder="Konfirmasi kata sandi"
          class="w-full py-3 pl-5 pr-12 rounded-full bg-[#ffffff]-800 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600">
        <i class='bx bxs-lock absolute top-1/2 right-4 transform -translate-y-1/2 text-black text-xl'></i>
      </div>
    </div>

    <button type="submit"
      class="w-full bg-[#53AFA2]  text-white font-semibold py-3 rounded-full hover:bg-gray-900 transition">Simpan</button>
  </form>
</div>
@endsection
@section('scripts')
<style>
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
  animation: fadeIn 0.3s ease-out;
}
</style>
<script>
  setTimeout(() => {
    const popup = document.getElementById('popupSuccess');
    if (popup) popup.remove();
  }, 3000); // Auto close setelah 3 detik
</script>
@endsection


