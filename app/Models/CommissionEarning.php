<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CommissionEarning
 * 
 * @property int $commission_earning_id
 * @property int $consumer_id
 * @property int|null $level_id
 * @property Carbon|null $date
 * @property string|null $particulars
 * @property string|null $point
 * @property string|null $equivalent_taka
 * @property int|null $referral_id
 * @property int|null $is_verified
 * 
 * @property ConsumerInformation $consumer_information
 *
 * @package App\Models
 */
class CommissionEarning extends Model
{
	protected $table = 'commission_earning';
	protected $primaryKey = 'commission_earning_id';
	public $timestamps = false;

	protected $casts = [
		'consumer_id' => 'int',
		'level_id' => 'int',
		'referral_id' => 'int',
		'is_verified' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'consumer_id',
		'level_id',
		'date',
		'particulars',
		'point',
		'equivalent_taka',
		'referral_id',
		'is_verified'
	];

	public function consumer_information()
	{
		return $this->belongsTo(ConsumerInformation::class, 'consumer_id');
	}
}
