<?php

use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::resource('module', ModuleController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
});
