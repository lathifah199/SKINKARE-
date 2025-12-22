<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilDeteksi extends Model
{
    use HasFactory;

    protected $table = 'hasil_deteksi';
    protected $primaryKey = 'id_hasil';

    protected $fillable = [
        'id_pemeriksaan',
        'id',
        'status_prediksi',
        'zscore',
        'risiko_persen',
        'kategori_risiko',
        'warna_risiko',
        'hasil',
    ];

    // Relasi ke tabel pemeriksaan
    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class, 'id_pemeriksaan');
    }
    public function anak()
    {
        return $this->belongsTo(Anak::class, 'id', 'id');
    }

}
