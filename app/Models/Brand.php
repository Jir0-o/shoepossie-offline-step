<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Brand
 * 
 * @property int $brand_id
 * @property string $brand_name
 * @property string $brand_logo
 * @property int $is_active
 * 
 * @property Collection|PurchaseDetail[] $purchase_details
 *
 * @package App\Models
 */
class Brand extends Model
{
	protected $table = 'brands';
	protected $primaryKey = 'brand_id';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'int'
	];

	protected $fillable = [
		'brand_name',
		'brand_logo',
		'is_active'
	];

	public function purchase_details()
	{
		return $this->hasMany(PurchaseDetail::class);
	}
}
