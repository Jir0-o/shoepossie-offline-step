<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AttributeDefinition
 * 
 * @property int $attribute_id
 * @property string|null $attribute_name
 * @property int|null $attribute_type_id
 * @property int|null $is_active
 * 
 * @property AttributeTypeDefinition|null $attribute_type_definition
 *
 * @package App\Models
 */
class AttributeDefinition extends Model
{
	protected $table = 'attribute_definition';
	protected $primaryKey = 'attribute_id';
	public $timestamps = false;

	protected $casts = [
		'attribute_type_id' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'attribute_name',
		'attribute_type_id',
		'is_active'
	];

	public function attribute_type_definition()
	{
		return $this->belongsTo(AttributeTypeDefinition::class, 'attribute_type_id');
	}
}
