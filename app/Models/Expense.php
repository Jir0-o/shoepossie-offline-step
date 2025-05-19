<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $table = "expenses";

    protected $primaryKey = "expense_id";

    protected $fillable = [
        'expense_name',
        'expense_category_id',
        'is_default',
        'is_active',
        'created_at',
        'updated_at'
    ];
    
}
