<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisController;
use App\Http\Controllers\LoginController;
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

Route::get('/login', [RegisController::class, 'showLoginForm'])->name('login');
Route::post('/login', [RegisController::class, 'login'])->name('login.submit');
Route::get('/login', [RegisController::class, 'showLoginForm'])->name('login');
Route::post('/login', [RegisController::class, 'login'])->name('login.submit');
Route::post('/logout', [RegisController::class, 'logout'])->name('logout');

Route::get('/registrasi', [RegisController::class, 'showRegisterForm'])->name('register.form');
Route::post('/registrasi', [RegisController::class, 'registrasi'])->name('registrasi');
