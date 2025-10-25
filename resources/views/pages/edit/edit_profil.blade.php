<div id="editProfilModal" class="fixed inset-0 flex items-start justify-center bg-black bg-opacity-40 hidden z-50 pt-24">
    <div class="bg-white rounded-lg shadow-md w-80 sm:w-96 border border-gray-300 p-5 relative">
        <form class="space-y-3">
            <h2 class="text-center text-base font-semibold mb-3">Edit Profil</h2>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text"
                    class="w-full border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:outline-none focus:ring focus:ring-emerald-200" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Tempat Tinggal</label>
                <input type="text"
                    class="w-full border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:outline-none focus:ring focus:ring-emerald-200" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                <input type="tel"
                    class="w-full border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:outline-none focus:ring focus:ring-emerald-200" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email"
                    class="w-full border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:outline-none focus:ring focus:ring-emerald-200" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Baru</label>
                <input type="password"
                    class="w-full border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:outline-none focus:ring focus:ring-emerald-200" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
                <input type="password"
                    class="w-full border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:outline-none focus:ring focus:ring-emerald-200" />
            </div>

            <div class="flex justify-center mt-4">
                <button type="submit"
                    class="bg-emerald-500 hover:bg-emerald-600 text-white font-medium rounded-full px-6 py-1.5 text-sm transition-all">
                    Simpan
                </button>
            </div>
        </form>

        <!-- Tombol tutup -->
        <button onclick="closeEditModal()" class="absolute top-2.5 right-3 text-gray-500 hover:text-gray-700 text-xl">&times;</button>
    </div>
</div>

<script>
    function openEditModal() {
        document.getElementById('editProfilModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editProfilModal').classList.add('hidden');
    }
</script>
