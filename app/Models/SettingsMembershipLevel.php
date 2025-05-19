<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SettingsMembershipLevel
 * 
 * @property int $id
 * @property string $membership_level
 * @property int $minimum_points
 * @property int $maximum_points
 * @property int|null $parent_level_id
 * @property int $is_cash_back_enables
 * @property int $cash_back_amount
 * @property int|null $child_level_id
 * @property int|null $maximum_child_limit
 * @property int $is_active
 *
 * @package App\Models
 */
class SettingsMembershipLevel extends Model
{
	protected $table = 'settings_membership_level';
	public $timestamps = false;

	protected $casts = [
		'minimum_points' => 'int',
		'maximum_points' => 'int',
		'parent_level_id' => 'int',
		'is_cash_back_enables' => 'int',
		'cash_back_amount' => 'int',
		'child_level_id' => 'int',
		'maximum_child_limit' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'membership_level',
		'minimum_points',
		'maximum_points',
		'parent_level_id',
		'is_cash_back_enables',
		'cash_back_amount',
		'child_level_id',
		'maximum_child_limit',
		'is_active'
	];
}
