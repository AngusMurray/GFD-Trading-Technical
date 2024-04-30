<?php

use App\Http\Controllers\DepartmentsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group( function () {
    Route::get('departments', DepartmentsController::class)->name('department.dashboard');
});

