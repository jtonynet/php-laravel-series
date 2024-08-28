<?php

use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\EpisodesController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/series');
});

Route::resource('/series', SeriesController::class)
    ->except(['show']);

Route::get('series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index');

Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index'])->name('episodes.index');
Route::post('/seasons/{season}/episodes', function (FormRequest $request) {
    dd($request->all());
});
