<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\ColorsController;
use App\Http\Controllers\DesignersController;
use App\Http\Controllers\ExtrasController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\YearsController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('cars', CarsController::class);
Route::resource('colors', ColorsController::class);
Route::resource('designers', DesignersController::class);
Route::resource('extras', ExtrasController::class);
Route::resource('series', SeriesController::class);
Route::resource('years', YearsController::class);