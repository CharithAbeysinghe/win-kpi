<?php

namespace App\Http\Controllers;

use App\Models\Kpi;
use App\Models\User;
use App\Models\UserKpi;
use App\Models\UserKpiDetail;
use App\Models\WeekAssignment;
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
        $weeks = WeekAssignment::get();
        $kpi = Kpi::where('department_id',Auth::user()->department_id)->get();
        return view('department.dashboard',compact('kpi','weeks'));

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
        $week_id = $request->week_id;
        $is_null = 0;
        
        DB::BeginTransaction();
            try{

            $userKpi = UserKpi::create([
                'department_id' => $user->department_id,
                'week_id' => $week_id
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
}
