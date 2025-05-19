<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    use HasFactory;
    protected $table = 'colors';
    protected $primaryKey = 'colors_id';

    protected $fillable = [
        'colors_name','colors_code','colors_is_active'
    ];
}
