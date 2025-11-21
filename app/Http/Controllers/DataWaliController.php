<?php

namespace App\Http\Controllers;

use App\Models\Orangtua;
use Illuminate\Http\Request;

class DataWaliController extends Controller
{
    public function index(Request $request)
    {
        $query = Orangtua::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $dataWali = $query->paginate(5);

        return view('pages.Data_Wali', compact('dataWali'));
    }

    public function show($id)
    {
        $wali = Orangtua::find($id);

        if (!$wali) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($wali);
    }

     public function profil()
    {
        $id = session('user_id');   // ambil ID user login

        if (!$id) {
            return redirect()->route('login')->with('error', 'Silakan login dulu');
        }

        $orangtua = Orangtua::find($id);

        if (!$orangtua) {
            return redirect()->route('login')->with('error', 'Data pengguna tidak ditemukan');
        }

        return view('pages.profil', compact('orangtua'));
    }
    public function homeOrangtua()
    {
        return view('pages.halaman_orang_tua');
    }

}

