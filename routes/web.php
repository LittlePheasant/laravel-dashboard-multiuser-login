<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\SummaryReportController;
use App\Http\Controllers\ParticularsController;
use App\Http\Controllers\QuartersController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Grouped under the /dashboard prefix
Route::prefix('dashboard')->group(function () {

    Route::get('/users-lists', [UsersController::class, 'getPaginatedUsers'])->name('users-lists');
    Route::post('/users-lists/add', [UsersController::class, 'add_user'])->name('add-user');

    Route::get('/accomplishment-reports', [ReportsController::class, 'accomplishments_reports'])->name('accomplishment-report');
    Route::post('/accomplishment-reports/add', [ReportsController::class, 'add_report'])->name('add-report');

    Route::get('/program-list', [ProgramsController::class, 'program_list'])->name('program-list');
    Route::post('/program-list/add', [ProgramsController::class, 'add_program'])->name('add-program');
    
    Route::get('/actual-accomplishment-reports', [SummaryReportController::class, 'actual_reports'])->name('actual-reports');


    Route::get('/particulars-list', [ParticularsController::class, 'particular_list'])->name('particulars-list');
    Route::post('/particulars-list/add', [ParticularsController::class, 'add_particular'])->name('add-particular');

    Route::get('/quarters-list', [QuartersController::class, 'quarter_list'])->name('quarters-list');
    Route::post('/quarters-list/add', [QuartersController::class, 'add_quarter'])->name('add-quarter');
});
