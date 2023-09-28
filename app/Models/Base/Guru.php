<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Guru
 * 
 * @property int $id
 * @property string $nama
 * @property string $email
 * @property string $jenis_kelamin
 * @property string|null $alamat
 * @property string|null $no_telepon
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models\Base
 */
class Guru extends Model
{
	protected $table = 'guru';
}
