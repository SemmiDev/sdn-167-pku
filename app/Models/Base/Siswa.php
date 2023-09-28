<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Siswa
 * 
 * @property int $id
 * @property string $nama
 * @property int $kelas
 * @property string $jenis_kelamin
 * @property string|null $alamat
 * @property string|null $nama_ortu
 * @property string|null $no_telepon_ortu
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models\Base
 */
class Siswa extends Model
{
	protected $table = 'siswa';

	protected $casts = [
		'kelas' => 'int'
	];
}
