<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DataWaliController;
use App\Http\Controllers\DataAnakController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\RiwayatController;

Route::get('/', function () {
    return view('welcome');
});

// ======================= AUTH =======================
Route::get('/login', [RegisController::class, 'showLoginForm'])->name('login');
Route::post('/login', [RegisController::class, 'login'])->name('login.submit');
Route::post('/logout', [RegisController::class, 'logout'])->name('logout');
Route::get('/lupa_sandi', [RegisController::class, 'showLupaSandiForm'])->name('lupa_sandi');
Route::post('/lupa_sandi', [RegisController::class, 'showLupaSandi'])->name('lupaSandi.submit');

Route::get('/registrasi', [RegisController::class, 'showRegisterForm'])->name('register.form');
Route::post('/registrasi', [RegisController::class, 'registrasi'])->name('registrasi');

// ======================= HALAMAN UTAMA =======================
Route::view('/halaman_orangtua', 'pages.halaman_orang_tua')->name('halaman_orang_tua');
Route::view('/halaman_nakes', 'pages.halaman_nakes')->name('halaman_nakes');
Route::view('/pertumbuhan', 'pages.pertumbuhan')->name('pertumbuhan');

// ======================= DATA ANAK =======================
// Form input data anak (awal sebelum pengukuran)
Route::get('/tambah-data-anak', [AnakController::class, 'create'])->name('tambah.data.anak');
Route::post('/tambah-data-anak', [AnakController::class, 'store'])->name('anak.store');

// Tabel daftar anak
Route::get('/data-anak', [DataAnakController::class, 'index'])->name('data-anak.index');

// ======================= SCAN PENGUKURAN =======================
Route::get('/scan_tinggi', [ScanController::class, 'index'])->name('scan_tinggi');
Route::get('/scan_berat', [ScanController::class, 'berat'])->name('scan_berat');
Route::get('/hasil_scan', [ScanController::class, 'hasilScan'])->name('hasil_scan');
Route::get('/input_manual', [ScanController::class, 'inputManual'])->name('input_manual');

// ======================= Riwayat Anak ==================
Route::get('/riwayat_anak', [RiwayatController::class, 'riwayat'])->name('riwayat_anak');

// ======================= DATA WALI =======================
Route::get('/data-wali', [DataWaliController::class, 'index'])->name('data-wali.index');
Route::get('/data-wali/{id}', [DataWaliController::class, 'show'])->name('data-wali.show');

// ======================= BARCODE (QR CODE) =======================
// Menampilkan barcode per anak
Route::get('/barcode/hasil/{id}', [BarcodeController::class, 'showBarcode'])->name('barcode.hasil');
// Jika barcode di-scan → tampilkan halaman hasil pengukuran anak tsb
Route::get('/barcode/detail/{id}', [BarcodeController::class, 'showDetail'])->name('barcode.detail');
// Tombol download QR
Route::get('/barcode/download/{id}', [BarcodeController::class, 'download'])->name('barcode.download');
