<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Imdex page
Route::get('index', [AdminController::class, 'index'])->name('index');

//Rgister Table
Route::get('register-page', [AdminController::class, 'RegisterPage'])->name('register.page');
Route::post('register', [AdminController::class, 'RegisterCreate'])->name('register.create');

//Login Table
Route::get('/', [AdminController::class, 'LoginPage'])->name('login.page');
Route::get('login', [AdminController::class, 'LoginCreate'])->name('login.create');
//logout
Route::middleware('auth')->get('logout', [AdminController::class, 'Logout'])->name('logout');


route::middleware(['auth', 'role:admin'])->group(function () {
    // Users Table
    Route::get('user-details', [AdminController::class, 'User'])->name('user');
    Route::post('user-register', [AdminController::class, 'UserCreate'])->name('user.create');
    Route::get('user-edit/{id}', [AdminController::class, 'UserEdit'])->name('user.edit');
    Route::post('user-update/{id}', [AdminController::class, 'UserUpdate'])->name('user.update');
    Route::get('user-delete/{id}', [AdminController::class, 'UserDelete'])->name('user.delete');
    //login details
    Route::get('login-details', [AdminController::class, 'LoginDetails'])->name('login.details');
});

route::middleware(['auth', 'role:admin,agent'])->group(function () {
    // Employee Table
    Route::get('employee_details', [AdminController::class, 'EmpShow'])->name('emp.show');
    Route::post('employee', [AdminController::class, 'Employee'])->name('emp.store');
    Route::get('employee-edit/{id}', [AdminController::class, 'EmpEdit'])->name('emp.edit');
    Route::post('employee-update/{id}', [AdminController::class, 'EmpUpdate'])->name('emp.update');
    Route::get('employee-delete/{id}', [AdminController::class, 'EmpDelete'])->name('emp.delete');
});
