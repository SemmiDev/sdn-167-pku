<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            DB::table('kategori_pengaduan')->insert([
                'kategori' => 'Kategori Pengaduan ' . $i,
                'created_at' => date('Y-m-d H:i:s', mt_rand(1672531200, 1704067200)),
                'updated_at' => date('Y-m-d H:i:s', mt_rand(1672531200, 1704067200)),
            ]);
        }

        for ($i = 1; $i <= 100; $i++) {
            DB::table('pengaduan')->insert([
                'nama' => 'Pengadu ' . $i,
                'keterangan' => 'Keterangan Pengaduan ' . $i,
                'foto' => 'https://picsum.photos/seed/' . $i . '/200/300',
                'id_kategori' => mt_rand(1, 100),
                'status' => 'belum',
                'created_at' => date('Y-m-d H:i:s', mt_rand(1672531200, 1704067200)),
                'updated_at' => date('Y-m-d H:i:s', mt_rand(1672531200, 1704067200)),
            ]);
        }
    }
}
