<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseTemporaryItem extends Model
{
    use HasFactory;

    protected $table='purchase_temporary_items';
    protected $primaryKey='temp_purchase_id';
    public $timestamps = false;
    protected $fillable=[
        'purchase_temporary_id',
        'unit_id',
        'quantity',
        'discount',
        'vat',
        'temp_net_amount',
    ];
}
