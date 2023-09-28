<?php

namespace App\Models;

use App\Models\Base\Siswa as BaseSiswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends BaseSiswa
{
    use  HasFactory;

	protected $fillable = [
		'nama',
		'kelas',
		'jenis_kelamin',
		'alamat',
		'nama_ortu',
		'no_telepon_ortu'
	];
}
