<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransactionsController;


Route::post(
    '/transactions',
        [
            TransactionsController::class, 'create'
        ]
    )
    ->middleware('auth:sanctum')
;

