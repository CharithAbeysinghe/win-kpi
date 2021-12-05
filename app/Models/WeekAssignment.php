<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeekAssignment extends Model
{
    use HasFactory,SoftDeletes;

    protected $primaryKey = 'id';
    
    protected $fillable = ['week_name','start_date','end_date'];

}
