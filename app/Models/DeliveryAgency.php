<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DeliveryAgency
 * 
 * @property int $delivery_agency_id
 * @property string $delivery_agency_name
 * @property string $agency_address
 * @property string $agency_contact_no
 * @property int $is_active
 *
 * @package App\Models
 */
class DeliveryAgency extends Model
{
	protected $table = 'delivery_agency';
	protected $primaryKey = 'delivery_agency_id';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'int'
	];

	protected $fillable = [
		'delivery_agency_name',
		'agency_address',
		'agency_contact_no',
		'is_active'
	];
}
