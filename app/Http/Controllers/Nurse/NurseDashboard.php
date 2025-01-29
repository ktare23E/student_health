<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use App\Models\Student;
use App\Models\Checkup;
use App\Models\Nurse;
use App\Models\District;
use App\Models\Division;
use App\Models\SystemLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
class NurseDashboard extends Controller
{
    //
    //
    public function index()
    {
        $nurse = Auth::user();

        if ($nurse->type === 'school') {
            $division = Division::with('districts')->get();
            //retrieve 3 schools that are active
            $school = School::where('id', $nurse->entity_id)->get();


            //retrieve 3 nurses with different type
            $nurses = Nurse::where('status', 'active')->orderBy('id', 'desc')->take(3)->get();
            //retrieve the number of active students
            $activeStudentNumber = Student::where('school_id',$nurse->entity_id)->where('status', 'active')->count();

            //retrieve the count of inactive students
            $inactiveStudentNumber = Student::where('school_id',$nurse->entity_id)->where('status', 'inactive')->count();

            //number of checkup
            $nurseCheckupCount = Checkup::where('nurse_id',$nurse->id)->count();
            $latestCheckup = Checkup::with('student')->where('nurse_id',$nurse->id)->latest()->first();

            return view('nurse.index',[
                'nurse' => $nurse,
                'division' => $division,
                'school' => $school,
                'nurses' => $nurses,
                'activeStudentNumber' => $activeStudentNumber,
                'inactiveStudentNumber' => $inactiveStudentNumber,
                'nurseCheckupCount' => $nurseCheckupCount,
                'latestCheckup' => $latestCheckup
            ]);

        } elseif ($nurse->type === 'district') {
            $division = Division::with('districts')->get();
            //retrieve 3 schools that are active
            $schools = School::where('status', 'active')->orderBy('id', 'desc')->take(3)->get();

            //retrieve 3 nurses with different type
            $nurses = Nurse::where('status', 'active')->orderBy('id', 'desc')->take(3)->get();
            //retrieve the number of active students
            $activeStudentNumber = Student::where('status', 'active')->count();

            //retrieve the count of inactive students
            $inactiveStudentNumber = Student::where('status', 'inactive')->count();

            return view('nurse.index',[
                'nurse' => $nurse,
                'division' => $division,
                'schools' => $schools,
                'nurses' => $nurses,
                'activeStudentNumber' => $activeStudentNumber,
                'inactiveStudentNumber' => $inactiveStudentNumber
            ]);

        } elseif ($nurse->type === 'division') {
            $division = Division::with('districts')->get();
            //retrieve 3 schools that are active
            $schools = School::where('status', 'active')->orderBy('id', 'desc')->take(3)->get();

            //retrieve 3 nurses with different type
            $nurses = Nurse::where('status', 'active')->orderBy('id', 'desc')->take(3)->get();
            //retrieve the number of active students
            $activeStudentNumber = Student::where('status', 'active')->count();

            //retrieve the count of inactive students
            $inactiveStudentNumber = Student::where('status', 'inactive')->count();

            return view('nurse.index',[
                'nurse' => $nurse,
                'division' => $division,
                'schools' => $schools,
                'nurses' => $nurses,
                'activeStudentNumber' => $activeStudentNumber,
                'inactiveStudentNumber' => $inactiveStudentNumber
            ]);
        }
    }

    public function schoolList()
    {
        $nurse = Auth::user();
        if ($nurse->type === 'district') {
            $district_id = $nurse->entity_id;
            $schools = School::with('district')->where('district_id', $district_id)->get();

            return view('nurse.school.index', [
                'schools' => $schools
            ]);
        }elseif($nurse->type === 'division'){
            $division_id = $nurse->entity_id;
            $districts = District::where('division_id', $division_id)->get();
            $schools = School::with('district')->whereIn('district_id', $districts->pluck('id'))->get();

            return view('nurse.school.index', [
                'schools' => $schools
            ]);
        }
    }

    public function studentList(School $school,Request $request)
    {
        // return $request->all();
        $students = $school->students;
        // return $students;
        return view('nurse.student.district_student', [
            'students' => $students
        ]);
    }

    public function viewStudent(Student $student)
    {
        $student = Student::findOrFail($student->id);
        $studentCheckUps = Student::with('checkups.nurse')->where('id', $student->id)->get();
        $studentSchool = $student->school;


        return view('nurse.student.view_student', [
            'student' => $student,
            'studentCheckUps' => $studentCheckUps,
            'studentSchool' => $studentSchool
        ]);
    }


    public function viewCheckup(Checkup $checkup)
    {
        $studentData = Student::with('school')->findOrFail($checkup->student_id);
        $schoolData = School::findOrFail($studentData->school_id);
        // return $checkup->nurse;
        $nurseData = Nurse::findOrFail($checkup->nurse_id);

        
        $nurse = Auth::user();

        $currentTime = Carbon::now('Asia/Manila');

        SystemLog::create([
                'nurse_id' => $nurse->id,
                'date' => $currentTime,
                'access' => 'Viewed Checkup Details of '.$studentData->first_name.' '.$studentData->last_name.' Student'
        ]);

        return view('nurse.checkup.view_checkup', [
            'checkup' => $checkup,
            'student' => $studentData,
            'school' => $schoolData,
            'nurse' => $nurseData
        ]);
    }

    public function profile(){
        $nurse = Auth::user();

        return view('nurse.profile', [
            'nurse' => $nurse
        ]);
        
    }

    public function changePassword(Request $request){   
        $nurse = Nurse::findOrFail($request->id);
        $nurse->password = bcrypt($request->password);
        $nurse->save();
        
        return response()->json(['message' => 'success']);
    }

    public function nurseProfile(Request $request,Nurse $nurse){
       // Validate the uploaded file
        $request->validate([
            'nurse_profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation as needed
        ]);

    // Handle the uploaded file
    if ($request->hasFile('nurse_profile')) {
        // Get the file
        $file = $request->file('nurse_profile');
        // Define the file path and name
        $filePath = 'uploads/profiles';
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Store the file
        $path = $file->storeAs($filePath, $fileName, 'public');

        // Optionally, delete the old profile image if it exists
        if ($nurse->nurse_profile) {
            Storage::disk('public')->delete($nurse->nurse_profile);
        }

        // Save the new profile image path to the student's profile
        $nurse->nurse_profile = $path;
        $nurse->save();
    }

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Profile image updated successfully!');
    }

    public function testCheckUp(Checkup $checkup){
        $studentData = Student::with('school')->findOrFail($checkup->student_id);
        $nurseData = Nurse::findOrFail($checkup->nurse_id);

        return view('nurse.checkup.test_checkup',[
            'checkup' => $checkup,
            'student' => $studentData,
            'nurse' => $nurseData
        ]);
    }

    public function checkUpForm(Student $student){
        $nurse = Auth::user();

        //
        $checkupsByGrade = $student->checkups->groupBy('student_grade_level');
        
        return view('nurse.checkup.new_checkup',[
            'student' => $student,
            'checkupsByGrade' => $checkupsByGrade,
            'nurse' => $nurse
            // 'checkups' => $student->checkups
        ]);
    }


    public function printStudentCheckup(Student $student){
        $nurse = Auth::user();

        //
        $checkupsByGrade = $student->checkups->groupBy('student_grade_level');
        // return $checkupsByGrade;
        
        return view('nurse.checkup.print_checkup',[
            'student' => $student,
            'checkupsByGrade' => $checkupsByGrade,
            'nurse' => $nurse
            // 'checkups' => $student->checkups
        ]);
    }

}
