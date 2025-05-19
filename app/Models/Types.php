<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    use HasFactory;
    protected $table = 'types';
    protected $primaryKey = 'type_id';

    protected $fillable = [
        'type_name','type_code','type_is_active'
    ];
}
