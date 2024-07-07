<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use App\Models\Checkup;
use App\Models\District;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class ReportController extends Controller
{
    //

    public function index(){
        $nurse = Auth::user();

        $schools = [];
        $district = [];

        if($nurse->type == 'district'){
            $schools = School::where('district_id',$nurse->district_id)->get();
        }elseif($nurse->type == 'division'){
            $district = District::where('id',$nurse->entity_id)->first();
            $schools = School::where('district_id',$district->id)->get();
        }

        return view('nurse.report.index',[
            'schools' => $schools,
            'district' => $district
        ]);
    }

        public function filterReport(Request $request)
        {
            $nurse = Auth::user();
            $query = Checkup::query();
    
            // Filter by school if applicable
            if ($request->filled('school_id')) {
                $query->where('school_id', $request->school_id);
            }
    
            // Filter by category
            if ($request->filled('category')) {
                $query->select($request->category,'student_id','id','date_of_checkup');
            }
    
            // Filter by grade level
            if ($request->filled('grade_level') && $request->grade_level != 'all') {
                $query->whereHas('student', function ($q) use ($request) {
                    $q->where('grade_level', $request->grade_level);
                });
            }
    
            // Filter by date range
            if ($request->filled('range')) {
                switch ($request->range) {
                    case 'weekly':
                        $query->whereBetween('date_of_checkup', [now()->subWeek(), now()]);
                        break;
                    case 'monthly':
                        $query->whereBetween('date_of_checkup', [now()->subMonth(), now()]);
                        break;
                    case 'annually':
                        $query->whereBetween('date_of_checkup', [now()->subYear(), now()]);
                        break;
                    case 'custom':
                        if ($request->filled('start_date') && $request->filled('end_date')) {
                            $query->whereBetween('date_of_checkup', [$request->start_date, $request->end_date]);
                        }
                        break;
                }
            }
    
            $checkups = $query->where('nurse_id',$nurse->id)->get();
            // return $checkups;
           // Eager load student and adviser relationships

              // Prepare data for Chart.js
            $chartData = [];
            foreach ($checkups as $checkup) {

                $student = $checkup->student_id;
                $chartData[] = [
                    'category' => $request->category, 
                    'student' => 'Student '.$student, // or any unique identifier for the student
                    'value' => $checkup->{$request->category}
                ];
            }

            $students = Student::with(['checkups' => function ($q) use ($checkups) {
            $q->whereIn('id', $checkups->pluck('id'));
            }]) // Assuming 'adviser' is the relationship name in Student model
            ->whereIn('id', $checkups->pluck('student_id'))->get();

            // return $students;

            // return $students[0]->checkups[0]->adviser_name;
            // return $students[0]->checkups->first()->adviser_name;
            return view('nurse.report.result', compact('checkups', 'students', 'chartData'));
        }
}

