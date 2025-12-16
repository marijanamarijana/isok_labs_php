<?php

use App\Http\Controllers\CoordinatorApiController;
use App\Http\Controllers\EventApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('events')->group(function () {
    Route::get('/', [EventApiController::class, 'index']);
    Route::post('/', [EventApiController::class, 'store']);
    Route::get('/{id}', [EventApiController::class, 'show']);
    Route::put('/{id}', [EventApiController::class, 'update']);
    Route::delete('/{id}', [EventApiController::class, 'destroy']);
});


Route::prefix('coordinators')->group(function () {
    Route::get('/', [CoordinatorApiController::class, 'index']);
    Route::post('/', [CoordinatorApiController::class, 'store']);
    Route::get('/{id}', [CoordinatorApiController::class, 'show']);
    Route::put('/{id}', [CoordinatorApiController::class, 'update']);
    Route::delete('/{id}', [CoordinatorApiController::class, 'destroy']);
});
