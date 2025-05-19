<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CartPaymentMethod
 * 
 * @property int $payment_method_id
 * @property string $payment_method
 * @property string $payment_method_symbol
 * @property float $payment_method_charge
 * @property int $is_verified
 * 
 * @property Collection|CartPaymentInformation[] $cart_payment_informations
 *
 * @package App\Models
 */
class CartPaymentMethod extends Model
{
	protected $table = 'cart_payment_methods';
	protected $primaryKey = 'payment_method_id';
	public $timestamps = false;

	protected $casts = [
		'payment_method_charge' => 'float',
		'is_verified' => 'int'
	];

	protected $fillable = [
		'payment_method',
		'payment_method_symbol',
		'payment_method_charge',
		'is_verified'
	];

	public function cart_payment_informations()
	{
		return $this->hasMany(CartPaymentInformation::class, 'payment_method_id');
	}
}
