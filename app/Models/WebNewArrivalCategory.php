<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WebNewArrivalCategory
 * 
 * @property int $web_new_arrival_category_id
 * @property string|null $web_new_arrival_category_name
 * @property int|null $is_active
 *
 * @package App\Models
 */
class WebNewArrivalCategory extends Model
{
	protected $table = 'web_new_arrival_category';
	protected $primaryKey = 'web_new_arrival_category_id';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'int'
	];

	protected $fillable = [
		'web_new_arrival_category_name',
		'is_active'
	];
}
