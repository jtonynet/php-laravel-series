<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SeriesController;
use App\Http\Controllers\Api\UploadImageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::get('/series', [SeriesController::class, 'index']);

Route::apiResource("/series", SeriesController::class);
Route::get('/series', [SeriesController::class, 'index']);

Route::post('/upload', [UploadImageController::class, 'upload']);
