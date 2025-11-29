<div id="editProfilModal"
    class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex justify-center transition-all duration-300 overflow-y-auto">
    
    <!-- Container modal -->
    <div
        class="bg-white rounded-2xl shadow-lg w-[90%] sm:w-[380px] md:w-[420px] lg:w-[360px] border border-gray-200 p-6 mt-28 mb-8 relative transform transition-all scale-95 sm:scale-100 max-h-[90vh] overflow-y-auto">
        
        <!-- Tombol Tutup -->
        <button onclick="closeEditModal()"
            class="absolute top-3 right-4 text-gray-500 hover:text-gray-700 text-xl leading-none">
            &times;
        </button>

        <!-- Judul -->
        <h2 class="text-center text-lg font-semibold mb-5 text-gray-800">Edit Profil</h2>

        <!-- Form -->
        <form action="{{ route('profil.update') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ $orangtua->nama }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Domisili</label>
                <input type="text" name="domisili" value="{{ $orangtua->domisili }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                <input type="tel" name="no_hp" value="{{ $orangtua->no_hp }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ $orangtua->email }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Baru (Opsional)</label>
                <input type="password" name="kata_sandi"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
                <input type="password" name="kata_sandi_confirmation"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300" />
            </div>

            <div class="flex justify-center pt-2 pb-2">
                <button type="submit"
                    class="w-full sm:w-auto bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-full px-6 py-2 text-sm transition-all shadow-md hover:shadow-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal() {
        const modal = document.getElementById('editProfilModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeEditModal() {
        const modal = document.getElementById('editProfilModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }
</script>
