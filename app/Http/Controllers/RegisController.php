<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Orangtua;
use Illuminate\Support\Facades\Hash;

class RegisController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('orangtua')->check()) {
            return redirect()->route('halaman_orangtua');
        }
        return view('pages.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'kata_sandi' => 'required|string'
        ]);

        $orangtua = Orangtua::where('nama', $request->nama)->first();

        if (!$orangtua) {
            return back()->withErrors(['nama' => 'Nama pengguna tidak ditemukan.']);
        }

        if (!Hash::check($request->kata_sandi, $orangtua->kata_sandi)) {
            return back()->withErrors(['kata_sandi' => 'Kata sandi salah.']);
        }

        // Gunakan guard pelanggan untuk login
        Auth::guard('orangtua')->login($orangtua);
        $request->session()->regenerate();

        return redirect()->route('halaman_orang_tua')->with('success', 'Login berhasil!');
    }
    public function showLupaSandiForm()
    {
        return view('pages.lupa_sandi');
    }
    
    public function showLupaSandi(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'kata_sandi' => 'required|string'
        ]);

        $orangtua = Orangtua::where('email', $request->email)->first();

        if (!$orangtua) {
            return back()->withErrors(['email' => 'Email pengguna tidak ditemukan.']);
        }

        if (!Hash::check($request->kata_sandi, $orangtua->kata_sandi)) {
            return back()->withErrors(['kata_sandi' => 'Kata sandi salah.']);
        }
        return redirect()->route('login')->with('success', 'reset berhasil!');
    }

    public function showRegisterForm()
    {
        return view('pages.registrasi');
    }

    public function registrasi(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:orangtua',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:12',
            'kata_sandi' => 'required|string|min:6|confirmed',
        ]);

        Orangtua::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'alamat' => $validated['alamat'],
            'no_hp' => $validated['no_hp'],
            'kata_sandi' => bcrypt($validated['kata_sandi']),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }


   #public function logout(Request $request)
#{
    #Auth::guard('pelanggan')->logout(); // Guard pelanggan!
    #$request->session()->invalidate();
    #$request->session()->regenerateToken();

    #return redirect()->route('dash-public');
#}
}