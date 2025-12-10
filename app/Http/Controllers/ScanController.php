<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Anak;

class ScanController extends Controller
{
    // ===================== SCAN TINGGI =====================
    public function index($id)
    {
        $anak = Anak::findOrFail($id);
        return view('pages.scan_tinggi', compact('anak'));
    }

    // ===================== SCAN BERAT / INPUT BERAT =====================
    public function berat($id)
    {
        $anak = Anak::findOrFail($id);
        return view('pages.input_berat', compact('anak'));
    }

    // ===================== PREDICT TINGGI (CNN) =====================
    public function predict(Request $request)
    {
        if (!$request->hasFile('foto')) {
            return response()->json(['error' => 'Tidak ada file dikirim'], 400);
        }

        $file = $request->file('foto');

        try {
            // Kirim gambar ke Flask CNN
            $response = Http::attach(
                'file',
                file_get_contents($file),
                $file->getClientOriginalName()
            )->post('http://127.0.0.1:5000/predict'); // endpoint CNN kamu

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

 // ===================== SIMPAN HASIL SCAN BERAT =====================
public function storeBerat(Request $request, $id)
{
    // Validasi input berat
    $request->validate([
        'berat_badan' => 'required|numeric',
    ]);

    try {
        // Ambil data anak
        $anak = Anak::findOrFail($id);

        // Simpan berat badan ke database
        $anak->berat_badan = $request->berat_badan;
        $anak->save();

        // Logging untuk debugging (opsional)
        \Log::info('Berat badan tersimpan dan redirect ke hasil deteksi', ['id' => $id]);

        // ✅ Setelah tersimpan → lanjut ke halaman hasil deteksi (Flask Random Forest)
        return redirect()->route('scan.hasil', ['id' => $id])
                         ->with('success', 'Data berat badan berhasil disimpan!');
    } catch (\Exception $e) {
        // Jika gagal menyimpan
        \Log::error('Gagal menyimpan berat: ' . $e->getMessage());
        return back()->with('error', 'Gagal menyimpan berat badan');
    }
}

public function hasil($id)
{
    $anak = Anak::findOrFail($id);

    try {
        $response = Http::post('http://127.0.0.1:5001/predict_rf', [
            'umur' => $anak->umur,
            'tinggi_badan' => $anak->tinggi_badan,
            'berat_badan' => $anak->berat_badan,
            'jenis_kelamin' => $anak->jenis_kelamin === 'L' ? 'laki-laki' : 'perempuan',
        ]);

        if ($response->failed()) {
            return back()->with('error', 'Gagal memproses data di Flask.');
        }

        $data = $response->json();

        $hasil     = $data['hasil'] ?? 'Tidak diketahui';
        $status    = $data['status_prediksi'] ?? 'Tidak diketahui';
        $risiko    = $data['risiko_persen'] ?? null;
        $zscore    = $data['zscore'] ?? null;
        $warna     = $data['warna_risiko'] ?? '#808080'; // ✅ Tambah ini
        $kategori  = $data['kategori_risiko'] ?? 'Tidak diketahui'; // ✅ Dan ini

        // Simpan hasil ke database
        $anak->hasil_deteksi = $hasil;
        $anak->save();

        // Kirim ke Blade
        return view('pages.hasil_deteksi', compact(
            'anak',
            'hasil',
            'data',
            'status',
            'risiko',
            'zscore',
            'warna',
            'kategori'
        ));

    } catch (\Exception $e) {
        \Log::error('Gagal terhubung ke Flask: ' . $e->getMessage());
        return back()->with('error', 'Tidak dapat terhubung ke server AI.');
    }
}
}