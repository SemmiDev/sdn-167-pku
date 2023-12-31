<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Atribut;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Komponen
 * 
 * @property int $id
 * @property string $nama
 * @property string|null $keterangan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Atribut[] $atributs
 *
 * @package App\Models\Base
 */
class Komponen extends Model
{
	protected $table = 'komponen';

	public function atributs()
	{
		return $this->hasMany(Atribut::class, 'id_komponen');
	}
}
