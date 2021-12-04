<?php

namespace App\Http\Controllers;

use App\Models\Kpi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function user(){
        
        $userType = \App\Models\UserType::get();
        $locations = \App\Models\Location::get();
        $departments = \App\Models\Department::get();
        return view('auth.register',compact('userType','locations','departments'));
    }

    public function delete_data(Request $request) {
        DB::BeginTransaction();
        try{
            $model = $request->tbl;
            if($model == 'Kpi'){
                $flight = \App\Models\Kpi::find($request->id);
            }else if($model == 'Location'){
                $flight = \App\Models\Location::find($request->id);
            }else if($model == 'KpiOption'){
                $flight = \App\Models\KpiOption::find($request->id);
            }else if($model == 'Department'){
                $flight = \App\Models\Department::find($request->id);
                
            }else{
                
            } 

            $flight->delete();
        
        DB::commit();
            return back()->with('success', 'Deleted Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Not Deleted!');       
        }
    }
}
