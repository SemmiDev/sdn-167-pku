<?php

namespace App\Models;

use App\Models\Base\Kekerasan as BaseKekerasan;

class Kekerasan extends BaseKekerasan
{
	protected $fillable = [
		'id_siswa',
		'id_komponen',
		'id_atribut',
		'keterangan'
	];
}
