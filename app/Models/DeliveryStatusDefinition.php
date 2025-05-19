<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DeliveryStatusDefinition
 * 
 * @property int $delivery_status_id
 * @property string $delivery_status
 * @property string|null $delivery_status_client
 * @property string $delivery_status_symbol
 * @property int $is_active
 *
 * @package App\Models
 */
class DeliveryStatusDefinition extends Model
{
	protected $table = 'delivery_status_definition';
	protected $primaryKey = 'delivery_status_id';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'int'
	];

	protected $fillable = [
		'delivery_status',
		'delivery_status_client',
		'delivery_status_symbol',
		'is_active'
	];
}
