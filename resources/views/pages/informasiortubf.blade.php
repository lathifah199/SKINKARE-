@extends('layouts.appbf')

@section('title', 'Informasi untuk Orang Tua')

@section('content')
<div class="min-h-screen bg-white py-12 px-4 sm:px-6 lg:px-8 mt-14">
  <div class="max-w-7xl mx-auto">
    
    {{-- Header Section --}}
    <div class="text-center mb-12">
      <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-[#53AFA2] to-[#6BC4B8] rounded-full mb-6 shadow-lg">
        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
        </svg>
      </div>
      <h1 class="text-4xl font-bold text-[#2A7F6F] mb-4">Informasi untuk Orang Tua</h1>
      <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
        Dapatkan informasi seputar kesehatan ibu, ayah, dan anak untuk mendukung tumbuh kembang optimal si kecil.
      </p>
    </div>

    {{-- Grid Artikel --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

      {{-- Artikel 1 --}}
      <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group shadow-md">
        <div class="relative overflow-hidden">
          <img src="https://image.cermati.com/directus/9e3f1c48-5a6c-4314-90cb-750720153849?.webp"   alt="Cegah Stunting Sejak Dini" 
               class="h-52 w-full object-cover group-hover:scale-110 transition-transform duration-500">
          <div class="absolute top-4 left-4">
            <span class="px-4 py-1.5 bg-gradient-to-r from-[#53AFA2] to-[#6BC4B8] text-white text-xs font-bold rounded-full shadow-md">
              Kesehatan Anak
            </span>
          </div>
        </div>
        <div class="p-6">
          <h2 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-[#2A7F6F] transition-colors">
            10 Cara Menjaga Kesehatan Anak Biar Tumbuh Kembangnya Terjamin
          </h2>
          <p class="text-gray-600 text-sm leading-relaxed mb-4">
            sebagai orang tua, kamu harus memahami 10 cara menjaga kesehatan anak tanpa membatasi kesempatannya untuk mempelajari hal baru dan bereksplorasi berikut ini.
          <a href="https://www.kemkes.go.id/article/view/24010900001/cegah-stunting-dengan-pola-makan-seimbang.html" 
             target="_blank" 
             class="inline-flex items-center text-[#2A7F6F] font-bold hover:gap-2 transition-all group">
             Baca Selengkapnya 
             <svg class="w-5 h-5 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
             </svg>
          </a>
        </div>
      </div>

      {{-- Artikel 2 --}}
      <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group shadow-md">
        <div class="relative overflow-hidden">
          <img src="https://sigap.tanotofoundation.org/wp-content/uploads/2021/09/SIGAP_BasicRetouch-16.jpg"               alt="Parenting Positif" 
               class="h-52 w-full object-cover group-hover:scale-110 transition-transform duration-500">
          <div class="absolute top-4 left-4">
            <span class="px-4 py-1.5 bg-gradient-to-r from-[#53AFA2] to-[#6BC4B8] text-white text-xs font-bold rounded-full shadow-md">
              Parenting
            </span>
          </div>
        </div>
        <div class="p-6">
          <h2 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-[#2A7F6F] transition-colors">
            Membangun Komunikasi Positif dengan Anak
          </h2>
          <p class="text-gray-600 text-sm leading-relaxed mb-4">
            menciptakan lingkungan yang mendukung komunikasi positif menjadi hal yang krusial dalam membantu anak mengembangkan kemampuan berbicara dan memahami lawan bicara dengan baik.
          <a href="https://communityspeech.com/peran-komunikasi-positif-dalam-perkembangan-bahasa-anak/"      target="_blank" 
             class="inline-flex items-center text-[#2A7F6F] font-bold hover:gap-2 transition-all group">
             Baca Selengkapnya 
             <svg class="w-5 h-5 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
             </svg>
          </a>
        </div>
      </div>

      {{-- Artikel 3 --}}
      <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group shadow-md">
        <div class="relative overflow-hidden">
          <img src="https://img.okezone.com/content/2017/05/24/481/1698598/saatnya-mengetahui-prinzip-gizi-seimbang-untuk-ibu-hamil-dan-menyusui-qZIGglyfpm.jpg"               alt="Nutrisi Ibu Hamil" 
               class="h-52 w-full object-cover group-hover:scale-110 transition-transform duration-500">
          <div class="absolute top-4 left-4">
            <span class="px-4 py-1.5 bg-gradient-to-r from-[#53AFA2] to-[#6BC4B8] text-white text-xs font-bold rounded-full shadow-md">
              Kesehatan Ibu
            </span>
          </div>
        </div>
        <div class="p-6">
          <h2 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-[#2A7F6F] transition-colors">
            Nutrisi Penting untuk Ibu Hamil dan Menyusui
          </h2>
          <p class="text-gray-600 text-sm leading-relaxed mb-4">
            Penuhi kebutuhan gizi selama kehamilan untuk menjaga kesehatan ibu dan pertumbuhan janin yang optimal.
          </p>
          <a href="https://repository.kemkes.go.id/book/879" 
             target="_blank" 
             class="inline-flex items-center text-[#2A7F6F] font-bold hover:gap-2 transition-all group">
             Baca Selengkapnya 
             <svg class="w-5 h-5 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
             </svg>
          </a>
        </div>
      </div>

      {{-- Artikel 4 --}}
      <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group shadow-md">
        <div class="relative overflow-hidden">
          <img src="https://image.popmama.com/post/20251022/upload_8aa716eb973c0a82f8182a3061bced74_257d7fd7-c970-4224-85ce-c5a7746d8c5a.jpg?tr=w-1200,f-webp,q-75&width=1200&format=webp&quality=75"               alt="Peran Ayah" 
               class="h-52 w-full object-cover group-hover:scale-110 transition-transform duration-500">
          <div class="absolute top-4 left-4">
            <span class="px-4 py-1.5 bg-gradient-to-r from-[#53AFA2] to-[#6BC4B8] text-white text-xs font-bold rounded-full shadow-md">
              Peran Ayah
            </span>
          </div>
        </div>
        <div class="p-6">
          <h2 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-[#2A7F6F] transition-colors">
            Peran Ayah dalam Tumbuh Kembang Anak
          </h2>
          <p class="text-gray-600 text-sm leading-relaxed mb-4">
            Dukungan dan kehadiran ayah berperan penting dalam pembentukan karakter dan kesehatan mental anak.
          </p>
          <a href="https://www.popmama.com/kid/4-5-years-old/pentingnya-peran-ayah-dalam-mengasuh-anak-00-sdwkg-z91j2g "  target="_blank" 
             class="inline-flex items-center text-[#2A7F6F] font-bold hover:gap-2 transition-all group">
             Baca Selengkapnya 
             <svg class="w-5 h-5 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
             </svg>
          </a>
        </div>
      </div>

      {{-- Artikel 5 --}}
      <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group shadow-md">
        <div class="relative overflow-hidden">
          <img src="https://www.ybkb.or.id/wp-content/uploads/ayah-ibu-anak-memasak-bersama.jpg" 
               alt="Menu Sehat Keluarga" 
               class="h-52 w-full object-cover group-hover:scale-110 transition-transform duration-500">
          <div class="absolute top-4 left-4">
            <span class="px-4 py-1.5 bg-gradient-to-r from-[#53AFA2] to-[#6BC4B8] text-white text-xs font-bold rounded-full shadow-md">
              Peran Keluarga
            </span>
          </div>
        </div>
        <div class="p-6">
          <h2 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-[#2A7F6F] transition-colors">
           Peran Orang Tua dalam Mendukung 7 Kebiasaan Anak Indonesia Hebat
          </h2>
          <p class="text-gray-600 text-sm leading-relaxed mb-4">
            Kebiasaan sehat anak seperti bangun pagi, olahraga, dan menerapkan pola makan sehat anak perlu dibentuk sejak dini. 
          </p>
          <a href="https://www.ybkb.or.id/peran-orang-tua-dalam-mendukung-7-kebiasaan-anak-indonesia-hebat/" 
             target="_blank" 
             class="inline-flex items-center text-[#2A7F6F] font-bold hover:gap-2 transition-all group">
             Baca Selengkapnya 
             <svg class="w-5 h-5 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
             </svg>
          </a>
        </div>
      </div>

      {{-- Artikel 6 - Kesehatan Mental --}}
      <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group shadow-md">
        <div class="relative overflow-hidden">
          <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
               alt="Kesehatan Mental" 
               class="h-52 w-full object-cover group-hover:scale-110 transition-transform duration-500">
          <div class="absolute top-4 left-4">
            <span class="px-4 py-1.5 bg-gradient-to-r from-[#53AFA2] to-[#6BC4B8] text-white text-xs font-bold rounded-full shadow-md">
              Kesehatan Mental
            </span>
          </div>
        </div>
        <div class="p-6">
          <h2 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-[#2A7F6F] transition-colors">
            Menjaga Kesehatan Mental Orang Tua: Fondasi Keluarga Bahagia Dan Teladan Yang Baik Bagi Anak
          </h2>
          <p class="text-gray-600 text-sm leading-relaxed mb-4">
            Menjadi orang tua adalah sebuah perjalanan yang penuh dengan cinta, kebahagiaan, dan tantangan. Di balik senyum dan tawa anak-anak, seringkali tersembunyi beban dan tekanan yang dialami oleh orang tua
          <a href="https://pedia.or.id/menjaga-kesehatan-mental-orang-tua-fondasi-keluarga-bahagia-dan-teladan-yang-baik-bagi-anak/"             target="_blank" 
             class="inline-flex items-center text-[#2A7F6F] font-bold hover:gap-2 transition-all group">
             Baca Selengkapnya 
             <svg class="w-5 h-5 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
             </svg>
          </a>
        </div>
      </div>

    </div>

    {{-- Call to Action --}}
    <div class="mt-16 bg-gradient-to-r from-[#53AFA2] to-[#6BC4B8] rounded-2xl p-8 md:p-12 text-center shadow-xl">
      <h3 class="text-2xl md:text-3xl font-bold text-white mb-4">
        Punya Pertanyaan Seputar Kesehatan Anak?
      </h3>
      <p class="text-white/90 text-lg mb-6 max-w-2xl mx-auto">
        Konsultasikan dengan tenaga kesehatan profesional untuk mendapatkan informasi yang tepat
      </p>

    </div>

  </div>
</div>
@endsection