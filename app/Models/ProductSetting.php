<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductSetting
 * 
 * @property int $product_settings_id
 * @property string $product_settings_name
 * @property string $product_settings_value
 * @property int $is_active
 *
 * @package App\Models
 */
class ProductSetting extends Model
{
	protected $table = 'product_settings';
	protected $primaryKey = 'product_settings_id';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'int'
	];

	protected $fillable = [
		'product_settings_name',
		'product_settings_value',
		'is_active'
	];
}
