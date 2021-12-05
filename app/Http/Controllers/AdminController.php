<?php

namespace App\Http\Controllers;

use App\Models\Kpi;
use App\Models\WeekAssignment;
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

    public function assign_week(Request $request){

        $weeks = \App\Models\WeekAssignment::get();
        return view('admin.week_assign',compact('weeks'));

    }

    public function week_add(Request $request){
        DB::BeginTransaction();
        try{

            $week = WeekAssignment::create([
                'week_name' => $request->week_name,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);
        
        DB::commit();
            return redirect('admin/assign_week')->with('success', 'Week Add Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('admin/assign_week')->with('error', 'Week Not Added!');       
        }
    }
}
