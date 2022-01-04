<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Kpi;
use App\Models\KpiCalculation;
use App\Models\UserKpi;
use App\Models\UserKpiDetail;
use App\Models\UserKpiTotals;
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
        $weeks = WeekAssignment::get();
        $departments = \App\Models\Department::get();
        return view('admin.dashboard_index',compact('kpi','weeks','departments'));
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
            }else if($model == 'KpiCalculation'){
                $flight = \App\Models\KpiCalculation::find($request->id);
            }else if($model == 'User'){
                $flight = \App\Models\User::find($request->id);
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

    public function kpi_per_department(Request $request){
        $kpis = Kpi::where('department_id',$request->department_id)->get();
        echo $kpis->toJson();
    }

    public function kpi_result(Request $request){

        $kpi_data = UserKpi::whereNull('deleted_at')->orderBy('id', 'asc');
        
        if($request->week_id != 0){
            $kpi_data->where('week_id',$request->week_id);
        }

        if($request->department_id != 0){
            $kpi_data->where('department_id',$request->department_id);
        }

        $kpi_id = 0;
        if($request->kpi_id != 0){
            $kpi_id = $request->kpi_id;
        }

        $kpi_data = $kpi_data->get();

        // dd($kpi_data);

        $main_array = array();
        $kpi_data->transform(function($transform) use($kpi_id) {
            
            $kpi_opt_details = UserKpiDetail::where('user_kpi_id',$transform->id);

            if($kpi_id != 0){

                $kpi_opt_details->where('kpi_id',$kpi_id);

            }

            $kpi_opt_details = $kpi_opt_details->get();

            $kpi_totals = UserKpiTotals::where('user_kpi_id',$transform->id)->get();
            
            return [
                'department' => $transform->department_id,
                'week'       => $transform->week_id,
                'kpi_data'   => $kpi_opt_details,
                'kpi_total'  => $kpi_totals
            ];
        });

        return view('admin.dashboard_data',compact('kpi_data'));
    }


    public function update_data(Request $request) {
        DB::BeginTransaction();
        try{
            $model = $request->tbl;
            if($model == 'Kpi'){
                $flight = \App\Models\Kpi::find($request->id);
                $flight->kpi = $request->vale;
            }else if($model == 'Location'){
                $flight = \App\Models\Location::find($request->id);
                $flight->location = $request->vale;
            }else if($model == 'KpiOption'){
                $flight = \App\Models\KpiOption::find($request->id);
                $flight->kpi_option = $request->vale;
            }else if($model == 'Department'){
                $flight = \App\Models\Department::find($request->id);
                $flight->department = $request->vale;
            }else if($model == 'KpiCalculation'){
                $flight = \App\Models\KpiCalculation::find($request->id);
                $flight->formula_label = $request->vale;
            }

            $flight->save();
        
        DB::commit();
            echo json_encode(array('result'=>true,'data'=>$request->vale));
        } catch (\Exception $e) {
            DB::rollback();
            echo json_encode(array('result'=>false));      
        }
    }
}
