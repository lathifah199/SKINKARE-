<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PertumbuhanController extends Controller
 {public function show(Anak $anak)
{

    $anak_utama = $anak;

    // Bisa ambil data pertumbuhan atau lainnya
    $pertumbuhan = $anak->pertumbuhan()->latest()->get();

    return view('pages.pertumbuhan', compact('anak_utama', 'pertumbuhan'));
}}