<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SizeDefinition
 * 
 * @property int $size_id
 * @property string $size_name
 * @property int $size_symbol
 * @property int $is_active
 *
 * @package App\Models
 */
class SizeDefinition extends Model
{
	protected $table = 'size_definition';
	protected $primaryKey = 'size_id';
	public $timestamps = false;

	protected $casts = [
		'size_symbol' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'size_name',
		'size_symbol',
		'is_active'
	];
}
