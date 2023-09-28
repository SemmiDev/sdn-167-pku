<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Komponen;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Atribut
 * 
 * @property int $id
 * @property string $nama
 * @property int $id_komponen
 * @property string|null $keterangan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Komponen $komponen
 *
 * @package App\Models\Base
 */
class Atribut extends Model
{
	protected $table = 'atribut';

	protected $casts = [
		'id_komponen' => 'int'
	];

	public function komponen()
	{
		return $this->belongsTo(Komponen::class, 'id_komponen');
	}
}
