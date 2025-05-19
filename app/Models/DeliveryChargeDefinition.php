<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DeliveryChargeDefinition
 * 
 * @property int $delivery_charge_id
 * @property string $deliver_charge_name
 * @property int $agency_id
 * @property string|null $package_description
 * @property string|null $source
 * @property string|null $destination
 * @property int $expected_delivery_days
 * @property float $delivery_charge
 * @property int $is_active
 *
 * @package App\Models
 */
class DeliveryChargeDefinition extends Model
{
	protected $table = 'delivery_charge_definition';
	protected $primaryKey = 'delivery_charge_id';
	public $timestamps = false;

	protected $casts = [
		'agency_id' => 'int',
		'expected_delivery_days' => 'int',
		'delivery_charge' => 'float',
		'is_active' => 'int'
	];

	protected $fillable = [
		'deliver_charge_name',
		'agency_id',
		'package_description',
		'source',
		'destination',
		'expected_delivery_days',
		'delivery_charge',
		'is_active'
	];
}
