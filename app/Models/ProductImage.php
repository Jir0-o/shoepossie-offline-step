<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductImage
 * 
 * @property int $product_images_id
 * @property string $product_images_name
 * @property string $product_images_path
 * @property string $product_images_size
 *
 * @package App\Models
 */
class ProductImage extends Model
{
	protected $table = 'product_images';
	protected $primaryKey = 'product_images_id';
	public $timestamps = false;

	protected $fillable = [
		'product_images_name',
		'product_images_path',
		'product_images_size'
	];
}
