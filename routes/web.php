<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth'])->group(function(){
    Route::get('', [App\Http\Controllers\DashboardController::class, 'index']);
});

Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
