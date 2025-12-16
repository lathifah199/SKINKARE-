<div class="min-h-screen bg-gray-50 pt-20">
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="bg-white p-6 rounded-lg shadow-md">

            <!-- Judul -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Data Anak</h2>
                <p class="text-gray-600 mt-1">Total: {{ $dataAnak->total() }} data</p>
            </div>

            <hr class="mb-6 border-gray-200" />

            <!-- Search -->
            <div class="mb-6">
                <form action="{{ route('data-anak.index') }}" method="GET" class="flex gap-3">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                            placeholder="Cari nama anak...">
                    </div>

                    <button type="submit"
                        class="px-6 py-2.5 bg-[#F3C0CD] hover:bg-[#E8A8B8] text-white rounded-lg shadow">
                        Cari
                    </button>

                    @if(request('search'))
                        <a href="{{ route('data-anak.index') }}"
                            class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase">
                                Nama Anak
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($dataAnak as $anak)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="h-10 w-10 rounded-full bg-[#F3C0CD] flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr($anak->nama_lengkap, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $anak->nama_lengkap }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <button
                            onclick="lihatDetail(this)"
                            data-nama="{{ $anak->nama_lengkap }}"
                            data-jenis-kelamin="{{ $anak->jenis_kelamin }}"
                            data-umur="{{ $anak->umur }}" 
                            data-tb="{{ $anak->tinggi_badan }}"
                            data-bb="{{ $anak->berat_badan }}"
                            data-status="{{ $anak->hasil_deteksi }}"
                            data-alamat-anak="{{ $anak->alamat }}"
                            data-nama-ortu="{{ $anak->orangtua->nama ?? '-' }}"
                            data-alamat-ortu="{{ $anak->orangtua->domisili ?? '-' }}"
                            class="inline-flex items-center px-4 py-2 bg-[#F3C0CD] hover:bg-[#E8A8B8] text-white text-sm roundedify rounded-lg shadow">
                                Lihat Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="px-6 py-12 text-center text-gray-500">
                                Tidak ada data anak
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($dataAnak->hasPages())
            <div class="mt-6">
                {{ $dataAnak->appends(['search' => request('search')])->links() }}
            </div>
            @endif

        </div>
    </div>
</div>