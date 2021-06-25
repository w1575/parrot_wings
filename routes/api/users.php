<?php


use Illuminate\Support\Facades\Route;

Route::group(['auth:sanctum'], function() {


    Route::get('/users', [\App\Http\Controllers\Api\UsersController::class, 'index']);

});
