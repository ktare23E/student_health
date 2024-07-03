<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nurse;
use App\Models\School;
use App\Models\District;
use App\Models\Division;
use Illuminate\Support\Facades\Log;

class NurseController extends Controller
{
    //

    public function index(){
           // Retrieve all nurses with their associated entities
           $nurses = Nurse::all()->map(function ($nurse) {
            $nurse->entity = $nurse->entity; // Ensure entity relationship is loaded
            return $nurse;
        });

        return view('admin.nurse.index',[
            'nurses' => $nurses
        ]);
    }

    public function getEntities($type)
    {
        switch ($type) {
            case 'school':
                $entities = School::all();
                break;
            case 'district':
                $entities = District::all();
                break;
            case 'division':
                $entities = Division::all();
                break;
            default:
                $entities = [];
        }

        return $entities;

        return response()->json($entities);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'email' => 'required',
            'password' => 'required',
            'status' => 'required',
            'type' => 'required',
            'entity_id' => 'required',
        ]);

        //encrypt password
        $validatedData['password'] = bcrypt($validatedData['password']);
        
        Nurse::create($validatedData);

        return response()->json(['message' => 'success']);
    }
}
