<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Roles
    Route::resource('roles', RoleController::class);

    // Routes cho Permissions
    Route::resource('permissions', PermissionController::class);
});
