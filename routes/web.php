<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Models\Batch;
use Illuminate\Support\Facades\Route;

Route::get('', function () {return view('layout');});
Route::resource('students/', StudentController:: class);
Route::get('/students/{id}', [StudentController::class, 'show']);
Route::get('/students/{id}/edit', [StudentController::class, 'edit']);
Route::patch('/students/{id}', [StudentController::class, 'update']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);

Route::resource('teachers/', TeacherController:: class);
Route::get('/teachers/{id}', [TeacherController::class, 'show']);
Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit']);
Route::patch('/teachers/{id}', [TeacherController::class, 'update']);
Route::delete('/teachers/{id}', [TeacherController::class, 'destroy']);

Route::resource('courses/', CourseController:: class);
Route::get('/courses/{id}', [CourseController::class, 'show']);
Route::get('/courses/{id}/edit', [CourseController::class, 'edit']);
Route::patch('/courses/{id}', [CourseController::class, 'update']);
Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

Route::resource('batches/', BatchController:: class);
Route::get('/batches/{id}', [BatchController::class, 'show']);
Route::get('/batches/{id}/edit', [BatchController::class, 'edit']);
Route::patch('/batches/{id}', [BatchController::class, 'update']);
Route::delete('/batches/{id}', [BatchController::class, 'destroy']);


Route::resource('enrollments/', EnrollmentController:: class);
Route::get('/enrollments/{id}', [EnrollmentController::class, 'show']);
Route::get('/enrollments/{id}/edit', [EnrollmentController::class, 'edit']);
Route::patch('/enrollments/{id}', [EnrollmentController::class, 'update']);
Route::delete('/enrollments/{id}', [EnrollmentController::class, 'destroy']);

Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);




