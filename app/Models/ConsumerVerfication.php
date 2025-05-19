<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ConsumerVerfication
 * 
 * @property int $con_verification_id
 * @property int $consumer_id
 * @property string $generated_otp
 * @property int $otp_delivery_status
 * @property int $otp_type_id
 * @property int $is_verified
 * 
 * @property ConsumerInformation $consumer_information
 *
 * @package App\Models
 */
class ConsumerVerfication extends Model
{
	protected $table = 'consumer_verfication';
	protected $primaryKey = 'con_verification_id';
	public $timestamps = false;

	protected $casts = [
		'consumer_id' => 'int',
		'otp_delivery_status' => 'int',
		'otp_type_id' => 'int',
		'is_verified' => 'int'
	];

	protected $fillable = [
		'consumer_id',
		'generated_otp',
		'otp_delivery_status',
		'otp_type_id',
		'is_verified'
	];

	public function consumer_information()
	{
		return $this->belongsTo(ConsumerInformation::class, 'consumer_id');
	}
}
