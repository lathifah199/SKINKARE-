<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DataWaliController;
use App\Http\Controllers\DataAnakController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PertumbuhanController;

Route::get('/', function () {
    return view('pages.halamanbf');
});

// ======================= AUTH =======================
Route::get ('/login', [RegisController::class, 'showLoginForm'])->name('login');
Route::post('/login', [RegisController::class, 'login'])->name('login.submit');
Route::post('/logout', [RegisController::class, 'logout'])->name('logout');
Route::get('/lupa_sandi', [RegisController::class, 'showLupaSandiForm'])->name('lupa_sandi');
Route::post('/lupa_sandi', [RegisController::class, 'showLupaSandi'])->name('lupaSandi.submit');

Route::get('/halaman_nakes', [NakesController::class, 'index'])->name('halaman_nakes');

Route::get('/registrasi', [RegisController::class, 'showRegisterForm'])->name('register.form');
Route::post('/registrasi', [RegisController::class, 'registrasi'])->name('registrasi');

// ======================= HALAMAN UTAMA =======================
Route::get('/halaman_orangtua', [DataWaliController::class, 'halaman_orangtua'])->name('halaman_orangtua');
Route::view('/halamanbf', 'pages.halamanbf')->name('halamanbf');
Route::view('/pertumbuhan', 'pages.pertumbuhan')->name('pertumbuhan');
// Daftar pertumbuhan anak
Route::get('/pertumbuhan/{anak}', [PertumbuhanController::class, 'show'])->name('pertumbuhan.show');

Route::view('/informasiortu', 'pages.informasiortu')->name('informasiortu');
Route::view('/informasiortubf', 'pages.informasiortubf')->name('informasiortubf');

// ======================= DATA ANAK =======================
// Form input data anak (awal sebelum pengukuran)
Route::get('/tambah-data-anak', [AnakController::class, 'create'])->name('tambah.data.anak');
Route::post('/tambah-data-anak', [AnakController::class, 'store'])->name('anak.store');

// Tabel daftar anak
Route::get('/data-anak', [DataAnakController::class, 'index'])->name('data-anak.index');

// ======================= SCAN PENGUKURAN =======================

// Scan tinggi (AI)
Route::get('/scan_tinggi/{id}', [AnakController::class, 'scanTinggi'])->name('scan_tinggi');


// API dari AI (predict)
Route::post('/scan/predict', [ScanController::class, 'predict'])->name('scan.predict');

// Simpan tinggi hasil AI / manual
Route::post('/scan_tinggi/{id}/store', [AnakController::class, 'storeTinggi'])->name('scan_tinggi.store');


// ======================= INPUT BERAT  =======================
Route::get('/input_berat/{id}', [AnakController::class, 'inputBerat'])->name('input_berat');
// Simpan berat manual
Route::post('/input_berat/{id}/store', [AnakController::class, 'storeBerat'])->name('input_berat.store');


// ======================= Riwayat Anak ==================
Route::get('/riwayat_anak', [RiwayatController::class, 'riwayat'])->name('riwayat_anak');

// ======================= DATA WALI =======================
Route::get('data-wali', [DataWaliController::class, 'index'])
    ->name('Data_Wali');
//Route::get('/data-wali', [DataWaliController::class, 'index'])->name('data-wali.index');
Route::get('/data-wali/{id}', [DataWaliController::class, 'show'])->name('data-wali.show');

// ======================= BARCODE (QR CODE) =======================
// Menampilkan barcode per anak
Route::get('/barcode/hasil/{id}', [BarcodeController::class, 'showBarcode'])->name('barcode.hasil');
// Jika barcode di-scan → tampilkan halaman hasil pengukuran anak tsb
Route::get('/barcode/detail/{id}', [BarcodeController::class, 'showDetail'])->name('barcode.detail');
// Tombol download QR
Route::get('/barcode/download/{id}', [BarcodeController::class, 'download'])->name('barcode.download');

// ======================= PROFIL PENGGUNA =======================
Route::get('/profil', [DataWaliController::class, 'profil'])->name('profil');
Route::middleware('auth:orangtua')->group(function () {
    Route::get('/profil-orangtua', [ProfilController::class, 'index'])->name('profil.orangtua');
    Route::post('/profil-orangtua/update', [ProfilController::class, 'update'])->name('profil.update');
});



Route::get('/SKINKARE', function () {
    return view('pages.splash');
});

