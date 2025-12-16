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

    $query = Anak::with('orangtua')
                ->where('id_nakes', $idNakes);

    if ($request->filled('search')) {
        $query->where('nama_lengkap', 'like', '%' . $request->search . '%');
    }

    $dataAnak = $query->paginate(5);

    return view('pages.data_anak', compact('dataAnak'));
}

    public function store(Request $request)
    {
        // 1️⃣ Pastikan nakes login
        if (session('user_tipe') !== 'nakes') {
            return redirect('/login')->with('error', 'Akses ditolak');
        }

        // 2️⃣ Ambil id nakes
        $idNakes = session('user_id');

        // 3️⃣ Validasi
        $request->validate([
            'nama_lengkap'  => 'required|string|max:100',
            'tgl_lahir'     => 'required|date',
            'jenis_kelamin' => 'required',
        ]);

        // 4️⃣ Simpan data anak + id_nakes
        Anak::create([
            'nama_lengkap'  => $request->nama_lengkap,
            'tgl_lahir'     => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_nakes'      => $idNakes, // 🔑 KUNCI
        ]);

        return redirect()->route('data-anak.index')
                         ->with('success', 'Data anak berhasil ditambahkan');
    }
}