<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CartInformtion
 * 
 * @property int $cart_id
 * @property int $consumer_id
 * @property Carbon|null $cart_date
 * @property int|null $cart_status
 * @property string|null $delivery_address
 * @property int|null $is_temp_user
 * @property int $payment_method_id
 * @property float|null $total_cart_amount
 * @property float|null $vat_amount
 * @property float|null $tax_amount
 * @property float|null $delivery_charge
 * @property float|null $total_discount
 * @property float|null $total_payable_amount
 * @property float|null $gross_profit
 * @property float|null $payment_method_charge
 * @property float|null $final_total_amount
 * @property float|null $paid_amount
 * @property float|null $due_amount
 * @property float|null $net_profit
 * @property string|null $cart_note
 * @property Carbon|null $expected_delivery_date
 * @property Carbon|null $delivery_date
 * @property int $delivery_status_id
 * 
 * @property ConsumerInformation $consumer_information
 * @property Collection|CartItemReturn[] $cart_item_returns
 * @property Collection|CartItem[] $cart_items
 * @property Collection|CartPaymentInformation[] $cart_payment_informations
 *
 * @package App\Models
 */
class CartInformtion extends Model
{
	protected $table = 'cart_informtion';
	protected $primaryKey = 'cart_id';
	public $timestamps = false;

	protected $casts = [
		'consumer_id' => 'int',
		'cart_status' => 'int',
		'is_temp_user' => 'int',
		'payment_method_id' => 'int',
		'total_cart_amount' => 'float',
		'vat_amount' => 'float',
		'tax_amount' => 'float',
		'delivery_charge' => 'float',
		'total_discount' => 'float',
		'total_payable_amount' => 'float',
		'gross_profit' => 'float',
		'payment_method_charge' => 'float',
		'final_total_amount' => 'float',
		'paid_amount' => 'float',
		'due_amount' => 'float',
		'net_profit' => 'float',
		'delivery_status_id' => 'int'
	];

	protected $dates = [
		'expected_delivery_date',
		'delivery_date'
	];

	protected $fillable = [
		'consumer_id',
		'cart_date',
		'cart_status',
		'delivery_address',
		'is_temp_user',
		'payment_method_id',
		'total_cart_amount',
		'vat_amount',
		'tax_amount',
		'delivery_charge',
		'total_discount',
		'total_payable_amount',
		'gross_profit',
		'payment_method_charge',
		'final_total_amount',
		'paid_amount',
		'due_amount',
		'net_profit',
		'cart_note',
		'expected_delivery_date',
		'delivery_date',
		'delivery_status_id'
	];

	public function consumer_information()
	{
		return $this->belongsTo(ConsumerInformation::class, 'consumer_id');
	}

	public function cart_item_returns()
	{
		return $this->hasMany(CartItemReturn::class, 'cart_id');
	}

	public function cart_items()
	{
		return $this->hasMany(CartItem::class, 'cart_id');
	}

	public function cart_payment_informations()
	{
		return $this->hasMany(CartPaymentInformation::class, 'cart_id');
	}
}
