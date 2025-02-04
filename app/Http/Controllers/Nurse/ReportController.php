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
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    //

    public function index()
    {
        $nurse = Auth::user();

        $schools = [];
        $district = [];

        if ($nurse->type == 'district') {
            $schools = School::where('district_id', $nurse->entity_id)->get();
        } elseif ($nurse->type == 'division') {
            $district = District::where('id', $nurse->entity_id)->first();
            $schools = School::where('district_id', $district->id)->get();
        }


        return view('nurse.report.index', [
            'schools' => $schools,
            'district' => $district
        ]);
    }


    public function filterReport(Request $request)
    {
        $nurse = Auth::user();
        $query = Checkup::query();
        $category = $request->category;

        
        switch ($category) {
            case "bmi_weight":
                $category = "BMI WEIGHT";
                break;
            case "bmi_height":
                $category = "BMI HEIGHT";
                break;
            case "temperature":
                $category = "TEMPERATURE";
                break;
            case "heart_rate":
                $category = "HEART RATE";
                break;
            case "pulse_rate":
                $category = "PULSE RATE";
                break;
            case "respiratory_rate":
                $category = "RESPIRATORY RATE";
                break;
            case "vision_screening":
                $category = "VISION SCREENING";
                break;
            case "auditory_screening":
                $category = "AUDITORY SCREENING";
                break;
            case "skin":
                $category = "SKIN";
                break;
            case "scalp":
                $category = "SCALP";
                break;
            case "eyes":
                $category = "EYES";
                break;
            case "ears":
                $category = "EARS";
                break;
            case "nose":
                $category = "NOSE";
                break;
            case "mouth":
                $category = "MOUTH";
                break;
            case "lungs":
                $category = "LUNGS";
                break;
            case "heart":
                $category = "HEART";
                break;
            case "abdomen":
                $category = "ABDOMEN";
                break;
            case "deformities":
                $category = "DEFORMITIES";
                break;
            case "iron_supplementation":
                $category = "IRON SUPPLEMENTATION";
                break;
            case "deworming":
                $category = "DEWORMING";
                break;
            case "immunization":
                $category = "IMMUNIZATION";
                break;
            default:
                $category = "UNKNOWN CATEGORY";
                break;
        }
        


        if ($nurse->type === 'school') {
            // Filter by category
            if ($request->filled('category')) {
                $query->select($request->category, 'student_id', 'id', 'date_of_checkup');
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

            // Retrieve the checkups
            $checkups = $query->where('nurse_id', $nurse->id)->get();

            // Prepare data for Chart.js
            $chartData = [];
            foreach ($checkups as $checkup) {
                $student = $checkup->student_id;
                $chartData[] = [
                    'category' => $request->category,
                    'student' => 'Student ' . $student,
                    'value' => Crypt::decrypt($checkup->{$request->category}) 
                ];
            }

        


            $students = Student::with(['checkups' => function ($q) use ($checkups) {
                $q->whereIn('id', $checkups->pluck('id'));
            }],'school')
                ->whereIn('id', $checkups->pluck('student_id'))
                ->get();

            $schoolData = $nurse->entity;

            // return [
            //     $chartData,
            //     $checkups
            // ];

                return view('nurse.report.result', compact('checkups', 'students', 'chartData','schoolData','category'));

        } else if ($nurse->type === 'district' || $nurse->type === 'division') {
            // Filter by school if the nurse is not a school nurse
            if ($request->filled('school_id')) {
                if ($request->school_id == 'all') {
                    // Retrieve all schools within the district
                    $schools = School::where('district_id', $nurse->entity_id)->get();
            
                    // Retrieve all student IDs for schools within the district
                    $studentIds = Student::whereIn('school_id', $schools->pluck('id'))->pluck('id');
            
                    // Apply filters to the query
                    $query->whereIn('student_id', $studentIds);
            
                    if ($request->filled('category')) {
                        $query->select($request->category, 'student_id', 'id', 'date_of_checkup');
                    }
            
                    if ($request->filled('grade_level') && $request->grade_level != 'all') {
                        $query->whereHas('student', function ($q) use ($request) {
                            $q->where('grade_level', $request->grade_level);
                        });
                    }
            
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
            
                    // Retrieve the checkups with related student and school data
                    $checkups = $query->with(['student.school'])->get();
                    $students = Student::with(['checkups' => function ($q) use ($checkups) {
                        $q->whereIn('id', $checkups->pluck('id'));
                    }],'school')
                        ->whereIn('id', $checkups->pluck('student_id'))
                        ->get();

    
            
                    // Prepare data for Chart.js by grouping by school
                    $chartData = [];
            
                    // Group checkups by school name
                    $groupedBySchool = $checkups->groupBy(function ($checkup) {
                        return $checkup->student->school->name;
                    });
                    $category = $request->category;
                    // Prepare chart data, ensuring all schools are included
                    foreach ($schools as $school) {
                        $schoolName = $school->name;
                        if (isset($groupedBySchool[$schoolName])) {
                            foreach ($groupedBySchool[$schoolName] as $checkup) {
                                $chartData[] = [
                                    'category' => $request->category,
                                    'school' => $schoolName,
                                    'value' => Crypt::decrypt($checkup->$category) // Or the selected category value
                                ];
                            }
                        } else {
                            // Default value for schools without checkups
                            $chartData[] = [
                                'category' => $category,
                                'school' => $schoolName,
                                'value' => 0,
                            ];
                        }
                    }


                    $user = Auth::user();
            
                    // Return the grouped data or further process it as needed
                    return view('nurse.report.all_school_result',
                            [
                                'students' => $students,
                                'chartData' => $chartData,
                                'user' => $user,
                                'category' => $category
                            ]
                        );
                }
                else {
                    // Retrieve student IDs for the selected school
                    $studentIds = Student::where('school_id', $request->school_id)->pluck('id');
                    $query->whereIn('student_id', $studentIds);

                    // Apply other filters
                    if ($request->filled('category')) {
                        $query->select($request->category, 'student_id', 'id', 'date_of_checkup');
                    }

                    if ($request->filled('grade_level') && $request->grade_level != 'all') {
                        $query->whereHas('student', function ($q) use ($request) {
                            $q->where('grade_level', $request->grade_level);
                        });
                    }

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

                    // Retrieve the checkups
                    $checkups = $query->get();
                    // Prepare data for Chart.js
                    $chartData = [];
                    foreach ($checkups as $checkup) {
                        $student = $checkup->student_id;
                        $chartData[] = [
                            'category' => $request->category,
                            'student' => 'Student ' . $student,
                            'value' => Crypt::decrypt($checkup->{$request->category})
                        ];
                    }


                    $user = Auth::user();

                    $students = Student::with(['checkups' => function ($q) use ($checkups) {
                        $q->whereIn('id', $checkups->pluck('id'));
                    }],'school')
                        ->whereIn('id', $checkups->pluck('student_id'))
                        ->get();

                        return view('nurse.report.result', compact('checkups', 'students', 'chartData','user','category'));

                }
            }
        }

    }

    public function sample(){
        return view('sample');
    }
}
