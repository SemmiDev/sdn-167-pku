<?php

namespace App\Http\Controllers\Admin;

use App\Models\Atribut;
use App\Models\Siswa;

class AjaxController
{
    public function daftarSiswaByKelas($kelas)
    {
        $siswa = Siswa::where('kelas', $kelas)->get();
        return response()->json([
            'success' => true,
            'data' => $siswa,
        ]);
    }

    public function daftarAtributByKomponen($id_komponen)
    {
        $atribut = Atribut::where('id_komponen', $id_komponen)->get();
        return response()->json([
            'success' => true,
            'data' => $atribut,
        ]);
    }
}
