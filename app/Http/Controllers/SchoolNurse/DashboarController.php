<?php

namespace App\Http\Controllers\SchoolNurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboarController extends Controller
{
    //

    public function index(){
        $user = auth()->user();
        if($user->role != 'school'){
            abort(403);
        }
        return view('nurse.index');
    }
}
