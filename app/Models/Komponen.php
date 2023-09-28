<?php

namespace App\Models;

use App\Models\Base\Komponen as BaseKomponen;

class Komponen extends BaseKomponen
{
	protected $fillable = [
		'nama',
		'keterangan'
	];
}
