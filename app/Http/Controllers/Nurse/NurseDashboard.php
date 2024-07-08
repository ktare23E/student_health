<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use App\Models\Student;

class NurseDashboard extends Controller
{
    //
      //
    public function index(){
      $nurse = Auth::user();
        if ($nurse->type === 'school') {
            return view('nurse.index');
        } elseif ($nurse->type === 'district') {
            return view('nurse.index');
        } elseif ($nurse->type === 'division') {
            return view('nurse.index');
        }
    }

    public function schoolList(){
        $nurse = Auth::user();
        if ($nurse->type === 'district') {
          $district_id = $nurse->entity_id;
          $schools = School::with('district')->where('district_id',$district_id)->get();
       
          return view('nurse.school.index',[
            'schools' => $schools
          ]);
        } 
    }

    public function studentList(School $school){
        $students = $school->students;
        return view('nurse.student.district_student',[
            'students' => $students
        ]);
    }

    public function viewStudent(Student $student){
      $student = Student::findOrFail($student->id);
      $studentCheckUps = Student::with('checkups.nurse')->where('id',$student->id)->get();
      $studentSchool = $student->school;

      return view('nurse.student.view_student',[
          'student' => $student,
          'studentCheckUps' => $studentCheckUps,
          'studentSchool' => $studentSchool
      ]);
  }
}
