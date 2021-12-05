<?php

namespace App\Http\Controllers;

use App\Models\Kpi;
use App\Models\User;
use App\Models\WeekAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
