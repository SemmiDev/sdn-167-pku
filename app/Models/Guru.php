<?php

namespace App\Models;

use App\Models\Base\Guru as BaseGuru;

class Guru extends BaseGuru
{
	protected $fillable = [
		'nama',
		'jenis_kelamin',
		'alamat',
		'no_telepon'
	];
}
