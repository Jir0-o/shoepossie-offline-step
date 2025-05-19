<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootWareCategory extends Model
{
    use HasFactory;
    protected $table = 'foot_ware_categories';
    protected $primaryKey = 'foot_ware_categories_id';

    protected $fillable = [
        'foot_ware_categories_name','foot_ware_categories_code','foot_ware_categories_is_active'
    ];
}
