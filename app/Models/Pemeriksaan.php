<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan';
    protected $primaryKey = 'id_pemeriksaan';

    protected $fillable = [
        'id', // ini FK ke anaks
        'tanggal_pemeriksaan',
        'tinggi_badan',
        'berat_badan',
        'metode_input'
    ];

    // relasi ke anak
    public function anak()
    {
        return $this->belongsTo(Anak::class, 'id');
    }
    public function hasilDeteksi()
    {
        return $this->hasOne(HasilDeteksi::class, 'id_pemeriksaan', 'id_pemeriksaan');
    }
}