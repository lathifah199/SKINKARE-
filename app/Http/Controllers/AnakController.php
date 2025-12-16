<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Orangtua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // ==========================
        // VALIDASI DATA ANAK (WAJIB)
        // ==========================
        $validated = $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'umur'          => 'required|integer',
            'tempat_lahir'  => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
        ]);

        // ==========================
        // JIKA ORANG TUA LOGIN
        // ==========================
        if (Auth::guard('orangtua')->check()) {
            $validated['id_orangtua'] = Auth::guard('orangtua')->id();
            $validated['id_nakes'] = null;
        }

        // ==========================
        // JIKA NAKES LOGIN
        // ==========================
        if (Auth::guard('nakes')->check()) {

            // VALIDASI DATA ORANG TUA
            $request->validate([
                'ortu_nama'     => 'required|string|max:255',
                'ortu_no_hp'    => 'required|string|max:20',
                'domisili' => 'required|string|max:255',
            ]);

            // SIMPAN ORANG TUA
            $orangtua = Orangtua::create([
                'nama'     => $request->ortu_nama,
                'no_hp'    => $request->ortu_no_hp,
                'domisili' => $request->domisili,
            ]);

            // HUBUNGKAN KE ANAK
            $validated['id_orangtua'] = $orangtua->id_orangtua; // ⬅️ INI PENTING
            $validated['id_nakes'] = Auth::guard('nakes')->id();
        }

        // ==========================
        // SIMPAN DATA ANAK
        // ==========================
        $anak = Anak::create($validated);

        // ==========================
        // REDIRECT KE SCAN
        // ==========================
        return redirect()->route('scan_tinggi', $anak->id);
    }

    // ➤ HALAMAN SCAN TINGGI
    public function scanTinggi($id)
    {
        $anak = Anak::findOrFail($id);
        return view('pages.scan_tinggi', compact('anak'));
    }

    // ➤ SIMPAN TINGGI
    public function storeTinggi(Request $request, $id)
    {
        $request->validate([
            'tinggi_badan' => 'required|numeric'
        ]);

        $anak = Anak::findOrFail($id);

        $anak->update([
            'tinggi_badan' => $request->tinggi_badan
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tinggi berhasil disimpan',
            'redirect_url' => route('scan.berat', $anak->id)
        ]);
    }
}