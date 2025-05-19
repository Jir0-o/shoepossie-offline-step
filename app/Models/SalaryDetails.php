<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryDetails extends Model
{
    use HasFactory;

    protected $table = 'salary_details';
    protected $primaryKey = 'salary_details_id';
    protected $fillable = [
        'salary_details_id',
        'salary_info_id',
        'pay_date',
        'paid_amount',
        'extra_allowence_amount',
        'paid_for_month',
        'description',
        'salary_amount',
    ];
}
