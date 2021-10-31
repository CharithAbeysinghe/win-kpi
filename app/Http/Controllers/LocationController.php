<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function __construct() 
    {
    $this->middleware('auth');
    }
    
    public function index(){
        $location = Location::get();
        $title = 'Location';
        $page = 'Location';
        $page_sub = 'View';
        return view('master.location.index',compact('location','title','page','page_sub'));
    }

    public function add(Request $request){
        DB::BeginTransaction();
        try{

            $locations = Location::create([
                'location' => $request->location
            ]);
        
        DB::commit();
            return redirect('location/view')->with('success', 'Profile updated!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('location/view')->with('error', 'Profile updated!');       
        }
    }
}
