<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductAttribute
 * 
 * @property int $product_attribute_id
 * @property int|null $product_id
 * @property string|null $attribute_id
 * @property string|null $attribute_image
 * @property string|null $attribute_value
 * @property int|null $is_active
 * 
 * @property Product|null $product
 *
 * @package App\Models
 */
class ProductAttribute extends Model
{
	protected $table = 'product_attribute';
	protected $primaryKey = 'product_attribute_id';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'product_id',
		'attribute_id',
		'attribute_image',
		'attribute_value',
		'is_active'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
