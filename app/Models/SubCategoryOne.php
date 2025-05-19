<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubCategoryOne
 * 
 * @property int $sc_one_id
 * @property int $category_id
 * @property string $sc_one_name
 * @property string|null $sc_one_description
 * @property string|null $sc_one_image
 * @property int $is_active
 * 
 * @property ProductCategory $product_category
 * @property Collection|SubCategoryTwo[] $sub_category_twos
 *
 * @package App\Models
 */
class SubCategoryOne extends Model
{
	protected $table = 'sub_category_one';
	protected $primaryKey = 'sc_one_id';
	public $timestamps = false;

	protected $casts = [
		'category_id' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'category_id',
		'sc_one_name',
		'sc_one_description',
		'sc_one_image',
		'is_active'
	];

	public function product_category()
	{
		return $this->belongsTo(ProductCategory::class, 'category_id');
	}

	public function sub_category_twos()
	{
		return $this->hasMany(SubCategoryTwo::class, 'sc_one_id');
	}
}
