<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubCategoryTwo
 * 
 * @property int $sc_two_id
 * @property int $sc_one_id
 * @property string $sc_two_name
 * @property string|null $sc_two_description
 * @property string|null $sc_two_image
 * @property int $is_active
 * 
 * @property SubCategoryOne $sub_category_one
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class SubCategoryTwo extends Model
{
	protected $table = 'sub_category_two';
	protected $primaryKey = 'sc_two_id';
	public $timestamps = false;

	protected $casts = [
		'sc_one_id' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'sc_one_id',
		'sc_two_name',
		'sc_two_description',
		'sc_two_image',
		'is_active'
	];

	public function sub_category_one()
	{
		return $this->belongsTo(SubCategoryOne::class, 'sc_one_id');
	}

	public function products()
	{
		return $this->hasMany(Product::class, 'sc_two_id');
	}
}
