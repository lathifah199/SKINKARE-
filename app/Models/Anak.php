<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;

    protected $table = 'anaks'; // nama tabel
    protected $primaryKey = 'id'; // pk di tabel anak
    public $timestamps = false; // kalau tidak ada created_at / updated_at

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

        // foreign key penting!
        'id_orangtua',
    ];

    public function orangtua()
    {
        return $this->belongsTo(Orangtua::class, 'id_orangtua');
    }
    
}