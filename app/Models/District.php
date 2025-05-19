<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class District
 * 
 * @property int $district_id
 * @property string $district_name
 * @property int $division_id
 *
 * @package App\Models
 */
class District extends Model
{
	protected $table = 'district';
	protected $primaryKey = 'district_id';
	public $timestamps = false;

	protected $casts = [
		'division_id' => 'int'
	];

	protected $fillable = [
		'district_name',
		'division_id'
	];
}
