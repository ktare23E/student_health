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
            'status' => 'required',
            'principal' => 'required'
        ]);

        School::create($validatedData);

        return response()->json(['message' => 'success']);
    }

    public function update(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
            'district_id' => 'required',
            'address' => 'required',
            'principal' => 'required',
            'status' => 'required',
        ]);

        School::find($request->id)->update($validatedData);

        return response()->json(['message' => 'success']);
    }
}
