<?php

namespace App\Http\Controllers;

use App\Models\Kpi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct() 
    {
    $this->middleware('auth');
    }
    
    public function index(){
        $kpi = Kpi::where('department_id',2)->get();
        return view('admin.dashboard',compact('kpi'));
    }
}
