@php
    if (Auth::guard('orangtua')->check()) {
        $layout = 'layouts.orangtuanofooter';
    } else {
        $layout = 'layouts.app_nakesnofooter';
    }
@endphp

@extends($layout)

@section('content')
<div class="min-h-screen bg-pink-100 flex flex-col">
    <div class="flex-grow bg-cover bg-center flex items-center justify-center py-16"
         style="background-image: url('https://source.unsplash.com/800x600/?family,child');">

        <div class="bg-white/90 backdrop-blur-md p-8 rounded-2xl shadow-lg w-full max-w-md mt-10 mb-10">
            <h2 class="text-xl font-semibold text-gray-700 mb-6">Isi Data Anak</h2>

            {{-- Notifikasi --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-2 mb-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('anak.store') }}" method="POST" class="space-y-4">
                @csrf
                {{--TAMBAH DISPLAY ERROR DI SINI --}}
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <strong>Field kosong wajib diisi:</strong>
                        <ul class="mt-2 ml-4 list-disc">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- DATA ANAK --}}
                <div>
                    <label class="block text-gray-600">Nama Lengkap Anak</label>
                    <input name="nama_lengkap" type="text" placeholder="Masukkan nama lengkap"
                        class="w-full border rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="block text-gray-600">Jenis Kelamin</label>
                    <select name="jenis_kelamin" required
                        class="w-full border rounded-lg px-3 py-2">
                        <option value="">-- Pilih --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-600">Tempat Lahir</label>
                    <input name="tempat_lahir" type="text" placeholder="Masukkan tempat lahir"
                        class="w-full border rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="block text-gray-600">Tanggal Lahir</label>
                    <input name="tanggal_lahir" type="date" id="tanggal_lahir" placeholder="Masukkan tanggal lahir"
                        class="w-full border rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="block text-gray-600">Umur (bulan)</label>
                    <input id="umur" name="umur" type="number" readonly placeholder="Terisi Otomatis"
                        class="w-full border rounded-lg px-3 py-2 bg-gray-100">
                </div>

                {{-- 🔥 KHUSUS NAKES --}}
                @if(!Auth::guard('orangtua')->check())
                    <hr class="my-4">

                    <h3 class="font-semibold text-gray-700">Data Orang Tua</h3>

                    <div>
                        <label class="block text-gray-600">Nama Orang Tua</label>
                        <input name="ortu_nama" type="text" placeholder="Masukkan nama orang tua"
                            class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-gray-600">No HP Orang Tua</label>
                        <input name="ortu_no_hp" type="text" placeholder="Masukkan nomor telepon "
                            class="w-full border rounded-lg px-3 py-2">
                    </div>

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
                @endif

                <button type="submit"
                    class="w-full bg-emerald-400 hover:bg-emerald-500 text-white py-2 rounded-full mt-4">
                    Simpan & Scan
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const tanggalInput = document.getElementById('tanggal_lahir');
    const umurInput = document.getElementById('umur');
    const form = document.querySelector('form');

    tanggalInput.addEventListener('change', function() {
        const tglLahir = new Date(this.value);
        const today = new Date();

        if (!this.value) {
            umurInput.value = '';
            return;
        }

        let years = today.getFullYear() - tglLahir.getFullYear();
        let months = today.getMonth() - tglLahir.getMonth();

        if (months < 0) {
            years--;
            months += 12;
        }

        const totalBulan = years * 12 + months;

        // Tampilkan hasilnya di input umur
        umurInput.value = totalBulan;
    });
    // Validasi form sebelum submit
    formDataAnak.addEventListener('submit', function(e) {
        let isValid = true;
        let errorMessages = [];

        // Validasi nama lengkap
        const nama = document.querySelector('[name="nama_lengkap"]');
        if (!nama.value.trim()) {
            isValid = false;
            errorMessages.push('Nama lengkap anak wajib diisi');
            nama.classList.add('border-red-500');
        }

        // Validasi jenis kelamin
        const jenisKelamin = document.querySelector('[name="jenis_kelamin"]');
        if (!jenisKelamin.value) {
            isValid = false;
            errorMessages.push('Jenis kelamin wajib dipilih');
            jenisKelamin.classList.add('border-red-500');
        }

        // Validasi tempat lahir
        const tempatLahir = document.querySelector('[name="tempat_lahir"]');
        if (!tempatLahir.value.trim()) {
            isValid = false;
            errorMessages.push('Tempat lahir wajib diisi');
            tempatLahir.classList.add('border-red-500');
        }

        // Validasi tanggal lahir
        if (!tanggalInput.value) {
            isValid = false;
            errorMessages.push('Tanggal lahir wajib diisi');
            tanggalInput.classList.add('border-red-500');
        }

        // Validasi umur
        if (!umurInput.value) {
            isValid = false;
            errorMessages.push('Umur belum terisi (pilih tanggal lahir dulu)');
            umurInput.classList.add('border-red-500');
        }

        // Validasi khusus nakes
        @if(!Auth::guard('orangtua')->check())
        const ortuNama = document.querySelector('[name="ortu_nama"]');
        const ortuNoHp = document.querySelector('[name="ortu_no_hp"]');
        const domisili = document.querySelector('[name="domisili"]');

        if (!ortuNama.value.trim()) {
            isValid = false;
            errorMessages.push('Nama orang tua wajib diisi');
            ortuNama.classList.add('border-red-500');
        }

        if (!ortuNoHp.value.trim()) {
            isValid = false;
            errorMessages.push('No HP orang tua wajib diisi');
            ortuNoHp.classList.add('border-red-500');
        }

        if (!domisili.value) {
            isValid = false;
            errorMessages.push('Domisili wajib dipilih');
            domisili.classList.add('border-red-500');
        }
        @endif

        // Jika tidak valid, tampilkan pesan error dan prevent submit
        if (!isValid) {
            e.preventDefault();
            alert('Field kosong wajib diisi:\n\n' + errorMessages.join('\n'));
        }
    });
});
</script>

@endsection