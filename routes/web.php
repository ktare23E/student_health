<?php

use Illuminate\Support\Facades\Route;	
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\NurseController;
use App\Http\Controllers\DistrictNurse\DistrictDashboard;
use App\Http\Controllers\DistrictNurse\StudentSchoolList;
use App\Http\Controllers\Nurse\NurseAllController;
use App\Http\Middleware\CheckUserType;
use App\Http\Controllers\Nurse\NurseDashboard;
use App\Http\Controllers\Nurse\ReportController;

use App\Http\Controllers\Admin\DashboardController;


Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');


Route::post('/login',[LoginController::class,'store'])->name('login.store');
// Route::post('/logout',[LoginController::class,'destroy'])->name('logout');
Route::post('/admin_logout',[LoginController::class,'adminLogout'])->name('admin_logout');

Route::get('/test_checkup/{checkup}', [NurseDashboard::class, 'testCheckUp'])->name('test_checkup');


Route::middleware(CheckUserType::class)->group(function(){
    Route::get('/admin_dashboard', [DashboardController::class, 'index'])->name('admin.index');
    Route::get('/system_logs', [DashboardController::class, 'systemLogs'])->name('system_logs');


    Route::get('/division', [DivisionController::class,'index'])->name('admin.division');
    Route::post('/store_division', [DivisionController::class,'store'])->name('store_division');
    Route::patch('/update_division', [DivisionController::class,'update'])->name('update_division');

    Route::get('/district', [DistrictController::class,'index'])->name('admin.district');
    Route::get('/view_district/{division}', [DistrictController::class,'viewDistrict'])->name('view_district');
    Route::post('/store_district', [DistrictController::class,'store'])->name('store_district');
    Route::patch('/update_district', [DistrictController::class,'update'])->name('update_district');

    Route::get('/school', [SchoolController::class,'index'])->name('admin.school');
    Route::get('/district_view_school_list/{district}', [SchoolController::class,'viewSchool'])->name('district_view_school_list');
    Route::get('/district_view_school_list2/{district}', [SchoolController::class,'viewSchool2'])->name('district_view_school_list2');
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

Route::middleware('auth:nurse')->group(function(){
    Route::post('/logout',[LoginController::class,'destroy'])->name('logout');

    Route::middleware('nurse.type:school')->group(function(){
        Route::get('/nurse_dashboard',[NurseDashboard::class,'index'])->name('nurse_dashboard');
        Route::get('/checkup_form/{student}', [NurseDashboard::class, 'checkUpForm'])->name('checkup_form');
        Route::get('/print_student_checkup/{student}',[NurseDashboard::class,'printStudentCheckup'])->name('print_student_checkup');


        Route::get('/student_list',[NurseAllController::class,'index'])->name('student_list');
        Route::post('/store_student',[NurseAllController::class, 'store'])->name('store_student');
        Route::post('/import_student',[NurseAllController::class, 'importStudent'])->name('import_student');
        Route::patch('/update_student',[NurseAllController::class, 'update'])->name('update_student');

        Route::get('/archive_student',[NurseAllController::class,'archiveStudent'])->name('school.archive_student');
        Route::post('/update_student_status/{id}',[NurseAllController::class,'updateStatus'])->name('update_student_status');
        Route::post('/restore_student/{id}',[NurseAllController::class,'restoreStudent'])->name('restore_student');
        Route::get('/view_student/{student}',[NurseAllController::class,'viewStudent'])->name('view_student');

        Route::get('/checkup_student/{id}',[NurseAllController::class,'checkupStudent'])->name('checkup_student');
        Route::post('/store_checkup/{student}',[NurseAllController::class,'storeCheckup'])->name('store_checkup');
        Route::post('/student_profile/{student}',[NurseAllController::class,'studentProfile'])->name('student_profile');
        Route::get('/edit_checkup/{checkup}',[NurseAllController::class,'editCheckup'])->name('edit_checkup');
        Route::get('/new_edit_checkup/{checkup}',[NurseAllController::class,'newEditCheckUp'])->name('new_edit_checkup');
        Route::patch('/update_checkup/{checkup}',[NurseAllController::class,'updateCheckup'])->name('update_checkup');
        Route::get('/view_checkup/{checkup}',[NurseAllController::class,'viewCheckup'])->name('view_checkup');
        Route::get('/new_view_checkup/{checkup}',[NurseAllController::class,'newViewCheckUp'])->name('new_view_checkup');
        

        Route::get('/report',[ReportController::class,'index'])->name('report');
        Route::post('/filter_report',[ReportController::class,'filterReport'])->name('filter_report');

        Route::get('/school_profile',[NurseDashboard::class,'profile'])->name('school_profile');
        Route::post('/school_change_password',[NurseDashboard::class,'changePassword'])->name('school_change_password');
        Route::post('/nurse_profile/{nurse}',[NurseDashboard::class,'nurseProfile'])->name('nurse_profile');


    });

    Route::middleware('nurse.type:district')->group(function(){
        Route::get('/district_nurse_dashboard',[NurseDashboard::class,'index'])->name('district_nurse_dashboard');
        Route::get('/school_list',[NurseDashboard::class,'schoolList'])->name('school_list');
        Route::get('/view_school/{school}',[NurseDashboard::class,'studentList'])->name('view_school');
        Route::get('/district_view_student/{student}',[NurseDashboard::class,'viewStudent'])->name('district_view_student');
        Route::get('/district_view_checkup/{checkup}',[NurseDashboard::class,'viewCheckup'])->name('district_view_checkup');



        Route::get('/district_report',[ReportController::class,'index'])->name('district_report');
        Route::post('/district_filter_report',[ReportController::class,'filterReport'])->name('district_filter_report');
        Route::get('/sample',[ReportController::class,'sample'])->name('sample');

        Route::get('/district_profile',[NurseDashboard::class,'profile'])->name('district_profile');
        Route::post('/district_change_password',[NurseDashboard::class,'changePassword'])->name('district_change_password');
        Route::post('/district_nurse_profile/{nurse}',[NurseDashboard::class,'nurseProfile'])->name('district_nurse_profile');

    });

    Route::middleware('nurse.type:division')->group(function(){
        Route::get('/division_nurse_dashboard',[NurseDashboard::class,'index'])->name('division_nurse_dashboard');
        Route::get('/division_school_list',[NurseDashboard::class,'schoolList'])->name('division_school_list');
        Route::get('/division_view_school/{school}',[NurseDashboard::class,'studentList'])->name('division_view_school');
        Route::get('/division_view_student/{student}',[NurseDashboard::class,'viewStudent'])->name('division_view_student');
        Route::get('/division_view_checkup/{checkup}',[NurseDashboard::class,'viewCheckup'])->name('division_view_checkup');

        
        Route::get('/division_report',[ReportController::class,'index'])->name('division_report');
        Route::post('/division_filter_report',[ReportController::class,'filterReport'])->name('division_filter_report');

        Route::get('/division_profile',[NurseDashboard::class,'profile'])->name('division_profile');
        Route::post('/division_change_password',[NurseDashboard::class,'changePassword'])->name('division_change_password');
        Route::post('/division_nurse_profile/{nurse}',[NurseDashboard::class,'nurseProfile'])->name('division_nurse_profile');

    });
});








