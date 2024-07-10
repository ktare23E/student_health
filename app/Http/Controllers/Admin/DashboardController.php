<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\School;
use App\Models\Nurse;
use App\Models\Student;
use App\Models\SystemLog;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //

    public function index(){
        $user = auth()->user();
  
        $division = Division::with('districts')->get();
        $division = $division->isEmpty() ? [] : $division;
        
        // return $division;

     
        //retrieve 3 schools that are active
        $schools = School::where('status', 'active')->orderBy('id', 'desc')->take(3)->get();

        //retrieve 3 nurses with different type
        $nurses = Nurse::where('status', 'active')->orderBy('id', 'desc')->take(3)->get();
        //retrieve the number of active students
        $activeStudentNumber = Student::where('status', 'active')->count();

        //retrieve the count of inactive students
        $inactiveStudentNumber = Student::where('status', 'inactive')->count();

        if($user->role != 'admin'){
            abort(403);
        }
        return view('admin.index',[
            'user' => $user,
            'division' => $division,
            'schools' => $schools,
            'nurses' => $nurses,
            'activeStudentNumber' => $activeStudentNumber,
            'inactiveStudentNumber' => $inactiveStudentNumber
        ]);
    }

    public function systemLogs(){
        $logs = SystemLog::with('nurse')->get();
        // $currentPhTime = Carbon::now('Asia/Manila')->format('F j, Y g:i A');
        // return $currentPhTime;
        // Include the assigned entity in the response
        // foreach ($logs as $log) {
        //     $log->nurse->assigned_entity = $log->nurse->assigned_entity;
        // }

    
        return view('admin.system_logs',[
            'logs' => $logs
        ]);
    }
}
