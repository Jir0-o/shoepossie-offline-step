<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ConsumerBalanceSummary
 * 
 * @property int $consumer_balance_summary_id
 * @property int|null $consumer_id
 * @property int|null $total_accumulated_points
 * @property float|null $total_accumulated_taka_for_points
 * @property float|null $total_accumulated_taka
 * @property int|null $total_claimed_points
 * @property float|null $total_claimed_taka_for_points
 * @property float|null $total_claimed_taka
 * @property int|null $total_claimable_points
 * @property float|null $total_claimable_taka_for_points
 * @property float|null $total_claimable_taka
 * @property int|null $total_claimable_balance
 * @property Carbon|null $last_updated_on
 * 
 * @property ConsumerInformation|null $consumer_information
 *
 * @package App\Models
 */
class ConsumerBalanceSummary extends Model
{
	protected $table = 'consumer_balance_summary';
	protected $primaryKey = 'consumer_balance_summary_id';
	public $timestamps = false;

	protected $casts = [
		'consumer_id' => 'int',
		'total_accumulated_points' => 'int',
		'total_accumulated_taka_for_points' => 'float',
		'total_accumulated_taka' => 'float',
		'total_claimed_points' => 'int',
		'total_claimed_taka_for_points' => 'float',
		'total_claimed_taka' => 'float',
		'total_claimable_points' => 'int',
		'total_claimable_taka_for_points' => 'float',
		'total_claimable_taka' => 'float',
		'total_claimable_balance' => 'int'
	];

	protected $dates = [
		'last_updated_on'
	];

	protected $fillable = [
		'consumer_id',
		'total_accumulated_points',
		'total_accumulated_taka_for_points',
		'total_accumulated_taka',
		'total_claimed_points',
		'total_claimed_taka_for_points',
		'total_claimed_taka',
		'total_claimable_points',
		'total_claimable_taka_for_points',
		'total_claimable_taka',
		'total_claimable_balance',
		'last_updated_on'
	];

	public function consumer_information()
	{
		return $this->belongsTo(ConsumerInformation::class, 'consumer_id');
	}
}
