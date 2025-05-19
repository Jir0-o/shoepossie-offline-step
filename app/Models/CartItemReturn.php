<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CartItemReturn
 * 
 * @property int $cart_item_return_id
 * @property int|null $consumer_id
 * @property int|null $cart_id
 * @property int $cart_item_id
 * @property int|null $received_by_id
 * @property string|null $reason_of_return
 * @property string|null $total_amount
 * @property string|null $non_refundable_vat
 * @property string|null $refund_amount
 * @property string|null $return_date
 * @property int|null $authorized_by
 * @property string|null $authorize_date
 * @property string|null $return_status
 * 
 * @property CartInformtion|null $cart_informtion
 * @property ConsumerInformation|null $consumer_information
 * @property CartItem $cart_item
 * @property BackofficeLogin|null $backoffice_login
 *
 * @package App\Models
 */
class CartItemReturn extends Model
{
	protected $table = 'cart_item_return';
	protected $primaryKey = 'cart_item_return_id';
	public $timestamps = false;

	protected $fillable = [
		'consumer_id',
		'cart_id',
		'cart_item_id',
		'received_by_id',
		'reason_of_return',
		'total_amount',
		'non_refundable_vat',
		'refund_amount',
		'return_date',
		'authorized_by',
		'authorize_date',
		'return_status'
	];

	public function cart_informtion()
	{
		return $this->belongsTo(CartInformtion::class, 'cart_id');
	}

	public function consumer_information()
	{
		return $this->belongsTo(ConsumerInformation::class, 'consumer_id');
	}

	public function cart_item()
	{
		return $this->belongsTo(CartItem::class);
	}

	public function backoffice_login()
	{
		return $this->belongsTo(BackofficeLogin::class, 'received_by_id');
	}
}
