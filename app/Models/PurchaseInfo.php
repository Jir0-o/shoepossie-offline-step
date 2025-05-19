<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PurchaseInfo
 * 
 * @property int $purchase_id
 * @property string|null $supply_no
 * @property int $supplier_id
 * @property string|null $date
 * @property string|null $is_verified
 * 
 * @property Supplier $supplier
 * @property Collection|FinalStockTable[] $final_stock_tables
 * @property Collection|PurchaseDetail[] $purchase_details
 *
 * @package App\Models
 */
class PurchaseInfo extends Model
{
	protected $table = 'purchase_info';
	protected $primaryKey = 'purchase_id';
	public $timestamps = false;

	protected $casts = [
		'supplier_id' => 'int'
	];

	protected $fillable = [
		'ref_no',
		'supplier_id',
		'pur_date',
		'total_item_price',
		'discount',
		'total_payable',
		'paid_status',
		'notes',
		'store_id'
	];

	public function supplier()
	{
		return $this->belongsTo(Supplier::class);
	}

	public function final_stock_tables()
	{
		return $this->hasMany(FinalStockTable::class, 'purchase_id');
	}

	public function purchase_details()
	{
		return $this->hasMany(PurchaseDetail::class, 'purchase_id');
	}
}
