@php
    if (Auth::guard('orangtua')->check()) {
        $layout = 'layouts.orangtuanofooter';
    } else {
        $layout = 'layouts.app_nakesnofooter';
    }
@endphp
@extends($layout)
@section('content')
<div class="min-h-screen bg-white flex flex-col items-center justify-between p-4 pt-20">

  {{-- AREA KAMERA --}}
  <div class="flex-1 flex flex-col items-center justify-center w-full max-w-2xl mt-4">
    <div class="relative w-full bg-gray-200 rounded-2xl overflow-hidden shadow-lg aspect-[3/4] sm:aspect-[4/3]">
      <video id="video" autoplay playsinline muted class="w-full h-full object-cover bg-black hidden rounded-2xl"></video>
      <img id="previewImage" class="w-full h-full object-cover hidden rounded-2xl" />
    </div>

    {{-- Tombol kontrol --}}
    <div class="flex flex-wrap justify-center gap-3 mt-5">
      <button id="btnStart" onclick="startCamera()" 
        class="bg-purple-500 hover:bg-purple-600 text-white px-5 py-2.5 rounded-full shadow-md transition">
        Aktifkan Kamera
      </button>

      <button id="btnStop" onclick="stopCamera()" 
        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-5 py-2.5 rounded-full shadow-md hidden transition">
        Matikan Kamera
      </button>

      <label class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2.5 rounded-full cursor-pointer shadow-md transition">
        <input type="file" accept="image/*" id="fileInput" class="hidden">
        Ambil / Pilih Gambar
      </label>
    </div>
  </div>

  {{-- DAFTAR ITEM --}}
  <div class="w-full max-w-md bg-purple-50 rounded-xl shadow p-4 mt-8 mb-6">
    @foreach (['Panduan: Pastikan anak berdiri tegak', 'Gunakan latar netral', 'Pastikan pencahayaan cukup'] as $item)
    <div class="flex items-center justify-between mb-3 last:mb-0">
      <div class="flex items-center space-x-3">
        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-purple-300 text-white font-semibold">
          ✓
        </div>
        <span class="text-gray-800 text-sm">{{ $item }}</span>
      </div>
      <input type="checkbox" checked class="w-5 h-5 text-purple-500 border-gray-300 rounded focus:ring-purple-400" />
    </div>
    @endforeach
  </div>

  {{-- BAGIAN BAWAH --}}
  <div class="w-full bg-green-100 rounded-t-3xl py-6 px-6 text-center shadow-inner">
    <h2 class="text-lg font-semibold text-gray-700 mb-3">Tinggi Badan:</h2>
    <div class="flex flex-col sm:flex-row justify-center gap-3">
      <button onclick="openPopup()" 
        class="bg-pink-400 hover:bg-pink-500 text-white px-6 py-2 rounded-full transition shadow-md">
        Lanjut
      </button>
      <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-full transition shadow-md"
        onclick="window.history.back()">
        Kembali
      </button>
    </div>
  </div>

  {{-- POPUP --}}
  <div id="popup" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-lg p-6 w-80 text-center animate-fadeIn">
      <p class="text-gray-800 mb-4">Hasil Scan Tinggi anak anda adalah</p>
      <input type="text" placeholder="Tinggi badan anak (cm)" 
        class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-4 text-center focus:ring focus:ring-purple-300" />
      <p class="text-gray-700 mb-4">Apakah anda ingin melakukan Input manual?</p>
      <div class="flex justify-center gap-3">
        <a href="{{ route('scan_berat') }}" 
          class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-full">
          Scan berat badan
        </a>
        <a href="{{ route('input_manual') }}" 
          class="bg-pink-300 hover:bg-pink-400 text-white px-4 py-2 rounded-full">
          Input Manual
        </a>
      </div>
      <button onclick="closePopup()" 
        class="mt-4 text-sm text-gray-500 hover:text-gray-700 underline">
        Tutup
      </button>
    </div>
  </div>
</div>

{{-- SCRIPT KAMERA --}}
<script>
  const video = document.getElementById('video');
  const previewImage = document.getElementById('previewImage');
  const fileInput = document.getElementById('fileInput');
  const btnStart = document.getElementById('btnStart');
  const btnStop = document.getElementById('btnStop');
  let stream = null;

  async function startCamera() {
    try {
      stream = await navigator.mediaDevices.getUserMedia({
        video: { facingMode: "environment" }, 
        audio: false
      });
      video.srcObject = stream;
      video.classList.remove('hidden');
      previewImage.classList.add('hidden');
      btnStart.classList.add('hidden');
      btnStop.classList.remove('hidden');
    } catch (err) {
      alert('Tidak bisa mengakses kamera. Pastikan izin kamera diaktifkan.');
      console.error(err);
    }
  }

  function stopCamera() {
    if (stream) {
      stream.getTracks().forEach(track => track.stop());
      stream = null;
    }
    video.classList.add('hidden');
    btnStart.classList.remove('hidden');
    btnStop.classList.add('hidden');
  }

  // Preview foto dari galeri
  fileInput.addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (!file) return;
    const url = URL.createObjectURL(file);
    previewImage.src = url;
    previewImage.classList.remove('hidden');
    video.classList.add('hidden');
    stopCamera();
  });

  // Popup
  function openPopup() {
    document.getElementById('popup').classList.remove('hidden');
    document.getElementById('popup').classList.add('flex');
  }
  function closePopup() {
    document.getElementById('popup').classList.add('hidden');
    document.getElementById('popup').classList.remove('flex');
  }
</script>
@endsection
