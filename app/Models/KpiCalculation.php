<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KpiCalculation extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'formula_label','kpi_id','formula','formula_string','is_perce'
    ];

    function get_kpi_name(){
        return $this->belongsTo(Kpi::class,'kpi_id')->first();
    }
}
