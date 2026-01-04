<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Nakes extends Authenticatable
{
    use Notifiable;

    protected $table = 'nakes';
    protected $primaryKey = 'id_nakes';
    public $timestamps = false;

    protected $fillable = [
        'nama_lengkap',
        'email',
        'kata_sandi',
        'nomor_hp'
    ];

    protected $hidden = [
        'kata_sandi'
    ];

    // Untuk sistem login Laravel
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }

    //nakes bisa punya banyak anak
    public function anaks()
    {
        return $this->hasMany(Anak::class, 'id_nakes', 'id_nakes');
    }
}