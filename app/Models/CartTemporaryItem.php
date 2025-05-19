<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CartTemporaryItem
 * 
 * @property int $temp_cart_item_id
 * @property int|null $temp_cart_id
 * @property int|null $purchase_details_id
 * @property int|null $quantity
 * @property int|null $total_discount
 * @property int|null $size_id
 * @property int|null $color_id
 * @property float|null $temp_net_amount
 * 
 * @property CartTemporary|null $cart_temporary
 * @property PurchaseDetail|null $purchase_detail
 *
 * @package App\Models
 */
class CartTemporaryItem extends Model
{
	protected $table = 'cart_temporary_items';
	protected $primaryKey = 'temp_cart_item_id';
	public $timestamps = false;

	protected $casts = [
		'temp_cart_id' => 'int',
		'purchase_details_id' => 'int',
		'quantity' => 'float',
		'total_discount' => 'int',
		'size_id' => 'int',
		'color_id' => 'int',
		'temp_net_amount' => 'float'
	];

	protected $fillable = [
		'temp_cart_id',
		'purchase_details_id',
		'quantity',
		'total_discount',
		'size_id',
		'color_id',
		'temp_net_amount'
	];

	public function cart_temporary()
	{
		return $this->belongsTo(CartTemporary::class, 'temp_cart_id');
	}

	public function purchase_detail()
	{
		return $this->belongsTo(PurchaseDetail::class, 'purchase_details_id');
	}
}
