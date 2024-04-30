<?php

use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group( function () {
    Route::resource('users', UserManagementController::class);
});

