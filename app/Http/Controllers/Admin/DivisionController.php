<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    //

    public function index(){
        $divisions = Division::all();

        return view('admin.division.index',[
            'divisions' => $divisions,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        Division::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return response()->json([
            'message' => 'success',
        ]);
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'id' => 'required|integer',
        ]);

        $division = Division::findOrFail($request->id);
        $division->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return response()->json([
            'message' => 'success',
        ]);
    }
    
    public function divisions(){
        $divisions = Division::all();
        
        return view('components.modal.district_modal',[
            'divisions' => $divisions,
        ]);
    }


}
