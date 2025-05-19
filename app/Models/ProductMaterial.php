<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMaterial extends Model
{
    use HasFactory;

    protected $table = 'product_materials';
    protected $primaryKey = 'product_material_id';

    protected $fillable = [
        'product_material_name','foot_ware_categories_id','type_id','material_type_id','brand_type_id'
    ];
}
