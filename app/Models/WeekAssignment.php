<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class WeekAssignment extends Model
{
    use HasFactory,SoftDeletes,RevisionableTrait;

    protected $primaryKey = 'id';
    
    protected $fillable = 
    ['week_name',
    'start_date',
    'end_date',
    'current_week_status'
    ];

    public function get_week_name($id){
        return $this::where('id',$id)->first();
    }

}
