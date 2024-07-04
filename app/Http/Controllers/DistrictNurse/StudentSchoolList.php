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
}
