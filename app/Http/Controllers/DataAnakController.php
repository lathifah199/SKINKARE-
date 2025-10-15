<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class DataAnakController extends Controller
{
    public function index(Request $request)
    {
        // Dummy data (tidak dari database)
    $dataDummy = collect([
        (object) ['id_anak' => 'A001', 'nama_anak' => 'Amey'],
    ]);


        // Filter pencarian (jika ada)
        $search = $request->input('search');
        if ($search) {
        $dataDummy = $dataDummy->filter(function ($item) use ($search) {
            return stripos($item->nama_anak, $search) !== false;
        });


        }

        // Pagination manual (5 data per halaman)
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;
        $currentItems = $dataDummy->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $dataAnak = new LengthAwarePaginator(
            $currentItems,
            $dataDummy->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('pages.data_anak', compact('dataAnak'));
    }
}
