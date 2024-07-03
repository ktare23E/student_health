<?php

namespace App\Http\Controllers\DistrictNurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DistrictDashboard extends Controller
{
    //
    public function index(){
        return view('nurse.index');
    }
}
