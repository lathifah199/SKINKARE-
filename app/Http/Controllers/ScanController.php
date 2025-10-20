<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScanController extends Controller
{
    public function index()
    {
        return view ('pages.scan_tinggi');
    }
    public function berat()
    {
        return view ('pages.scan_berat');
    }
    public function hasilScan()
    {
        return view('pages.hasil_scan');
    }

    public function inputManual()
    {
        return view('pages.input_manual');
    }
}