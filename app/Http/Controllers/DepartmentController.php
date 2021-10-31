<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function __construct() 
    {
    $this->middleware('auth');
    }
    
    public function index(){
        $department = Department::get();
        $location = Location::get();
        $title = 'Department';
        $page = 'Department';
        $page_sub = 'View';
        return view('master.department.index',compact('department','title','page','page_sub','location'));
    }

    public function add(Request $request){
        DB::BeginTransaction();
            try{

            $department = Department::create([
                'location_id' => $request->location_id,
                'department' => $request->department,
            ]);
        
        DB::commit();
            return redirect('department/view')->with('success', 'Profile updated!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('department/view')->with('error', 'Profile updated!');       
        }
    }
}
