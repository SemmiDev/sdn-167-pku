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
        Guru::create([
            'nama' => 'Natanael',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Anu 1',
            'no_telepon' => '081234567890',
        ]);
        Guru::create([
            'nama' => 'Winner',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Anu 2',
            'no_telepon' => '081234567891',
        ]);
        Guru::create([
            'nama' => 'Nana',
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'Jl. Anu 3',
            'no_telepon' => '081234567892',
        ]);
    }
}
