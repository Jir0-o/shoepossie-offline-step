<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OnSale
 * 
 * @property int $on_sale_id
 * @property int|null $color_id
 * @property string|null $on_sale_product_name
 * @property string|null $on_sale_label
 * @property string|null $on_sale_price
 * @property string|null $on_sale_image
 * @property int|null $is_active
 *
 * @package App\Models
 */
class OnSale extends Model
{
	protected $table = 'on_sale';
	protected $primaryKey = 'on_sale_id';
	public $timestamps = false;

	protected $casts = [
		'color_id' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'color_id',
		'on_sale_product_name',
		'on_sale_label',
		'on_sale_price',
		'on_sale_image',
		'is_active'
	];
}
