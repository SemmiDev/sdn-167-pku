<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('pengumuman')->insert([
                'judul' => 'Pengumuman ' . $i,
                'keterangan' => 'Keterangan Pengumuman ' . $i,
                'created_at' => date('Y-m-d H:i:s', mt_rand(1577836800, 1609459199)),
                'updated_at' => date('Y-m-d H:i:s', mt_rand(1577836800, 1609459199)),
            ]);
        }
    }
}
