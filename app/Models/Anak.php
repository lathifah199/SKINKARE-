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
        'umur',
        'domisili',
        'nama_wali',
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
    // 1 anak bisa punya banyak pemeriksaan
    public function pemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class, 'id', 'id');
    }

    public function hasilDeteksi()
    {
        return $this->hasMany(HasilDeteksi::class, 'id', 'id');
    }

}
