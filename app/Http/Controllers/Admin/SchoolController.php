<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\District;

class SchoolController extends Controller
{
    //

    public function index(){
        $schools = School::with('district')->get();
        $districts = District::all();

        return view('admin.school.index',[
            'schools' => $schools,
            'districts' => $districts
        ]);

    }
}
