<?php

use App\Http\Controllers\actualsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\departmentController;
use App\Http\Controllers\indicatorsController;
use App\Http\Controllers\nortificationsController;
use App\Http\Controllers\quartersController;
use App\Http\Controllers\reportsController;
use App\Http\Controllers\targetsController;
use App\Http\Controllers\usersController;
use App\Http\Controllers\yearController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/






// Route::get('/targets', [Controller::class, 'targets'])->name('targets');



Route::group(['middleware' => ['auth', 'pass_change']], function () {
    Route::group(['middleware' => ['admin']], function () {
        Route::post('/departments/create', [departmentController::class, 'store'])->name('create_department');
        Route::post('/departments/delete', [departmentController::class, 'destroy'])->name('delete_department');
        Route::post('/departments/update', [departmentController::class, 'update'])->name('update_department');

        Route::get('/departments', [departmentController::class, 'getDepartments'])->name('departments');


        Route::get('/years', [yearController::class, 'getYears'])->name('years');
        Route::post('/year/activate-deactivate', [yearController::class, 'activate_deactivate'])->name('activate_deactivate_year');

        Route::post('/years/create', [yearController::class, 'store'])->name('create_year');
        Route::post('/year/delete', [yearController::class, 'destroy'])->name('delete_year');

        Route::post('/indicators/create', [indicatorsController::class, 'store'])->name('create_indicator');
        Route::post('/indicators/update', [indicatorsController::class, 'update'])->name('update_indicator');
        Route::post('/indicators/delete', [indicatorsController::class, 'delete'])->name('delete_indicator');
        Route::post('/indicators/setdepartment', [indicatorsController::class, 'setDepartment'])->name('setdepartment');
        Route::get('/indicators/setdepartment', [indicatorsController::class, 'setDepartmentQuick'])->name('setdepartmentquick');

        Route::post('/targets/create', [targetsController::class, 'store'])->name('create_target');
        Route::post('/targets/update', [targetsController::class, 'update'])->name('update_target');
        Route::post('/targets/delete', [targetsController::class, 'delete'])->name('delete_target');
        Route::post('/quarter/year', [quartersController::class, 'setyear'])->name('set_year');
        Route::post('/quarter/create', [quartersController::class, 'store'])->name('create_quarter');
        Route::post('/quarter/update', [quartersController::class, 'update'])->name('update_quarter');
        Route::post('/quarter/delete', [quartersController::class, 'destroy'])->name('delete_quarter');
        Route::post('/quarters/activate-deactivate', [quartersController::class, 'activate_deactivate'])->name('activate_deactivate_quarter');
        Route::get('/users', [usersController::class, 'getUsers'])->name('users');
        Route::post('/create_users', [usersController::class, 'create_User'])->name('create_user');
        Route::post('/update_users', [usersController::class, 'update_users'])->name('update_users');
        Route::post('/activate_deactivate', [usersController::class, 'activate_deactivate'])->name('activate_deactivate');
        Route::post('/actual/delete', [actualsController::class, 'delete'])->name('delete_actual');
    });

    Route::group(['middleware' => ['check_role']], function () {

        Route::get('/', [dashboardController::class, 'home'])->name('home');
    });
    Route::get('/home', [dashboardController::class, 'home'])->name('admin_home');
    Route::get('/userhome', [dashboardController::class, 'userhome'])->name('user_home');


    Route::post('/tagerts/indicator', [targetsController::class, 'setIndicator'])->name('set_indicator');
    Route::get('/indicators', [indicatorsController::class, 'getIndicators'])->name('indicators');
    Route::get('/targets', [targetsController::class, 'targets'])->name('targets');
    Route::get('/setmyindicator', [targetsController::class, 'setMyIndicator'])->name('set_my_indicator');
    Route::post('/markasfinished', [targetsController::class, 'markAsComplete'])->name('markAsComplete');

    Route::post('/actual/targets', [actualsController::class, 'settarget'])->name('set_target');
    Route::get('/actuals', [actualsController::class, 'actuals'])->name('actuals');
    Route::get('/actualsToApprove', [actualsController::class, 'actualsToApprove'])->name('actualsToApprove');
    Route::post('/approve_reject', [actualsController::class, 'approve_reject'])->name('approve_reject');

    Route::get('/quarter_report', [reportsController::class, 'getQuarterlyReportData'])->name('quarter_report');
    Route::post('/report/quarter/filter', [reportsController::class, 'filterQuarterlyReportData'])->name('filterquarterreport');
    Route::get('/yearly_report', [reportsController::class, 'getYearlyReportData'])->name('year_report');
    Route::post('/report/year/filter', [reportsController::class, 'filterYearlyReportData'])->name('filteryearreport');


    Route::group(['middleware' => ['usermd']], function () {

        Route::post('/actuals/create', [actualsController::class, 'store'])->name('create_actual');
    });

    Route::get('/quarter', [quartersController::class, 'getQuaters'])->name('quarter');
});


//auth routes


Route::group(['middleware' => ['after_auth']], function () {
Route::get('/login', [AuthController::class, 'login'])->name('login');
});





Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/reset_password_view', [AuthController::class, 'promtChangePass'])->name('reset_password_view');

Route::post('/reset_password', [AuthController::class, 'reset_password'])->name('reset_password');

Route::get('/forgot_password', [AuthController::class, 'forget_password'])->name('forgot_password');



Route::get('/fetchnortification', [nortificationsController::class, 'fetch'])->name('fetch_nortification');
Route::get('/fetchallnortification', [nortificationsController::class, 'fetchAll'])->name('fetch_nortification_all');

Route::get('/nortifications', [nortificationsController::class, 'inbox'])->name('messages');
Route::get('/nortifications-read', [nortificationsController::class, 'nortifications-details'])->name('read');
