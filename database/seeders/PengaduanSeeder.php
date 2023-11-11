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


        DB::table('pengaduan')->insert([
            'nama' => 'Siti',
            'keterangan' => 'Anak saya acen kurecen kelas 6, di bully oleh donny dan teman-temannya',
            'foto' => 'https://picsum.photos/seed/' . 1 . '/200/300',
            'id_kategori' => 2,
            'status' => 'belum',
            'created_at' => date('Y-m-d H:i:s', mt_rand(1672531200, 1704067200)),
            'updated_at' => date('Y-m-d H:i:s', mt_rand(1672531200, 1704067200)),
        ]);
    }
}
