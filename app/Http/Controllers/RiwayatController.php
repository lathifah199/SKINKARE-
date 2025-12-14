<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Anak;

class RiwayatController extends Controller
{
    public function riwayat()
    {
        $ortu = Auth::guard('orangtua')->user();
        $id_orangtua = $ortu->id_orangtua;
        $anak = Anak::where('id_orangtua',$id_orangtua)
                ->orderBy('created_at', 'desc')
                ->paginate(3);
        return view('pages.riwayat_anak', compact('anak'));
    }
    public function detail($id)
    {
        // Ambil data anak berdasarkan ID
        $anak = Anak::findOrFail($id);
        return view('pages.riwayat_anak', compact('anak'));
    }
}