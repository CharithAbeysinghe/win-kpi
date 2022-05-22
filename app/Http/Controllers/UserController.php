<?php

namespace App\Http\Controllers;

use App\Models\Kpi;
use App\Models\User;
use App\Models\UserKpi;
use App\Models\UserKpiDetail;
use App\Models\UserKpiTotals;
use App\Models\WeekAssignment;
use App\Models\Location;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct() 
    {
    $this->middleware('auth');
    }
    
    public function index(){
        //$weeks = WeekAssignment::where('current_week_status',1)->get();
        $weeks = WeekAssignment::get();
        $kpi = Kpi::where('department_id',Auth::user()->department_id)->get();
        return view('department.dashboard',compact('kpi','weeks'));

    }

    public function index_edit(Request $request){

        $kpi_data = UserKpi::where('id',$request->id)->whereNull('deleted_at')->orderBy('id', 'asc');
        $kpi_s = UserKpi::where('id',$request->id)->whereNull('deleted_at')->first();

        if($request->week_id != 0){
            $kpi_data->where('week_id',$kpi_s->week_id);
        }

        if($request->department_id != 0){
            $kpi_data->where('department_id',$kpi_s->department_id);
        }

        $kpi_id = 0;
        if($request->kpi_id != 0){
            $kpi_id = $request->id;
        }

        $kpi_data = $kpi_data->get();

        $main_array = array();
        $kpi_data->transform(function($transform) use($kpi_id) {
            
            $kpi_opt_details = UserKpiDetail::where('user_kpi_id',$transform->id);

            if($kpi_id != 0){

                $kpi_opt_details->where('kpi_id',$kpi_id);

            }

            $kpi_opt_details = $kpi_opt_details->get();

            $kpi_opt_details->transform(function($transform){
                return[
                    'id' => $transform->id,
                    'user_kpi_id' => $transform->user_kpi_id,
                    'kpi_id' => $transform->kpi_id,
                    'kpi_option_id' => $transform->kpi_option_id,
                    'amount' => $transform->amount,
                ];

            });

            

            $kpi_totals = UserKpiTotals::where('user_kpi_id',$transform->id)->get();
            $WeekAssignment = new WeekAssignment();
            $department_modal = new Department();
            return [
                'department' => $transform->department_id,
                'department_name' => $department_modal->get_week_name($transform->department_id)->department,
                'week_name' => $WeekAssignment->get_week_name($transform->week_id)->week_name,
                'week'       => $transform->week_id,
                'kpi_data'   => $kpi_opt_details,
                'kpi_total'  => $kpi_totals
            ];
        });
        
        $weeks = WeekAssignment::get();
        $locations = \App\Models\Location::get();
        $departments = \App\Models\Department::get();
        $kpi = Kpi::where('department_id',$kpi_s->department_id)->get();
        $kUId = $request->id;
        return view('admin.edit_kpi_result_index',compact('kpi','weeks','locations','departments','kpi_data','kUId'));

    }

    public function register(Request $request){

        $this->validator($request->all())->validate();

        if($this->create($request->all())){
            return redirect()->back()->with('success', 'User Registered!');
        }

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_type' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'u_tp_id' => $data['user_type'],
            'location_id' => $data['location_id'],
            'department_id' => $data['department_id']
        ]);
    }

    public function submit(Request $request) {

        $user = Auth::user();
        $kpis =$user->get_user_department()->get_kpi_per_department();
        $user_id = $user->id;
        $user_id = $user->id;
        $user_location_id = $user->location_id;
        $week_id = $request->week_id;
        $is_null = 0;
        
        DB::BeginTransaction();
            try{

            $userKpi = UserKpi::create([
                'department_id' => $user->department_id,
                'week_id' => $week_id,
                'user_id' => $user_id,
                'location_id' => $user_location_id,
            ]);

            foreach($kpis as $kpi_ids){
                $var_string = 'kpi_opt_count_'.$kpi_ids->id;
                $opt_count = $request->$var_string;
    
                for($i = 0;$i<$opt_count;$i++){
    
                    $opt_var = 'kpi_opt_id_'.$kpi_ids->id.'_'.$i;
                    $opt_var_val = 'kpi_opt_val_'.$kpi_ids->id.'_'.$i;
                    
                    if(isset($request->$opt_var_val) != ""){
                        $userKpiDetail = UserKpiDetail::create([
                            'user_kpi_id' => $userKpi->id,
                            'kpi_id' => $kpi_ids->id,
                            'kpi_option_id' => $request->$opt_var,
                            'amount' => $request->$opt_var_val,
                        ]);
                        $is_null++;
                    }
                }
                $var_eq = 'kpi_eq_count_'.$kpi_ids->id;
                if(($request->$var_eq) > 0){
                for($eq = 0; $eq < $request->$var_eq; $eq++){
                    $eq_vls_ids = 'kpi_eq_ids_'.$kpi_ids->id.'_'.$eq;
                    $eq_vls = 'total_val_'.$kpi_ids->id.'_'.$eq;
                    $is_perce = 'is_perce_'.$kpi_ids->id.'_'.$eq;
                    
                    $is_perce_on = "";
                    $is_perce_off = "";
                    
                    if (strpos($request->$eq_vls, '%') !== false) {
                        $is_perce_on = $request->$eq_vls;
                        $is_perce_off = "";
                    }else{
                        $is_perce_off = $request->$eq_vls;
                        $is_perce_on = "";
                    }

                    if(isset($request->$opt_var_val) != ""){
                        $UserKpiTotals = UserKpiTotals::create([
                            'user_kpi_id' => $userKpi->id,
                            'kpi_eq_id' => $request->$eq_vls_ids,
                            'amount' => $request->$eq_vls,
                            'amt' => $is_perce_off,
                            'amt_percentage' => $is_perce_on,
                        ]);
                    }
                }
            }
            }

        DB::commit();
            if($is_null == 0){
                return redirect('user/dashboard')->with('error', 'Nothing to Submit');  
            }else{
                return redirect('user/dashboard')->with('success', 'Successfully Submitted!');
            }

            
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect('user/dashboard')->with('error', 'error!');       
        }
    }


    public function submit_update(Request $request) {
    
        $kpis = Kpi::where('department_id',$request->department_id)->get();
        $user = Auth::user();
        $kpi_user_id = $request->kUId;
        $user_id = $user->id;
        $week_id = $request->week_id;
        $is_null = 0;
        
        DB::BeginTransaction();
            try{


            foreach($kpis as $kpi_ids){
                $var_string = 'kpi_opt_count_'.$kpi_ids->id;
                $opt_count = $request->$var_string;
    
                for($i = 0;$i<$opt_count;$i++){
    
                    $opt_var = 'kpi_opt_id_'.$kpi_ids->id.'_'.$i;
                    $opt_var_val = 'kpi_opt_val_'.$kpi_ids->id.'_'.$i;
                    
                    if(isset($request->$opt_var_val) != ""  ){

                        $where = [
                            'user_kpi_id'=>$kpi_user_id,
                            'kpi_id'=>$kpi_ids->id,
                            'kpi_option_id'=> $request->$opt_var
                        ];

                        $exsit = UserKpiDetail::where($where)->first();

                        if( $exsit ){
                            UserKpiDetail::where($where)->update([
                                'amount' => $request->$opt_var_val,
                            ]);
                        }else{
                            UserKpiDetail::Create([
                                'user_kpi_id' => $kpi_user_id,
                                'kpi_id' => $kpi_ids->id,
                                'kpi_option_id' => $request->$opt_var,
                                'amount' => $request->$opt_var_val,
                            ]);
                        }

                        
                        $is_null++;
                    }
                }
                $var_eq = 'kpi_eq_count_'.$kpi_ids->id;
                if(($request->$var_eq) > 0){
                for($eq = 0; $eq < $request->$var_eq; $eq++){
                    $eq_vls_ids = 'kpi_eq_ids_'.$kpi_ids->id.'_'.$eq;
                    $eq_vls = 'total_val_'.$kpi_ids->id.'_'.$eq;
                    $is_perce = 'is_perce_'.$kpi_ids->id.'_'.$eq;
                    
                    $is_perce_on = "";
                    $is_perce_off = "";
                    
                    if (strpos($request->$eq_vls, '%') !== false) {
                        $is_perce_on = $request->$eq_vls;
                        $is_perce_off = "";
                    }else{
                        $is_perce_off = $request->$eq_vls;
                        $is_perce_on = "";
                    }

                    if(isset($request->$opt_var_val) != ""){

                        $whereTot = [
                            'user_kpi_id'=>$kpi_user_id,
                            'kpi_eq_id'=>$request->$eq_vls_ids
                        ];
                        $exsitTotal = UserKpiTotals::where($whereTot)->first();

                        if( $exsitTotal ){
                            UserKpiTotals::where($whereTot)->update([
                                'amount' => $request->$eq_vls,
                                'amt' => $is_perce_off,
                                'amt_percentage' => $is_perce_on,
                            ]);
                        }else{
                            UserKpiTotals::Create([
                                'user_kpi_id' => $kpi_user_id,
                                'kpi_eq_id' => $request->$eq_vls_ids,
                                'amount' => $request->$eq_vls,
                                'amt' => $is_perce_off,
                                'amt_percentage' => $is_perce_on,
                            ]);
                        }
                    }
                }
            }
            }

        DB::commit();
            if($is_null == 0){
                return redirect('admin/editdashboard?id='.$request->kUId)->with('error', 'Nothing to Submit');  
            }else{
                return redirect('admin/editdashboard?id='.$request->kUId)->with('success', 'Successfully Submitted!');
            }

            
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect('admin/editdashboard?id='.$request->kUId)->with('error', 'error!');       
        }
    }
    
    
    public function user_view(){
        $getUser = User::get();
        return view('auth.user',compact('getUser'));
    }
    
    public function user_edit_popup(Request $request){
        $getUser = User::find($request->id);
        $userType = [
           ['id' => '1', 'type'=>'Admin'],
           ['id' => '2', 'type'=>'User']
        ];
        $department = Department::get();
        $location = Location::get();
        
        return view('auth.edit_popup',compact('getUser','userType','department','location'));
    }

    public function user_edit(Request $request){

        $department_id = isset($request->department_id) ? $request->department_id : 0;
        $location_id = isset($request->location_id) ? $request->location_id : 0;
        $password = $request->password;
        $email = $request->email;
        $u_tp_id = $request->u_tp_id;
        $name = $request->name;
        $u_id = $request->u_id;

        DB::BeginTransaction();
        try{

                $flight = \App\Models\User::find($u_id);
                $flight->name = $name;
                $flight->email = $email;
                if($flight->password !="" && $flight->password != null ){
                    $flight->password = Hash::make($password);
                }
                $flight->u_tp_id = $u_tp_id;
                $flight->location_id = $location_id;
                $flight->department_id = $department_id;
            

            $flight->save();
        
        DB::commit();
            return redirect('admin/user-view')->with('success', 'Successfully Updated!'); 
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('admin/user-view')->with('error', 'error');      
        }


    }
}
