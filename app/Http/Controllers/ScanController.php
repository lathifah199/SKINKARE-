<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Anak;

class ScanController extends Controller
{
    // ===================== PRECHECK GAMBAR =====================
    public function precheck(Request $request)
    {
        // Validasi file
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5120', // 5MB max
        ]);

        try {
            $file = $request->file('foto');
            
            // Kirim ke Flask untuk precheck
            $response = Http::attach(
                'file',
                file_get_contents($file),
                $file->getClientOriginalName()
            )->timeout(30)->post('http://127.0.0.1:5000/precheck');

            if (!$response->ok()) {
                Log::error("Flask precheck error:", [$response->body()]);
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Gagal melakukan precheck gambar'
                ], 500);
            }

            $result = $response->json();
            
            return response()->json($result);

        } catch (\Exception $e) {
            Log::error("Precheck Error:", [$e->getMessage()]);
            return response()->json([
                'status' => 'failed',
                'message' => 'Tidak dapat terhubung ke server precheck'
            ], 500);
        }
    }

    // ===================== PREDICT TINGGI (CNN) =====================
    public function predict(Request $request)
    {
        // Validasi file
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        try {
            $file = $request->file('foto');
            
            // Kirim ke Flask untuk predict
            $response = Http::attach(
                'file',
                file_get_contents($file),
                $file->getClientOriginalName()
            )->timeout(30)->post('http://127.0.0.1:5000/predict');

            if (!$response->ok()) {
                Log::error("Flask predict error:", [$response->body()]);
                return response()->json([
                    'error' => 'Gagal memprediksi tinggi'
                ], 500);
            }

            $data = $response->json();
            
            return response()->json([
                'tinggi' => $data['tinggi'] ?? 0
            ]);

        } catch (\Exception $e) {
            Log::error("Predict Error:", [$e->getMessage()]);
            return response()->json([
                'error' => 'Tidak dapat terhubung ke server AI'
            ], 500);
        }
    }

    // ===================== Halaman Input Berat =====================
    public function berat($id)
    {
        $anak = Anak::findOrFail($id);
        
        // Pastikan tinggi sudah diisi
        if (!$anak->tinggi_badan) {
            return redirect()->route('scan_tinggi', ['id' => $id])
                             ->with('warning', 'Harap scan tinggi badan terlebih dahulu.');
        }

        return view('pages.input_berat', compact('anak'));
    }

    // ===================== SIMPAN BERAT =====================
    public function storeBerat(Request $request, $id)
    {
        // Validasi input berat
        $request->validate([
            'berat_badan' => 'required|numeric|min:1|max:100',
        ]);

        try {
            // Ambil data anak
            $anak = Anak::findOrFail($id);

            // Simpan berat badan ke database
            $anak->berat_badan = $request->berat_badan;
            $anak->save();

            Log::info('Berat badan tersimpan', [
                'anak_id' => $id,
                'berat' => $request->berat_badan,
                'nama' => $anak->nama
            ]);

            // Redirect ke halaman hasil deteksi
            return redirect()->route('scan.hasil', ['id' => $id])
                             ->with('success', 'Data berat badan berhasil disimpan!');

        } catch (\Exception $e) {
            Log::error('Gagal menyimpan berat: ' . $e->getMessage());
            return back()->with('error', 'Gagal menyimpan berat badan');
        }
    }

    // ===================== HASIL DETEKSI (Random Forest) =====================
    public function hasil($id)
    {
        $anak = Anak::findOrFail($id);

        // Validasi data lengkap
        if (!$anak->tinggi_badan || !$anak->berat_badan || !$anak->umur || !$anak->jenis_kelamin) {
            return redirect()->route('scan_tinggi', ['id' => $id])
                             ->with('error', 'Data anak tidak lengkap. Harap lengkapi terlebih dahulu.');
        }

        try {
            // Kirim data ke Flask untuk prediksi Random Forest
            $response = Http::timeout(60)->post('http://127.0.0.1:5001/predict_rf', [
                'umur' => (float) $anak->umur,
                'tinggi_badan' => (float) $anak->tinggi_badan,
                'berat_badan' => (float) $anak->berat_badan,
                'jenis_kelamin' => $anak->jenis_kelamin === 'L' ? 'laki-laki' : 'perempuan',
            ]);

            if ($response->failed()) {
                Log::error('Flask RF error:', [$response->body()]);
                return back()->with('error', 'Gagal memproses data di server AI.');
            }

            $data = $response->json();

            // Extract data dari response
            $hasil     = $data['hasil'] ?? 'Tidak diketahui';
            $status    = $data['status_prediksi'] ?? 'Tidak diketahui';
            $risiko    = $data['risiko_persen'] ?? null;
            $zscore    = $data['zscore'] ?? null;
            $warna     = $data['warna_risiko'] ?? '#808080';
            $kategori  = $data['kategori_risiko'] ?? 'Tidak diketahui';

            // Simpan hasil ke database
            $anak->hasil_deteksi = $hasil;
            $anak->save();

            // Kirim data ke view
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
            Log::error('Gagal terhubung ke Flask RF: ' . $e->getMessage());
            return back()->with('error', 'Tidak dapat terhubung ke server AI.');
        }
    }
}