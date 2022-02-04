<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::prefix('admin')->middleware('isAdmin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin_dashboard');
    Route::get('/user', [App\Http\Controllers\AdminController::class, 'user'])->name('user');
    Route::post('/register',[App\Http\Controllers\UserController::class,'register']);
    Route::get('/user-view',[App\Http\Controllers\UserController::class,'user_view']);
    Route::get('/user-edit-popup',[App\Http\Controllers\UserController::class,'user_edit_popup'])->name('user_edit_popup');
    Route::post('/user-edit',[App\Http\Controllers\UserController::class,'user_edit'])->name('user_edit');
    Route::get('/user-permission', [App\Http\Controllers\AdminController::class, 'user_permission'])->name('user-permission');
    Route::get('/delete_data',[App\Http\Controllers\AdminController::class,'delete_data'])->name('delete_data');
    Route::get('/update_data',[App\Http\Controllers\AdminController::class,'update_data'])->name('update_data');
    Route::get('/assign_week',[App\Http\Controllers\AdminController::class,'assign_week'])->name('assign_week');
    Route::post('/week_add',[App\Http\Controllers\AdminController::class,'week_add'])->name('week_add');
    Route::get('kpi-per-department',[App\Http\Controllers\AdminController::class,'kpi_per_department'])->name('kpi_per_department');
    Route::get('kpi-result',[App\Http\Controllers\AdminController::class,'kpi_result'])->name('kpi_result');
    Route::get('enable-disable-week',[App\Http\Controllers\AdminController::class,'enable_disable_week'])->name('enable-disable-week');
});

// Route::prefix('kpi')->middleware('isAdmin')->group(function (){
//     Route::get('/view', [App\Http\Controllers\AdminController::class, 'index'])->name('kpi-add');
//     Route::get('/option-view', [App\Http\Controllers\AdminController::class, 'option_view'])->name('option_view');
//     Route::post('add', [App\Http\Controllers\LocationController::class, 'add']);
//     Route::post('add_option', [App\Http\Controllers\LocationController::class, 'add_option']);
// });

Route::prefix('location')->middleware('isAdmin')->group(function (){
    Route::post('add', [App\Http\Controllers\LocationController::class, 'add']);
    Route::get('/view', [App\Http\Controllers\LocationController::class, 'index'])->name('fac-view');
});

Route::prefix('department')->middleware('isAdmin')->group(function () {
    Route::post('add', [App\Http\Controllers\DepartmentController::class, 'add']);
    Route::get('/view', [App\Http\Controllers\DepartmentController::class, 'index'])->name('dep-view');
});

Route::prefix('kpi')->middleware('isAdmin')->group(function (){
    Route::post('add', [App\Http\Controllers\KpiController::class, 'add']);
    Route::get('/view',[App\Http\Controllers\KpiController::class,'index'])->name('kpi-view');
    Route::get('kpi-option', [App\Http\Controllers\KpiController::class, 'index_option']);
    Route::post('add-option', [App\Http\Controllers\KpiController::class, 'add_option']);
    Route::get('/kpi-formula',[App\Http\Controllers\KpiController::class,'kpi_formula']);
    Route::post('save-formula',[App\Http\Controllers\KpiController::class,'save_formula']);
    Route::get('/kpi-option-load',[App\Http\Controllers\KpiController::class,'kpi_option_load']);
});

Route::prefix('user')->middleware('isUser')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'index'])->name('user_dashboard');
    Route::post('/submit', [App\Http\Controllers\UserController::class, 'submit'])->name('submit');
});



