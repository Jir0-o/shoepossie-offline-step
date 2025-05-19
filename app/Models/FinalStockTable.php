<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FinalStockTable
 * 
 * @property int $stock_id
 * @property int|null $product_id
 * @property float|null $total_purchased_quantity
 * @property float|null $total_sold_quantity
 * @property float|null $total_ordered_quantity
 * @property float|null $in_order_queue
 * @property float|null $temp_quantity
 * @property float|null $final_quantity
 * @property int|null $purchase_id
 * 
 * @property Product|null $product
 * @property PurchaseInfo|null $purchase_info
 *
 * @package App\Models
 */
class FinalStockTable extends Model
{
	protected $table = 'final_stock_table';
	protected $primaryKey = 'stock_id';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'total_purchased_quantity' => 'float',
		'total_sold_quantity' => 'float',
		'total_ordered_quantity' => 'float',
		'in_order_queue' => 'float',
		'temp_quantity' => 'float',
		'final_quantity' => 'float',
		'purchase_id' => 'int'
	];

	protected $fillable = [
		'product_id',
		'total_purchased_quantity',
		'total_sold_quantity',
		'total_ordered_quantity',
		'in_order_queue',
		'temp_quantity',
		'final_quantity',
		'purchase_id'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function purchase_info()
	{
		return $this->belongsTo(PurchaseInfo::class, 'purchase_id');
	}
}
