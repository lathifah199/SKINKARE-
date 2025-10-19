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
}