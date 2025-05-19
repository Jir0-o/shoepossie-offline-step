<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CartDelivery
 * 
 * @property int $delivery_id
 * @property int|null $cart_id
 * @property int|null $delivery_agency_id
 * @property int|null $delivery_agent_id
 * @property int|null $delivery_charge_id
 * @property float|null $delivery_charge
 * @property int|null $payment_status
 * @property Carbon|null $agency_handover_date
 * @property Carbon|null $agent_takeover_date
 * @property Carbon|null $delivery_to_consumer_date
 * @property int|null $delivery_status_id
 * @property string|null $dispute
 * @property string|null $special_instruction
 *
 * @package App\Models
 */
class CartDelivery extends Model
{
	protected $table = 'cart_delivery';
	protected $primaryKey = 'delivery_id';
	public $timestamps = false;

	protected $casts = [
		'cart_id' => 'int',
		'delivery_agency_id' => 'int',
		'delivery_agent_id' => 'int',
		'delivery_charge_id' => 'int',
		'delivery_charge' => 'float',
		'payment_status' => 'int',
		'delivery_status_id' => 'int'
	];

	protected $dates = [
		'agency_handover_date',
		'agent_takeover_date',
		'delivery_to_consumer_date'
	];

	protected $fillable = [
		'cart_id',
		'delivery_agency_id',
		'delivery_agent_id',
		'delivery_charge_id',
		'delivery_charge',
		'payment_status',
		'agency_handover_date',
		'agent_takeover_date',
		'delivery_to_consumer_date',
		'delivery_status_id',
		'dispute',
		'special_instruction'
	];
}
