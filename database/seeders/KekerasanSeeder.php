<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KekerasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            DB::table('kekerasan')->insert([
                'id_siswa' => mt_rand(1, 100),
                'id_komponen' => mt_rand(1, 2),
                'id_atribut' => mt_rand(1, 2),
                'keterangan' => 'Keterangan Kekerasan ' . $i,
                'created_at' => date('Y-m-d H:i:s', mt_rand(1672531200, 1704067200)),
                'updated_at' => date('Y-m-d H:i:s', mt_rand(1672531200, 1704067200)),
            ]);
        }
    }
}
