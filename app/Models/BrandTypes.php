<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandTypes extends Model
{
    use HasFactory;
    protected $table = 'brand_types';
    protected $primaryKey = 'brand_type_id';

    protected $fillable = [
        'brand_type_name','brand_type_code','brand_type_is_active'
    ];
}
