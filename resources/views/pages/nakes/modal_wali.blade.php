<!-- Modal Detail dengan Data Dummy -->
<div id="modalDetail" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[9999] p-4 backdrop-blur-sm transition-all duration-300" onclick="tutupModal()">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-95 opacity-0" id="modalContent" onclick="event.stopPropagation()">
        <!-- Modal Header -->
        <div class="bg-teal-600 px-6 py-4 rounded-t-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="h-10 w-10 rounded-full bg-white/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Detail Data Wali</h3>
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
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-teal-500"></div>
                </div>
            </div>

            <!-- Data Content -->
            <div id="dataContent" class="space-y-4">
                <!-- Nama -->
                <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <div class="flex-shrink-0 mt-1">
                        <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Nama</p>
                        <p class="text-sm font-medium text-gray-900 mt-1" id="detailNama">-</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <div class="flex-shrink-0 mt-1">
                        <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Email</p>
                        <p class="text-sm font-medium text-gray-900 mt-1 break-all" id="detailEmail">-</p>
                    </div>
                </div>

                <!-- No. WA -->
                <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <div class="flex-shrink-0 mt-1">
                        <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">No. WhatsApp</p>
                        <p class="text-sm font-medium text-gray-900 mt-1" id="detailNoWa">-</p>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <div class="flex-shrink-0 mt-1">
                        <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Alamat</p>
                        <p class="text-sm font-medium text-gray-900 mt-1" id="detailAlamat">-</p>
                    </div>
                </div>

                <!-- Wali Dari -->
                <div class="flex items-start space-x-3 p-3 bg-teal-50 rounded-lg border border-teal-100">
                    <div class="flex-shrink-0 mt-1">
                        <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Wali Dari</p>
                        <p class="text-sm font-medium text-gray-900 mt-1" id="detailWaliDari">-</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="bg-gray-50 rounded-b-2xl px-6 py-4 flex justify-center sticky bottom-0 z-10">
            <button 
                onclick="tutupModal()" 
                class="px-8 py-2.5 bg-[#F3C0CD] hover:bg-[#E8A8B8] text-white font-medium rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 flex items-center space-x-2">
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
        
        // 🔥 Fetch Data Dari Database
        fetch(`/data-wali/${id}`)
            .then(response => response.json())
            .then(data => {
                loadingState.classList.add('hidden');
                dataContent.classList.remove('hidden');

                // Isi data dari database
                console.log(data);
                document.getElementById('detailNama').textContent = data.nama ?? '-';
                document.getElementById('detailEmail').textContent = data.email ?? '-';
                document.getElementById('detailNoWa').textContent = data.no_hp ?? '-';
                document.getElementById('detailAlamat').textContent = data.alamat ?? '-';

                // Jika ada relasi anak
                let waliDari = '-';
                if (data.anak && data.anak.length > 0) {
                    waliDari = data.anak.map(a => a.nama).join(', ');
                }
                document.getElementById('detailWaliDari').textContent = waliDari;

                showNotification('Data berhasil dimuat', 'success');
            })
            .catch(error => {
                console.error(error);
                loadingState.classList.add('hidden');
                showNotification('Gagal memuat data', 'error');
            });

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
    const bgColor = type === 'error' ? 'bg-red-500' : type === 'success' ? 'bg-green-500' : 'bg-teal-500';
    
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
    background: #14b8a6;
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #0d9488;
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