<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ConsumerImage
 * 
 * @property int $image_id
 * @property int $consumer_id
 * @property string|null $image
 * @property string|null $image_path
 * @property string|null $image_size
 * @property Carbon $uoload_date
 * 
 * @property ConsumerInformation $consumer_information
 *
 * @package App\Models
 */
class ConsumerImage extends Model
{
	protected $table = 'consumer_image';
	protected $primaryKey = 'image_id';
	public $timestamps = false;

	protected $casts = [
		'consumer_id' => 'int'
	];

	protected $dates = [
		'uoload_date'
	];

	protected $fillable = [
		'consumer_id',
		'image',
		'image_path',
		'image_size',
		'uoload_date'
	];

	public function consumer_information()
	{
		return $this->belongsTo(ConsumerInformation::class, 'consumer_id');
	}
}
