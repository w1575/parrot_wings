<?php


use Illuminate\Support\Facades\Route;

Route::get(
    '/users',
    [
        \App\Http\Controllers\Api\UsersController::class,
        'index'
    ]
)->middleware('auth:sanctum');


