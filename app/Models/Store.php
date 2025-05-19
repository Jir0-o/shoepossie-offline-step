<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';
	protected $primaryKey = 'store_id';
	public $timestamps = false;

    protected $fillable = [
		'store_name',
		'is_active'
	];
}
