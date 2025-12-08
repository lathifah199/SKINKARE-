<?php

namespace App\Http\Controllers;

use App\Models\Anak;
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
        $validated = $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'umur'          => 'required|integer',
            'tempat_lahir'  => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
        ]);

        // Ambil id orangtua dari session
        $validated['id_orangtua'] = session('user_id');

        // Buat anak baru
        $anak = Anak::create($validated);

        // Lanjut ke langkah scan tinggi
        return redirect()->route('scan_tinggi', $anak->id);
    }

    // ➤ HALAMAN SCAN TINGGI
    public function scanTinggi($id)
    {
        $anak = Anak::findOrFail($id);
        return view('pages.scan_tinggi', compact('anak'));
    }

    // ➤ SIMPAN TINGGI (SCAN AI / INPUT MANUAL)
    public function storeTinggi(Request $request, $id)
    {
        \Log::info('Store Tinggi Called', [
            'id' => $id,
            'request_data' => $request->all()
        ]);

        $request->validate([
            'tinggi_badan' => 'required|numeric'
        ]);

        $anak = Anak::findOrFail($id);

        $anak->update([
            'tinggi_badan' => $request->tinggi_badan
        ]);

        \Log::info('After Update', ['anak' => $anak->fresh()->toArray()]);

        return response()->json([
            'success' => true,
            'message' => 'Tinggi berhasil disimpan',
            'tinggi' => $request->tinggi_badan,
            'redirect_url' => route('scan.berat', $anak->id) // lanjut ke input berat
        ]);
    }
}
//Jadi di AnakController hanya tersisa fitur:
//tambah anak
//simpan data awal
//scan tinggi
//simpan tinggi