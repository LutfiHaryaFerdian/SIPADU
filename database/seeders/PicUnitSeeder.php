<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PicUnitSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pic_units')->insert([
            [
                'id' => Str::uuid(),
                'nama_unit' => 'Bagian Sarpras',
                'nama_pic' => 'Andi Saputra',
                'email' => 'sarpras@unila.ac.id',
                'password' => Hash::make('sarpras123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_unit' => 'Bagian Akademik',
                'nama_pic' => 'Dewi Kurnia',
                'email' => 'akademik@unila.ac.id',
                'password' => Hash::make('akademik123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
