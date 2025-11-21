<div class="min-h-screen bg-gray-50 pt-20">
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            
            <!-- Judul Tabel -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Data Wali</h2>
                <p class="text-gray-600 mt-1">Total: {{ $dataWali->total() }} data</p>
            </div>

            <hr class="mb-6 border-gray-200" />

            <!-- Search Bar -->
            <div class="mb-6">
                <form action="{{ route('Data_Wali') }}" method="GET" class="flex gap-3">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all"
                            placeholder="Cari nama wali...">
                    </div>
                    <button 
                        type="submit"
                        class="px-6 py-2.5 bg-teal-500 hover:bg-teal-600 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                        Cari
                    </button>
                    @if(request('search'))
                    <a 
                        href="{{ route('Data_Wali') }}"
                        class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-all duration-200">
                        Reset
                    </a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span>Nama Wali</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($dataWali as $index => $wali)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-teal-500 flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr($wali->nama, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $wali->nama }}</div>
                                        <div class="text-xs text-gray-500">ID: {{ $wali->id_orangtua }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <button 
                                    class="inline-flex items-center px-4 py-2 bg-teal-500 hover:bg-teal-600 text-white text-sm font-medium rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200"
                                    onclick="lihatDetail('{{ $wali->nama }}', '{{ $wali->id_orangtua }}')"
                                    aria-label="Lihat detail {{ $wali->nama }}">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <p class="text-gray-500 font-medium">
                                        @if(request('search'))
                                            Tidak ada hasil untuk "{{ request('search') }}"
                                        @else
                                            Tidak ada data wali
                                        @endif
                                    </p>
                                    <p class="text-gray-400 text-sm">
                                        @if(request('search'))
                                            Coba gunakan kata kunci pencarian lain
                                        @else
                                            Data akan muncul di sini ketika tersedia
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
