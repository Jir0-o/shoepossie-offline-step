<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Supplier
 * 
 * @property int $supplier_id
 * @property string $supplier_name
 * @property string $supplier_address
 * @property string $supplier_contact_person
 * @property string $supplier_contact_no
 * @property int $is_active
 * 
 * @property Collection|PurchaseInfo[] $purchase_infos
 *
 * @package App\Models
 */
class Supplier extends Model
{
	protected $table = 'suppliers';
	protected $primaryKey = 'supplier_id';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'int'
	];

	protected $fillable = [
		'supplier_name',
		'supplier_address',
		'supplier_contact_person',
		'supplier_contact_no',
		'is_active'
	];

	public function purchase_infos()
	{
		return $this->hasMany(PurchaseInfo::class);
	}
}
