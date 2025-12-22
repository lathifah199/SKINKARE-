<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Pemeriksaan;
use App\Models\Orangtua;
use App\Models\HasilDeteksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AnakController extends Controller
{
    // ➤ FORM TAMBAH DATA ANAK
    public function create()
    {
        if (Auth::guard('orangtua')->check()) {
            $layout = 'layouts.orangtuanofooter';
        } elseif (Auth::guard('nakes')->check()) {
            $layout = 'layouts.app_nakesnofooter';
        } else {
            $layout = 'layouts.appbf';
        }

        return view('pages.tambah_data_anak', compact('layout'));
    }

    // ➤ SIMPAN DATA AWAL ANAK
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'umur'          => 'required|integer',
            'tempat_lahir'  => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
        ]);

        if (Auth::guard('orangtua')->check()) {
            $validated['id_orangtua'] = Auth::guard('orangtua')->id();
            $validated['id_nakes'] = null;
        }

        if (Auth::guard('nakes')->check()) {
            $request->validate([
                'ortu_nama'  => 'required|string|max:255',
                'ortu_no_hp' => 'required|string|max:20',
                'domisili'   => 'required|string|max:255',
            ]);

            $orangtua = Orangtua::create([
                'nama'     => $request->ortu_nama,
                'no_hp'    => $request->ortu_no_hp,
                'domisili' => $request->domisili,
            ]);

            $validated['id_orangtua'] = $orangtua->id_orangtua;
            $validated['id_nakes'] = Auth::guard('nakes')->id();
        }

        $anak = Anak::create($validated);

        return redirect()->route('scan_tinggi', $anak->id);
    }

    // ➤ HALAMAN SCAN TINGGI
    public function scanTinggi($id)
    {
        $anak = Anak::findOrFail($id);
        return view('pages.scan_tinggi', compact('anak'));
    }

    // ➤ SIMPAN TINGGI (masuk ke tabel pemeriksaan)
    public function storeTinggi(Request $request, $id)
    {
        $request->validate([
            'tinggi_badan' => 'required|numeric',
        ]);

        try {
            $anak = Anak::findOrFail($id);

            // Simpan ke tabel pemeriksaan
            $pemeriksaan = Pemeriksaan::create([
                'id' => $anak->id, // FK ke tabel anaks
                'tanggal_pemeriksaan' => now(),
                'tinggi_badan' => $request->tinggi_badan,
                'berat_badan' => null, // nanti diisi di langkah berikutnya
                'metode_input' => $request->metode_input ?? 'otomatis',
            ]);

            Log::info('Data pemeriksaan berhasil disimpan', $pemeriksaan->toArray());

            return response()->json([
                'success' => true,
                'message' => 'Tinggi berhasil disimpan',
                'redirect_url' => route('scan.berat', $pemeriksaan->id_pemeriksaan),
            ]);

        } catch (\Exception $e) {
            Log::error('Gagal menyimpan pemeriksaan: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan data'], 500);
        }
    }
}
