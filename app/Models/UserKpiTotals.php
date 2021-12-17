<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserKpiTotals extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_kpi_id',
        'kpi_eq_id',
        'kpi_eq_id',
        'amount'
    ];
}
