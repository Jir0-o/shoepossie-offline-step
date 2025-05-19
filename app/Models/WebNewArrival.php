<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WebNewArrival
 * 
 * @property int $web_new_arrival_id
 * @property int|null $product_id
 * @property string|null $web_new_arrival_listed_on
 * @property string|null $web_new_arrival_listed_by
 * @property int|null $is_active
 *
 * @package App\Models
 */
class WebNewArrival extends Model
{
	protected $table = 'web_new_arrival';
	protected $primaryKey = 'web_new_arrival_id';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'product_id',
		'web_new_arrival_listed_on',
		'web_new_arrival_listed_by',
		'is_active'
	];
}
