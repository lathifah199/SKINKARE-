<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Nakes extends Model
{
    use Notifiable;

    protected $table = 'nakes';
    protected $primaryKey = 'id_nakes';
    public $timestamps = false;

    protected $fillable = ['nama_lengkap', 'email', 'kata_sandi', 'nomor_hp'];

    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
}
