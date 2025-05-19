<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CartTemporaryPayment
 * 
 * @property int $cart_temporary_payment_id
 * @property int $cart_temporary_id
 * @property int $cart_temporary_total
 * @property int $discount_amount
 * @property int $total_payable
 * @property int $payment_method_id
 * @property int $paid_amount
 * @property int $due_amount
 * @property int $change_amount
 *
 * @package App\Models
 */
class CartTemporaryPayment extends Model
{
	protected $table = 'cart_temporary_payment';
	protected $primaryKey = 'cart_temporary_payment_id';
	public $timestamps = false;

	protected $casts = [
		'cart_temporary_id' => 'int',
		'cart_temporary_total' => 'int',
		'discount_amount' => 'int',
		'total_payable' => 'int',
		'payment_method_id' => 'int',
		'paid_amount' => 'int',
		'due_amount' => 'int',
		'change_amount' => 'int'
	];

	protected $fillable = [
		'cart_temporary_id',
		'cart_temporary_total',
		'discount_amount',
		'total_payable',
		'payment_method_id',
		'paid_amount',
		'due_amount',
		'change_amount'
	];
}
