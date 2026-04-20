<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ========================
// Public Route (Landing Page)
// ========================
Route::get('/', [HomeController::class, 'index'])->name('landing');

// ========================
// Authentication
// ========================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'processAdminLogin']);
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

// ========================
// User / Marketing Route (Wajib Login)
// ========================
Route::middleware(['auth', 'marketing', 'sync.jadwal'])->group(function () {
    Route::get('/kelola-jadwal', [HomeController::class, 'kalender'])->name('user.jadwal');
});

// ========================
// Admin Route (Wajib Login & Admin Only)
// ========================
Route::prefix('admin')->name('admin.')->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class, 'sync.jadwal'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/jadwal', [DashboardController::class, 'store']);
    Route::put('/jadwal/{id}', [DashboardController::class, 'update']);
    Route::delete('/jadwal/{id}', [DashboardController::class, 'destroy']);

    // User Management Routes
    Route::post('/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('user.store');
    Route::put('/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('user.destroy');
});
