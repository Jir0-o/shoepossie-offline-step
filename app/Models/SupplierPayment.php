<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    use HasFactory;

    protected $table = 'supplier_payments';
	protected $primaryKey = 'supplier_payment_id';

    protected $fillable = [
		'supplier_id',
		'purchase_id',
		'payable_amount',
		'paid_amount',
		'revised_due',
		'payment_methods',
		'cheque_no',
		'notes',
		'payment_method',
	];

}
