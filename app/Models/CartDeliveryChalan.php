<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CartDeliveryChalan
 * 
 * @property int $delivery_chalan_id
 * @property int $cart_delivery_id
 * @property Carbon $issue_date
 * @property int $items_checked
 * @property string $delivery_address
 * @property string $consumer_contact_no
 * @property int $is_printed
 *
 * @package App\Models
 */
class CartDeliveryChalan extends Model
{
	protected $table = 'cart_delivery_chalan';
	protected $primaryKey = 'delivery_chalan_id';
	public $timestamps = false;

	protected $casts = [
		'cart_delivery_id' => 'int',
		'items_checked' => 'int',
		'is_printed' => 'int'
	];

	protected $dates = [
		'issue_date'
	];

	protected $fillable = [
		'cart_delivery_id',
		'issue_date',
		'items_checked',
		'delivery_address',
		'consumer_contact_no',
		'is_printed'
	];
}
