<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kpi extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'kpi','department_id'
    ];

    protected $primaryKey = 'id';

    public function get_options(){
        return $this->hasMany(KpiOption::class,'kpi_id')->get();
    }

    public function get_kpi_formulae(){
        return $this->hasMany(KpiCalculation::class,'kpi_id')->get();
    }
}
