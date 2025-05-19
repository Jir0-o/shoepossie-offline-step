<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WebWishList
 * 
 * @property int $wish_list_id
 * @property int $consumer_id
 * @property int $product_id
 *
 * @package App\Models
 */
class WebWishList extends Model
{
	protected $table = 'web_wish_list';
	protected $primaryKey = 'wish_list_id';
	public $timestamps = false;

	protected $casts = [
		'consumer_id' => 'int',
		'product_id' => 'int'
	];

	protected $fillable = [
		'consumer_id',
		'product_id'
	];
}
