<?php

namespace App\Models;

use App\Models\Base\InformasiSekolah as BaseInformasiSekolah;

class InformasiSekolah extends BaseInformasiSekolah
{
	protected $fillable = [
		'nama',
		'kepala_sekolah',
		'operator_sekolah',
		'akreditasi',
		'alamat',
		'link_data_pokok_pendidikan'
	];
}
