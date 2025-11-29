<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Menentukan guard dan password broker default aplikasi.
    | Kamu bisa mengubah nilainya sesuai kebutuhan.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Setiap guard mengatur cara autentikasi pengguna.
    | Secara default menggunakan session driver dan provider Eloquent.
    |
    | Supported drivers: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'orangtua' => [
            'driver' => 'session',
            'provider' => 'orangtua',
        ],
        'nakes' => [
            'driver' => 'session',
            'provider' => 'nakes',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Provider menentukan bagaimana pengguna diambil dari database.
    | Biasanya menggunakan model Eloquent.
    |
    | Supported drivers: "eloquent", "database"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],
        'orangtua' => [
            'driver' => 'eloquent',
            'model' => App\Models\Orangtua::class,
        ],
        'nakes' => [
            'driver' => 'eloquent',
            'model' => App\Models\Nakes::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Pengaturan perilaku reset password, termasuk tabel token
    | dan lama waktu token valid.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Jumlah detik sebelum konfirmasi password kadaluarsa.
    | Default-nya adalah 3 jam (10800 detik).
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
