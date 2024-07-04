<?php

namespace App\Http\Controllers\DistrictNurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class StudentSchoolList extends Controller
{
    //

    public function index(){
        // retrieve auth nurse
        $nurse = Auth::user();
        if($nurse->type === 'school'){
            $students = Student::with('school')->where('school_id',$nurse->entity_id)->get();
        }

        return view('nurse.student.index',[
            'students' => $students
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'student_lrn' => 'required',
            'status' => 'required',
            'grade_level' => 'required'
        ]);

        $nurse = Auth::user();
        $school_id = $nurse->entity_id;

        Student::create([
            'school_id' => $school_id,
            'student_lrn' => $request->student_lrn,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'status' => $request->status,
            'grade_level' => $request->grade_level,
        ]);

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function update(Request $request){
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'student_lrn' => 'required',
            'status' => 'required',
            'grade_level' => 'required'
        ]);

        $student = Student::findOrFail($request->id)->update($validated);

        return response()->json([
            'message' => 'success'
        ]);
    }
}
