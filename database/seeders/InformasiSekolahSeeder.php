<?php

namespace Database\Seeders;

use App\Models\InformasiSekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InformasiSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InformasiSekolah::create([
            'nama' => 'SD NEGERI 167 PEKANBARU',
            'kepala_sekolah' => 'Hasminarni',
            'operator_sekolah' => 'ELVA NINGSIH',
            'akreditasi' => 'A',
            'alamat' => 'Jl. Muhajirin, Sidomulyo Barat, Kec. Tampan, Kota Pekanbaru, Provinsi Riau 28294',
            'link_data_pokok_pendidikan' => 'https://dapo.kemdikbud.go.id/sekolah/E8B5EBF511070E94BA97',
        ]);
    }
}
