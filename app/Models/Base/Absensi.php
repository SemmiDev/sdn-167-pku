<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Atribut;
use App\Models\Komponen;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Absensi
 * 
 * @property int $id
 * @property int $id_siswa
 * @property int $id_komponen
 * @property int $id_atribut
 * @property string|null $keterangan
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Atribut $atribut
 * @property Komponen $komponen
 * @property Siswa $siswa
 *
 * @package App\Models\Base
 */
class Absensi extends Model
{
	protected $table = 'absensi';

	protected $casts = [
		'id_siswa' => 'int',
		'id_komponen' => 'int',
		'id_atribut' => 'int'
	];

	public function atribut()
	{
		return $this->belongsTo(Atribut::class, 'id_atribut');
	}

	public function komponen()
	{
		return $this->belongsTo(Komponen::class, 'id_komponen');
	}

	public function siswa()
	{
		return $this->belongsTo(Siswa::class, 'id_siswa');
	}
}
