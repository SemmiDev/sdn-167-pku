<?php

namespace Database\Seeders;

use App\Models\Atribut;
use App\Models\Komponen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KomponenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $komponen = [
            [
                'nama' => 'Anti Kekerasan',
                'keterangan' => "Anti Kekerasan",
            ],
            [
                'nama' => 'Religius',
                'keterangan' => "Religius",
            ],
        ];

        foreach ($komponen as $key => $value) {
            $k = Komponen::create($value);
            $komponen[$key] = $k;
        }

        $atribut = [
            [
                'nama' => 'Verbal',
                'id_komponen' => $komponen[0]->id,
                'keterangan' => "Verbal",
            ],
            [
                'nama' => 'Non Verbal',
                'id_komponen' => $komponen[0]->id,
                'keterangan' => "Non Verbal",
            ],
            [
                'nama' => 'Sholat Berjamaah',
                'id_komponen' => $komponen[1]->id,
                'keterangan' => "Sholat Berjamaah",
            ],
            [
                'nama' => 'Perayaan Hari Besar',
                'id_komponen' => $komponen[1]->id,
                'keterangan' => "Perayaan Hari Besar",
            ],
        ];

        foreach ($atribut as $key => $value) {
            Atribut::create($value);
        }
    }
}
