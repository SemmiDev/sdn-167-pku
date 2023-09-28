<?php

namespace App\Models;

use App\Models\Base\Atribut as BaseAtribut;

class Atribut extends BaseAtribut
{
	protected $fillable = [
		'nama',
		'keterangan',
		'id_komponen'
	];
}
