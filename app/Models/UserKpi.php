<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserKpi extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'department_id',
        'year',
        'month',
        'week_id',
        'user_id',
        'location_id'
    ];
}
