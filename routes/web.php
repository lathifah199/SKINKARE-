<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/halaman_orangtua', function () {
    return view('pages.halaman_orang_tua');
});

Route::get('/login', function () {
    return view('pages.login');
});
Route::get('/registrasi', function () {
    return view('pages.registrasi');
});

