<?php
use Illuminate\Support\Facades\Route;

Route::get(
    '/test',
    [
        \App\Http\Controllers\Test\TestController::class,
        'index'
    ]
)->middleware('auth')->name('dashboard');
