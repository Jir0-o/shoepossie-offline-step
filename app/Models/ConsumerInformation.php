<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ConsumerInformation
 * 
 * @property int $consumer_id
 * @property string|null $consumer_name
 * @property string|null $address
 * @property string|null $thana
 * @property string|null $zilla
 * @property string|null $zip_code
 * @property int $is_sales_member
 * @property int $referral_id
 * @property int $parent_id
 * @property int|null $level_id
 * @property int|null $accumulated_points
 * @property int|null $cash_for_points
 * @property string|null $cash_for_referral
 * @property int $is_active
 * 
 * @property Collection|CartInformtion[] $cart_informtions
 * @property Collection|CartItemReturn[] $cart_item_returns
 * @property Collection|CartTemporary[] $cart_temporaries
 * @property Collection|CommissionEarning[] $commission_earnings
 * @property Collection|CommissionWithdraw[] $commission_withdraws
 * @property Collection|ConsumerLogin[] $consumer_logins
 * @property Collection|ConsumerBalanceSummary[] $consumer_balance_summaries
 * @property Collection|ConsumerImage[] $consumer_images
 * @property Collection|ConsumerVerfication[] $consumer_verfications
 * @property Collection|Review[] $reviews
 *
 * @package App\Models
 */
class ConsumerInformation extends Model
{
	protected $table = 'consumer_information';
	protected $primaryKey = 'consumer_id';
	public $timestamps = false;

	protected $casts = [
		'is_sales_member' => 'int',
		'referral_id' => 'int',
		'parent_id' => 'int',
		'level_id' => 'int',
		'accumulated_points' => 'int',
		'cash_for_points' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'consumer_name',
		'address',
		'thana',
		'zilla',
		'zip_code',
		'is_sales_member',
		'referral_id',
		'parent_id',
		'level_id',
		'accumulated_points',
		'cash_for_points',
		'cash_for_referral',
		'is_active'
	];

	public function cart_informtions()
	{
		return $this->hasMany(CartInformtion::class, 'consumer_id');
	}

	public function cart_item_returns()
	{
		return $this->hasMany(CartItemReturn::class, 'consumer_id');
	}

	public function cart_temporaries()
	{
		return $this->hasMany(CartTemporary::class, 'consumer_id');
	}

	public function commission_earnings()
	{
		return $this->hasMany(CommissionEarning::class, 'consumer_id');
	}

	public function commission_withdraws()
	{
		return $this->hasMany(CommissionWithdraw::class, 'consumer_id');
	}

	public function consumer_logins()
	{
		return $this->hasMany(ConsumerLogin::class, 'consumer_id');
	}

	public function consumer_balance_summaries()
	{
		return $this->hasMany(ConsumerBalanceSummary::class, 'consumer_id');
	}

	public function consumer_images()
	{
		return $this->hasMany(ConsumerImage::class, 'consumer_id');
	}

	public function consumer_verfications()
	{
		return $this->hasMany(ConsumerVerfication::class, 'consumer_id');
	}

	public function reviews()
	{
		return $this->hasMany(Review::class, 'consumer_id');
	}
}
