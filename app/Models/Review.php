<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 * 
 * @property int $reviews_id
 * @property int $product_id
 * @property int $consumer_id
 * @property string|null $rating
 * @property string|null $review_text
 * @property Carbon|null $review_date
 * 
 * @property Product $product
 * @property ConsumerInformation $consumer_information
 * @property Collection|ReviewImage[] $review_images
 *
 * @package App\Models
 */
class Review extends Model
{
	protected $table = 'reviews';
	protected $primaryKey = 'reviews_id';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'consumer_id' => 'int'
	];

	protected $dates = [
		'review_date'
	];

	protected $fillable = [
		'product_id',
		'consumer_id',
		'rating',
		'review_text',
		'review_date'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function consumer_information()
	{
		return $this->belongsTo(ConsumerInformation::class, 'consumer_id');
	}

	public function review_images()
	{
		return $this->hasMany(ReviewImage::class, 'reviews_id');
	}
}
