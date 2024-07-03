<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nurse;
use App\Models\School;
use App\Models\District;
use App\Models\Division;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\NurseEmailNotification;

class NurseController extends Controller
{
    //

    public function index(){
           // Retrieve all nurses with their associated entities
        $nurses = Nurse::all()->map(function ($nurse) {
            $nurse->entity = $nurse->entity; // Ensure entity relationship is loaded
            return $nurse;
        })->where('status', 'active');

        return view('admin.nurse.index',[
            'nurses' => $nurses
        ]);
    }

    public function archive(){
        // Retrieve all nurses with their associated entities
        $nurses = Nurse::all()->map(function ($nurse) {
            $nurse->entity = $nurse->entity; // Ensure entity relationship is loaded
            return $nurse;
        })->where('status', 'inactive');

        return view('admin.nurse.archive',[
            'nurses' => $nurses
        ]);
    }

    public function archiveNurse($id){
        $nurse = Nurse::findOrFail($id);
        $nurse->status = 'inactive';
        $nurse->save();

        return response()->json(['message' => 'success']);
    }

    public function activeNurse($id){
        $nurse = Nurse::findOrFail($id);
        $nurse->status = 'active';
        $nurse->save();

        return response()->json(['message' => 'success']);
    }

    public function resetPassword($id){
        $nurse = Nurse::findOrFail($id);


        $nurse->password = bcrypt('password');
        $nurse->save();
        
        $details = [
            'password' => 'password',
        ];

        Mail::to($nurse->email)->queue(new NurseEmailNotification($details));

        return response()->json(['message' => 'success']);
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

    public function update(Request $request){
        $validatedData = $request->validate([
            'id' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'type' => 'required',
            'entity_id' => 'required',
        ]);

        $nurse = Nurse::findOrFail($validatedData['id'])->update($validatedData);

        return response()->json(['message' => 'success']);

    }
}
