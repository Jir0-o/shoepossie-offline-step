<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayEndBalance extends Model
{
    use HasFactory;
    protected $table = 'day_end_balance';
    protected $primaryKey = 'day_end_balance_id';
    public $timestamps = false;

    protected $fillable = [
        'date',
        'is_closed',
        'closing_balance',
        'cash_out',
        'total_expense',
        'purchase_due_amount',
        'purchase_paid_amount',
        'total_purchase',
        'cash_in',
        'sales_due_amount',
        'sales_paid_amount',
        'total_sales',
        'opening_balance',
    ];
}
