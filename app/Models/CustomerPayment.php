<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    use HasFactory;

    protected $table = 'customer_payments';
    protected $primaryKey = 'customer_payment_id';

    protected $fillable = [
        'date',
        'customer_id',
        'payable_amount',
        'adjustment_amount',
        'adjust_payable',
        'paid_amount',
        'revised_due',
        'payment_method',
        'cheque_no',
        'bank_name',
        'sales_info_id',
    ];
}
