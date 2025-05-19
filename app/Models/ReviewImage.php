<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReviewImage
 * 
 * @property int $review_images_id
 * @property int $reviews_id
 * @property string|null $image_name
 * 
 * @property Review $review
 *
 * @package App\Models
 */
class ReviewImage extends Model
{
	protected $table = 'review_images';
	protected $primaryKey = 'review_images_id';
	public $timestamps = false;

	protected $casts = [
		'reviews_id' => 'int'
	];

	protected $fillable = [
		'reviews_id',
		'image_name'
	];

	public function review()
	{
		return $this->belongsTo(Review::class, 'reviews_id');
	}
}
