<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\ColorssController;
use App\Http\Controllers\DesignersController;
use App\Http\Controllers\ExtrassController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\YearsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cars/create', [CarsController::class, 'create'])->name('cars.create');
    Route::get('/cars/{car}/edit', [CarsController::class, 'edit'])->name('cars.edit');
    Route::patch('/cars/{car}', [CarsController::class, 'update'])->name('cars.update');
    Route::post('/cars', [CarsController::class, 'store'])->name('cars.store');
    Route::delete('/cars/{car}', [CarsController::class, 'destroy'])->name('cars.destroy');

    Route::get('/colors/create', [ColorssController::class, 'create'])->name('colors.create');
    Route::get('/colors/{car}/edit', [ColorssController::class, 'edit'])->name('colors.edit');
    Route::patch('/colors/{car}', [ColorssController::class, 'update'])->name('colors.update');
    Route::post('/colors', [ColorssController::class, 'store'])->name('colors.store');
    Route::delete('/colors/{car}', [ColorssController::class, 'destroy'])->name('colors.destroy');

    Route::get('/designers/create', [DesignersController::class, 'create'])->name('designers.create');
    Route::get('/designers/{car}/edit', [DesignersController::class, 'edit'])->name('designers.edit');
    Route::patch('/designers/{car}', [DesignersController::class, 'update'])->name('designers.update');
    Route::post('/designers', [DesignersController::class, 'store'])->name('designers.store');
    Route::delete('/designers/{car}', [DesignersController::class, 'destroy'])->name('designers.destroy');

    Route::get('/extras/create', [ExtrassController::class, 'create'])->name('extras.create');
    Route::get('/extras/{car}/edit', [ExtrassController::class, 'edit'])->name('extras.edit');
    Route::patch('/extras/{car}', [ExtrassController::class, 'update'])->name('extras.update');
    Route::post('/extras', [ExtrassController::class, 'store'])->name('extras.store');
    Route::delete('/extras/{car}', [ExtrassController::class, 'destroy'])->name('extras.destroy');

    Route::get('/series/create', [SeriesController::class, 'create'])->name('series.create');
    Route::get('/series/{car}/edit', [SeriesController::class, 'edit'])->name('series.edit');
    Route::patch('/series/{car}', [SeriesController::class, 'update'])->name('series.update');
    Route::post('/series', [SeriesController::class, 'store'])->name('series.store');
    Route::delete('/series/{car}', [SeriesController::class, 'destroy'])->name('series.destroy');

    Route::get('/years/create', [YearsController::class, 'create'])->name('years.create');
    Route::get('/years/{car}/edit', [YearsController::class, 'edit'])->name('years.edit');
    Route::patch('/years/{car}', [YearsController::class, 'update'])->name('years.update');
    Route::post('/years', [YearsController::class, 'store'])->name('years.store');
    Route::delete('/years/{car}', [YearsController::class, 'destroy'])->name('years.destroy');
    
});

require __DIR__.'/auth.php';

Route::get('/cars', [CarsController::class, 'index'])->name('cars.index');
Route::get('/cars/{id}', [CarsController::class, 'show'])->name('cars.show');

Route::get('/colors', [ColorssController::class, 'index'])->name('colors.index');
Route::get('/colors/{id}', [ColorssController::class, 'show'])->name('colors.show');

Route::get('/designers', [DesignersController::class, 'index'])->name('designers.index');
Route::get('/designers/{id}', [DesignersController::class, 'show'])->name('designers.show');

Route::get('/extras', [ExtrassController::class, 'index'])->name('extras.index');
Route::get('/extras/{id}', [ExtrassController::class, 'show'])->name('extras.show');


Route::get('/series', [SeriesController::class, 'index'])->name('series.index');
Route::get('/series/{id}', [SeriesController::class, 'show'])->name('series.show');

Route::get('/years', [YearsController::class, 'index'])->name('years.index');
Route::get('/years/{id}', [YearsController::class, 'show'])->name('years.show');

