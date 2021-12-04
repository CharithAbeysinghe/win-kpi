<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['location'];
    protected $primaryKey = 'id';
    public function get_fillable(){
    }
}
