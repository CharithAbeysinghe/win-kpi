<?php

namespace App\Http\Controllers;

use App\Models\Kpi;
use App\Models\Department;
use App\Models\KpiCalculation;
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
            return redirect('kpi/view')->with('success', 'Kpi Add Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('kpi/view')->with('error', 'Kpi Not Added!');       
        }
    }

    public function index_option(){
        $kpi = Kpi::get();
        $kpiOption = KpiOption::join('kpis','kpis.id','kpi_options.kpi_id')
        ->select('kpi_options.id','kpi_options.kpi_option','kpis.kpi')
        ->get();
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
            return redirect('kpi/kpi-option')->with('success', 'Kpi option Add Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('kpi/kpi-option')->with('error', 'Kpi option Not Added!');       
        }
    }

    public function kpi_formula() {

        $kpi = Kpi::get();
        $kpieqs = KpiCalculation::get();
        return view('admin.kpi_formular',compact('kpi','kpieqs'));

    }

    public function kpi_option_load(Request $request) {

        $kpiOption = KpiOption::where('kpi_id',$request->kpi)->get();
        return view('admin.kpi_opt_load',compact('kpiOption'));

    }

    public function save_formula(Request $request){
        
        DB::BeginTransaction();
        try{

            $kpi = KpiCalculation::create([
                'kpi_id' => $request->kpi_id,
                'formula_label' => $request->eq_label,
                'formula' => rtrim($request->real_form, ','),
                'formula_string'=>rtrim($request->real_form_value, ','),
                'is_perce'=> $request->is_perce
            ]);
        
        DB::commit();
            return redirect('kpi/kpi-formula')->with('success', 'Added Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('kpi/kpi-formula')->with('error', 'Not Added!');       
        }

    }
}
