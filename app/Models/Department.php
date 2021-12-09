<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory,SoftDeletes;
    protected $primaryKey = 'id';
    protected $fillable = ['department'];

    public function get_kpi_per_department(){
        return $this->hasMany(Kpi::class,'department_id')->get();
    }
}
