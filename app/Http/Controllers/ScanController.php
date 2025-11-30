<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Anak; // ← TAMBAHKAN INI

class ScanController extends Controller
{
    // ➤ UBAH METHOD INI
    public function index($id) 
    { 
        $anak = Anak::findOrFail($id);
        return view('pages.scan_tinggi', compact('anak')); 
    }
    
    public function berat() { return view('pages.input_berat'); }

    public function predict(Request $request)
    {
        if (!$request->hasFile('foto')) {
            return response()->json(['error' => 'Tidak ada file dikirim'], 400);
        }

        $file = $request->file('foto');

        try {
            $response = Http::attach(
                'file',
                file_get_contents($file),
                $file->getClientOriginalName()
            )->post('http://127.0.0.1:5000/predict'); // pastikan Flask running

            if (!$response->ok()) {
                Log::error("Flask error:", [$response->body()]);
                return response()->json(['error' => 'Flask gagal memproses'], 500);
            }

            return $response->json(); // hasil: {"tinggi": ...}

        } catch (\Exception $e) {
            Log::error("Request Error:", [$e->getMessage()]);
            return response()->json(['error' => 'Tidak dapat terhubung ke Flask'], 500);
        }
    }    
}