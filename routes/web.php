<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskDetailController;
use App\Http\Controllers\UsersController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Auth
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::redirect('/', '/login');

Route::middleware('auth')->group(function () {
    // Task List
    Route::resource('dashboard', DashboardController::class);
    Route::post('/task-details/add/{id}', [DashboardController::class, 'addTaskDetail']);
    Route::get('/task-details/{id}', [DashboardController::class, 'showTaskDetail']);
    Route::post('/task-details/update/{id}', [DashboardController::class, 'updateTaskDetail']);
    Route::post('/task-details/delete', [DashboardController::class, 'destroyTaskDetail']);
    
    // Profile
    Route::resource('profile', ProfileController::class);

    // Admin Only
    Route::resource('user-list', UsersController::class);
});
