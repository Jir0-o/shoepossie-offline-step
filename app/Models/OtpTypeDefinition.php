<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OtpTypeDefinition
 * 
 * @property int $otp_type_id
 * @property string $otp_type
 * @property int $is_active
 *
 * @package App\Models
 */
class OtpTypeDefinition extends Model
{
	protected $table = 'otp_type_definition';
	protected $primaryKey = 'otp_type_id';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'int'
	];

	protected $fillable = [
		'otp_type',
		'is_active'
	];
}
