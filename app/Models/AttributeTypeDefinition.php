<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AttributeTypeDefinition
 * 
 * @property int $attribute_type_id
 * @property string|null $attribute_type_name
 * @property int|null $is_active
 * 
 * @property Collection|AttributeDefinition[] $attribute_definitions
 *
 * @package App\Models
 */
class AttributeTypeDefinition extends Model
{
	protected $table = 'attribute_type_definition';
	protected $primaryKey = 'attribute_type_id';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'int'
	];

	protected $fillable = [
		'attribute_type_name',
		'is_active'
	];

	public function attribute_definitions()
	{
		return $this->hasMany(AttributeDefinition::class, 'attribute_type_id');
	}
}
