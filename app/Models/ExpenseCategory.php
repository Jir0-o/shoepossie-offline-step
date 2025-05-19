<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use HasFactory;

    protected $table = 'expense_categories';
    protected $primaryKey = 'expense_category_id';

    protected $fillable = [
        'expense_category_name','is_default','is_active','created_at','updated_at'
    ];

    public $timestamps = false;
}
