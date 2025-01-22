<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use App\Models\Checkup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Nurse;
use App\Models\SystemLog;
use Illuminate\Support\Facades\Storage;

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
            'grade_level' => 'required',
            'date_of_birth' => 'required',
            'birth_place' => 'required',
            'parent_name' => 'required',
            'cellphone_number' => 'required'
        ]);



        $nurse = Auth::user();
        $school_id = $nurse->entity_id;

        $region = "Region 10";
        
        Student::create([
            'school_id' => $school_id,
            'student_lrn' => $request->student_lrn,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'status' => $request->status,
            'grade_level' => $request->grade_level,
            'date_of_birth' => $request->date_of_birth,
            'birth_place' => $request->birth_place,
            'parent_name' => $request->parent_name,
            'cellphone_number' => $request->cellphone_number,
            'region' => $region
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

            $formattedDate = Carbon::createFromFormat('d/m/Y', $data[3])->format('Y-m-d');

    
            // Check if student already exists
            $student = Student::where('student_lrn', $data[0])->first();
            $region = "Region 10";

            if ($student) {
                // Update existing student
                $student->update([
                    'first_name' => $data[1],
                    'last_name' => $data[2],
                    'date_of_birth' => $formattedDate,
                    'birth_place' => $data[4],
                    'parent_name' => $data[5],
                    'cellphone_number' => $data[6],
                    'address' => $data[7],
                    'status' => $data[8],
                    'grade_level' => $data[9],
                    'region' => $region,
                ]);
            } else {
                // Create new student
                Student::create([
                    'school_id' => $school_id,
                    'student_lrn' => $data[0],
                    'first_name' => $data[1],
                    'last_name' => $data[2],
                    'date_of_birth' => $formattedDate,
                    'birth_place' => $data[4],
                    'parent_name' => $data[5],
                    'cellphone_number' => $data[6],
                    'address' => $data[7],
                    'status' => $data[8],
                    'grade_level' => $data[9],
                    'region' => $region,
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
        $student = Student::with(['school.district.division'])->findOrFail($student->id);
        $studentCheckUps = Student::with('checkups.nurse')->where('id',$student->id)->get();
        $studentSchool = $student->school;


        return view('nurse.student.view_student',[
            'student' => $student,
            'studentCheckUps' => $studentCheckUps,
            'studentSchool' => $studentSchool
        ]);
    }

    public function checkupStudent($id){
        $student = Student::findOrFail($id);

        return view('nurse.checkup.checkup_form',[
            'student' => $student
        ]);
    }

    public function storeCheckup(Request $request,Student $student){

        // return $request->all();
        $request->validate([
            'student_age' => 'required',
            'adviser_name' => 'required',
            'temperature' => 'required',
            'systolic' => 'required',
            'diastolic' => 'required',
            'heart_rate' => 'required',
            'respiratory_rate' => 'required',
            'pulse_rate' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'bmi_weight' => 'required',
            'bmi_height' => 'required',
            'vision_screening' => 'required',
            'auditory_screening' => 'required',
            'skin' => 'required',
            'scalp' => 'required',
            'ears' => 'required',
            'eyes' => 'required',
            'nose' => 'required',
            'mouth' => 'required',
            'lungs' => 'required',
            'heart' => 'required',
            'abdomen' => 'required',
            'deformities' => 'required',
            'iron_supplementation' => 'required',
            'deworming' => 'required',
            'immunization' => 'required',
            'sbfp_beneficiary' => 'required',
            'four_p_beneficiary' => 'required',
            'menarche' => 'required',
            'remarks' => 'required'
        ]);

                

        $currentTime = Carbon::now('Asia/Manila');

        $nurse = Auth::user();
        
        

        $checkup = Checkup::create([
            'student_id' => $student->id,
            'nurse_id' => $nurse->id,
            'student_lrn' => $student->student_lrn,
            'student_grade_level' => $student->grade_level,
            'student_age' => $request->student_age,
            'date_of_checkup' => now(),
            'adviser_name' => $request->adviser_name,
            'temperature' => $request->temperature,
            'systolic' => $request->systolic,
            'diastolic' => $request->diastolic,
            'heart_rate' => $request->heart_rate,
            'respiratory_rate' => $request->respiratory_rate,
            'pulse_rate' => $request->pulse_rate,
            'weight' => $request->weight,
            'height' => $request->height,
            'bmi_weight' => $request->bmi_weight,
            'bmi_height' => $request->bmi_height,
            'vision_screening' => $request->vision_screening,
            'auditory_screening' => $request->auditory_screening,
            'skin' => $request->skin,
            'scalp' => $request->scalp,
            'ears' => $request->ears,
            'eyes' => $request->eyes,
            'nose' => $request->nose,
            'mouth' => $request->mouth,
            'lungs' => $request->lungs,
            'heart' => $request->heart,
            'abdomen' => $request->abdomen,
            'deformities' => $request->deformities,
            'iron_supplementation' => $request->iron_supplementation,
            'deworming' => $request->deworming,
            'immunization' => $request->immunization,
            'sbfp_beneficiary' => $request->sbfp_beneficiary,
            'four_p_beneficiary' => $request->four_p_beneficiary,
            'menarche' => $request->menarche,
            'remarks' => $request->remarks
        ]);



        return redirect()->route('view_student',$student->id)->with('success','Checkup successfully added');
    }

    public function editCheckUp(Request $request,Checkup $checkup){


        $checkup = Checkup::findOrFail($checkup->id);


        return view('nurse.checkup.edit_checkup',[
            'checkup' => $checkup
        ]);
    }

    public function newEditCheckUp(Checkup $checkup){
        $nurse = Auth::user();
        $student = $checkup->student;
        $checkupsByGrade = $student->checkups->groupBy('student_grade_level');

        return view('nurse.checkup.new_edit_checkup',compact(['student','checkupsByGrade','nurse','checkup']));
    }

    public function updateCheckUp(Request $request,Checkup $checkup){

        $validateDate = $request->validate([
          
            'student_age' => 'required',
            'adviser_name' => 'required',
           
            'temperature' => 'required',
            'systolic' => 'required',
            'diastolic' => 'required',
            'heart_rate' => 'required',
            'respiratory_rate' => 'required',
            'pulse_rate' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'bmi_weight' => 'required',
            'bmi_height' => 'required',
            'vision_screening' => 'required',
            'auditory_screening' => 'required',
            'skin' => 'required',
            'scalp' => 'required',
            'ears' => 'required',
            'eyes' => 'required',
            'nose' => 'required',
            'mouth' => 'required',
            'lungs' => 'required',
            'heart' => 'required',
            'abdomen' => 'required',
            'deformities' => 'required',
            'iron_supplementation' => 'required',
            'deworming' => 'required',
            'immunization' => 'required',
            'sbfp_beneficiary' => 'required',
            'four_p_beneficiary' => 'required',
            'menarche' => 'required',
            'remarks' => 'required'
        ]);

        // $student_id = $request->student_id;

        $checkups = Checkup::findOrFail($checkup->id)->update($validateDate);


        return redirect()->route('view_student',$checkup->student_id)->with('success','Checkup successfully updated');
    }

    public function viewCheckup(Checkup $checkup){
        $studentData = Student::with('school')->findOrFail($checkup->student_id);
        $nurseData = Nurse::findOrFail($checkup->nurse_id);

        $nurse = Auth::user();

        $currentTime = Carbon::now('Asia/Manila');

        SystemLog::create([
                'nurse_id' => $nurse->id,
                'date' => $currentTime,
                'access' => 'Viewed Checkup Details of '.$studentData->first_name.' '.$studentData->last_name.' Student'
        ]);

        return view('nurse.checkup.view_checkup',[
            'checkup' => $checkup,
            'student' => $studentData,
            'nurse' => $nurseData
        ]);
    }
    
    public function newViewCheckUp(Checkup $checkup){
        $studentData = Student::with('school')->findOrFail($checkup->student_id);
        $nurseData = Nurse::findOrFail($checkup->nurse_id);

        $nurse = Auth::user();

        $currentTime = Carbon::now('Asia/Manila');

        SystemLog::create([
                'nurse_id' => $nurse->id,
                'date' => $currentTime,
                'access' => 'Viewed Checkup Details of '.$studentData->first_name.' '.$studentData->last_name.' Student'
        ]);

        return view('nurse.checkup.new_view_checkup',[
            'checkup' => $checkup,
            'student' => $studentData,
            'nurse' => $nurseData
        ]);
    }

    public function studentProfile(Request $request,Student $student){
        // Validate the uploaded file
        $request->validate([
            'student_profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation as needed
        ]);

        // Handle the uploaded file
        if ($request->hasFile('student_profile')) {
            // Get the file
            $file = $request->file('student_profile');
            // Define the file path and name
            $filePath = 'uploads/profiles';
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Store the file
            $path = $file->storeAs($filePath, $fileName, 'public');

            // Optionally, delete the old profile image if it exists
            if ($student->student_profile) {
                Storage::disk('public')->delete($student->student_profile);
            }

            // Save the new profile image path to the student's profile
            $student->student_profile = $path;
            $student->save();
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile image updated successfully!');
    }
}
