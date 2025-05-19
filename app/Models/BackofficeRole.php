<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BackofficeRole
 * 
 * @property int $role_id
 * @property string $role_name
 *
 * @package App\Models
 */
class BackofficeRole extends Model
{
	protected $table = 'backoffice_role';
	protected $primaryKey = 'role_id';
	public $timestamps = false;

	protected $fillable = [
		'role_name'
	];
}
