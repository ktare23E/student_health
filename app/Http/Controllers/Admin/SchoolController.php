<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\District;
use App\Models\Nurse;

class SchoolController extends Controller
{
    //

    public function index(){
        $schools = School::with('nurses')->get();
        $districts = District::all();

        return view('admin.school.index',[
            'schools' => $schools,
            'districts' => $districts
        ]);

    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
            'district_id' => 'required',
            'address' => 'required',
            'principal' => 'required',
            'school_type' => 'required',
        ]);
        
        //input static active status in validated data
        $validatedData['status'] = 'active';

        School::create($validatedData);

        return response()->json(['message' => 'success']);
    }

    public function update(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
            'district_id' => 'required',
            'address' => 'required',
            'principal' => 'required',
            'school_type' => 'required',
            'status' => 'required',
        ]);

        School::find($request->id)->update($validatedData);

        return response()->json(['message' => 'success']);
    }

    public function viewSchool(District $district){
        $schools = School::with('nurses')->where('district_id', $district->id)->get();
        

        return view('admin.school.view_school',[
            'schools' => $schools,
            'district' => $district,
        ]);
    }
}
