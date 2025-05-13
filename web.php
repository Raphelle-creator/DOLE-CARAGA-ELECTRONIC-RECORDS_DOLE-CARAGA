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
Route::get('/test_html', function () {
    return view('test_html');
});

// INCOMING / OUTGOING  Routes
Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/documents', [AuthController::class, 'allDocuments'])->name('documents.index');
    Route::get('/settings', [AuthController::class, 'settings']);
    Route::get('/reports', [AuthController::class, 'reports'])->name('reports');



    // CRU FOR OUTGOIN DOCUMENT
    Route::get('/outgoing', [AuthController::class, 'outgoingRecords'])->name('outgoing');
    Route::get('/outgoing/new', [AuthController::class, 'createOutgoingRecord'])->name('outgoing_new');
    Route::post('/outgoing/local', [AuthController::class, 'storeOutgoingDocumentLocal'])->name('outgoing.local_store');
    Route::post('/outgoing/co', [AuthController::class, 'storeOutgoingDocumentCO'])->name('outgoing.co_store');
    Route::get('/outgoing/{id}/view', [AuthController::class, 'viewOutgoingDocument'])->name('outgoing.view');
    Route::get('/outgoing/{id}/edit', [AuthController::class, 'editOutgoingDocument'])->name('outgoing.edit');
    Route::put('/outgoing/{id}', [AuthController::class, 'updateOutgoingDocument'])->name('outgoing.update');

    // INCOMING
    Route::get('/incoming', [AuthController::class, 'incomingRecords'])->name('incoming');


});

// Super Admin Routes
Route::prefix('super_admin')->group(function() {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('super_admin.dashboard');
    
    Route::get('/users', [SuperAdminController::class, 'users'])->name('super_admin.users');
    Route::post('/users', [SuperAdminController::class, 'createUser'])->name('super_admin.create_user');
    Route::post('/users/{id}/toggle-status', [SuperAdminController::class, 'toggleUserStatus'])->name('super_admin.toggle_user_status');
    Route::put('/users/{id}', [SuperAdminController::class, 'updateUser'])->name('super_admin.update_user');


    // Department Management
    Route::get('/departments', [SuperAdminController::class, 'departments'])->name('super_admin.departments');
    Route::post('/departments', [SuperAdminController::class, 'createDepartment'])->name('super_admin.create_department');
    Route::delete('/departments/{id}', [SuperAdminController::class, 'deleteDepartment'])->name('super_admin.delete_department');
    Route::put('/departments/{id}', [SuperAdminController::class, 'updateDepartment'])->name('super_admin.update_department');
});
