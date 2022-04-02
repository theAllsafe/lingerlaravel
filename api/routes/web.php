<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\ShiftsheduleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VisitController;


use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\Admin\BannerAdminController;

//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});
Route::get('/', [AdminLoginController::class, 'login'])->name('/');
