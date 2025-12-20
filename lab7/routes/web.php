<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('courses', CourseController::class);

Route::get('/courses/{course}/enroll', [EnrollmentController::class, 'create'])
    ->name('enrollments.create');

Route::post('/enrollments', [EnrollmentController::class, 'store'])
    ->name('enrollments.store');

Route::put('/enrollments/{enrollment}/approve', [EnrollmentController::class, 'approve'])
    ->name('enrollments.approve');

Route::put('/enrollments/{enrollment}/drop', [EnrollmentController::class, 'drop'])
    ->name('enrollments.drop');

