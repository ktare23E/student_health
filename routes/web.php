<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('index');
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


    Route::get('/division', function () {
        return view('admin.division.index');
    })->name('admin.division');

});