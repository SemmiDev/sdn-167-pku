<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\KategoriPengaduan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pengaduan
 * 
 * @property int $id
 * @property int $id_kategori
 * @property string $foto
 * @property string|null $keterangan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property KategoriPengaduan $kategori_pengaduan
 *
 * @package App\Models\Base
 */
class Pengaduan extends Model
{
	protected $table = 'pengaduan';

	protected $casts = [
		'id_kategori' => 'int'
	];

	public function kategori_pengaduan()
	{
		return $this->belongsTo(KategoriPengaduan::class, 'id_kategori');
	}
}
