<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;


// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Super Admin Auth
Route::get('/super_admin/login', [SuperAdminController::class, 'showLoginForm'])->name('super_admin.login');
Route::post('/super_admin/login', [SuperAdminController::class, 'superAdminLogin']);

// Public Route
Route::get('/', function () {
    return view('welcome');
});

// INCOMING / OUTGOING  Routes
Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/incoming', [AuthController::class, 'incomingRecords'])->name('incoming');
    Route::get('/outgoing', [AuthController::class, 'outgoingRecords'])->name('outgoing');
    Route::get('/documents', [AuthController::class, 'allDocuments'])->name('documents.index');
});

// Super Admin Routes
Route::prefix('super_admin')->group(function() {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('super_admin.dashboard');
    
    Route::get('/users', [SuperAdminController::class, 'users'])->name('super_admin.users');
    Route::post('/users', [SuperAdminController::class, 'createUser'])->name('super_admin.create_user');
    Route::post('/users/{id}/toggle-status', [SuperAdminController::class, 'toggleUserStatus'])->name('super_admin.toggle_user_status');

    // Department Management
    Route::get('/departments', [SuperAdminController::class, 'departments'])->name('super_admin.departments');
    Route::post('/departments', [SuperAdminController::class, 'createDepartment'])->name('super_admin.create_department');
    Route::delete('/departments/{id}', [SuperAdminController::class, 'deleteDepartment'])->name('super_admin.delete_department');
});