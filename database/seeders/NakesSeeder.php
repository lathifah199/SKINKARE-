<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NakesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('nakes')->insert([
            [
                'nama_lengkap' => 'Admin Nakes',
                'email' => 'nakes@gmail.com',
                'kata_sandi' => Hash::make('123456'),
                'nomor_hp' => '081234567890',
            ],
            [
                'nama_lengkap' => 'Petugas Klinik',
                'email' => 'petugas@example.com',
                'kata_sandi' => Hash::make('password123'),
                'nomor_hp' => '089876543210',
            ],
        ]);
    }
}
