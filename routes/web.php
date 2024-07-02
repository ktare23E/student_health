<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\DistrictController;

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

});