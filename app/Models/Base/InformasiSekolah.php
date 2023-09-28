<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InformasiSekolah
 * 
 * @property int $id
 * @property string $nama
 * @property string $kepala_sekolah
 * @property string $operator_sekolah
 * @property string $akreditasi
 * @property string $alamat
 * @property string $link_data_pokok_pendidikan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models\Base
 */
class InformasiSekolah extends Model
{
	protected $table = 'informasi_sekolah';
}
