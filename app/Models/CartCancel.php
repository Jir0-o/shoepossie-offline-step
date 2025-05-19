<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CartCancel
 * 
 * @property int $cancel_id
 * @property int $cart_id
 * @property int $cancelled_by_id
 * @property string $cancel_note
 * @property Carbon $cancel_time
 * @property int $last_delivery_level
 *
 * @package App\Models
 */
class CartCancel extends Model
{
	protected $table = 'cart_cancel';
	protected $primaryKey = 'cancel_id';
	public $timestamps = false;

	protected $casts = [
		'cart_id' => 'int',
		'cancelled_by_id' => 'int',
		'last_delivery_level' => 'int'
	];

	protected $dates = [
		'cancel_time'
	];

	protected $fillable = [
		'cart_id',
		'cancelled_by_id',
		'cancel_note',
		'cancel_time',
		'last_delivery_level'
	];
}
