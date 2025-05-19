<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DeliveryAgent
 * 
 * @property int $delivery_agent_id
 * @property string $delivery_agent_name
 * @property int $delivery_agency_id
 * @property string $agent_contact_no
 * @property int $is_active
 *
 * @package App\Models
 */
class DeliveryAgent extends Model
{
	protected $table = 'delivery_agent';
	protected $primaryKey = 'delivery_agent_id';
	public $timestamps = false;

	protected $casts = [
		'delivery_agency_id' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'delivery_agent_name',
		'delivery_agency_id',
		'agent_contact_no',
		'is_active'
	];
}
