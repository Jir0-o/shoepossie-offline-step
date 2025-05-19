<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WebSlider
 * 
 * @property int $slider_id
 * @property string|null $slider_title
 * @property string|null $slider_image
 * @property string|null $slider_subtitle
 * @property int|null $is_active
 *
 * @package App\Models
 */
class WebSlider extends Model
{
	protected $table = 'web_sliders';
	protected $primaryKey = 'slider_id';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'int'
	];

	protected $fillable = [
		'slider_title',
		'slider_image',
		'slider_subtitle',
		'is_active'
	];
}
