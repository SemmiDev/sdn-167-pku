<?php

namespace App\Models;

use App\Models\Base\Guru as BaseGuru;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends BaseGuru
{
    use  HasFactory;
    protected $locale = 'id';

	protected $fillable = [
		'nama',
		'jenis_kelamin',
		'alamat',
		'email',
		'no_telepon'
	];
}
