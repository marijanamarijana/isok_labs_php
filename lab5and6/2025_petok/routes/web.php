<?php

use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('coordinators', CoordinatorController::class);
Route::resource('events', EventController::class);
