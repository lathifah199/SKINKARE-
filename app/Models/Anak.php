<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;

    protected $table = 'anaks';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama_lengkap',
        'jenis_kelamin',
        'umur',
        'tempat_lahir',
        'tanggal_lahir',
        'tinggi_badan',
        'berat_badan',
        'hasil_deteksi',
        'nama_wali',
        'alamat',
        'foto',

        // foreign key
        'id_orangtua',
        'id_nakes', 
    ];

    // relasi ke orang tua
    public function orangtua()
    {
        return $this->belongsTo(Orangtua::class, 'id_orangtua');
    }

    // relasi ke nakes
    public function nakes()
    {
        return $this->belongsTo(Nakes::class, 'id_nakes', 'id_nakes');
    }
}
