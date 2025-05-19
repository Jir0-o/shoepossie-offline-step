<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseNew extends Model
{
    use HasFactory;

    protected $table = 'purchase_news';
    protected $primaryKey = 'purchase_id';

    protected $fillable = [
        'product_material_id',
        'colors_id',
        'size_id',
        'batch',
        'purchase_price',
        'sales_price',
        'vat',
        'qty',
        'purchase_code',
        'barcode',
    ];
}
