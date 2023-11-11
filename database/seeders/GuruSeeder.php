<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Guru::factory()->count(100)->create();
        Guru::create([
            'nama' => 'Naufal',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Raya 1',
            'email' => 'naufal@gmail.com',
            'no_telepon' => '082387325971',
        ]);
        Guru::create([
            'nama' => 'Sammi',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Raya 12',
            'email' => 'sammi@gmail.com',
            'no_telepon' => '082387325961',
        ]);
        Guru::create([
            'nama' => 'Acen',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Raya 12',
            'email' => 'acen@gmail.com',
            'no_telepon' => '082387345961',
        ]);
        Guru::create([
            'nama' => 'Donny',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Raya 12',
            'email' => 'donny@gmail.com',
            'no_telepon' => '082377345961',
        ]);
        Guru::create([
            'nama' => 'Winner',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Raya 2',
            'email' => 'winner@gmail.com',
            'no_telepon' => '082387325972',
        ]);
        Guru::create([
            'nama' => 'Natanael',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Raya 3',
            'email' => 'natanael@gmail.com',
            'no_telepon' => '082387325973',
        ]);
    }
}
