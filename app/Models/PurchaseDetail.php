<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PurchaseDetail
 * 
 * @property int $purchase_details_id
 * @property int $purchase_id
 * @property int $product_id
 * @property int $brand_id
 * @property int $unit_id
 * @property string|null $size_id
 * @property string|null $color_id
 * @property float|null $quantity
 * @property float|null $purchase_price
 * @property float|null $sales_price
 * @property int $courier_cost
 * @property int $transport_cost
 * @property float|null $discount
 * @property int $bonus_point
 * @property int|null $point_benefit
 * @property float|null $cash_benefit
 * @property int|null $total_purchase_price
 * @property int|null $is_verified
 * 
 * @property Brand $brand
 * @property Product $product
 * @property PurchaseInfo $purchase_info
 * @property UnitDefinition $unit_definition
 * @property Collection|CartItem[] $cart_items
 * @property Collection|CartTemporaryItem[] $cart_temporary_items
 *
 * @package App\Models
 */
class PurchaseDetail extends Model
{
	protected $table = 'purchase_details';
	protected $primaryKey = 'purchase_details_id';
	public $timestamps = false;

	protected $casts = [
		'purchase_id' => 'int',
		'product_id' => 'int',
		'brand_id' => 'int',
		'unit_id' => 'int',
		'quantity' => 'float',
		'purchase_price' => 'float',
		'sales_price' => 'float',
		'courier_cost' => 'int',
		'transport_cost' => 'int',
		'discount' => 'float',
		'bonus_point' => 'int',
		'point_benefit' => 'int',
		'cash_benefit' => 'float',
		'total_purchase_price' => 'int',
		'is_verified' => 'int'
	];

	protected $fillable = [
		'purchase_id',
		'product_id',
		'brand_id',
		'unit_id',
		'quantity',
		'purchase_price',
		'wholesale_price',
		'sales_price',
		'total_purchase_price',
		'discount',
		'vat',
	];

	public function brand()
	{
		return $this->belongsTo(Brand::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function purchase_info()
	{
		return $this->belongsTo(PurchaseInfo::class, 'purchase_id');
	}

	public function unit_definition()
	{
		return $this->belongsTo(UnitDefinition::class, 'unit_id');
	}

	public function cart_items()
	{
		return $this->hasMany(CartItem::class, 'purchase_details_id');
	}

	public function cart_temporary_items()
	{
		return $this->hasMany(CartTemporaryItem::class, 'purchase_details_id');
	}
}
