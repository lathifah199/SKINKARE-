<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Http\Request;

class AnakController extends Controller
{
    public function create()
    {
        return view('pages.tambah_data_anak');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'umur' => 'required|integer',
            'ttl' => 'required|string|max:255',
        ]);

        $anak = Anak::create($validated);

        // Setelah input data awal, lanjut ke scan tinggi terlebih dahulu
        return redirect()->route('scan_tinggi', $anak->id);
    }

    public function scanTinggi($id)
    {
        $anak = Anak::findOrFail($id);
        return view('pages.scan_tinggi', compact('anak'));
    }

    public function storeTinggi(Request $request, $id)
    {
        $request->validate(['tinggi_badan' => 'required|numeric']);

        $anak = Anak::findOrFail($id);
        $anak->update(['tinggi_badan' => $request->tinggi_badan]);

        // Setelah scan tinggi, lanjut ke scan berat
        return redirect()->route('scan_berat', $anak->id);
    }

    public function scanBerat($id)
    {
        $anak = Anak::findOrFail($id);
        return view('pages.scan_berat', compact('anak'));
    }

    public function storeBerat(Request $request, $id)
    {
        $request->validate(['berat_badan' => 'required|numeric']);

        $anak = Anak::findOrFail($id);
        $anak->update([
            'berat_badan' => $request->berat_badan,
            'hasil_deteksi' => $this->hitungStatusGizi($request->berat_badan, $anak->tinggi_badan)
        ]);

        // Setelah scan berat, langsung tampilkan hasil
        return redirect()->route('anak.hasil', $anak->id);
    }

    public function hasil($id)
    {
        $anak = Anak::findOrFail($id);
        return view('pages.hasil_deteksi', compact('anak'));
    }

    private function hitungStatusGizi($berat, $tinggi)
    {
        if (!$berat || !$tinggi) return null;

        $imt = $berat / pow($tinggi / 100, 2);

        if ($imt < 13) return 'Gizi Buruk';
        elseif ($imt < 14) return 'Gizi Kurang';
        elseif ($imt < 17) return 'Gizi Baik';
        else return 'Gizi Lebih';
    }
}
