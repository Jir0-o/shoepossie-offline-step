<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Thana
 * 
 * @property int $thana_id
 * @property string $thana_name
 * @property int $district_id
 *
 * @package App\Models
 */
class Thana extends Model
{
	protected $table = 'thana';
	protected $primaryKey = 'thana_id';
	public $timestamps = false;

	protected $casts = [
		'district_id' => 'int'
	];

	protected $fillable = [
		'thana_name',
		'district_id'
	];
}
