<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\NurseController;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');


Route::post('/login',[LoginController::class,'store'])->name('login.store');
Route::post('/logout',[LoginController::class,'destroy'])->name('logout');



Route::middleware(['auth'])->group(function(){

    Route::get('/admin_dashboard', function () {
        $user = auth()->user();
        if($user->role != 'admin'){
            abort(403);
        }
        return view('admin.index');
    })->name('admin.index');


    Route::get('/division', [DivisionController::class,'index'])->name('admin.division');
    Route::post('/store_division', [DivisionController::class,'store'])->name('store_division');
    Route::patch('/update_division', [DivisionController::class,'update'])->name('update_division');

    Route::get('/district', [DistrictController::class,'index'])->name('admin.district');
    Route::post('/store_district', [DistrictController::class,'store'])->name('store_district');
    Route::patch('/update_district', [DistrictController::class,'update'])->name('update_district');

    Route::get('/school', [SchoolController::class,'index'])->name('admin.school');
    Route::post('/store_school', [SchoolController::class,'store'])->name('store_school');
    Route::patch('/update_school', [SchoolController::class,'update'])->name('update_school');

    Route::get('/admin_nurse', [NurseController::class,'index'])->name('admin_nurse');
    Route::get('/api/entities/{type}', [NurseController::class, 'getEntities'])->name('api.entities');
    Route::post('/store_nurse', [NurseController::class,'store'])->name('store_nurse');
    Route::patch('/update_nurse', [NurseController::class,'update'])->name('update_nurse');
    Route::get('/archive_nurse', [NurseController::class,'archive'])->name('archive_nurse');
    Route::post('update_nurse_status/{id}', [NurseController::class,'archiveNurse'])->name('update_nurse_status');
    Route::post('active_nurse_status/{id}', [NurseController::class,'activeNurse'])->name('active_nurse_status');
    Route::post('reset_nurse_password/{id}', [NurseController::class,'resetPassword'])->name('reset_nurse_password');


});