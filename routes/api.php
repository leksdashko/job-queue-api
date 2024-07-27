<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmissionController;

Route::post('/submit', [SubmissionController::class, 'submit']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
