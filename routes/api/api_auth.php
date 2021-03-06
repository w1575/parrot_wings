<?php

use \App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::delete('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth:sanctum')
;

