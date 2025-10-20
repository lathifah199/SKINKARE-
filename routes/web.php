<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DataWaliController;
use App\Http\Controllers\DataAnakController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\ScanController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/halaman_orangtua', function () {
    return view('pages.halaman_orang_tua');
})->name('halaman_orang_tua');;

Route::get('/login', function () {
    return view('pages.login');
});
Route::get('/registrasi', function () {
    return view('pages.registrasi');
});
Route::get('/scan_tinggi', function () {
    return view('pages.scan_tinggi');
});

Route::get('/login', [RegisController::class, 'showLoginForm'])->name('login');
Route::post('/login', [RegisController::class, 'login'])->name('login.submit');
Route::get('/login', [RegisController::class, 'showLoginForm'])->name('login');
Route::post('/login', [RegisController::class, 'login'])->name('login.submit');
Route::post('/logout', [RegisController::class, 'logout'])->name('logout');

Route::get('/registrasi', [RegisController::class, 'showRegisterForm'])->name('register.form');
Route::post('/registrasi', [RegisController::class, 'registrasi'])->name('registrasi');

Route::get('/halaman_nakes', function () {
    return view('pages.halaman_nakes');
})->name('halaman_nakes');;


Route::get('/scan_tinggi', [ScanController::class, 'index'])->name('scan_tinggi');
Route::get('/hasil_scan', [ScanController::class, 'hasilScan'])->name('hasil_scan');
Route::get('/scan_berat', [ScanController::class, 'berat'])->name('scan_berat');
Route::get('/data-wali', [DataWaliController::class, 'index'])->name('data-wali.index');
Route::get('/data-wali/{id}', [DataWaliController::class, 'show'])->name('data-wali.show');
Route::get('/data-anak', [DataAnakController::class, 'index'])->name('data-anak.index');
Route::get('/tambah-data-anak', [AnakController::class, 'create'])->name('tambah.data.anak');
Route::post('/tambah-data-anak', [AnakController::class, 'store'])->name('anak.store');
Route::get('/input_manual', [ScanController::class, 'inputManual'])->name('input_manual');
Route::get('/data-wali', [DataWaliController::class, 'index'])->name('data-wali.index');
Route::get('/data-wali/{id}', [DataWaliController::class, 'show'])->name('data-wali.show');
Route::get('/data-anak', [DataAnakController::class, 'index'])->name('data-anak.index');

Route::get('/tambah-data-anak', [AnakController::class, 'create'])->name('tambah.data.anak');
Route::post('/tambah-data-anak', [AnakController::class, 'store'])->name('anak.store');

Route::get('/pertumbuhan', function () {
    return view('pages.pertumbuhan');
})->name('pertumbuhan');;
