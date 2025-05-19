<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ColorDefinition
 * 
 * @property int $color_id
 * @property string $color_name
 * @property string $color_syblol
 * @property int $is_active
 *
 * @package App\Models
 */
class ColorDefinition extends Model
{
	protected $table = 'color_definition';
	protected $primaryKey = 'color_id';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'int'
	];

	protected $fillable = [
		'color_name',
		'color_syblol',
		'is_active'
	];
}
