<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartServiceReturn extends Model
{
    use HasFactory;
    protected $table = 'cart_service_return';
    protected $primaryKey = 'service_return_id';
    public $timestamps = false;

    protected $fillable = [
        'job_number',
        'consumer_address',
        'consumer_name',
        'consumer_id',
        'cart_item_id',
        'warranty_card_no',
        'model_no',
        'cart_id',
        'imei',
        'delivery_date',
        'estimated_delivery_date',
        'sending_date',
        'purchase_date',
        'reason_of_return',
        'quantity'
    ];
}
