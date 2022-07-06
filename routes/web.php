<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');

// User Management Routes

Route::prefix('users')->group(function(){

    Route::get('/view', [UserController::class, 'UserView'])->name('user.view');
    Route::get('/add', [UserController::class, 'UserAdd'])->name('users.add');
    Route::post('/store', [UserController::class, 'UserStore'])->name('users.store');
    Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('users.edit');
    Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('users.update');
    Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('users.delete');

});

// User Profile and Password Management

Route::prefix('profiles')->group(function(){

    Route::get('/view', [ProfileController::class, 'ProfileView'])->name('profile.view');
    // Route::get('/add', [UserController::class, 'UserAdd'])->name('users.add');
    // Route::post('/store', [UserController::class, 'UserStore'])->name('users.store');
    Route::get('/edit', [ProfileController::class, 'ProfileEdit'])->name('profile.edit');
    Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');
    // Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('users.delete');
    Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');
    Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');

});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->prefix('setups')->group(function(){

    // Student Class Routes
    Route::get('student/class/view', [StudentClassController::class, 'ViewStudent'])->name('student.class.view');
    Route::get('student/class/add', [StudentClassController::class, 'StudentClassAdd'])->name('student.class.add');
    Route::post('student/class/store', [StudentClassController::class, 'StudentClassStore'])->name('store.student.class');
    Route::get('student/class/edit/{id}', [StudentClassController::class, 'StudentClassEdit'])->name('student.class.edit');
    Route::post('student/class/update/{id}', [StudentClassController::class, 'StudentClassUpdate'])->name('student.class.update');
    // Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');
    Route::get('student/class/delete/{id}', [StudentClassController::class, 'StudentClassDelete'])->name('student.class.delete');
    // Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');
    // Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');

    // Student Year Routes
    Route::get('student/year/view', [StudentYearController::class, 'ViewYear'])->name('student.year.view');
    Route::get('student/year/add', [StudentYearController::class, 'StudentYearAdd'])->name('student.year.add');
    Route::post('student/year/store', [StudentYearController::class, 'StudentYearStore'])->name('store.student.year');
    Route::get('student/year/edit/{id}', [StudentYearController::class, 'StudentYearEdit'])->name('student.year.edit');
    Route::post('student/year/update/{id}', [StudentYearController::class, 'StudentYearUpdate'])->name('student.year.update');
    // Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');
    Route::get('student/year/delete/{id}', [StudentYearController::class, 'StudentYearDelete'])->name('student.year.delete');
    // Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');
    // Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');

     // Student Group Routes
     Route::get('student/group/view', [StudentGroupController::class, 'ViewGroup'])->name('student.group.view');
     Route::get('student/group/add', [StudentGroupController::class, 'StudentGroupAdd'])->name('student.group.add');
     Route::post('student/group/store', [StudentGroupController::class, 'StudentGroupStore'])->name('store.student.group');
     Route::get('student/group/edit/{id}', [StudentGroupController::class, 'StudentGroupEdit'])->name('student.group.edit');
     Route::post('student/group/update/{id}', [StudentGroupController::class, 'StudentGroupUpdate'])->name('student.group.update');
     // Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');
     Route::get('student/group/delete/{id}', [StudentGroupController::class, 'StudentGroupDelete'])->name('student.group.delete');
     // Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');
     // Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');

     // Student Shift Routes
     Route::get('student/shift/view', [StudentShiftController::class, 'ViewShift'])->name('student.shift.view');
     Route::get('student/shift/add', [StudentShiftController::class, 'StudentShiftAdd'])->name('student.shift.add');
     Route::post('student/shift/store', [StudentShiftController::class, 'StudentShiftStore'])->name('store.student.shift');
     Route::get('student/shift/edit/{id}', [StudentShiftController::class, 'StudentShiftEdit'])->name('student.shift.edit');
     Route::post('student/shift/update/{id}', [StudentShiftController::class, 'StudentShiftUpdate'])->name('student.shift.update');
     // Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');
     Route::get('student/shift/delete/{id}', [StudentShiftController::class, 'StudentShiftDelete'])->name('student.shift.delete');
     // Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');
     // Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');

     // Fee Category Routes
     Route::get('fee/category/view', [FeeCategoryController::class, 'ViewFeeCategory'])->name('fee.category.view');
     Route::get('fee/category/add', [FeeCategoryController::class, 'FeeCategoryAdd'])->name('fee.category.add');
     Route::post('fee/category/store', [FeeCategoryController::class, 'FeeCategoryStore'])->name('store.fee.category');
     Route::get('fee/category/edit/{id}', [FeeCategoryController::class, 'FeeCategoryEdit'])->name('fee.category.edit');
     Route::post('fee/category/update/{id}', [FeeCategoryController::class, 'FeeCategoryUpdate'])->name('fee.category.update');
     // Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');
     Route::get('fee/category/delete/{id}', [FeeCategoryController::class, 'FeeCategoryDelete'])->name('fee.category.delete');
     // Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');
     // Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');

     // Fee Category AmountRoutes
     Route::get('fee/amount/view', [FeeAmountController::class, 'ViewFeeAmount'])->name('fee.amount.view');
     Route::get('fee/amount/add', [FeeAmountController::class, 'FeeAmountAdd'])->name('fee.amount.add');
     Route::post('fee/amount/store', [FeeAmountController::class, 'FeeAmountStore'])->name('store.fee.amount');
     Route::get('fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'FeeAmountEdit'])->name('fee.amount.edit');
     Route::post('fee/amount/update/{fee_category_id}', [FeeAmountController::class, 'FeeAmountUpdate'])->name('fee.amount.update');
     Route::get('fee/amount/details/{fee_category_id}', [FeeAmountController::class, 'FeeAmountDetails'])->name('fee.amount.details');




});


