<?php

namespace App\Models;

use App\Models\Base\Pengaduan as BasePengaduan;

class Pengaduan extends BasePengaduan
{
	protected $fillable = [
		'id_kategori',
		'nama',
		'foto',
		'wa',
        'jam_kejadian',
        'tanggal_kejadian',
		'keterangan',
        'sanksi',
        'penyelesaian'
	];
}
