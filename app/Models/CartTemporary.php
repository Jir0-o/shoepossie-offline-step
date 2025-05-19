<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CartTemporary
 * 
 * @property int $temp_cart_id
 * @property int|null $temporary_consumer_id
 * @property int|null $consumer_id
 * @property Carbon|null $create_date
 * @property string|null $from_ip
 * @property int $created_by
 * 
 * @property ConsumerInformation|null $consumer_information
 * @property Collection|CartTemporaryItem[] $cart_temporary_items
 *
 * @package App\Models
 */
class CartTemporary extends Model
{
	protected $table = 'cart_temporary';
	protected $primaryKey = 'temp_cart_id';
	public $timestamps = false;

	protected $casts = [
		'temporary_consumer_id' => 'int',
		'consumer_id' => 'int',
		'created_by' => 'int'
	];

	protected $dates = [
		'create_date'
	];

	protected $fillable = [
		'temporary_consumer_id',
		'consumer_id',
		'create_date',
		'from_ip',
		'created_by'
	];

	public function consumer_information()
	{
		return $this->belongsTo(ConsumerInformation::class, 'consumer_id');
	}

	public function cart_temporary_items()
	{
		return $this->hasMany(CartTemporaryItem::class, 'temp_cart_id');
	}
}
