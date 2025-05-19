<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LatestProduct
 * 
 * @property int $latest_product_id
 * @property string|null $latest_product_banner
 * @property string|null $latest_product_label
 * @property string|null $latest_product_image
 * @property string|null $latest_product_price
 * @property int|null $color_id
 * @property int|null $is_active
 *
 * @package App\Models
 */
class LatestProduct extends Model
{
	protected $table = 'latest_products';
	protected $primaryKey = 'latest_product_id';
	public $timestamps = false;

	protected $casts = [
		'color_id' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'latest_product_banner',
		'latest_product_label',
		'latest_product_image',
		'latest_product_price',
		'color_id',
		'is_active'
	];
}
