<?php

namespace App\Models;

use App\Models\Base\Siswa as BaseSiswa;

class Siswa extends BaseSiswa
{
	protected $fillable = [
		'nama',
		'kelas',
		'jenis_kelamin',
		'alamat',
		'no_telepon',
		'nama_ortu',
		'no_telepon_ortu'
	];
}
