<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    // Menampilkan halaman profil orangtua
    public function index()
    {
        $orangtua = Auth::guard('orangtua')->user();
        return view('pages.profil', compact('orangtua'));
    }

    // Memproses update profil orangtua
    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|string|email|max:255',
            'no_hp' => 'required|string|max:12',
            'domisili' => 'required|string|max:255',
            'kata_sandi' => 'nullable|string|min:6|confirmed',
        ]);

        $orangtua = Auth::guard('orangtua')->user();

        $orangtua->nama = $request->nama;
        $orangtua->email = $request->email;
        $orangtua->no_hp = $request->no_hp;
        $orangtua->domisili = $request->domisili;

        // Kalau user isi kata sandi baru, update juga
        if ($request->filled('kata_sandi')) {
            $orangtua->kata_sandi = bcrypt($request->kata_sandi);
        }

        $orangtua->save();

        return redirect()->route('profil.orangtua')->with('success', 'Profil berhasil diperbarui!');
    }
}
