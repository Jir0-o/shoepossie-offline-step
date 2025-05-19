<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UnitDefinition
 * 
 * @property int $unit_id
 * @property string $unit_name
 * @property string $unit_symbol
 * @property int $is_fractional
 * @property int $is_active
 * 
 * @property Collection|CartItem[] $cart_items
 * @property Collection|Product[] $products
 * @property Collection|PurchaseDetail[] $purchase_details
 *
 * @package App\Models
 */
class UnitDefinition extends Model
{
	protected $table = 'unit_definition';
	protected $primaryKey = 'unit_id';
	public $timestamps = false;

	protected $casts = [
		'is_fractional' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'unit_name',
		'unit_symbol',
		'is_fractional',
		'is_active'
	];

	public function cart_items()
	{
		return $this->hasMany(CartItem::class, 'unit_id');
	}

	public function products()
	{
		return $this->hasMany(Product::class, 'unit_type');
	}

	public function purchase_details()
	{
		return $this->hasMany(PurchaseDetail::class, 'unit_id');
	}
}
