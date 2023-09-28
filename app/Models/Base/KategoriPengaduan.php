<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Pengaduan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class KategoriPengaduan
 * 
 * @property int $id
 * @property string $kategori
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Pengaduan[] $pengaduans
 *
 * @package App\Models\Base
 */
class KategoriPengaduan extends Model
{
	protected $table = 'kategori_pengaduan';

	public function pengaduans()
	{
		return $this->hasMany(Pengaduan::class, 'id_kategori');
	}
}
