<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth'])->group(function(){
    Route::get('', [App\Http\Controllers\DashboardController::class, 'index']);
    Route::post('update-price', [App\Http\Controllers\DashboardController::class, 'updatePrice']);

    Route::group(['prefix' => 'users'], function(){
        Route::get('', [App\Http\Controllers\UsersController::class, 'index']);
        Route::post('create', [App\Http\Controllers\UsersController::class, 'store']);
        Route::get('edit/{id}', [App\Http\Controllers\UsersController::class, 'edit']);
        Route::put('edit/{id}', [App\Http\Controllers\UsersController::class, 'update']);
        Route::get('delete/{id}', [App\Http\Controllers\UsersController::class, 'delete']);
    });
});

Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
