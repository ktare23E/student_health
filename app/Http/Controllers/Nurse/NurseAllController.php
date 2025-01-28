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
use Illuminate\Support\Facades\Crypt;
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
            'temperature' => Crypt::encrypt($request->temperature),
            'systolic' => Crypt::encrypt($request->systolic),
            'diastolic' => Crypt::encrypt($request->diastolic),
            'heart_rate' => Crypt::encrypt($request->heart_rate),
            'respiratory_rate' => Crypt::encrypt($request->respiratory_rate),
            'pulse_rate' => Crypt::encrypt($request->pulse_rate),
            'weight' => Crypt::encrypt($request->weight),
            'height' => Crypt::encrypt($request->height),
            'bmi_weight' => Crypt::encrypt($request->bmi_weight),
            'bmi_height' => Crypt::encrypt($request->bmi_height),
            'vision_screening' => Crypt::encrypt($request->vision_screening),
            'auditory_screening' => Crypt::encrypt($request->auditory_screening),
            'skin' => Crypt::encrypt($request->skin),
            'scalp' => Crypt::encrypt($request->scalp),
            'ears' => Crypt::encrypt($request->ears),
            'eyes' => Crypt::encrypt($request->eyes),
            'nose' => Crypt::encrypt($request->nose),
            'mouth' => Crypt::encrypt($request->mouth),
            'lungs' => Crypt::encrypt($request->lungs),
            'heart' => Crypt::encrypt($request->heart),
            'abdomen' => Crypt::encrypt($request->abdomen),
            'deformities' => Crypt::encrypt($request->deformities),
            'iron_supplementation' => Crypt::encrypt($request->iron_supplementation),
            'deworming' => Crypt::encrypt($request->deworming),
            'immunization' => Crypt::encrypt($request->immunization),
            'sbfp_beneficiary' => Crypt::encrypt($request->sbfp_beneficiary),
            'four_p_beneficiary' => Crypt::encrypt($request->four_p_beneficiary),
            'menarche' => Crypt::encrypt($request->menarche),
            'remarks' => Crypt::encrypt($request->remarks)
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
        $check_up_grade_level = $checkup->student_grade_level;
        $nurse = Auth::user();
        $student = $checkup->student;
        $checkupsByGrade = $student->checkups->groupBy('student_grade_level');

        return view('nurse.checkup.new_edit_checkup',compact(['student','checkupsByGrade','nurse','checkup','check_up_grade_level']));
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
        

        // $checkups = Checkup::findOrFail($checkup->id)->update(Crypt::encrypt($validateDate));

        $checkup->update([
            'student_age' => $request->student_age,
            'adviser_name' => $request->adviser_name,
            'temperature' => Crypt::encrypt($request->temperature),
            'systolic' => Crypt::encrypt($request->systolic),
            'diastolic' => Crypt::encrypt($request->diastolic),
            'heart_rate' => Crypt::encrypt($request->heart_rate),
            'respiratory_rate' => Crypt::encrypt($request->respiratory_rate),
            'pulse_rate' => Crypt::encrypt($request->pulse_rate),
            'weight' => Crypt::encrypt($request->weight),
            'height' => Crypt::encrypt($request->height),
            'bmi_weight' => Crypt::encrypt($request->bmi_weight),
            'bmi_height' => Crypt::encrypt($request->bmi_height),
            'vision_screening' => Crypt::encrypt($request->vision_screening),
            'auditory_screening' => Crypt::encrypt($request->auditory_screening),
            'skin' => Crypt::encrypt($request->skin),
            'scalp' => Crypt::encrypt($request->scalp),
            'ears' => Crypt::encrypt($request->ears),
            'eyes' => Crypt::encrypt($request->eyes),
            'nose' => Crypt::encrypt($request->nose),
            'mouth' => Crypt::encrypt($request->mouth),
            'lungs' => Crypt::encrypt($request->lungs),
            'heart' => Crypt::encrypt($request->heart),
            'abdomen' => Crypt::encrypt($request->abdomen),
            'deformities' => Crypt::encrypt($request->deformities),
            'iron_supplementation' => Crypt::encrypt($request->iron_supplementation),
            'deworming' => Crypt::encrypt($request->deworming),
            'immunization' => Crypt::encrypt($request->immunization),
            'sbfp_beneficiary' => Crypt::encrypt($request->sbfp_beneficiary),
            'four_p_beneficiary' => Crypt::encrypt($request->four_p_beneficiary),
            'menarche' => Crypt::encrypt($request->menarche),
            'remarks' => Crypt::encrypt($request->remarks)
        ]);


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
