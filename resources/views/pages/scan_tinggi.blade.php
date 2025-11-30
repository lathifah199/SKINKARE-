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
      <canvas id="canvas" class="hidden"></canvas>
    </div>

    {{-- Tombol kontrol --}}
    <div class="flex flex-wrap justify-center gap-3 mt-5">
      <button id="btnStart" class="bg-purple-500 hover:bg-purple-600 text-white px-5 py-2.5 rounded-full shadow-md">Aktifkan Kamera</button>
      <button id="btnStop" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-5 py-2.5 rounded-full shadow-md hidden">Matikan Kamera</button>
      <button id="captureBtn" class="bg-green-500 hover:bg-green-600 text-white px-5 py-2.5 rounded-full shadow-md hidden">Scan Sekarang</button>

      <label class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2.5 rounded-full cursor-pointer shadow-md">
        <input type="file" accept="image/*" id="fileInput" class="hidden">
        Ambil / Pilih Gambar
      </label>
    </div>

    {{-- BAGIAN HASIL --}} 
    <div class="w-full bg-green-100 rounded-t-3xl py-6 px-6 text-center shadow-inner mt-6"> <h2 id="hasilTinggiBox" class="text-2xl font-bold text-gray-700 mb-3"></h2> 
    <div class="flex flex-col sm:flex-row justify-center gap-3"> 
      <button id="btnNext" onclick="openPopup()" class="bg-pink-400 hover:bg-pink-500 text-white px-6 py-2 rounded-full"> 
        Lanjut 
      </button> 
      <button onclick="window.history.back()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-full"> 
      Kembali 
      </button> 
    </div> 
    </div>

  {{-- POPUP --}}
  <div id="popup" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-2xl shadow-lg p-6 w-80 text-center" id="popupContent">

      <!-- MODE 1: KONFIRMASI HASIL -->
      <div id="modeHasil">
        <p class="text-gray-800 mb-4">Hasil Scan Tinggi anak anda adalah:</p>
        <input id="popupInput" type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-4 text-center">

        <p class="text-gray-700 mb-4">Apakah anda ingin melakukan Input manual?</p>

        <div class="flex justify-center gap-3">
          <button onclick="simpanDanLanjut()" 
                  class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-full">
              Scan Berat Badan
          </button>

          <button onclick="switchToManual()" 
                  class="bg-pink-300 hover:bg-pink-400 text-white px-4 py-2 rounded-full">
            Input Manual
          </button>
        </div>

        <button onclick="closePopup()" class="mt-4 text-sm text-gray-500 hover:text-gray-700 underline">Tutup</button>
      </div>

        <!-- MODE 2: INPUT MANUAL -->
        <div id="modeManual" class="hidden">
          <p class="text-gray-800 mb-4">Masukkan tinggi anak:</p>

          <input id="manualInput" type="number" 
                class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-4 text-center"
                placeholder="contoh: 90">

          <div class="flex justify-center gap-3">

              <!-- SIMPAN (warna emerald sama persis seperti di popup utama) -->
              <button onclick="saveManual()" 
                  class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-full">
                  Simpan
              </button>

              <!-- KEMBALI (warna pink sama persis seperti tombol Input Manual) -->
              <button onclick="switchToHasil()" 
                  class="bg-pink-300 hover:bg-pink-400 text-white px-4 py-2 rounded-full">
                  Kembali
              </button>

          </div>
      </div>
  </div>
  </div>


<script>
const video = document.getElementById("video");
const canvas = document.getElementById("canvas");
const previewImage = document.getElementById("previewImage");

const btnStart = document.getElementById("btnStart");
const btnStop = document.getElementById("btnStop");
const captureBtn = document.getElementById("captureBtn");
const fileInput = document.getElementById("fileInput");

const hasilTinggiBox = document.getElementById("hasilTinggiBox");
const popupInput = document.getElementById("popupInput");
let stream = null;
let tinggiTerakhir = null; // ✅ Simpan hasil tinggi

/* Loading Anim */
const loadingAnim = `
<div class="flex justify-center gap-2 text-gray-800 font-semibold">
  <div class="w-6 h-6 border-4 border-green-600 border-t-transparent rounded-full animate-spin"></div>
  Menghitung tinggi anak...
</div>`;

/* Kamera */
btnStart.onclick = async () => {
  stream = await navigator.mediaDevices.getUserMedia({ video:true });
  video.srcObject = stream;
  video.classList.remove("hidden");
  captureBtn.classList.remove("hidden");
  btnStart.classList.add("hidden");
  btnStop.classList.remove("hidden");
};

btnStop.onclick = () => {
  stream.getTracks().forEach(t => t.stop());
  video.classList.add("hidden");
  captureBtn.classList.add("hidden");
  btnStop.classList.add("hidden");
  btnStart.classList.remove("hidden");
};

/* Scan kamera */
captureBtn.onclick = () => {
  hasilTinggiBox.innerHTML = loadingAnim;
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;
  canvas.getContext("2d").drawImage(video,0,0);
  canvas.toBlob(blob => processImage(blob), "image/png");
};

/* Upload file */
fileInput.onchange = () => {
  const file = fileInput.files[0];
  if(!file) return;
  hasilTinggiBox.innerHTML = loadingAnim;
  previewImage.src = URL.createObjectURL(file);
  previewImage.classList.remove("hidden");
  processImage(file);
};

/* Proses AI */
function processImage(fileImg){
  let formData = new FormData();
  formData.append("foto", fileImg);

  fetch("{{ route('scan.predict') }}", {
      method:"POST",
      body: formData,
      headers:{ "X-CSRF-TOKEN":"{{ csrf_token() }}" }
  })
  .then(r=>r.json())
  .then(result=>{
      const tinggi = Math.round(result.tinggi);
      tinggiTerakhir = tinggi; // ✅ Simpan ke variabel

      hasilTinggiBox.innerHTML = `
      <span class="text-3xl font-bold text-green-700 animate-pulse">
        Tinggi Anak: ${tinggi} cm
      </span>`;

      popupInput.value = tinggi;
  })
  .catch(()=>{
      hasilTinggiBox.innerHTML = `<span class="text-red-600 font-semibold">Gambar gagal diproses ⚠</span>`;
  });
}

/* === POPUP CONTROL === */
function openPopup() {
  if (!tinggiTerakhir && !popupInput.value) {
    alert("Silakan scan atau input tinggi terlebih dahulu!");
    return;
  }
  
  const popup = document.getElementById("popup");
  popup.classList.remove("hidden");
  popup.classList.add("flex");
  switchToHasil();
}

function closePopup() {
  const popup = document.getElementById("popup");
  popup.classList.add("hidden");
  popup.classList.remove("flex");
}

function switchToManual() {
  document.getElementById("modeHasil").classList.add("hidden");
  document.getElementById("modeManual").classList.remove("hidden");
}

function switchToHasil() {
  document.getElementById("modeManual").classList.add("hidden");
  document.getElementById("modeHasil").classList.remove("hidden");
}

// ✅ SIMPAN DARI POPUP (HASIL SCAN)
function simpanDanLanjut() {
  const tinggi = popupInput.value;
  
  if (!tinggi) {
    alert("Tinggi tidak boleh kosong");
    return;
  }

  // Kirim ke backend untuk simpan
  fetch("{{ route('scan_tinggi.store', $anak->id) }}", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": "{{ csrf_token() }}"
    },
    body: JSON.stringify({ tinggi_badan: tinggi })
  })
  .then(r => r.json())
  .then(data => {
    if (data.success) {
      window.location.href = data.redirect_url;
    }
  })
  .catch(err => {
    alert("Gagal menyimpan data");
    console.error(err);
  });
}

// ✅ SIMPAN MANUAL
function saveManual() {
  const val = document.getElementById("manualInput").value;

  if (!val) {
    alert("Tinggi tidak boleh kosong");
    return;
  }

  tinggiTerakhir = val; // Update variabel
  popupInput.value = val;

  hasilTinggiBox.innerHTML = `
    <span class="text-3xl font-bold text-green-700 animate-pulse">
      Tinggi Anak: ${val} cm (Manual)
    </span>`;

  closePopup();
}
</script>

@endsection
