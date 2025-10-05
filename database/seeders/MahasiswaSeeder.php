<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mahasiswa')->insert([
            [
                'id' => Str::uuid(),
                'nama' => 'Lutfi Harya Ferdian',
                'npm' => '2317051096',
                'email' => 'lutfi@student.unila.ac.id',
                'password' => Hash::make('mahasiswa123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'Oryza Surya Hapsari',
                'npm' => '2317051107',
                'email' => 'oryza@student.unila.ac.id',
                'password' => Hash::make('mahasiswa123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
