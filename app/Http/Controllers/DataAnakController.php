<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Http\Request;

class DataAnakController extends Controller
{
    public function index(Request $request)
    {
        if (session('user_tipe') !== 'nakes') {
            return redirect('/login')->with('error', 'Akses ditolak');
        }

        $idNakes = session('user_id');

        $query = Anak::with([
            'orangtua',
            'hasilDeteksi' => fn ($q) => $q->latest()->limit(1),
            'pemeriksaan' => fn ($q) => $q->latest()->limit(1),
        ]);

        if ($request->filled('search')) {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%');
        }

        $dataAnak = $query->paginate(5);

        return view('pages.data_anak', compact('dataAnak'));
    }

    public function store(Request $request)
    {
        if (session('user_tipe') !== 'nakes') {
            return redirect('/login')->with('error', 'Akses ditolak');
        }
        $idNakes = session('user_id');
        $request->validate([
            'nama_lengkap'  => 'required|string|max:100',
            'tgl_lahir'     => 'required|date',
            'jenis_kelamin' => 'required',
        ]);

        Anak::create([
            'nama_lengkap'  => $request->nama_lengkap,
            'tgl_lahir'     => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_nakes'      => $idNakes, 
        ]);

        return redirect()->route('data-anak.index')
                         ->with('success', 'Data anak berhasil ditambahkan');
    }
}