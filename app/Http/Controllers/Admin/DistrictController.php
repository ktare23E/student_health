<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Division;

class DistrictController extends Controller
{
    //
    public function index(){
        $districts = District::with('division')->get();
        $divisions = Division::all();


        return view('admin.district.index',[
            'districts' => $districts,
            'divisions' => $divisions,
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'division_id' => 'required',
            'district_head' => 'required',
            'address' => 'required',
        ]);

        District::create($validatedData);

        return response()->json(['message' => 'success']);
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'division_id' => 'required',
            'district_head' => 'required',
            'address' => 'required',
            'id' => 'required',
        ]);

        $district = District::findOrFail($validatedData['id']);
        $district->update($validatedData);

        return response()->json(['message' => 'success']);
    }
}
