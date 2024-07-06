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

    public function filterReport(Request $request) {
        $nurse = Auth::user();
        
        // Initialize the query builder
        $query = DB::table('checkups')->where('nurse_id',$nurse->id)->get();
        
        // if ($request->filled('grade_level') && $request->grade_level !== 'all') {
        //     $query->where('student_grade_level', $request->grade_level);
        // }

        return $query;
    }
}
