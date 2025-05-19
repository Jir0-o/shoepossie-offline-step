<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BannerInformation
 * 
 * @property int $id
 * @property string $banner_url
 * @property string|null $banner_address
 * @property string $banner_email
 * @property string $banner_name
 * @property string $banner_logo
 * @property int $consumer_id
 * @property int $is_active
 *
 * @package App\Models 
 */
class BannerInformation extends Model
{
	protected $table = 'banner_information';
	public $timestamps = false;

	protected $casts = [
		'consumer_id' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'banner_url',
		'banner_address',
		'banner_email',
		'banner_name',
		'banner_logo',
		'consumer_id',
		'banner_code',
		'is_active',
	];
}
