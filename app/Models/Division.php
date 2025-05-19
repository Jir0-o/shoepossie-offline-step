<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Division
 * 
 * @property int $division_id
 * @property string $division_name
 *
 * @package App\Models
 */
class Division extends Model
{
	protected $table = 'division';
	protected $primaryKey = 'division_id';
	public $timestamps = false;

	protected $fillable = [
		'division_name'
	];
}
