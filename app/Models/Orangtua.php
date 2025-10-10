<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Orangtua extends Authenticatable
{
    use Notifiable;

    protected $table = 'orangtua';
    protected $primaryKey = 'id_orangtua';
    public $timestamps = false;

    protected $fillable = ['nama', 'email', 'alamat','no_hp', 'kata_sandi'];

    // Laravel secara default pakai kolom 'password', tapi kamu pakai 'kata_sandi'
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
}
