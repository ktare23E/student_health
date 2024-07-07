<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
