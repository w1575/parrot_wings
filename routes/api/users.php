<?php


use Illuminate\Support\Facades\Route;

Route::get(
    '/users',
    [
        \App\Http\Controllers\Api\UsersController::class,
        'index'
    ]
)->middleware('auth:sanctum');

Route::get(
    '/users/{id}',
    [
        \App\Http\Controllers\Api\UsersController::class,
        'view'
    ]
)->middleware('auth:sanctum');


