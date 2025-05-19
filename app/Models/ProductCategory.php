<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductCategory
 * 
 * @property int $category_id
 * @property string $category_name
 * @property string|null $category_description
 * @property string|null $sample_image_path
 * @property string|null $sample_image
 * @property int $is_active
 * 
 * @property Collection|SubCategoryOne[] $sub_category_ones
 *
 * @package App\Models
 */
class ProductCategory extends Model
{
	protected $table = 'product_category';
	protected $primaryKey = 'category_id';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'int'
	];

	protected $fillable = [
		'category_name',
		'category_description',
		'sample_image_path',
		'sample_image',
		'is_active'
	];

	public function sub_category_ones()
	{
		return $this->hasMany(SubCategoryOne::class, 'category_id');
	}
}
