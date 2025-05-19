<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WebFeatured
 * 
 * @property int $web_featured_id
 * @property string|null $web_featured_label
 * @property string|null $web_featured_listed_on
 * @property string|null $web_featured_listed_by
 * @property string|null $web_featured_discount
 * @property int|null $is_active
 *
 * @package App\Models
 */
class WebFeatured extends Model
{
	protected $table = 'web_featured';
	protected $primaryKey = 'web_featured_id';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'int'
	];

	protected $fillable = [
		'web_featured_label',
		'web_featured_listed_on',
		'web_featured_listed_by',
		'web_featured_discount',
		'is_active'
	];
}
