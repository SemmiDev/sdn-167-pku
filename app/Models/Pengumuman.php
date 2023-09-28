<?php

namespace App\Models;

use App\Models\Base\Pengumuman as BasePengumuman;

class Pengumuman extends BasePengumuman
{
	protected $fillable = [
		'judul',
		'keterangan'
	];
}
