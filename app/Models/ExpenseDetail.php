<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseDetail extends Model
{
    use HasFactory;

    protected $table = "expense_details";

    protected $primaryKey = "expense_details_id";

    protected $fillable = [
        'expense_id',
        'date',
        'amount',
        'notes',
        'created_at',
        'updated_at'
    ];
}
