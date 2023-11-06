<?php

namespace App\Models;

use App\Models\Base\Absensi as BaseAbsensi;

class Absensi extends BaseAbsensi
{
	protected $fillable = [
		'id_siswa',
		'id_komponen',
		'id_atribut',
		'kegiatan',
		'tanggal',
		'keterangan',
		'status'
	];
}
