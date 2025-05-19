<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salaryInfo extends Model
{
    use HasFactory;
    protected $table = 'salary_infos';
    protected $primaryKey = 'salary_info_id';
    protected $fillable = [
        'back_office_login_id','salary_type_id','salary_amount','due','paid','is_active'
    ];
}
