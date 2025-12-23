<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Anak;
use App\Models\Pemeriksaan;

class RiwayatController extends Controller
{
    public function riwayat()
    {
        $ortu = Auth::guard('orangtua')->user();
        
        // Ambil semua anak milik orangtua yang sedang login
        $anakIds = Anak::where('id_orangtua', $ortu->id_orangtua)->pluck('id');
        
        // Ambil semua pemeriksaan berdasarkan anak-anak tersebut
        $riwayat = Pemeriksaan::with(['anak', 'hasilDeteksi'])
            ->whereIn('id', $anakIds)
            ->orderBy('tanggal_pemeriksaan', 'desc')
            ->get()
            ->groupBy('id') // group by id anak
            ->map(function ($items) {
                return [
                    'anak' => [
                        'id' => $items->first()->id,
                        'nama_lengkap' => $items->first()->anak->nama_lengkap
                    ],
                    'pemeriksaan' => $items->map(function ($p) {
                        // Ambil hasil deteksi terbaru untuk pemeriksaan ini
                        $hasil = $p->hasilDeteksi;
                        
                        return [
                            'id_pemeriksaan' => $p->id_pemeriksaan,
                            'tanggal_pemeriksaan' => \Carbon\Carbon::parse($p->tanggal_pemeriksaan)->format('d/m/Y'),
                            'tinggi_badan' => $p->tinggi_badan,
                            'berat_badan' => $p->berat_badan ?? 0,
                            // Gunakan status_prediksi jika kategori_risiko NULL
                            'kategori_risiko' => $hasil 
                                ? ($hasil->kategori_risiko ?? $hasil->status_prediksi) 
                                : 'Belum ada hasil',
                        ];
                    })->values()->toArray()
                ];
            })->values();
        
        return view('pages.riwayat_anak', compact('riwayat'));
    }
}