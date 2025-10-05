<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        // TAMBAHKAN GUARD UNTUK ADMIN
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        // TAMBAHKAN GUARD UNTUK MAHASISWA
        'mahasiswa' => [
            'driver' => 'session',
            'provider' => 'mahasiswas',
        ],
        // TAMBAHKAN GUARD UNTUK PIC
        'pic' => [
            'driver' => 'session',
            'provider' => 'pics',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        // TAMBAHKAN PROVIDER UNTUK ADMIN
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class, // Pastikan nama model benar
        ],
        // TAMBAHKAN PROVIDER UNTUK MAHASISWA
        'mahasiswas' => [
            'driver' => 'eloquent',
            'model' => App\Models\Mahasiswa::class, // Pastikan nama model benar
        ],
        // TAMBAHKAN PROVIDER UNTUK PIC
        'pics' => [
            'driver' => 'eloquent',
            'model' => App\Models\PicUnit::class, // Sesuaikan jika nama model berbeda
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
