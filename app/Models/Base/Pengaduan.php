<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pengaduan
 * 
 * @property int $id
 * @property string $nama
 * @property string $foto
 * @property string|null $keterangan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models\Base
 */
class Pengaduan extends Model
{
	protected $table = 'pengaduan';
}
