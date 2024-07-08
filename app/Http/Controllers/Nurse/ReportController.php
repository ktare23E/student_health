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
                    'value' => $checkup->{$request->category}
                ];
            }

            $students = Student::with(['checkups' => function ($q) use ($checkups) {
                $q->whereIn('id', $checkups->pluck('id'));
            }])
                ->whereIn('id', $checkups->pluck('student_id'))
                ->get();

                return view('nurse.report.result', compact('checkups', 'students', 'chartData'));

        } else if ($nurse->type === 'district') {
            // Filter by school if the nurse is not a school nurse
            if ($request->filled('school_id')) {
                if ($request->school_id == 'all') {
                    // Retrieve all student IDs for schools within the district
                    $studentIds = Student::whereHas('school', function ($q) use ($nurse) {
                        $q->where('district_id', $nurse->entity_id);
                    })->pluck('id');
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

                    // Retrieve the aggregated checkups
                    $checkups = $query->get();

                    $students = Student::with(['checkups' => function ($q) use ($checkups) {
                        $q->whereIn('id', $checkups->pluck('id'));
                    }])
                        ->whereIn('id', $checkups->pluck('student_id'))
                        ->get();
              
                    // Prepare data for Chart.js
                    $chartData = [];
                    foreach ($checkups as $checkup) {
                        $chartData[] = [
                            'school' => 'School ' . $checkup->school_id,
                            'value' => $checkup->average_value,
                        ];
                    }
                    return $students;
                } else {
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
                    return $checkups;
                    // Prepare data for Chart.js
                    $chartData = [];
                    foreach ($checkups as $checkup) {
                        $student = $checkup->student_id;
                        $chartData[] = [
                            'category' => $request->category,
                            'student' => 'Student ' . $student,
                            'value' => $checkup->{$request->category}
                        ];
                    }

                    $students = Student::with(['checkups' => function ($q) use ($checkups) {
                        $q->whereIn('id', $checkups->pluck('id'));
                    }])
                        ->whereIn('id', $checkups->pluck('student_id'))
                        ->get();
                }
            }
        }

    }

    public function sample(){
        return view('sample');
    }
}
