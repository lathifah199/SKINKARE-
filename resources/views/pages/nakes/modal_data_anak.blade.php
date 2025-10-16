<!-- Modal Detail dengan Data Dummy -->
<div id="modalDetail" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[9999] p-4 backdrop-blur-sm transition-all duration-300" onclick="tutupModal()">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto" id="modalContent" onclick="event.stopPropagation()">
        
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-[#F3C0CD] to-[#E8A8B8] px-6 py-4 rounded-t-2xl sticky top-0 z-10">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="h-10 w-10 rounded-full bg-white/30 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Detail Data Anak</h3>
                </div>
                <button onclick="tutupModal()" class="text-white hover:bg-white/20 rounded-full p-2 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="p-6 space-y-4">
            <!-- Loading State -->
            <div id="loadingState" class="hidden">
                <div class="flex items-center justify-center py-8">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-pink-500"></div>
                </div>
            </div>

            <!-- Data Content -->
            <div id="dataContent" class="space-y-4">
                <!-- Photo Placeholder -->
                <div class="flex justify-center mb-4">
                    <div class="w-32 h-32 bg-gray-200 rounded-lg flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- Nama -->
                <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <div class="flex-shrink-0 mt-1">
                        <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Nama</p>
                        <p class="text-sm font-medium text-gray-900 mt-1" id="detailNama">-</p>
                    </div>
                </div>

                <!-- Jenis Kelamin -->
                <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <div class="flex-shrink-0 mt-1">
                        <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Jenis Kelamin</p>
                        <p class="text-sm font-medium text-gray-900 mt-1" id="detailJenisKelamin">-</p>
                    </div>
                </div>

                <!-- Umur -->
                <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <div class="flex-shrink-0 mt-1">
                        <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Umur</p>
                        <p class="text-sm font-medium text-gray-900 mt-1" id="detailUmur">-</p>
                    </div>
                </div>

                <!-- Tinggi & Berat Badan -->
                <div class="grid grid-cols-2 gap-3">
                    <div class="flex items-start space-x-2 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">TB</p>
                            <p class="text-sm font-medium text-gray-900 mt-1" id="detailTB">-</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-2 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">BB</p>
                            <p class="text-sm font-medium text-gray-900 mt-1" id="detailBB">-</p>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <div class="flex-shrink-0 mt-1">
                        <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Status</p>
                        <p class="text-sm font-medium text-gray-900 mt-1" id="detailStatus">-</p>
                    </div>
                </div>

                <!-- Anak Dari -->
                <div class="flex items-start space-x-3 p-3 bg-pink-50 rounded-lg border border-pink-100">
                    <div class="flex-shrink-0 mt-1">
                        <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Anak Dari</p>
                        <p class="text-sm font-medium text-gray-900 mt-1" id="detailAnakDari">-</p>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <div class="flex-shrink-0 mt-1">
                        <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Alamat</p>
                        <p class="text-sm font-medium text-gray-900 mt-1" id="detailAlamat">-</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="bg-gray-50 rounded-b-2xl px-6 py-4 flex justify-center sticky bottom-0 z-10">
            <button 
                onclick="tutupModal()" 
                class="px-6 py-2.5 bg-teal-500 hover:bg-teal-600 text-white font-medium rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                <span>Tutup</span>
            </button>
        </div>
    </div>
</div>

<!-- Script dengan Data Dummy -->
<script>
// Data dummy untuk pop-up
const dummyData = {
    jenisKelamin: ['Laki-laki', 'Perempuan'],
    umur: ['3 tahun', '4 tahun', '5 tahun', '6 tahun', '7 tahun', '8 tahun'],
    tinggiBadan: ['95 cm', '100 cm', '105 cm', '110 cm', '115 cm', '120 cm', '125 cm'],
    beratBadan: ['12 kg', '14 kg', '16 kg', '18 kg', '20 kg', '22 kg', '24 kg'],
    status: ['Normal', 'beresiko Stunting 5%'],
    orangTua: [
        'Kharina'
    ],
    alamat: [
        'Permata laguna blok A9 no 9'
    ]
};

function getRandomItem(array) {
    return array[Math.floor(Math.random() * array.length)];
}

function lihatDetail(nama, id) {
    const modal = document.getElementById('modalDetail');
    const modalContent = document.getElementById('modalContent');
    const loadingState = document.getElementById('loadingState');
    const dataContent = document.getElementById('dataContent');
    
    // Show modal with animation
    modal.classList.remove('hidden');
    modal.offsetHeight;
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    // Show loading state
    loadingState.classList.remove('hidden');
    dataContent.classList.add('hidden');
    
    // Simulate loading delay
    setTimeout(() => {
        // Hide loading, show data
        loadingState.classList.add('hidden');
        dataContent.classList.remove('hidden');
        
        // Generate dummy data
        const dummyJenisKelamin = getRandomItem(dummyData.jenisKelamin);
        const dummyUmur = getRandomItem(dummyData.umur);
        const dummyTB = getRandomItem(dummyData.tinggiBadan);
        const dummyBB = getRandomItem(dummyData.beratBadan);
        const dummyStatus = getRandomItem(dummyData.status);
        const dummyOrangTua = getRandomItem(dummyData.orangTua);
        const dummyAlamat = getRandomItem(dummyData.alamat);
        
        // Populate with dummy data
        document.getElementById('detailNama').textContent = nama;
        document.getElementById('detailJenisKelamin').textContent = dummyJenisKelamin;
        document.getElementById('detailUmur').textContent = dummyUmur;
        document.getElementById('detailTB').textContent = dummyTB;
        document.getElementById('detailBB').textContent = dummyBB;
        document.getElementById('detailStatus').textContent = dummyStatus;
        document.getElementById('detailAnakDari').textContent = dummyOrangTua;
        document.getElementById('detailAlamat').textContent = dummyAlamat;
        
        // Show notification
        showNotification('Data berhasil dimuat (Demo Mode)', 'success');
    }, 800);
}

function tutupModal() {
    const modal = document.getElementById('modalDetail');
    const modalContent = document.getElementById('modalContent');
    
    // Animate out
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function showNotification(message, type = 'info') {
    const notificationDiv = document.createElement('div');
    const bgColor = type === 'error' ? 'bg-red-500' : type === 'success' ? 'bg-green-500' : 'bg-pink-500';
    
    notificationDiv.className = `fixed top-20 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-[10000] animate-bounce`;
    notificationDiv.innerHTML = `
        <div class="flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>${message}</span>
        </div>
    `;
    document.body.appendChild(notificationDiv);
    
    setTimeout(() => {
        notificationDiv.remove();
    }, 3000);
}

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const modal = document.getElementById('modalDetail');
        if (!modal.classList.contains('hidden')) {
            tutupModal();
        }
    }
});

// Prevent modal from closing when clicking inside modal content
document.getElementById('modalContent')?.addEventListener('click', function(event) {
    event.stopPropagation();
});
</script>

<style>
/* Custom scrollbar untuk tabel */
.overflow-x-auto::-webkit-scrollbar {
    height: 8px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #ec4899;
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #db2777;
}

/* Animation untuk loading */
@keyframes spin {
    to { transform: rotate(360deg); }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

/* Smooth transitions */
* {
    transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

/* Animation untuk notification */
@keyframes bounce {
    0%, 20%, 53%, 80%, 100% {
        transform: translate3d(0,0,0);
    }
    40%, 43% {
        transform: translate3d(0, -8px, 0);
    }
    70% {
        transform: translate3d(0, -4px, 0);
    }
    90% {
        transform: translate3d(0, -2px, 0);
    }
}

.animate-bounce {
    animation: bounce 1s ease-in-out;
}

/* Ensure modal is above everything */
#modalDetail {
    z-index: 9999 !important;
}

#modalContent {
    z-index: 10000 !important;
}
</style>