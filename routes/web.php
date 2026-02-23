<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DateDistanceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/app', [DateDistanceController::class, 'index'])
    ->name('calculator');

Route::post('/calculate', [DateDistanceController::class, 'calculate'])
    ->name('calculate');
