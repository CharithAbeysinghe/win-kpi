<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKpiDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_kpi_id',
        'kpi_id',
        'kpi_option_id',
        'amount'
    ];
}
