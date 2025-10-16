<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnakController extends Controller
{
    // menampilkan form tambah anak
    public function create()
    {
        return view('pages.tambah_data_anak');
    }

    // menyimpan data dari form
    public function store(Request $request)
    {
        // validasi input
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'umur' => 'required|integer',
            'ttl' => 'required|string|max:255',
        ]);

        // nanti bisa simpan ke database di sini
        // contoh: Anak::create($validated);

        // kirim pesan sukses ke halaman yang sama
        return redirect()->back()->with('success', 'Data anak berhasil disimpan!');
    }
}
