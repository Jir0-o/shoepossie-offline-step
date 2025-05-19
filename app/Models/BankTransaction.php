<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    use HasFactory;

    protected $table = 'bank_transactions';
    protected $primaryKey = 'bank_transaction_id';
    public $timestamps = false;

    protected $fillable = [
        'bank_id',
        'date',
        'trx_type',
        'trx_mode',
        'bank_name',
        'cheque_no',
        'prev_balance',
        'amount',
        'current_balance',
        'is_verified'
    ];
}
