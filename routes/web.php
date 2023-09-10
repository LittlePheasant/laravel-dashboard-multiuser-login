<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\SummaryReportController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Grouped under the /dashboard prefix
Route::prefix('dashboard')->group(function () {

    Route::get('/users-lists', [UsersController::class, 'getPaginatedUsers'])->name('users-lists');
    

    Route::get('/accomplishment-reports', [ReportsController::class, 'accomplishments_reports'])->name('accommplishment-report');
    

    Route::get('/program-list', [ProgramsController::class, 'program_list'])->name('program-list');
    

    Route::get('/actual-accomplishment-reports', [SummaryReportController::class, 'actual_reports'])->name('actual-reports');

});
