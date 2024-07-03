<?php

namespace App\Http\Controllers\SchoolNurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchoolNurseDashboardController extends Controller
{
    //

    public function index(){
        return view('nurse.index');
    }
}
