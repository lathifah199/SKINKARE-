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

// ===================== HASIL DETEKSI (Z-SCORE) =====================
public function hasil($id)
{
    $anak = Anak::findOrFail($id);

    try {
        // Kirim data ke Flask (Random Forest)
        $response = Http::asJson()->post('http://127.0.0.1:5001/predict_rf', [
            'umur' => (float) $anak->umur,
            'tinggi_badan' => (float) $anak->tinggi_badan,
            'berat_badan' => (float) $anak->berat_badan,
            'jenis_kelamin' => $anak->jenis_kelamin,
        ]);

        if ($response->failed()) {
            // ❌ Jika Flask gagal, tetap tampilkan halaman dengan data dummy/error
            \Log::error('Flask gagal memproses: ' . $response->body());
            $hasil = [
                'status' => 'Tidak dapat diproses - Server AI offline',
                'persentase_stunting' => 0,
                'imt' => 0,
                'bbu' => 'Data tidak tersedia',
                'tbu' => 'Data tidak tersedia',
                'bbtb' => 'Data tidak tersedia',
                'imtu' => 'Data tidak tersedia',
                'z_bbu' => 0,
                'z_tbu' => 0,
                'z_bbtb' => 0,
                'z_imtu' => 0,
                'rekomendasi' => ['Server AI sedang offline. Silakan coba lagi nanti atau hubungi admin.']
            ];
            return view('pages.hasil_deteksi', compact('anak', 'hasil'))
                   ->with('error', 'Gagal terhubung ke server AI. Menampilkan data dasar saja.');
        }

        $hasil = $response->json();

        // Simpan hasil ke DB (opsional)
        $anak->hasil_deteksi = $hasil['status'] ?? 'Tidak diketahui';
        $anak->save();

        // ✅ Kirim ke tampilan hasil_deteksi.blade
        return view('pages.hasil_deteksi', compact('anak', 'hasil'));
    } catch (\Exception $e) {
        // Jika exception (e.g., koneksi gagal), fallback sama
        \Log::error('Gagal terhubung ke Flask: ' . $e->getMessage());
        $hasil = [
            'status' => 'Error koneksi',
            'persentase_stunting' => 0,
            'imt' => 0,
            'bbu' => 'Error',
            'tbu' => 'Error',
            'bbtb' => 'Error',
            'imtu' => 'Error',
            'z_bbu' => 0,
            'z_tbu' => 0,
            'z_bbtb' => 0,
            'z_imtu' => 0,
            'rekomendasi' => ['Terjadi kesalahan teknis. Coba refresh halaman.']
        ];
        return view('pages.hasil_deteksi', compact('anak', 'hasil'))
               ->with('error', 'Gagal terhubung ke server AI.');
    }
}}