<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;


class NurseAllController extends Controller
{
    //
    public function index(){
        // retrieve auth nurse
        $nurse = Auth::user();
        if($nurse->type === 'school'){
            $students = Student::with('school')->where('school_id',$nurse->entity_id)->where('status','active')->get();
        }

        return view('nurse.student.index',[
            'students' => $students
        ]);
    }

    public function archiveStudent(){
        // retrieve auth nurse
        $nurse = Auth::user();
        if($nurse->type === 'school'){
            $students = Student::with('school')->where('school_id',$nurse->entity_id)->where('status','inactive')->get();
        }

        return view('nurse.archive_student.index',[
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
    public function importStudent(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());
        $nurse = Auth::user();
        $school_id = $nurse->entity_id;
    
        foreach ($fileContents as $line) {
            $data = str_getcsv($line);
    
            // Check if student already exists
            $student = Student::where('student_lrn', $data[0])->first();
    
            if ($student) {
                // Update existing student
                $student->update([
                    'first_name' => $data[1],
                    'last_name' => $data[2],
                    'address' => $data[3],
                    'status' => $data[4],
                    'grade_level' => $data[5],
                ]);
            } else {
                // Create new student
                Student::create([
                    'school_id' => $school_id,
                    'student_lrn' => $data[0],
                    'first_name' => $data[1],
                    'last_name' => $data[2],
                    'address' => $data[3],
                    'status' => $data[4],
                    'grade_level' => $data[5],
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }

    public function updateStatus($id){
        $student = Student::findOrFail($id);
        $student->status = 'inactive';
        $student->save();

        return response()->json([
            'message' => 'success'
        ]);
    }

    
    public function restoreStudent($id){
        $student = Student::findOrFail($id);
        $student->status = 'active';
        $student->save();

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function viewStudent(Student $student){
        $student = Student::findOrFail($student->id);
        $studentCheckUps = $student->checkups;
        $studentSchool = $student->school;
        return view('nurse.student.view_student',[
            'student' => $student,
            'checkups' => $studentCheckUps,
            'studentSchool' => $studentSchool
        ]);
    }

    public function checkupStudent($id){
        $student = Student::findOrFail($id);

        return view('nurse.checkup.checkup_form',[
            'student' => $student
        ]);
    }
}
