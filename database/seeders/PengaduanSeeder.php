<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengaduanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori_pengaduan')->insert([
            'kategori' => 'Kekerasan Verbal',
        ]);

        DB::table('kategori_pengaduan')->insert([
            'kategori' => 'Kekerasan Fisik',
        ]);

        DB::table('kategori_pengaduan')->insert([
            'kategori' => 'Kekerasan Sosial',
        ]);

        DB::table('kategori_pengaduan')->insert([
            'kategori' => 'Kekerasan Seksual',
        ]);

        DB::table('kategori_pengaduan')->insert([
            'kategori' => 'Lainnya',
        ]);
    }
}
