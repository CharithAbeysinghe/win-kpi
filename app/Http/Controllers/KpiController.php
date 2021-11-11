<?php

namespace App\Http\Controllers;

use App\Models\Kpi;
use App\Models\Department;
use App\Models\KpiOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KpiController extends Controller
{
    public function __construct() 
    {
    $this->middleware('auth');
    }
    
    public function index(){
        $kpi = Kpi::get();
        $department = Department::get();
        $title = 'KPI';
        $page = 'KPI';
        $page_sub = 'View';
        return view('master.kpi.index',compact('kpi','title','page','page_sub','department'));
    }

    public function add(Request $request){
        DB::BeginTransaction();
        try{

            $kpi = Kpi::create([
                'kpi' => $request->kpi,
                'department_id' => $request->department_id,
            ]);
        
        DB::commit();
            return redirect('kpi/view')->with('success', 'Profile updated!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('kpi/view')->with('error', 'Profile updated!');       
        }
    }

    public function index_option(){
        $kpi = Kpi::get();
        $kpiOption = KpiOption::get();
        $title = 'KPI OPTION';
        $page = 'KPI';
        $page_sub = 'View';
        return view('master.kpi.index_kpi_option',compact('kpiOption','title','page','page_sub','kpi'));
    }

    public function add_option(Request $request){
        DB::BeginTransaction();
        try{

            $kpi = KpiOption::create([
                'kpi_id' => $request->kpi_id,
                'kpi_option' => $request->kpi_option,
            ]);
        
        DB::commit();
            return redirect('kpi/kpi-option')->with('success', 'Profile updated!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('kpi/kpi-option')->with('error', 'Profile updated!');       
        }
    }
}