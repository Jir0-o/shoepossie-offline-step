<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CartPaymentInformation
 *
 * @property int $payment_id
 * @property int $cart_id
 * @property int $payment_method_id
 * @property float $paid_amount
 * @property float $balance_amount
 * @property int $is_verified
 *
 * @property CartInformtion $cart_informtion
 * @property CartPaymentMethod $cart_payment_method
 *
 * @package App\Models
 */
class CartPaymentInformation extends Model
{
	protected $table = 'cart_payment_information';
	protected $primaryKey = 'payment_id';
	public $timestamps = false;

	protected $casts = [
		'cart_id' => 'int',
		'payment_method_id' => 'int',
		'paid_amount' => 'string',
		'balance_amount' => 'float',
		'is_verified' => 'int'
	];

	protected $fillable = [
		'cart_id',
		'payment_method_id',
		'paid_amount',
		'balance_amount',
		'is_verified'
	];

	public function cart_informtion()
	{
		return $this->belongsTo(CartInformtion::class, 'cart_id');
	}

	public function cart_payment_method()
	{
		return $this->belongsTo(CartPaymentMethod::class, 'payment_method_id');
	}
}
