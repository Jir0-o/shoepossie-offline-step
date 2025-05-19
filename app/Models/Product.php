<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $product_id
 * @property int $sc_two_id
 * @property string|null $attribute_id
 * @property string $product_name
 * @property string|null $avg_rating
 * @property string|null $product_description
 * @property string|null $product_details
 * @property int $unit_type
 * @property string $min_quantity
 * @property string|null $image_path
 * @property string|null $product_image
 * @property string|null $product_in_stock
 * @property string|null $sku_no
 * @property int $is_active
 * 
 * @property SubCategoryTwo $sub_category_two
 * @property UnitDefinition $unit_definition
 * @property Collection|CartItem[] $cart_items
 * @property Collection|FinalStockTable[] $final_stock_tables
 * @property Collection|ProductAttribute[] $product_attributes
 * @property Collection|PurchaseDetail[] $purchase_details
 * @property Collection|Review[] $reviews
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';
	protected $primaryKey = 'product_id';
	public $timestamps = false;

	protected $casts = [
		'sc_two_id' => 'int',
		'unit_type' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'sc_two_id',
		'attribute_id',
		'product_name',
		'avg_rating',
		'product_description',
		'product_details',
		'unit_type',
		'min_quantity',
		'image_path',
		'product_image',
		'product_in_stock',
		'sku_no',
		'is_active'
	];

	public function sub_category_two()
	{
		return $this->belongsTo(SubCategoryTwo::class, 'sc_two_id');
	}

	public function unit_definition()
	{
		return $this->belongsTo(UnitDefinition::class, 'unit_type');
	}

	public function cart_items()
	{
		return $this->hasMany(CartItem::class);
	}

	public function final_stock_tables()
	{
		return $this->hasMany(FinalStockTable::class);
	}

	public function product_attributes()
	{
		return $this->hasMany(ProductAttribute::class);
	}

	public function purchase_details()
	{
		return $this->hasMany(PurchaseDetail::class);
	}

	public function reviews()
	{
		return $this->hasMany(Review::class);
	}
}
