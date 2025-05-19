<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseTemporary extends Model
{
    use HasFactory;
    protected $table='purchase_temporaries';
    protected $primaryKey='purchase_temporary_id';
    public $timestamps = false;
    protected $fillable=[
        'temporary_consumer_id',
        'consumer_id',
        'create_date',
        'from_ip',
        'created_by',
        'sales_type',
        'is_suspented',
    ];
}
