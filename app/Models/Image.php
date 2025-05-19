<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 * 
 * @property int $image_id
 * @property int|null $product_id
 * @property string|null $image_name
 *
 * @package App\Models
 */
class Image extends Model
{
	protected $table = 'images';
	protected $primaryKey = 'image_id';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int'
	];

	protected $fillable = [
		'product_id',
		'image_name'
	];
}
