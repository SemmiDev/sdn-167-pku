<?php

namespace App\Models;

use App\Models\Base\Pengaduan as BasePengaduan;

class Pengaduan extends BasePengaduan
{
	protected $fillable = [
		'nama',
		'foto',
		'keterangan'
	];
}
