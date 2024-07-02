<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;

class DistrictController extends Controller
{
    //
    public function index(){
        $districts = District::with('division')->get();



        return view('admin.district.index',[
            'districts' => $districts,
        ]);
    }
}
