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

        return view('pages.data_wali', compact('dataWali'));
    }

    public function show($id)
    {
        $wali = Orangtua::find($id);

        if (!$wali) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($wali);
    }
}