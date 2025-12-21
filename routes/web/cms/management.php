<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'management',
    'as' => 'management.',
], function () {
    Route::resource('permissions', \App\Http\Controllers\Cms\Management\PermissionController::class);
    Route::resource('roles', \App\Http\Controllers\Cms\Management\RoleController::class);
});
