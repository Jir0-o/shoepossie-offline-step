<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CartItem
 * 
 * @property int $cart_item_id
 * @property int|null $cart_id
 * @property int|null $product_id
 * @property int|null $purchase_details_id
 * @property string|null $size_id
 * @property string|null $color_id
 * @property int $unit_id
 * @property float|null $unit_purchase_cost
 * @property float|null $quantity
 * @property float|null $unit_sales_cost
 * @property float|null $total_price
 * @property float|null $discount
 * @property float|null $after_discount_price
 * @property float|null $vat
 * @property float|null $tax
 * @property float|null $net_amount
 * @property int|null $point
 * @property int|null $point_value
 * @property string|null $is_confirmed
 * 
 * @property CartInformtion|null $cart_informtion
 * @property Product|null $product
 * @property PurchaseDetail|null $purchase_detail
 * @property UnitDefinition $unit_definition
 * @property Collection|CartItemReturn[] $cart_item_returns
 *
 * @package App\Models
 */
class CartItem extends Model
{
	protected $table = 'cart_items';
	protected $primaryKey = 'cart_item_id';
	public $timestamps = false;

	protected $casts = [
		'cart_id' => 'int',
		'product_id' => 'int',
		'purchase_details_id' => 'int',
		'unit_id' => 'int',
		'unit_purchase_cost' => 'float',
		'quantity' => 'float',
		'unit_sales_cost' => 'float',
		'total_price' => 'float',
		'discount' => 'float',
		'after_discount_price' => 'float',
		'vat' => 'float',
		'tax' => 'float',
		'net_amount' => 'float',
		'point' => 'int',
		'point_value' => 'int'
	];

	protected $fillable = [
		'cart_id',
		'product_id',
		'purchase_details_id',
		'size_id',
		'color_id',
		'unit_id',
		'unit_purchase_cost',
		'quantity',
		'unit_sales_cost',
		'total_price',
		'discount',
		'after_discount_price',
		'vat',
		'tax',
		'net_amount',
		'point',
		'point_value',
		'is_confirmed'
	];

	public function cart_informtion()
	{
		return $this->belongsTo(CartInformtion::class, 'cart_id');
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function purchase_detail()
	{
		return $this->belongsTo(PurchaseDetail::class, 'purchase_details_id');
	}

	public function unit_definition()
	{
		return $this->belongsTo(UnitDefinition::class, 'unit_id');
	}

	public function cart_item_returns()
	{
		return $this->hasMany(CartItemReturn::class);
	}
}
