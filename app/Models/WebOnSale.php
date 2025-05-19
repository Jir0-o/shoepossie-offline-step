<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WebOnSale
 * 
 * @property int $on_sale_id
 * @property int|null $product_id
 * @property string|null $on_sale_listed_on
 * @property string|null $on_sale_listed_by
 * @property int|null $is_active
 *
 * @package App\Models
 */
class WebOnSale extends Model
{
	protected $table = 'web_on_sale';
	protected $primaryKey = 'on_sale_id';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'product_id',
		'on_sale_listed_on',
		'on_sale_listed_by',
		'is_active'
	];
}
