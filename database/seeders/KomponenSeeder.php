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
                'nama' => 'Kekerasan Verbal',
                'id_komponen' => $komponen[0]->id,
                'keterangan' => "Kekerasan Verbal",
            ],
            [
                'nama' => 'Kekerasan Fisik',
                'id_komponen' => $komponen[0]->id,
                'keterangan' => "Kekerasan Fisik",
            ],
            [
                'nama' => 'Kekerasan Sosial',
                'id_komponen' => $komponen[0]->id,
                'keterangan' => "Kekerasan Sosial",
            ],
            [
                'nama' => 'Kekerasan Seksual',
                'id_komponen' => $komponen[0]->id,
                'keterangan' => "Kekerasan Seksual",
            ],
            [
                'nama' => 'Kekerasan Lainnya',
                'id_komponen' => $komponen[0]->id,
                'keterangan' => "Kekerasan Lainnya",
            ],
            [
                'nama' => 'Ibadah Harian',
                'id_komponen' => $komponen[1]->id,
                'keterangan' => "Ibadah Harian",
            ],
            [
                'nama' => 'Perayaan Hari Besar',
                'id_komponen' => $komponen[1]->id,
                'keterangan' => "Perayaan Hari Besar",
            ],
            [
                'nama' => 'Lainnya',
                'id_komponen' => $komponen[1]->id,
                'keterangan' => "Lainnya",
            ],
        ];

        foreach ($atribut as $key => $value) {
            Atribut::create($value);
        }
    }
}
