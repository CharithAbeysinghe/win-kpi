<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KpiOption extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['kpi_id','kpi_option'];

    public function get_kpi(){
        
        return $this->belongsTo(\App\Models\Kpi::class,'kpi_id')->first();
        
    }
}
